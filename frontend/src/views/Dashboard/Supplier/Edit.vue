<template>

  <button @click="openModal" class="text-indigo-600 hover:text-indigo-900">Edit</button>

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
                class="w-full max-w-xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
            >
              <DialogTitle
                  as="h3"
                  class="text-lg font-medium leading-6 text-gray-900"
              >
                Edit Brand
              </DialogTitle>
              <form @submit.prevent="Edit">
                <div class="grid grid-cols-6 gap-6 mt-6">
                  <div class="col-span-6 sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700">Brand Name</label>
                    <input type="text" name="name" id="name" v-model="name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                  <div class="col-span-6 sm:col-span-6">
                    <label for="contact" class="block text-sm font-medium text-gray-700">Contact</label>
                    <textarea
                        class="w-full mt-1  rounded-lg border-gray-200 p-3 text-sm"
                        rows="3"
                        id="contact" v-model="contact"
                    ></textarea>
                  </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                  <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Save</button>
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
import {useAuthStore} from "@/store/AuthStore.js";
import axiosInstance from "@/axios.js";
export default {
  props: {
    supplier: {
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
      id: this.supplier.id,
      name : this.supplier.name,
      contact : this.supplier.contact
    }
  },
  methods:{
    closeModal() {
      this.isOpen = false
    },
    openModal() {
      this.isOpen= true
    },
    async Edit(){
      await axiosInstance.post('/api/supplier/update',{
        id: this.id,
        name: this.name,
        contact: this.contact
      })
      this.isOpen = false
      this.$emit('passData' ,'Supplier successfully updated')
    }
  }

}

</script>
