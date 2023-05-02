<template>
  <button class="mr-2 text-green-400 hover:text-green-700" @click="openModal">Detail</button>
  <TransitionRoot as="template" :show="isOpen">
    <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="closeModal">
      <div class="flex min-h-screen text-center sm:block sm:px-6 lg:px-8" style="font-size: 0">
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="hidden sm:block sm:fixed sm:inset-0 sm:bg-gray-500 sm:bg-opacity-75 sm:transition-opacity" />
        </TransitionChild>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 scale-105" enter-to="opacity-100 scale-100" leave="ease-in duration-200" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-105">
          <div class="flex text-base text-left transform transition w-full sm:inline-block max-w-3xl sm:my-8 sm:align-middle">
            <div class="w-full relative flex flex-col bg-white pt-6 pb-8 overflow-hidden sm:pb-6 sm:rounded-lg lg:py-8">
              <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <h2 class="text-lg font-medium text-gray-900">Order History Detail</h2>
                <button type="button" class="text-gray-400 hover:text-gray-500" @click="closeModal">
                  <span class="sr-only">Close</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </button>
              </div>
              <section aria-labelledby="summary-heading" class="mt-auto">
                <div class="sm:p-8 sm:rounded-lg">
                  <div class="flow-root">
                    <dl class="-my-4 text-sm">
                      <div class="py-4 flex items-center justify-between">
                        <dt class="text-gray-600">Date : {{ order.created_at.substr(11, 8) }}  {{new Date(order.created_at).toLocaleDateString()}}</dt>
                        <dt class="text-gray-600">Invoice Number : {{ order.invoice_no }} </dt>
                      </div>

                    </dl>
                  </div>
                </div>
              </section>
              <section aria-labelledby="cart-heading">

                <ul role="list" class="divide-y divide-gray-200 px-4 sm:px-6 lg:px-8">
                  <li v-for="(item, itemIdx) in order.order_items" :key="item.id" class="py-8 flex text-sm sm:items-center">
                    <img :src="imgUrl+item.product_photo"  class="flex-none w-12 h-12 rounded-lg border border-gray-200 sm:w-20 sm:h-20" />
                    <div class="ml-4 flex-auto grid gap-y-3 gap-x-5 grid-rows-1 grid-cols-1 items-start sm:ml-6 sm:flex sm:gap-0 sm:items-center">
                      <div class="flex-auto row-end-1 sm:pr-6">
                        <h3 class="font-medium text-gray-900">
                          <a href="#">{{ item.product_name }}</a>
                        </h3>
                        <p class="mt-1 text-gray-500">{{ item.variant }}</p>
                      </div>
                      <p class="row-end-2 row-span-2 font-medium text-gray-900 sm:ml-6 sm:order-1 sm:flex-none sm:w-1/3 sm:text-right">
                        {{ item.quantity * item.price }} Ks
                      </p>
                      <p class="row-end-2 row-span-2 font-medium text-gray-900 sm:ml-6 sm:order-1 sm:flex-none sm:w-1/3 sm:text-right">
                        {{ item.price }} Ks
                      </p>
                      <div class="flex items-center sm:flex-none sm:block">
                        <p class="text-base leading-5 font-medium text-gray-700 sm:text-sm">{{item.quantity}}</p>

                      </div>
                    </div>
                  </li>
                </ul>
              </section>

              <section aria-labelledby="summary-heading" class="mt-auto">
                <div class="bg-gray-50 p-6 sm:p-8 sm:rounded-lg">
                  <div class="flow-root">
                    <dl class="-my-4 text-sm divide-y divide-gray-200">
                      <div class="py-4 flex items-center justify-between">
                        <dt class="text-gray-600">Subtotal</dt>
                        <dd class="font-medium text-gray-900">{{ order.subtotal }} Ks</dd>
                      </div>

                      <div class="py-4 flex items-center justify-between" v-if="order.discount">
                        <dt class="text-gray-600">Discount</dt>
                        <dd class="font-medium text-gray-900">{{ order.discount }} Ks</dd>
                      </div>
                      <div class="py-4 flex items-center justify-between">
                        <dt class="text-gray-600">Payment</dt>
                        <dd class="font-medium text-gray-900">{{ order.payment_type }}</dd>
                      </div>
                      <div class="py-4 flex items-center justify-between">
                        <dt class="text-base font-medium text-gray-900">Total</dt>
                        <dd class="text-base font-medium text-gray-900">{{ order.total }} Ks</dd>
                      </div>
                    </dl>
                  </div>
                </div>
              </section>

            </div>
          </div>
        </TransitionChild>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import { Dialog, DialogOverlay, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/24/outline'



export default {
  props: {
    order: {
      type: Object,
      required: true,
    },
  },
  components: {
    Dialog,
    DialogOverlay,
    TransitionChild,
    TransitionRoot,
    XMarkIcon,
  },
  data() {
    const isOpen = ref(false)
    return {
      isOpen,
      imgUrl: import.meta.env.VITE_API_BASE_URL + '/products/',
    }
  },
  methods:{
    closeModal() {
      this.isOpen = false
    },
    openModal() {
      this.isOpen = true
    },
  }
}
</script>