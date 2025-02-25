<?php

use App\Http\Controllers\Admin\AdminCarController;
use App\Http\Controllers\Admin\AdminRentalController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\CarController;
use App\Http\Controllers\Frontend\FrontendRentalController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TokenVerificationMiddleware;

//Public Routes (No Authentication Required)
Route::get('/', [HomeController::class, 'HomePage'])->name('HomePage');


// ================== User Routes ==================

Route::post('/user-registration', [UserController::class, 'userRegistration'])->name('userRegistration');
Route::post('/user-login', [UserController::class, 'userLogin'])->name('userLogin');
Route::get('/user-logout', [UserController::class, 'UserLogout'])->name('UserLogout')->middleware(TokenVerificationMiddleware::class);

// User Page Routes
Route::get('/registration-page', [UserController::class, 'RegistrationPage'])->name('RegistrationPage');
Route::get('/login-page', [UserController::class, 'LoginPage'])->name('LoginPage');
Route::get('/admin-logout', [UserController::class, 'AdminLogout'])->name('AdminLogout')->middleware(TokenVerificationMiddleware::class);

// ================== Dashboard Routes ==================

// Dashboard Routes (Protected)
Route::get('/admin-dashboard-page', [UserController::class, 'AdminDashboardPage'])->name('AdminDashboardPage')->middleware(TokenVerificationMiddleware::class);
Route::get('/customer-dashboard-page', [UserController::class, 'CustomerDashboardPage'])->name('CustomerDashboardPage')->middleware(TokenVerificationMiddleware::class);


// ================== Admin Car Routes ==================

// Car Routes (Anyone Can View)
Route::get('/carlist', [AdminCarController::class, 'carList'])->name('carList')->middleware(TokenVerificationMiddleware::class);

//Admin Routes (Car Management - Requires Auth)
Route::get('/car-save-page', [AdminCarController::class, 'carSavePage'])->name('carSavePage');
Route::post('/car-save', [AdminCarController::class, 'saveCar'])->name('saveCar');
Route::get('/admin/delete-car/{id}', [AdminCarController::class, 'deleteCar'])->name('deleteCar');
Route::post('/admin/update-car', [AdminCarController::class, 'updateCar'])->name('car-update');



// ================== Admin Customer Routes ==================

Route::post("/create-customer",[CustomerController::class,'CustomerCreate'])->middleware(TokenVerificationMiddleware::class);
Route::get('/CustomerPage', [CustomerController::class, 'CustomerPage'])->name('CustomerPage')->middleware(TokenVerificationMiddleware::class);
Route::get('/CustomerSavePage', [CustomerController::class, 'CustomerSavePage'])->name('CustomerSavePage')->middleware(TokenVerificationMiddleware::class);
Route::get("/list-customer",[CustomerController::class,'CustomerList'])->middleware(TokenVerificationMiddleware::class);
Route::get("/delete-customer/{id}",[CustomerController::class,'CustomerDelete'])->middleware(TokenVerificationMiddleware::class);
Route::post("/update-customer",[CustomerController::class,'CustomerUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::post("/customer-by-id",[CustomerController::class,'CustomerByID'])->middleware(TokenVerificationMiddleware::class);


// ==================Admin Rental Routes ==================

Route::get("/Admin-Rental-ListPage", [AdminRentalController::class, 'rentals'])->middleware(TokenVerificationMiddleware::class);
Route::get("/RentalSavePage", [AdminRentalController::class, 'rentalSavePage'])->middleware(TokenVerificationMiddleware::class);
Route::post("/admin-rental-save", [AdminRentalController::class, 'rentalSave'])->middleware(TokenVerificationMiddleware::class);
Route::post("/admin-rental-update", [AdminRentalController::class, 'rentalUpdate'])->middleware(TokenVerificationMiddleware::class);
Route::get("/admin-rental-delete", [AdminRentalController::class, 'rentalDelete'])->middleware(TokenVerificationMiddleware::class);



// ==================User Rental Routes ==================
Route::get('/ProfilePage', [UserController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);
//User Car Details show
Route::get('/car-details', [CarController::class, 'CarDetails'])->name('CarDetails');

//User Rental
Route::get('/user-rental-listPage', [FrontendRentalController::class, 'UserRentals'])->middleware(TokenVerificationMiddleware::class);
Route::get('/CustomerRentalSavePage', [FrontendRentalController::class, 'CustomerRentalSavePage'])->middleware(TokenVerificationMiddleware::class);
Route::post('/user-rental-save', [FrontendRentalController::class, 'UserRentalSave'])->middleware(TokenVerificationMiddleware::class);
Route::get('/user-rental-delete', [FrontendRentalController::class, 'UserRentalDelete'])->middleware(TokenVerificationMiddleware::class);


