<template>
  <button class="mr-2 text-green-600 hover:text-green-900" @click="openModal">Detail</button>

  <TransitionRoot :show="isOpen" appear as="template">
    <Dialog as="div" class="relative z-10" @close="closeModal">
      <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0">
        <div class="fixed inset-0 bg-black bg-opacity-25"/>
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild
              as="template"
              enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95">
            <DialogPanel class="w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <div class="absolute top-0 right-0 pt-4 pr-4">
                <button class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button" @click="closeModal">
                  <span class="sr-only">Close</span>
                  <XMarkIcon aria-hidden="true" class="h-6 w-6"/>
                </button>
              </div>
              <div class="sm:flex sm:items-start mt-5">

                <div class="text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <!-- start -->

                  <div class="lg:w-11/12 mx-auto flex flex-wrap">
                    <img :src="imgUrl+product.photo" class=" max-h-min rounded border border-gray-200">
                    <div class="lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                      <h2 class="text-sm title-font text-gray-500 tracking-widest">{{product.category.name}} / {{ product.brand.name }}</h2>
                      <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ product.name }}</h1>

                      <table class="w-full mt-4">
                        <tr>
                          <td class="w-1/4  font-medium text-gray-600"> Code</td>
                          <td class="w-3/4 text-gray-500 pl-12">{{product.code}}</td>
                        </tr>
                        <tr>
                          <td class="w-1/4 pt-3 font-medium text-gray-600">Description</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12">{{product.description}}</td>
                        </tr>
                        <tr>
                          <td class="w-1/4 pt-3 font-medium text-gray-600">Variant</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12">{{product.variant}}</td>
                        </tr>
                        <tr>
                          <td class="w-1/4 pt-3 font-medium text-gray-600">Unit in Stock</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12">{{product.latest_stock_record.stock}}</td>
                        </tr>
                        <tr>
                          <td class="w-1/4 pt-3 font-medium text-gray-600">Supplier</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12">{{product.supplier.name}}</td>
                        </tr>
                        <tr>
                          <td class="w-1/4 pt-3 font-medium text-gray-600">Is Show</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12" v-if="product.is_show === 1">Yes</td>
                          <td class="w-3/4 pt-3 text-gray-500 pl-12" v-else>No</td>
                        </tr>
                      </table>

                      <div class="flex mt-6 pb-5 border-gray-200 mb-5 border-t-2">
                        <span class="title-font mt-6 font-medium text-2xl text-gray-900">{{ product.price }} Kyats</span>

                      </div>
                    </div>
                  </div>

                  <!--end -->
                </div>
              </div>


            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import {ref} from 'vue'
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
  TransitionChild,
  TransitionRoot
} from '@headlessui/vue'
import {ShieldCheckIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import {CheckIcon, QuestionMarkCircleIcon, StarIcon} from '@heroicons/vue/20/solid'


export default {
  props: {
    product: {
      type: Object,
      required: true,
    },
  },
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    XMarkIcon,
    RadioGroup,
    RadioGroupDescription,
    RadioGroupLabel,
    RadioGroupOption,
    CheckIcon,
    QuestionMarkCircleIcon,
    ShieldCheckIcon,
    StarIcon,
  },
  data() {
    const isOpen = ref(false)
    return {
      isOpen,
      imgUrl: import.meta.env.VITE_API_BASE_URL + '/products/'

    }
  },
  methods: {
    closeModal() {
      this.isOpen = false

    },
    openModal() {
      this.isOpen = true
    },


  }
}
</script>