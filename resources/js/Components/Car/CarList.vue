<script setup>
import { usePage, router, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
let page = usePage();

// Table Headers
const Header = [
  { text: "No", value: "id" },
  { text: "Image", value: "image" },
  { text: "Name", value: "name" },
  { text: "Brand", value: "brand" },
  { text: "Model", value: "model" },
  { text: "Year", value: "year" },
  { text: "Car Type", value: "car_type" },
  { text: "Daily Rent Price", value: "daily_rent_price" },
  { text: "Availability", value: "availability" },
  { text: "Action", value: "actions" },
];

// Fetch and Sort Cars Data (Latest First)
const Item = computed(() => {
  return [...page.props.cars].sort((a, b) => b.id - a.id);
});

// Search
const searchValue = ref("");

// Handle Delete Car
const deleteCar = (id) => {
  if (confirm("Are you sure you want to delete this car?")) {
    router.get(`/admin/delete-car/${id}`);
  }
};

// Flash Message Handling
if (page.props.flash?.status === true) {
  toaster.success(page.props.flash.message);
}

if (page.props.flash?.status === false) {
  toaster.warning(page.props.flash.message);
}
</script>

  
<template>
    <div class="container-fluid">
      <div class="row">
        <nav class="navbar navbar-light bg-white shadow-sm p-3 mb-4">
        <div class="container-fluid d-flex justify-content-between align-items-center">
          <!-- Toggle Sidebar Button -->
  
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
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div>
                <h3>Manage Cars</h3>
              </div>
              <hr />
  
              <!-- Add New Car Button -->
              <div class="float-end">
                <Link :href="`/car-save-page?id=${0}`" class="btn btn-success btn-sm">
                  Add Car
                </Link>
              </div>
  
              <!-- Search Input -->
              <div>
                <input
                  placeholder="Search..."
                  class="form-control mb-2 w-auto form-control-sm"
                  type="text"
                  v-model="searchValue"
                />
  
                <!-- EasyDataTable for Admin -->
                <EasyDataTable
                  buttons-pagination
                  alternating
                  :headers="Header"
                  :items="Item"
                  :rows-per-page="5"
                  :search-field="searchField"
                  :search-value="searchValue"
                >
                  <!-- Custom Image Slot -->
                  <template #item-image="{ image }">
                    <img :src="`/images/${image}`" alt="Car Image" height="40px" width="60px" />
                  </template>
  
                  <!-- Custom Action Slot -->
                  <template #item-actions="{ id }">
                    <Link class="btn btn-success mx-2 btn-sm" :href="`/car-save-page?id=${id}`">Edit</Link>
                    <button class="btn btn-danger btn-sm" @click="deleteCar(id)">Delete</button>
                  </template>
                </EasyDataTable>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  