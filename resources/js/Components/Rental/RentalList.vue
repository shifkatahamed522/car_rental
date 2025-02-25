<script setup>
import { usePage, router, Link } from '@inertiajs/vue3'
import { ref, computed } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster();
let page = usePage();
console.log(page.props.rentals);
const Header = [
    { text: "ID", value: "id" },
    { text: "Customer Name", value: "user.name" },
    { text: "Car Name", value: "car.name" },
    { text: "Car Brand", value: "car.brand" },
    { text: "start Date", value: "start_date" },
    { text: "End Date", value: "end_date" },
    { text: "Total Cost", value: "total_cost" },
    { text: "Status", value: "status" },
    { text: "Action", value: "action" },
];

// Ensure customers exist
const item = ref(page.props.rentals);
// const searchValue = ref("");
// const searchField = ref("name"); // Define the missing variable

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
        router.get(`/admin-rental-delete?id=${id}`)
    }
};
</script>

<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12"></div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h3>Rental</h3>
                        </div>
                        <hr />
                        <div class="float-end">
                            <Link :href="`/RentalSavePage?id=${0}`" class="btn btn-success mx-3 btn-sm">
                                Add Rental
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
                                :items="item" 
                                :rows-per-page="10" 
                                :search-field="searchField"  
                                :search-value="searchValue"
                            >
                                <template #item-action="{ id }">
                                    <Link class="btn btn-success mx-3 btn-sm" :href="`/RentalSavePage?id=${id}`">Edit</Link>
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
