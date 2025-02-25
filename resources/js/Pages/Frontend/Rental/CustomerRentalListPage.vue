<template>
    <SideNavLayout>
        <CustomerRentalList/>
    </SideNavLayout>
</template>


<script setup>
import { defineProps } from 'vue';
import SideNavLayout from "../../../Layout/Customer/SideNavLayout.vue";
import CustomerRentalList from "../../../Components/Rental/CustomerRentalList.vue";


</script>