<template>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                
                
                <div class="card">
                <div class="card-body">
                        <div class="float-end">
                            <Link href="/carlist" class="btn btn-success mx-3 btn-sm">
                               Back
                            </Link>
                        </div>
                    <form>
                    <h4>Save Car</h4>
                    <label>Name:</label>
                    <input type="text" v-model="car.name" class="form-control" required />
        
                    <label>Brand:</label>
                    <input type="text" v-model="car.brand" class="form-control" required />
        
                    <label>Model:</label>
                    <input type="text" v-model="car.model" class="form-control" required />
        
                    <label>Year:</label>
                    <input type="number" v-model="car.year" class="form-control" required />
        
                    <label>Car Type:</label>
                    <input type="text" v-model="car.car_type" class="form-control" required />
        
                    <label>Daily Rent Price:</label>
                    <input type="number" v-model="car.daily_rent_price" class="form-control" required />
        
                    <label>Availability:</label>
                    <select v-model="car.availability" class="form-control">
                        <option value="available">Available</option>
                        <option value="not available">Not Available</option>
                    </select>
        
                    <label>Image:</label>
                    <ImageUpload :image="car.image" @image="(e)=>{car.image=e}"/>

                        
                        
                    <!-- <input type="file" class="form-control" @change="handleImageUpload" /> -->
        
                    <button class="btn btn-success mt-3 w-100 " type="button" @click="submitCar">Save Car</button>
                    </form>
                </div>
                </div>
        
            </div>
        </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import { router, usePage, useForm, Link } from "@inertiajs/vue3";
  import SideNavLayout from "../../Layout/Admin/SideNavLayout.vue";
  const page = usePage();
  import ImageUpload from "../../Components/Car/ImageUpload.vue";
  let URL = "/car-save"
  const id=new URLSearchParams(window.location.search).get("id");
  const car = useForm({
    name: "",
    brand: "",
    model: "",
    year: "",
    car_type: "",
    daily_rent_price: "",
    availability: "",
    image: "",
    id:id
  });
  
  
  if(id!==0 && page.props.car!==null){
      car.name=page.props.car.name;
      car.brand=page.props.car.brand;
      car.model=page.props.car.model;
      car.year=page.props.car.year;
      car.car_type=page.props.car.car_type;
      car.daily_rent_price=page.props.car.daily_rent_price;
      car.availability=page.props.car.availability;
      car.image=page.props.car.image;

      URL = '/admin/update-car'
  }

  function submitCar (){
    car.post(URL);
  }
  
  // Handle Image Upload
  
  // Handle Image Upload
 
  </script>
  