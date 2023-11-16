<template>
  <div>
    <button class="text-indigo-400 hover:text-indigo-700" @click="openModal">
      Edit
    </button>

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
                  Edit Product
                </DialogTitle>
                <form @submit.prevent="Edit" enctype="multipart/form-data">
                  <div
                    class="grid grid-cols-6 gap-6 mt-6"
                    v-if="codeError || photoError || reasonError"
                  >
                    <div class="col-span-6 sm:col-span-6" v-if="codeError">
                      <ul class="list-disc mt-4 ml-4">
                        <li class="text-sm font-medium text-red-600">
                          {{ codeError }}
                        </li>
                      </ul>
                    </div>
                    <div class="col-span-6 sm:col-span-6" v-if="photoError">
                      <ul class="list-disc mt-4 ml-4">
                        <li class="text-sm font-medium text-red-600">
                          {{ photoError }}
                        </li>
                      </ul>
                    </div>
                    <div class="col-span-6 sm:col-span-6" v-if="reasonError">
                      <ul class="list-disc mt-4 ml-4">
                        <li class="text-sm font-medium text-red-600">
                          {{ reasonError }}
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="grid grid-cols-6 gap-6 mt-6">
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >Product Name</label
                      >
                      <input
                        type="text"
                        name="name"
                        id="name"
                        v-model="name"
                        required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="code"
                        class="block text-sm font-medium text-gray-700"
                        >Product Code</label
                      >
                      <input
                        type="text"
                        name="code"
                        id="code"
                        v-model="code"
                        required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="variant"
                        class="block text-sm font-medium text-gray-700"
                        >Product Variant</label
                      >
                      <input
                        type="text"
                        name="variant"
                        id="variant"
                        v-model="variant"
                        required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="brand"
                        class="block text-sm font-medium text-gray-700"
                        >Brand</label
                      >
                      <select
                        id="brand"
                        name="brand"
                        v-model="brand"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option v-if="!brands.length" disabled>
                          No Inserted
                        </option>
                        <option
                          :value="brand.id"
                          :key="brand.id"
                          v-for="brand in brands"
                        >
                          {{ brand.name }}
                        </option>
                      </select>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                        >Category</label
                      >
                      <select
                        id="category"
                        name="category"
                        v-model="category"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option v-if="!categories.length" disabled>
                          No Inserted
                        </option>
                        <option
                          :value="category.id"
                          :key="category.id"
                          v-for="category in categories"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="supplier"
                        class="block text-sm font-medium text-gray-700"
                        >Supplier</label
                      >
                      <select
                        id="supplier"
                        name="supplier"
                        v-model="supplier"
                        required
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option v-if="!suppliers.length" disabled>
                          No Inserted
                        </option>
                        <option
                          :value="supplier.id"
                          :key="supplier.id"
                          v-for="supplier in suppliers"
                        >
                          {{ supplier.name }}
                        </option>
                      </select>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Description</label
                      >
                      <textarea
                        required
                        class="w-full mt-1 rounded-lg border-gray-200 p-3 text-sm"
                        rows="3"
                        id="contact"
                        v-model="description"
                      ></textarea>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="buying-price"
                        class="block text-sm font-medium text-gray-700"
                        >Buying Price</label
                      >
                      <input
                        type="number"
                        name="buying-price"
                        id="buying-price"
                        required
                        v-model="buying_price"
                        min="0"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="selling-price"
                        class="block text-sm font-medium text-gray-700"
                        >Selling Price</label
                      >
                      <input
                        type="number"
                        name="selling-price"
                        id="selling-price"
                        required
                        v-model="selling_price"
                        min="0"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="unit-in-stock"
                        class="block text-sm font-medium text-gray-700"
                        >Unit in Stock</label
                      >
                      <input
                        type="number"
                        name="stock"
                        id="stock"
                        v-model="stock"
                        required
                        min="0"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                      <label
                        for="reason"
                        class="block text-sm font-medium text-gray-700"
                        >Reason Why Update Stock ?<span class="text-red-500">
                          ( Required if u update unit in stock )</span
                        ></label
                      >
                      <input
                        type="text"
                        name="reason"
                        id="reason"
                        v-model="reason"
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                      />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="product-photo"
                        class="block text-sm font-medium text-gray-700"
                        >Product Photo</label
                      >
                      <label
                        class="relative mt-1 block w-full py-5 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <span
                          class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2"
                        >
                          <svg
                            class="w-6 h-6"
                            fill="#000000"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                          >
                            <path
                              d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"
                            />
                          </svg>
                        </span>
                        <input
                          type="file"
                          name="photo"
                          id="photo"
                          class="hidden"
                          v-on:change="onImageChange"
                        />
                        <span v-if="photo">{{ photo.name }}</span>
                      </label>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                      <label
                        for="is-show"
                        class="block text-sm font-medium text-gray-700"
                        >Is Show</label
                      >
                      <select
                        id="is-show"
                        name="is-show"
                        v-model="is_show"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <button
                      type="submit"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                      :disabled="isLoading"
                    >
                      Save
                    </button>
                    <button
                      type="button"
                      class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                      @click="closeModal"
                      ref="cancelButtonRef"
                    >
                      Cancel
                    </button>
                  </div>
                </form>
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
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from "@headlessui/vue";
import { useAuthStore } from "@/store/AuthStore.js";
import axiosInstance from "@/axios.js";
export default {
  props: {
    brands: {
      type: Array,
      required: true,
    },
    categories: {
      type: Array,
      required: true,
    },
    suppliers: {
      type: Array,
      required: true,
    },
    product: {
      type: Object,
      required: true,
    },
  },
  emits: ["passData"],
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  },
  data() {
    const isOpen = ref(false);
    return {
      isOpen,
      name: this.product.name,
      code: this.product.code,
      variant: this.product.variant,
      is_show: this.product.is_show,
      brand: this.product.brand ? this.product.brand.id : null,
      category: this.product.category ? this.product.category.id : null,
      supplier: this.product.supplier ? this.product.supplier.id : null,
      description: this.product.description,
      buying_price: ref(this.product.latest_stock_record.buying_price),
      selling_price: ref(this.product.latest_stock_record.selling_price),
      stock: ref(this.product.current_stock),
      photo: null,
      reason: null,
      codeError: ref(null),
      photoError: ref(null),
      reasonError: ref(null),
      isLoading: null,
    };
  },
  watch: {
    product(after, before) {
      this.buying_price = this.product.latest_stock_record.buying_price;
      this.selling_price = this.product.latest_stock_record.selling_price;
      this.stock = this.product.current_stock;
    },
  },
  methods: {
    closeModal() {
      this.isOpen = false;
      this.errorRest();
    },
    openModal() {
      this.isOpen = true;
    },
    onImageChange(e) {
      this.photo = e.target.files[0];
    },
    async Edit() {
      try {
        const config = {
          headers: { "content-type": "multipart/form-data" },
        };
        this.isLoading = true;
        setTimeout(() => {
          this.isLoading = false;
        }, 1000);
        await axiosInstance.post(
          "/api/product/update",
          {
            id: this.product.id,
            name: this.name,
            code: this.code,
            variant: this.variant,
            description: this.description,
            brand_id: this.brand,
            category_id: this.category,
            supplier_id: this.supplier,
            photo: this.photo,
            buying_price: this.buying_price,
            selling_price: this.selling_price,
            stock: this.stock,
            reason: this.reason,
            is_show: this.is_show,
            last_stock_id: this.product.latest_stock_record.id,
          },
          config
        );
        this.isOpen = false;
        this.photo = null;
        this.reason = null;
        this.$emit("passData", "Product successfully updated");
      } catch (errors) {
        this.errorRest();
        if (errors.response.data.errors) {
          if (errors.response.data.errors.reason) {
            this.reasonError = errors.response.data.errors.reason[0];
          }
          if (errors.response.data.errors.photo) {
            this.photoError = errors.response.data.errors.photo[0];
          }
        }
        if (errors.response.data.codeError) {
          this.codeError = errors.response.data.codeError;
        }
      }
    },
    errorRest() {
      this.code = this.product.code;
      this.stock = this.product.current_stock;
      this.photo = null;
      this.photoError = null;
      this.codeError = null;
      this.reasonError = null;
    },
  },
};
</script>
