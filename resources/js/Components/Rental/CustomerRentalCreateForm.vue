<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage();

let buttonTitle = 'Update A Rent';
let title = 'Create A Rent';
const id = new URLSearchParams(window.location.search).get('id');

const form = useForm({
    customer_id: '',
    car_id: '',
    start_date: '',
    end_date: '',
    status: '',
    id: id
});

let URL = '/user-rental-save';

if (id !== 0 && page.props.rental !== null) {
    buttonTitle = 'Update a Rent';
    title = 'Update a Rent';
    URL = '/admin-rental-update';
    form.customer_id = page.props.rental.user.id;
    form.car_id = page.props.rental.car.id;
    form.start_date = page.props.rental.start_date;
    form.end_date = page.props.rental.end_date;
    form.status = page.props.rental.status;
}

function saveRental() {
    form.post(URL);
}
</script>

<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Customer</label>
                            <select v-model="form.customer_id" class="form-select">
                                <option selected disabled>Select Customer</option>
                                <option v-for="(user, i) in page.props.users" :key="i" :value="user.id">
                                    {{ user.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Car</label>
                            <select v-model="form.car_id" class="form-select">
                                <option selected disabled>Select Car</option>
                                <option v-for="(car, i) in page.props.cars" :key="i" :value="car.id">
                                    {{ car.name }}
                                </option>
                            </select>
                        </div>
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
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select v-model="form.status" class="form-select">
                                <option value="Cancelled">Cancelled</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button @click="saveRental()" class="btn btn-success">{{ buttonTitle }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
