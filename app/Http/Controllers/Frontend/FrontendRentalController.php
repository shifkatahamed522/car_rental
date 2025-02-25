<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrontendRentalController extends Controller
{

    public function UserRentals(Request $request){
        $id=$request->header('user_id');
        $rentals=Rental::where('user_id', $id)->orderBy('id', 'desc')->with('car','user')->get();
        return Inertia::render('Frontend/Rental/CustomerRentalListPage',['rentals'=>$rentals]);
    }

    // Show all available cars for rent
    public function UserRentalSave(Request $request){
        $start_date= date('Y-m-d', strtotime($request->input('start_date')));
        $end_date= date('Y-m-d', strtotime($request->input('end_date')));
        $count=Rental::where('car_id', $request->car_id)->whereBetween('start_date', [$start_date, $end_date ])->count();
        if(!$count){
            $id=$request->header('user_id');
                $startDate=Carbon::parse($request->input('start_date'));
                $endDate=Carbon::parse($request->input('end_date'));
                $days=$startDate->diffInDays($endDate);
                $dailyRentPrice=Car::where('id','=',$request->car_id)->first()->daily_rent_price;
                $totalCost=$days*$dailyRentPrice;

            Rental::Create([
                'car_id' => $request->car_id,
                'user_id' => $id,
                'total_cost' =>$totalCost,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return redirect('/user-rental-listPage');
        }
        else{
            return "Already Book on this date";
        }
        
      

    }

    public function UserRentalDelete(Request $request){
        $id=$request->query('id');
        Rental::where('id',$id)->delete();
        return redirect('/user-rental-listPage');
    }
}
