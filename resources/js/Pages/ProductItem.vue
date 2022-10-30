<script setup>

import TextInput from '@/Components/TextInput.vue';
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
const count = [];
const props = defineProps({
    product : Object
});


const AddItem = (id) => {
    Inertia.post(`/add-item/${id}`, {count: count.find(el => el!= null)}, {
        onError: () => alert('Inventory Out Of Stock'),
        onSuccess: () => {
           alert('Item Added to Cart');
        },});

}
</script>

<template>
    <div class="grid flex-row">
    <div class="grid grid-cols-5 gap-5 border-r">
        <div v-for="(item, key) in product">
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img v-if="item.category == 'tablets'" class="w-full rounded-l-md" src="../../img/medicine.jpeg" alt="Medicines">
                <img v-if="item.category == 'vaccines'" class="w-full rounded-l-md" src="../../img/vaccine.jpeg" alt="Vaccines">
                <img v-if="item.category == 'syrups'" class="w-full rounded-l-md" src="../../img/syrup.jpeg" alt="Syrups">

            <div class="font-bold text-xl mb-2">{{ item.name }}</div>
                <div class="flex items-center">
                    <TextInput
                        type="number"
                        v-model="count[key+1]"
                        class="py-2 px-4"
                    />
                    <button class="bg-blue-500 hover:bg-blue-700 text-white m-2 font-bold py-2 px-4 rounded-full"
                            @click="AddItem(item.id)">Add to Cart</button>
                </div>
        </div>
        </div>
    </div>
    </div>



</template>



