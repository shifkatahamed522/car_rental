<template>
    <div class="container">
      <h2 class="text-center my-4">Available Cars</h2>
      <div class="row">
        <div class="col-md-4" v-for="car in cars" :key="car.id">
          <div class="card">
            <img :src="`/images/${car.image}`" class="card-img-top" alt="Car Image" />
            <div class="card-body">
              <h5 class="card-title">{{ car.name }}</h5>
              <p class="card-text">Brand: {{ car.brand }}</p>
              <p class="card-text">Daily Rent: ${{ car.daily_rent_price }}</p>
              <Link :href="`/rental-form/${car.id}`" class="btn btn-primary">Rent Now</Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { usePage, Link } from "@inertiajs/vue3";
  const page = usePage();
  const cars = page.props.cars;
  </script>
  