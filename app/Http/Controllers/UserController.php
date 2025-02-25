<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{

    public function RegistrationPage(){
        return Inertia::render('Auth/RegistrationPage');
    }

    public function LoginPage(){
        return Inertia::render('Auth/LoginPage');
    }

    public function AdminDashboardPage(){
        $availableCar=Car::where('availability','=','Available')->count();
        $totalCar=Car::count();
        $rentals=Rental::count();
        $total=Rental::sum('total_cost');
        $data=[
            'availableCar'=>$availableCar,
            'totalCar'=>$totalCar,
            'rentals'=>$rentals,
            'total'=>$total
        ];
    
        return Inertia::render('Dashboard/AdminDashboardPage',$data);
    }

    public function CustomerDashboardPage(Request $request){

        $availableCar=Car::where('availability','=','Available')->count();
        $totalCar=Car::count();
        $rentals=Rental::where('user_id', $request->header('user_id'))->count();
        $total=Rental::sum('total_cost');
        $data=[
            'availableCar'=>$availableCar,
            'totalCar'=>$totalCar,
            'rentals'=>$rentals,
            'total'=>$total
        ];
        return Inertia::render('Dashboard/CustomerDashboardPage', $data);
    }


    function ProfilePage(Request $request)
    {
        $email=$request->header('email');
        $user=User::where('email','=',$email)->first();
        return Inertia::render('Frontend/ProfilePage',['list'=>$user]);
    }

    
   


    public function userRegistration(Request $request){


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



        return redirect()->route('LoginPage');
    }

    public function userLogin(Request $request){
       
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        $userEmail=$request->email;
        $userPassword=$request->password;

        $user = User::where('email', $userEmail)->where('password', $userPassword)->first();
        
        if ($user) {
            $token = JWTToken::createToken($user->id,$user->email,$user->role);
            if ($user->role == 'admin') {
                $request->session()->put('name', $user->name);
                return redirect ('/admin-dashboard-page')->cookie('token', $token, 60 * 24);
            }
            else {
                $request->session()->put('name', $user->name);
                return redirect ('/customer-dashboard-page')->cookie('token', $token, 60 * 24);
            }
            
            } else {
            return response()->json(['message' => 'Invalid email or password'], 401);
            }
    }

    public function readProfile(Request $request){
        $userId=$request->header('user_id');
        $userEmail=$request->header('user_email');
        $user = User::where('id', $userId)->where('email', $userEmail)->first();
        return $user;
    }

    function AdminLogout(Request $request){
        $request->session()->flush();
        return redirect()->route('LoginPage')->cookie('token', null, -1);
    }

    function UserLogout(Request $request){
        $request->session()->flush();
        return redirect()->route('LoginPage')->cookie('token', null, -1);
    }
}
