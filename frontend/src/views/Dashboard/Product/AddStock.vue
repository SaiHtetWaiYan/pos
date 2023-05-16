<template>
  <button class="mr-2 text-purple-400 hover:text-purple-700" @click="openModal">Add Stock</button>

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
                Add Stock
              </DialogTitle>
              <div class="flex flex-inline mt-2">
                <p class="text-sm font-medium text-gray-700">📈 Remaining Stock</p>
                <p class="text-sm font-medium text-red-500 ml-3" v-if="current_stock === 0 ">Out of Stock</p>
                <p class="text-sm font-medium text-red-500 ml-3" v-else>{{ current_stock }}</p>
              </div>

              <form @submit.prevent="Add" enctype="multipart/form-data">

                <div class="grid grid-cols-6 gap-6 mt-6">
                  <div class="col-span-6 sm:col-span-2">
                    <label for="buying-price" class="block text-sm font-medium text-gray-700">Buying Price</label>
                    <input type="number" name="buying-price" id="buying-price" required v-model="buying_price" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <label for="selling-price" class="block text-sm font-medium text-gray-700">Selling Price</label>
                    <input type="number" name="selling-price" id="selling-price" required v-model="selling_price" min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                  <div class="col-span-6 sm:col-span-2">
                    <label for="unit-in-stock" class="block text-sm font-medium text-gray-700">Add Stock</label>
                    <input type="number" name="stock" id="stock" v-model="stock" required min="0" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>

                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                  <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm" :disabled="isLoading">Save</button>
                  <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm" @click="closeModal" ref="cancelButtonRef">Cancel</button>
                </div>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import axiosInstance from "@/axios.js";
export default {
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
  emits: ['passData'],
  components:{
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  },
  data(){
    const isOpen = ref(false)
    return{
      isOpen,
      buying_price : null,
      selling_price: null,
      stock: null,
      isLoading: null,
      current_stock: this.product.current_stock
    }
  },
  watch:{
    product(after, before){
      this.current_stock = this.product.current_stock
    },
    stock(after,before){
      this.current_stock = this.product.current_stock + this.stock
    },
  },
  methods:{
    closeModal() {
      this.isOpen = false
      this.reset()
    },
    openModal() {
      this.isOpen= true
    },

    async Add(){
      try {
        this.isLoading = true
        setTimeout(() => {
          this.isLoading = false
        }, 1000)
        await axiosInstance.post('/api/product/add/stock',{
          product_id : this.product.id,
          buying_price: this.buying_price,
          selling_price: this.selling_price,
          current_stock: this.current_stock,
          stock: this.stock,

        })
        this.reset()
        this.isOpen = false
        this.$emit('passData' ,'Stock successfully added')
      }catch (errors)
      {
        console.log(errors)

      }
    },
    reset(){
      this.buying_price = null;
      this.selling_price = null;
      this.stock =null;

    }
  }
}
</script>