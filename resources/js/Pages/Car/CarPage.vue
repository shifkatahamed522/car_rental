<template>
  <SideNavLayout>
    <CarList :cars="cars" /> <!-- Passing the 'cars' prop to CarList.vue -->
  </SideNavLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import SideNavLayout from "../../Layout/Admin/SideNavLayout.vue";
import CarList from "../../Components/Car/CarList.vue";

// Receiving the 'cars' prop from Laravel controller (AdminCarController)
defineProps({
  cars: Array,  // This will contain the array of cars
});
</script>
