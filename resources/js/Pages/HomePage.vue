<script setup>
import { Link, usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">Car Rental</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><Link class="nav-link" href="#">Home</Link></li>
          <li class="nav-item"><Link class="nav-link" href="#">About</Link></li>
          <li class="nav-item"><Link class="nav-link" href="#">Rentals</Link></li>
          <li class="nav-item"><Link class="nav-link" href="#">Contact</Link></li>
          <li class="nav-item"><Link href="/login-page" class="btn w-100 btn-success">Login </Link></li>
          <li class="nav-item"><Link class="btn btn-primary ms-2" href="/registration-page">Signup</Link></li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="hero bg-dark text-white text-center py-5">
    <div class="container">
      <h1 class="display-4">Rent the Best Cars with <span class="text-warning">Affordable Prices</span></h1>
      <p class="lead">Explore a wide range of cars for your trips. From luxury to economy, we have the perfect vehicle for every occasion.</p>
      <Link href="/rentals" class="btn btn-primary btn-lg">Browse Cars</Link>
    </div>
  </header>

  <section class="container my-5">
    <h2 class="text-center mb-4">Featured Cars</h2>
    <div class="row">
      <div v-for="(car, index) in page.props.data" :key="index" class="col-md-4">
        <div class="card">
          <img :src="`/images/${car.image}`" class="card-img-top" alt="Car Image" />

          <div class="card-body">
            <h5 class="card-title">{{ car.name }}</h5>
            <p class="card-text">Brand: {{ car.brand }}</p>
            <p class="card-text">Daily Rent: ${{ car.daily_rent_price }}</p>
            <Link :href="`/car-details?id=${car.id}`" class="btn btn-primary">Rent Now</Link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style>

</style>
