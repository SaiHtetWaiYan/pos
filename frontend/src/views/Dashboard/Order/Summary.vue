<template>
  <div class="mt-10">
    <button type="button" @click="openModal" class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Checkout</button>
  </div>

  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal" class="relative z-10">
      <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-black bg-opacity-25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div
            class="flex min-h-full items-center justify-center p-4 text-center"
        >
          <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
          >
            <DialogPanel
                class="w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white p-8 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900"
              >
                Order Summary
                <div class="absolute top-0 right-0 mt-6 mr-6">
                  <button type="button" class="-m-2 p-2 inline-flex text-gray-600 hover:text-gray-700"  @click="closeModal">
                    <span class="sr-only">Remove</span>
                    <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                  </button>
                </div>
              </DialogTitle>
              <div class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                  <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                  <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                    <li v-for="(product, productIdx) in products" :key="product.id" class="flex py-6 sm:py-10">
                      <div class="flex-shrink-0">
                        <img :src="imgUrl+product.photo"  class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48" />
                      </div>

                      <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                          <div>
                            <div class="flex justify-between">
                              <h3 class="text-sm">
                                <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                                  {{ product.name }}
                                </a>
                              </h3>
                            </div>
                            <div class="mt-1 flex text-sm">
                              <p class="text-gray-500">
                                {{ product.variant }}
                              </p>

                            </div>
                            <p class="mt-1 text-sm font-medium text-gray-900">{{ product.price }} Ks</p>
                          </div>
                            <p class="max-w-full text-base leading-5 font-medium text-gray-700 text-left sm:text-sm">{{product.quantity}}</p>
                        </div>

                      </div>
                    </li>
                  </ul>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">


                  <dl class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                      <dt class="text-sm text-gray-600">Subtotal</dt>
                      <dd class="text-sm font-medium text-gray-900">{{ subtotal }} Ks</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between" v-if="discount !== 0">
                      <dt class="text-sm text-gray-600">discount</dt>
                      <dd class="text-sm font-medium text-gray-900">{{ discount }} Ks</dd>
                    </div>

                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                      <dt class="text-sm text-gray-600">Payment Type</dt>
                      <dd class="text-sm font-medium text-gray-900">{{payment}}</dd>
                    </div>
                    <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                      <dt class="text-base font-medium text-gray-900">Order total</dt>
                      <dd class="text-base font-medium text-gray-900">{{total}} Ks</dd>
                    </div>
                  </dl>
                  <div class="mt-6" v-if="useAuthStore().user_name === null">
                    <p class="text-sm text-red-500">Please provide your information in profile tab for purpose order invoice print!</p>
                  </div>
                  <div class="mt-6">
                    <button v-if="useAuthStore().user_name === null" disabled class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">Confirm</button>
                    <button v-else class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500" @click="orderConfirm">Confirm</button>
                  </div>
                </section>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>

  <div id="printMe" hidden>
    <div class="container">

      <div class="row">
        <div class="col-md-12 mt-5 text-center">
          <h5>{{useAuthStore().shop_name  }}</h5>
          <p>{{useAuthStore().street_address}} , {{useAuthStore().city}} , {{useAuthStore().state}}</p>
          <p>{{useAuthStore().phone_number}}</p>
        </div>

      </div>

      <div class="row mt-5">
        <div class="col-md-6">
          <p>Date: {{`${new Date().getDate()}/${new Date().getMonth()+1}/${new Date().getFullYear()}`}} {{`${new Date().getHours()}:${new Date().getMinutes().toLocaleString('my-MM', {minimumIntegerDigits: 2, useGrouping:false})}`}}</p>

        </div>
        <div class="col-md-6 text-right">
          <p>Invoice #: {{ invoice_no }}</p>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-12">
          <table class="table ">
            <thead>
            <tr>
              <th></th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Unit Price</th>
              <th class="text-right">Amount</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(product ,index) in products" :key="index">
              <td>{{index +1}}</td>
              <td>{{ product.name }}</td>
              <td>{{ product.quantity }}</td>
              <td>{{ product.price }} Ks</td>
              <td class="text-right">{{ product.quantity * product.price }} Ks</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <hr>
      <div class="row mt-5">
        <div class="col-md-12 text-right">
          <p>Subtotal: {{ subtotal }} Ks</p>
        </div>
        <div class="col-md-12 text-right" v-if="discount">
          <p>Discount: {{ discount }} Ks</p>
        </div>
        <div class="col-md-12 text-right">
          <p>Payment Type: {{ payment }}</p>
        </div>
        <div class="col-md-12 text-right">
          <p>Total: {{ total }} Ks</p>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-12 text-center">
          <p>Thank you for your business!</p>
          <h6>Powered By Online POS</h6>
        </div>
      </div>
    </div>


  </div>

</template>

<script>
import {ref} from "vue";
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot,} from '@headlessui/vue'
import {CheckIcon, ClockIcon, QuestionMarkCircleIcon, XMarkIcon} from '@heroicons/vue/20/solid'
import {useCartStore} from "@/store/CartStore.js";
import {useAuthStore} from "@/store/AuthStore.js";
import axiosInstance from "@/axios.js";
export default {
  props: {
    subtotal: {
      type: Number,
      required: true,
    },
    discount: {
      type: Number,
      required: true,
    },
    total: {
      type: Number,
      required: true
    },
    payment:{
      type: String,
      required: true
    }
  },
  emits: ['passData'],
  components:{
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    CheckIcon,
    ClockIcon,
    QuestionMarkCircleIcon,
    XMarkIcon
  },
  data(){
    const isOpen = ref(false)
    const products = useCartStore().products
    return{
      useAuthStore,
      useCartStore,
      isOpen,
      products,
      isLoading: null,
      imgUrl : import.meta.env.VITE_API_BASE_URL+'/products/',
      invoice_no : ref(null)

    }
  },
  methods:{
    async orderConfirm(){
      try {
        this.isLoading = true
        setTimeout(() => {
          this.isLoading = false
        }, 1000)
        this.invoice_no = `${new Date().getFullYear()}${new Date().getMonth()+1}${new Date().getDate()}${new Date().getHours()}${new Date().getMinutes().toLocaleString('my-MM', {minimumIntegerDigits: 2, useGrouping:false})}${new Date().getSeconds().toLocaleString('my-MM', {minimumIntegerDigits: 2, useGrouping:false})}`
        const resource = await axiosInstance.post('/api/order',{
          user_id: useAuthStore().id,
          invoice_no : this.invoice_no,
          products : this.products,
          subtotal: this.subtotal,
          discount: this.discount,
          total: this.total,
          payment: this.payment,
        })
        this.$emit('passData' ,'Order success')
        this.print()
        this.isOpen = false
      }catch (errors)
      {
        console.log(errors)

      }
    },
    closeModal() {
      this.isOpen = false
    },
    openModal() {
      this.isOpen= true
    },
    print() {
      this.$htmlToPaper('printMe')
      useCartStore().removeAllItem()
    }

  }

}
</script>

<style scoped>

</style>