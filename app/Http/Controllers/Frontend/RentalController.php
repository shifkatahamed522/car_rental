<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Rental;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function rentCar(Request $request){
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
       return redirect('/Admin-Rental-ListPage');

       return response()->json(['message' => 'Car rented successfully'], 200);

    }

    public function removeCarRental(Request $request){
        $userId=$request->header('user_id');
        $carId=$request->query('id');

        Rental::where('car_id', $carId)->where('user_id', $userId)->delete();

        return response()->json(['message' => 'Car removed successfully'], 200);
    }
}
