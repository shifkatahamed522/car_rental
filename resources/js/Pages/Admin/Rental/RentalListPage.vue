<template>
    <SideNavLayout>
        <RentalList/>
    </SideNavLayout>
</template>


<script setup>
import { defineProps } from 'vue';
import SideNavLayout from "../../../Layout/Admin/SideNavLayout.vue";
import RentalList from "../../../Components/Rental/RentalList.vue";


</script>