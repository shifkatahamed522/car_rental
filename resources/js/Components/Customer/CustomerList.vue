<script setup>
import { usePage, router, Link } from '@inertiajs/vue3'
import { ref, computed } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
let page = usePage();

const Header = [
    { text: "No", value: "id" },
    { text: "Name", value: "name" },
    { text: "Email", value: "email" },
    { text: "Action", value: "number" },
];

// Ensure customers exist
const Item = computed(() => page.props.customers || []);
const searchValue = ref("");
const searchField = ref("name"); // Define the missing variable

// Fixing potential undefined flash error
if (page.props.flash?.status === true) {
    toaster.success(page.props.flash.message);
}

if (page.props.flash?.status === false) {
    toaster.warning(page.props.flash.message);
}

const DeleteClick = (id) => {

    let text = "Do you want to delete this customer?";
    if (confirm(text) === true) {
        router.get(`/delete-customer/${id}`)
    }
};
</script>

<template>
    <div class="container-fluid">
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
            <div class="col-12"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h3>Customer</h3>
                        </div>
                        <hr />
                        <div class="float-end">
                            <Link href="/CustomerSavePage?id=0" class="btn btn-success mx-3 btn-sm">
                                Add Customer
                            </Link>
                        </div>

                        <!-- Search & Table -->
                        <div>
                            <input 
                                placeholder="Search..." 
                                class="form-control mb-2 w-auto form-control-sm" 
                                type="text" 
                                v-model="searchValue"
                            />
                            <EasyDataTable 
                                buttons-pagination 
                                alternating 
                                :headers="Header" 
                                :items="Item" 
                                :rows-per-page="10" 
                                :search-field="searchField"  
                                :search-value="searchValue"
                            >
                                <template #item-number="{ id }">
                                    <Link class="btn btn-success mx-3 btn-sm" :href="`/CustomerSavePage?id=${id}`">Edit</Link>
                                    <button class="btn btn-danger btn-sm" @click="DeleteClick(id)">Delete</button>
                                </template>
                            </EasyDataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
