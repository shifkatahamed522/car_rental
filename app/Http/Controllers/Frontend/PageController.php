<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    public function RegistrationPage(){
        return Inertia::render('Auth/RegistrationPage');
    }

    public function LoginPage(){
        return Inertia::render('Auth/LoginPage');
    }

    public function DashboardPage(){
        return Inertia::render('Admin/DashboardPage');
    }
    public function CustomerDashboardPage(){
        return Inertia::render('Customer/DashboardPage');
    }

    
   
}
