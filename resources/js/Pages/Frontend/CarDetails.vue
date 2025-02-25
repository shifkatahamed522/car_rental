<script setup>
import { Link, usePage, useForm } from '@inertiajs/vue3';
const page = usePage();

const form = useForm({
    car_id: page.props.carDetails.id,
    start_date: '',
    end_date: '',
});
 
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
      <h2 class="text-center mb-4">Car Details</h2>
    </div>
  </header>

  <section class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <img :src="`/images/${page.props.carDetails.image}`" class="card-img-top" alt="Car Image" />
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ page.props.carDetails.name }}</h5>
                    <p class="card-text">Brand: {{ page.props.carDetails.brand }}</p>
                    <p class="card-text">Daily Rent: ${{ page.props.carDetails.daily_rent_price }}</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Start Date</label>
                            <input v-model="form.start_date" type="date" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">End Date</label>
                            <input v-model="form.end_date" type="date" class="form-control">
                        </div>
                    </div>
                    <button @click="form.post('/user-rental-save')" class="btn btn-primary">Rent Now</button>
                </div>
            </div>

        </div>
    </div>
  </section>
 
</template>
 
<style scoped>
 
</style>