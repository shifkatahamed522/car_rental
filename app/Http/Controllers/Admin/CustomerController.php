<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{


    public function CustomerList()
    {
        // Fetch all cars sorted in descending order by ID (latest cars first)
        $customers = User::orderBy('id', 'desc')->get();
    
        return Inertia::render('Customer/CustomerPage', [
            'customers' => $customers
        ]);
    }

    public function CustomerSavePage(Request $request)
    {
        $id=$request->query('id');
        $customers = User::where('id', $id)->first();
    
        return Inertia::render('Customer/CustomerSavePage', ['customers' => $customers]);
    }

    public function CustomerCreate(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return  redirect("/list-customer");
    }

    public function CustomerUpdate(Request $request){

        $request->validate([
            'name' => 'required',
            'password' => 'required|min:8',
        ]);
        User::where('id',$request->id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return  redirect("/list-customer");
    }

    function CustomerDelete(Request $request){

        try {
            $customer=$request->id;
        
            User::where('id',$customer)->delete();
            $data =['message'=>'Delete Successful','status'=>true,'error'=>''];
            return  redirect("/list-customer");
        }catch (Exception $e){
            $data =['message'=>'Delete Fail','status'=>false,'error'=>''];
            return  redirect("/list-customer");
        }

    }





    
    
}
