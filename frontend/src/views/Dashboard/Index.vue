<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-16">
      <div class="mt-10 text-center lg:col-start-8 lg:col-end-13 lg:row-start-1 lg:mt-9 xl:col-start-9">

        <DatePicker v-model.range="range"   expanded />

      </div>
      <div class="mt-4 divide-y divide-gray-100 text-sm leading-6 lg:col-span-7 xl:col-span-8">

          <h3 class="text-lg leading-6 font-medium text-gray-900">
            <span class="mr-4">{{new Date(range.start).toDateString()}}</span>
            <span class="mr-4"> ➔ </span>
            <span >{{new Date(range.end).toDateString()}}</span>
          </h3>

          <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <div class="relative bg-white pt-5 px-4 pb-6 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
              <dt>
                <div class="absolute bg-yellow-400 rounded-md p-3">
                  <ShoppingBagIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Order</p>
              </dt>
              <dd class="ml-16  flex items-baseline ">
                <p class="text-2xl font-semibold text-gray-900">
                  {{ order }}
                </p>
              </dd>
            </div>

            <div class="relative bg-white pt-5 px-4 pb-6 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
              <dt>
                <div class="absolute bg-orange-400 rounded-md p-3">
                  <ScaleIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Units Sold</p>
              </dt>
              <dd class="ml-16  flex items-baseline ">
                <p class="text-2xl font-semibold text-gray-900">
                  {{ unit }}
                </p>
              </dd>
            </div>

            <div class="relative bg-white pt-5 px-4 pb-6 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
              <dt>
                <div class="absolute bg-blue-400 rounded-md p-3">
                  <CurrencyDollarIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Total Income</p>
              </dt>
              <dd class="ml-16  flex items-baseline ">
                <p class="text-2xl font-semibold text-gray-900">
                  <span v-if="income === null">0 Ks</span>
                  <span v-else>{{ income }} Ks</span>
                </p>
              </dd>
            </div>
            <div class="relative bg-white pt-5 px-4 pb-6 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
              <dt>
                <div class="absolute bg-red-400 rounded-md p-3">
                  <ArchiveBoxIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </div>
                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Out Of Stock Unit</p>
              </dt>
              <dd class="ml-16  flex items-baseline ">
                <p class="text-2xl font-semibold text-gray-900">
                  {{ stock }}
                </p>
              </dd>
            </div>
<!--            <div class="relative bg-white pt-5 px-4 pb-6 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">-->
<!--              <dt>-->
<!--                <div class="absolute bg-green-400 rounded-md p-3">-->
<!--                  <ArrowTrendingUpIcon class="h-6 w-6 text-white" aria-hidden="true" />-->
<!--                </div>-->
<!--                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Net Profit</p>-->
<!--              </dt>-->
<!--              <dd class="ml-16  flex items-baseline ">-->
<!--                <p class="text-2xl font-semibold text-gray-900">-->
<!--                  71,897 Ks-->
<!--                </p>-->
<!--              </dd>-->
<!--            </div>-->
          </dl>

    </div>
    </div>
  </div>
</template>

<script>

import {  DatePicker } from 'v-calendar';
import 'v-calendar/style.css';
import { ref } from 'vue';
import axiosInstance from "@/axios.js";
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'
import { CurrencyDollarIcon , ShoppingBagIcon , ScaleIcon, ArchiveBoxIcon , ArrowTrendingDownIcon , ArrowTrendingUpIcon} from '@heroicons/vue/24/outline'
export default {
  components: {
    ArrowDownIcon,
    ArrowUpIcon,
    DatePicker,
    CurrencyDollarIcon,
    ShoppingBagIcon,
    ScaleIcon,
    ArchiveBoxIcon,
    ArrowTrendingDownIcon,
    ArrowTrendingUpIcon
  },
  data() {

    const range = ref({
      start: new Date().toLocaleDateString(),
      end: new Date().toLocaleDateString()
    });
    return {
      range,
      income:null,
      order:null,
      unit: null,
      stock: null
    }
  },
  mounted() {
    this.fetchdata();
  },
  watch:{
    range(after,before){
      this.range.start =this.range.start.toLocaleDateString()
      this.range.end = this.range.end.toLocaleDateString()
      this.fetchdata()
    },
  },
  methods: {
    async fetchdata() {
      const response = await axiosInstance.post('/api/dashboard', {
       range: this.range,
      })
      this.income = response.data.amount
      this.order = response.data.order
      this.unit = response.data.unit
      this.stock = response.data.stock
    },
  }
}
</script>