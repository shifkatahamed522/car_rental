<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
class AdminCarController extends Controller
{


    public function carList()
    {
        // Fetch all cars sorted in descending order by ID (latest cars first)
        $cars = Car::orderBy('id', 'desc')->get();
    
        return Inertia::render('Car/CarPage', [
            'cars' => $cars
        ]);
    }



    public function carSavePage(Request $request)
    {
        $car_id=$request->query('id');
        $car = Car::where('id', $car_id)->first();
        if ($car && $car->image) {
            $car->image = asset('images/' . $car->image);
        }
        return Inertia::render('Car/CarSavePage', ['car' => $car]);
    }

    // ✅ Store or Update Car Data
    public function saveCar(Request $request)
    {
        $data=$request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'car_type' => 'required',
            'daily_rent_price' => 'required|numeric',
            'availability' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle Image Upload
        


        if ($request->hasFile('image')) {
            $imagePath = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imagePath);
            $data['image']=$imagePath;
        } else {
            $data['image']=null;
        }

        $data['id']= $request->header('id');
        Car::Create ($data);


        // If updating an existing car
        // if ($request->id) {
        //     $car = Car::findOrFail($request->id);
        //     $car->update([
        //         'name' => $request->name,
        //         'brand' => $request->brand,
        //         'model' => $request->model,
        //         'year' => $request->year,
        //         'car_type' => $request->car_type,
        //         'daily_rent_price' => $request->daily_rent_price,
        //         'availability' => $request->availability,
        //         'image' => $imagePath ? $imagePath : $car->image,
        //     ]);
        // } else {
        //     // If creating a new car
        //     Car::create([
        //         'name' => $request->name,
        //         'brand' => $request->brand,
        //         'model' => $request->model,
        //         'year' => $request->year,
        //         'car_type' => $request->car_type,
        //         'daily_rent_price' => $request->daily_rent_price,
        //         'availability' => $request->availability,
        //         'image' => $imagePath,
        //     ]);
        // }

        return redirect()->route('carList')->with('status', true)->with('message', 'Car saved successfully!');
    }

    public function updateCar(Request $request){
        
        $id=$request->input('id');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName=time().'.'.$file->Extension();
            $file->move(public_path('images'),$fileName);
            $request->merge(['image'=>$fileName]);
            $oldImage=Car::where('id',$id)->first()->image;
            File::delete('images/'.$oldImage);
        }
        // else{
        //     $filter=array_filter($request->all());
        //     return $filter;
        // }
        Car::where('id',$id)->update($request->input());
        return redirect()->route('carList')->with('status', true)->with('message', 'Car updated successfully!');
    }




    public function updateProduct(Request $request){
        try{
         $id=$request->header('id');
 
         $request->validate([
             'name'=>'required|string',
             'price'=>'required|numeric|min:0',
             'qty'=>'required|integer|min:0'
         ]);
         $data=[
             'name'=>$request->input('name'),
             'price'=>$request->input('price'),
             'unit'=>$request->input('qty'),
             'category_id'=>$request->input('category_id')
          ];
 
          if($request->hasFile('image')){
             $file=$request->file('image');
             $fileName=$file->getClientOriginalName();
             $t=time();
             $img_url=$userId.'-'.$t.'-'.$fileName;
             $path='images/'.$image;
             $file->move(public_path('images'),$image);
             $data['image']=$path;
 
             $oldImage=Car::where('user_id','=',$userId)->where('id','=',$request->input('id'))->select('img_url')->first();
             File::delete($oldImage);
             Car::where('user_id','=',$userId)->where('id','=',$request->input('id'))->update($data);
 
          }else{
             Product::where('user_id','=',$userId)->where('id','=',$request->input('id'))->update($data);
          }
          return redirect()->route('productSavePage')->with(['status'=>true,'message'=>'Product updated successfully']);
        }catch(Exception $e){
            return redirect()->route('productSavePage') ->with(['status'=>false,'message'=>'Something went wrong']);
        }
     }







    // ✅ Delete a Car
        public function deleteCar($id)
    {
        Car::destroy($id);
        return redirect()->route('carList')->with('status', true)->with('message', 'Car deleted successfully!');
    }

    // ✅ Fetch all cars for Admin


}
