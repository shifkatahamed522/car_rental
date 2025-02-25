<?php

namespace App\Http\Controllers;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function HomePage()
{
    // Fetch latest cars first (sorted by 'id' in descending order)
    $featuredCars = Car::orderBy('id', 'desc') // Or use ->orderBy('created_at', 'desc') if you want by date
                       ->select('id', 'name', 'brand', 'daily_rent_price', 'image')
                       ->get();

    return Inertia::render('HomePage', [
        'data' => $featuredCars
    ]);
}


}
