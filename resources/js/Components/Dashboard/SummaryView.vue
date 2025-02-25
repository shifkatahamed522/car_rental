<template>
    <div class="container-fluid">
      <!-- Stats Cards -->
      <div class="row">
        <nav class="navbar navbar-light bg-white shadow-sm p-3 mb-4">
        <div class="container-fluid d-flex justify-content-between align-items-center">
          <!-- Toggle Sidebar Button -->
          
  
          <!-- Search Bar -->
          <div class="search-bar">
            <input type="text" class="form-control" placeholder="Search">
          </div>
  
          <!-- User Actions -->
          <div class="d-flex align-items-center">
            <i class="fas fa-bell me-3"></i>
            <div class="dropdown">
              <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                <!-- <img :src="userImage" alt="User" class="rounded-circle me-2" width="30"> -->
                {{page.props.user.name}}
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
        <div class="col-md-3">
          <div class="card stats-card bg-primary text-white">
            <div class="card-body">
              <i class="fas fa-car fa-2x"></i>
              <h5 class="card-title">Total Cars</h5>
              <h3>{{ page.props.totalCar }}</h3>
            </div>
          </div>
        </div>
  
        <div class="col-md-3">
          <div class="card stats-card bg-info text-white">
            <div class="card-body">
              <i class="fas fa-car-side fa-2x"></i>
              <h5 class="card-title">Available Cars</h5>
              <h3>{{ page.props.availableCar }}</h3>
            </div>
          </div>
        </div>
  
        <div class="col-md-3">
          <div class="card stats-card bg-success text-white">
            <div class="card-body">
              <i class="fas fa-receipt fa-2x"></i>
              <h5 class="card-title">Total Rentals</h5>
              <h3>{{ page.props.rentals }}</h3>
            </div>
          </div>
        </div>
  
        <div class="col-md-3">
          <div class="card stats-card bg-danger text-white">
            <div class="card-body">
              <i class="fas fa-dollar-sign fa-2x"></i>
              <h5 class="card-title">Total Earnings</h5>
              <h3>${{ page.props.total }}</h3>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Charts -->
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
              <span>Worldwide Sales</span>
              <a href="#" class="text-white">Show All</a>
            </div>
            <div class="card-body">
              <canvas id="salesChart"></canvas>
            </div>
          </div>
        </div>
  
        <div class="col-md-6">
          <div class="card">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
              <span>Sales & Revenue</span>
              <a href="#" class="text-white">Show All</a>
            </div>
            <div class="card-body">
              <canvas id="revenueChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>


  import { usePage } from '@inertiajs/vue3';
  import Chart from "chart.js/auto";

  const page = usePage()
  console.log(page.props.availableCar)
  // Store dashboard stats
  

  // Fetch stats from backend
  
  
  // Initialize data and charts
  
  </script>
  
  <style scoped>
  .stats-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px;
    border-radius: 10px;
  }
  
  .stats-card i {
    font-size: 30px;
    opacity: 0.8;
  }
  
  .card {
    border-radius: 10px;
  }
  
  .card-header {
    font-weight: bold;
  }
  
  canvas {
    width: 100% !important;
    height: 200px !important;
  }
  </style>
  