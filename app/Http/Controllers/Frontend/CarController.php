<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Inertia\Inertia;

class CarController extends Controller
{
//     public function carList(Request $request){
//         $carList=Car::where('availability','=','available')->get();
//         //return Inertia::render('Home',['carList'=>$carList]);
//         return $carList;
//    }

//    public function carListByBrand(Request $request){
//        $carList=Car::where('brand','=',$request->brand)->get();
//        return $carList;
//    }

//    public function carListByType(Request $request){
//        $carList=Car::where('car_type','=',$request->type)->get();
//        return $carList;
//    }//

    public function CarDetails(Request $request){
        $carDetails=Car::where('id','=',$request->id)->first();
        return Inertia::render('Frontend/CarDetails',['carDetails'=>$carDetails]);
    }
}
