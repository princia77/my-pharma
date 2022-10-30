<script setup>

import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
    item : Object
});

const DeleteOrderItem = () => {
   Inertia.delete(`/order-item/${props.item.id}`);
}
</script>

<template>
<div class="rounded shadow-lg flex mb-4">
<div>
    <div class="font-bold text-xl mb-2">{{ item.product.name }}</div>
    <div class=" mb-2">Price: AED {{ item.product.price }}</div>

</div>
    <div class="mt-4 ml-4">
        <button class="bg-red-500 hover:bg-blue-700 text-white font-bold rounded-full p-2"
                @click="DeleteOrderItem">Delete Item</button>
    </div>

</div>

</template>



