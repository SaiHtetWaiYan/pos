<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Orders</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the orders in your account created.</p>
      </div>


    </div>

    <div class="grid grid-cols-6 gap-6 mt-6">
      <div class="col-span-6 sm:col-span-2">
        <label for="search" class="block text-sm font-medium text-gray-700">Search by Invoice Number</label>
        <input type="text" name="search" id="search" v-model="search" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="per-page" class="block text-sm font-medium text-gray-700">Per page</label>
        <select id="per-page" name="per-page" v-model="per_page" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value=10>10</option>
          <option value=25>25</option>
          <option value=50>50</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
        <select id="discount" name="discount" v-model="discount" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option value="discount">Discount Only</option>
          <option value="no discount">No Discount Only</option>

        </select>
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="payment" class="block text-sm font-medium text-gray-700">Payment Type</label>
        <select id="payment" name="payment" v-model="payment" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option value="Cash">Cash</option>
          <option value="MPU">MPU</option>
          <option value="Kpay">Kpay</option>
          <option value="AYAPay">AYAPay</option>
          <option value="Wave">Wave</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="start date" class="block text-sm font-medium text-gray-700">Date Range</label>
        <VueDatePicker v-model="date" range :enable-time-picker="false"></VueDatePicker>
      </div>

    </div>

    <div class="mt-8 flex flex-col">
      <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"></th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Invoice Number</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Payment Type</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Discount</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Total</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Date & Time</th>
                <th scope="col" class="relative py-3.5  pr-4 sm:pr-6">
                  <span class="sr-only">Action</span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white">
              <tr v-for="(order, orderIdx) in orders.data" :key="order.id" :class="orderIdx % 2 === 0 ? undefined : 'bg-gray-50'">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-500 sm:pl-6">{{ (orderIdx+ 1 + orders.current_page * orders.per_page) - orders.per_page   }}</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500">{{ order.invoice_no }}</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500">{{ order.payment_type }}</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500" v-if="order.discount !== 0">{{ order.discount }} Ks</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500" v-else>No</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500">{{ order.total }} Ks</td>
                <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500">{{ order.created_at.substr(11, 8) }}  {{new Date(order.created_at).toLocaleDateString()}}</td>
                <td class="relative whitespace-nowrap py-4 pr-4 text-right text-sm font-medium sm:pr-6">
                  <Detail :order="order"></Detail>
                </td>
              </tr>
              <tr v-if="orders.total === 0">
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center" colspan="7">No order history found.</td>
              </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="flex items-center justify-center p-8">
      <v-pagination
          v-model="page"
          :pages="pageCount"
          :range-size="1"
          active-color="#DCEDFF"
          @update:modelValue="fetchdata"
      />
    </div>
  </div>

</template>

<script>
import {ref} from "vue";
import axiosInstance from "@/axios.js";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import Detail from "@/views/Dashboard/Order/Detail.vue";
export default {
  components: {
    VPagination,
    VueDatePicker,
    Detail
  },
  data(){
    let orders = ref([])
    return{
      orders,
      page : 1,
      pageCount : null,
      search : null,
      per_page : ref('10'),
      payment: null,
      date : null,
      discount: null
    }

  },
  mounted() {
    this.fetchdata();
  },
  watch:{
    search(after,before){
      this.fetchdata()
    },
    per_page(after,before){
      this.fetchdata()
    },
    payment(after,before){
      this.fetchdata()
    },
    date(after,before){
      this.fetchdata()
    },
    discount(after,before){
      this.fetchdata()
    }


  },
  methods:{
    async fetchdata(){
      const response = await axiosInstance.post('/api/order/history?page=' + this.page ,{
        search : this.search,
        perpage : this.per_page,
        payment : this.payment,
        date : this.date,
        discount : this.discount
      })
      this.orders = response.data.orders
      this.pageCount = response.data.orders.last_page
    },

  }

}

</script>