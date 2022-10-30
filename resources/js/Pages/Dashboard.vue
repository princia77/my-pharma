<script setup xmlns="http://www.w3.org/1999/html">
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductItem from '@/Pages/ProductItem.vue';
import DialogModal from '@/Components/DialogModal.vue';
import OrderItem from '@/Pages/OrderItem.vue';
import PaidOrders from '@/Pages/PaidOrders.vue';
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";

defineProps({
    open_order_items: Object,
    paid_order_items: Object,
    paidItem: Object,
    products: Object,
    order: Object,
    auth: Object,
    count: Object
});

const ProcessPayment = () => {
    Inertia.post(`/process-payment`, {}, {
        onError: () => alert('Payment Failed'),
        onSuccess: () => {
            showCart.value = false;
            showSuccessPayment.value = true;
        }
    });
}

const showCart = ref(false);
const showOrders = ref(false);
const showSuccessPayment = ref(false);
</script>

<template>

    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl flex items-center text-gray-800 leading-tight flex">
                Welcome Back {{ auth.name }} !
            </h2>
            <div class="sm:-my-px sm:ml-10 sm:flex">
                <li class="font-sans block mt-4 lg:inline-block lg:mt-0 lg:ml-6 align-middle text-black hover:text-gray-700">
                    <a href="#" role="button" class="relative flex">
                        <svg class="flex-1 w-8 h-8 fill-current" viewbox="0 0 24 24">
                            <path
                                d="M17,18C15.89,18 15,18.89 15,20A2,2 0 0,0 17,22A2,2 0 0,0 19,20C19,18.89 18.1,18 17,18M1,2V4H3L6.6,11.59L5.24,14.04C5.09,14.32 5,14.65 5,15A2,2 0 0,0 7,17H19V15H7.42A0.25,0.25 0 0,1 7.17,14.75C7.17,14.7 7.18,14.66 7.2,14.63L8.1,13H15.55C16.3,13 16.96,12.58 17.3,11.97L20.88,5.5C20.95,5.34 21,5.17 21,5A1,1 0 0,0 20,4H5.21L4.27,2M7,18C5.89,18 5,18.89 5,20A2,2 0 0,0 7,22A2,2 0 0,0 9,20C9,18.89 8.1,18 7,18Z"/>
                        </svg>
                        <span
                            class="absolute right-0 top-0 rounded-full bg-red-600 w-4 h-4 top right p-0 m-0 text-white font-mono text-sm  leading-tight text-center">{{ count }}
    </span>
                    </a>
                </li>
                <button type="button"
                        class="flex-row items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                        @click="showCart = true">
                    View Cart
                </button>
                <button type="button"
                        class="flex-row items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                        @click="showOrders = true">
                    Your Orders
                </button>
            </div>

        </template>
        <div v-for="(product, key) in products">
            <h2 class="font-bold text-xl flex items-center leading-tight flex m-6 text-blue-600/100">
                CATEGORY: {{ key }}
            </h2>
            <ProductItem :key="product.id" :product="product"></ProductItem>

        </div>
    </AppLayout>
    <DialogModal :show="showSuccessPayment" @close="showSuccessPayment = false">
        <template #content>
            <div class="bg-white p-6  md:mx-auto">
                <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
                    <path fill="currentColor"
                          d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
                    </path>
                </svg>
                <div class="text-center">
                    <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!</h3>
                    <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
                    <p> Have a great day! </p>

                </div>
            </div>
        </template>

    </DialogModal>
    <DialogModal scrollable=true :show="showCart" @close="showCart = false">
        <template #title>
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Your Cart Items</h1>
            </div>
        </template>

        <template #content v-if="open_order_items">
            <div class="grid flex-row">
                <div class="grid grid-cols-2 gap-2 border-r">
            <div v-for="item in open_order_items">
                <OrderItem :key="item.id" :item="item"></OrderItem>
            </div>
                </div></div>
            <div class="flex justify-between border-b text-2xl ml-4 mt-6">
                <label class="flex-none font-bold font-medium"><h1>Total: AED {{ order.total }}</h1></label>
            </div>
        </template>
        <template #content v-if="!open_order_items">
            Your Cart is Empty!! Hurry up!

        </template>

        <template #footer v-if="open_order_items">
            <div class="flex">
                <button class=" flex-1 bg-green-500 hover:bg-blue-700 text-white m-2 font-bold py-2 px-4 rounded-full"
                        @click="ProcessPayment">Make Payment
                </button>
            </div>

        </template>
    </DialogModal>
    <DialogModal :show="showOrders" @close="showOrders = false">
        <template #title>
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Your Orders</h1>
            </div>
        </template>
        <template #content v-if="!paid_order_items">
           You have no previous orders

        </template>
        <template #content v-if="paid_order_items">
            <div class="grid divide-x" v-for="(paidItem, key) in paid_order_items">
                <span class="mt-4 font-bold font-mono">Order #{{key + 1}}</span>

                <ul>
                    <div v-for="item in paidItem.order_items">
                        <PaidOrders :key="item.id" :item="item"></PaidOrders>
                    </div>
                </ul>

                <div class="flex justify-between border-b text-2xl ml-4 mt-6">
                    <label class="flex-none font-bold font-medium"><h1>Order Total: AED {{ paidItem.total }}</h1></label>
                </div>
            </div>

        </template>
    </DialogModal>
</template>

