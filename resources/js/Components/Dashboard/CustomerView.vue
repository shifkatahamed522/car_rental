<template>
    <div class="main-content">
      <!-- Top Navbar -->
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
  
      <!-- Dashboard Stats -->
      <div class="container-fluid">
        <h2 class="mb-4">Welcome To Dashboard</h2>
  
        <div class="row">
          
  
          <div class="col-md-4">
            <div class="card dashboard-card">
              <div class="card-body text-center">
                <i class="fas fa-receipt fa-2x text-success"></i>
                <h5 class="card-title">Total Rentals</h5>
                <h3>{{ page.props.rentals }}</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Footer -->
      
    </div>
  </template>
  
  <script setup>
  import { usePage } from '@inertiajs/vue3';
  import Chart from "chart.js/auto";

  const page = usePage()
  console.log(page.props.availableCar)


  </script>
  
  <style scoped>
  /* Main Content Layout */
  .main-content {
    
    padding: 20px;
    transition: margin-left 0.3s ease-in-out;
  }
  
  /* Responsive Sidebar Toggle */
  @media (max-width: 768px) {
    .main-content {
      margin-left: 0;
    }
  }
  
  /* Dashboard Cards */
  .dashboard-card {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
  }
  
  .dashboard-card:hover {
    transform: scale(1.05);
  }
  
  /* Navbar */
  .search-bar {
    width: 200px;
  }
  
  .navbar img {
    border: 2px solid #ddd;
    padding: 2px;
  }
  
  /* Footer */
  footer {
    font-size: 14px;
    color: gray;
  }
  </style>
  