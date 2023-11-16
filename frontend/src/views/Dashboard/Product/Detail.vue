<template>
  <div>
    <button class="mr-2 text-green-400 hover:text-green-700" @click="openModal">
      Detail
    </button>

    <TransitionRoot :show="isOpen" appear as="template">
      <Dialog as="div" class="relative z-10" @close="closeModal">
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
                class="w-full max-w-5xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
              >
                <div class="absolute top-0 right-0 pt-4 pr-4">
                  <button
                    class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    type="button"
                    @click="closeModal"
                  >
                    <span class="sr-only">Close</span>
                    <XMarkIcon aria-hidden="true" class="h-6 w-6" />
                  </button>
                </div>
                <div class="sm:flex sm:items-start mt-5">
                  <div class="text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <!-- start -->
                    <div
                      class="mx-2 flex flex-wrap items-center justify-center"
                    >
                      <img
                        :src="imgUrl + product.photo"
                        class="w-1/2 h-1/2 rounded border border-gray-200 float-center"
                      />
                      <div class="w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                        <h2
                          class="text-sm title-font text-gray-500 tracking-widest"
                        >
                          <span v-if="product.category"
                            >{{ product.category.name }} / </span
                          ><span v-if="product.brand">{{
                            product.brand.name
                          }}</span>
                        </h2>
                        <h1
                          class="text-gray-900 text-3xl title-font font-medium mb-1"
                        >
                          {{ product.name }}
                        </h1>

                        <table class="w-full mt-4">
                          <tr>
                            <td class="w-1/4 font-medium text-gray-600">
                              Code
                            </td>
                            <td class="w-3/4 text-gray-500 pl-12">
                              {{ product.code }}
                            </td>
                          </tr>
                          <tr>
                            <td class="w-1/4 pt-3 font-medium text-gray-600">
                              Description
                            </td>
                            <td
                              class="w-3/4 pt-3 text-gray-500 pl-12 text-justify"
                            >
                              {{ product.description }}
                            </td>
                          </tr>
                          <tr>
                            <td class="w-1/4 pt-3 font-medium text-gray-600">
                              Variant
                            </td>
                            <td class="w-3/4 pt-3 text-gray-500 pl-12">
                              {{ product.variant }}
                            </td>
                          </tr>
                          <tr>
                            <td class="w-1/4 pt-3 font-medium text-gray-600">
                              Unit in Stock
                            </td>
                            <td
                              class="w-3/4 pt-3 text-red-500 pl-12"
                              v-if="product.current_stock === 0"
                            >
                              Out of Stock
                            </td>
                            <td class="w-3/4 pt-3 text-gray-500 pl-12" v-else>
                              {{ product.current_stock }}
                            </td>
                          </tr>
                          <tr>
                            <td class="w-1/4 pt-3 font-medium text-gray-600">
                              Supplier
                            </td>
                            <td
                              class="w-3/4 pt-3 text-gray-500 pl-12"
                              v-if="product.supplier"
                            >
                              {{ product.supplier.name }}
                            </td>
                            <td class="w-3/4 pt-3 text-gray-500 pl-12" v-else>
                              -
                            </td>
                          </tr>
                          <tr>
                            <td class="w-1/4 pt-3 font-medium text-gray-600">
                              Is Show
                            </td>
                            <td
                              class="w-3/4 pt-3 text-gray-500 pl-12"
                              v-if="product.is_show === 1"
                            >
                              Yes
                            </td>
                            <td class="w-3/4 pt-3 text-gray-500 pl-12" v-else>
                              No
                            </td>
                          </tr>
                        </table>

                        <div class="flex mt-6 border-gray-200 mb-5 border-t-2">
                          <span
                            class="title-font mt-6 font-medium text-2xl text-gray-900"
                            >{{ product.price }} Ks</span
                          >
                        </div>
                      </div>
                    </div>

                    <!--end -->
                    <div class="lg:mx-8 pb-14" @click="getHistory">
                      <Disclosure v-slot="{ open }">
                        <DisclosureButton
                          class="flex w-full justify-between rounded-lg bg-green-100 px-4 py-2 text-left text-sm font-medium text-green-600 hover:bg-green-200 focus:outline-none focus-visible:ring focus-visible:ring-green-500 focus-visible:ring-opacity-75"
                        >
                          <span>Price & Stock history</span>
                          <ChevronUpIcon
                            :class="open ? 'rotate-180 transform' : ''"
                            class="h-5 w-5 text-purple-500"
                          />
                        </DisclosureButton>
                        <DisclosurePanel
                          class="px-4 pt-4 pb-8 text-sm text-gray-500"
                        >
                          <div
                            class="overflow-x-auto rounded-lg border border-gray-200"
                          >
                            <table
                              class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm"
                            >
                              <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  ></th>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    Buying Price
                                  </th>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    Selling Price
                                  </th>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    Added Stock
                                  </th>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    Reason
                                  </th>
                                  <th
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    Added Date
                                  </th>
                                </tr>
                              </thead>

                              <tbody class="divide-y divide-gray-200">
                                <tr
                                  v-for="(stock, stockIdx) in stocks.data"
                                  :key="stock.id"
                                >
                                  <td
                                    class="whitespace-nowrap px-4 py-2 font-medium text-gray-900"
                                  >
                                    {{
                                      stockIdx +
                                      1 +
                                      stocks.current_page * stocks.per_page -
                                      stocks.per_page
                                    }}
                                  </td>
                                  <td
                                    class="whitespace-nowrap px-4 py-2 text-gray-700"
                                  >
                                    {{ stock.buying_price }} Ks
                                  </td>
                                  <td
                                    class="whitespace-nowrap px-4 py-2 text-gray-700"
                                  >
                                    {{ stock.selling_price }} Ks
                                  </td>
                                  <td
                                    class="whitespace-nowrap px-4 py-2 text-gray-700"
                                  >
                                    {{ stock.stock }}
                                  </td>
                                  <td
                                    class="whitespace-nowrap px-4 py-2 text-gray-700"
                                  >
                                    {{ stock.reason }}
                                  </td>
                                  <td
                                    class="whitespace-nowrap px-4 py-2 text-gray-700"
                                  >
                                    {{ stock.created_at.substr(11, 8) }}
                                    {{
                                      new Date(
                                        stock.created_at
                                      ).toLocaleDateString()
                                    }}
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="flex items-center justify-center pt-4">
                            <v-pagination
                              v-model="page"
                              :pages="pageCount"
                              :range-size="1"
                              active-color="#DCEDFF"
                              @update:modelValue="getHistory"
                            />
                          </div>
                        </DisclosurePanel>
                      </Disclosure>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  RadioGroup,
  RadioGroupDescription,
  RadioGroupLabel,
  RadioGroupOption,
  TransitionChild,
  TransitionRoot,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
} from "@headlessui/vue";
import { ShieldCheckIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import {
  CheckIcon,
  QuestionMarkCircleIcon,
  StarIcon,
  ChevronUpIcon,
} from "@heroicons/vue/20/solid";
import axiosInstance from "@/axios.js";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

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
    ChevronUpIcon,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    VPagination,
  },
  data() {
    const isOpen = ref(false);
    let stocks = ref([]);
    return {
      isOpen,
      imgUrl: import.meta.env.VITE_API_BASE_URL + "/products/",
      stocks,
      page: 1,
      pageCount: null,
    };
  },
  methods: {
    closeModal() {
      this.isOpen = false;
    },
    openModal() {
      this.isOpen = true;
    },
    async getHistory() {
      const response = await axiosInstance.post(
        "/api/product/stock?page=" + this.page,
        {
          product_id: this.product.id,
        }
      );
      this.stocks = response.data.stocks;
      this.pageCount = response.data.stocks.last_page;
    },
  },
};
</script>
