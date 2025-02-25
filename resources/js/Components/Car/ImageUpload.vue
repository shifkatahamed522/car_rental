<script setup>

import { ref } from "vue";

const props = defineProps({
    image: String,
});


const currentImage = props.image?props.image: null;
const preview = ref(currentImage);
const emit=defineEmits(['image'])

const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);

    emit('image',e.target.files[0])

};
</script>
<template>
    <div>
        <label for="image">
            <img
            :src="preview ?? image"
                
                    class="img-thumbnail object-cover object-center w-full h-full"
                    height="100px" width="150px"
                    alt="Product Image"
                />
        </label>
        <input
            @input="imageSelected($event)"
            type="file"
            name="image"
            id="image"
            
        />
    </div>
</template>