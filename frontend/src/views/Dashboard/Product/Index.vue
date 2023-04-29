<template>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Products</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the products in your account including their name, product code , variant , price and stock.</p>
      </div>
      <Create @passData="getData" :brands="brands" :categories="categories" :suppliers="suppliers"></Create>
    </div>
    <div class="grid grid-cols-6 gap-6 mt-6">
      <div class="col-span-6 sm:col-span-2">
        <label for="search" class="block text-sm font-medium text-gray-700">Search by name</label>
        <input type="text" name="search" id="search" v-model="search" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="brand" class="block text-sm font-medium text-gray-700">Brand</label>
        <select name="brand" id="brand" v-model="brand" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option :value="brand.id" v-for="brand in brands">{{brand.name}}</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
        <select name="category" id="category" v-model="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option :value="category.id" v-for="category in categories">{{category.name}}</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-2">
        <label for="supplier" class="block text-sm font-medium text-gray-700">Supplier</label>
        <select name="supplier" id="supplier" v-model="supplier" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option :value="supplier.id" v-for="supplier in suppliers">{{supplier.name}}</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-1">
        <label for="per-page" class="block text-sm font-medium text-gray-700">Per page</label>
        <select id="per-page" name="per-page" v-model="per_page" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option value=10>10</option>
          <option value=25>25</option>
          <option value=50>50</option>
        </select>
      </div>
      <div class="col-span-6 sm:col-span-1">
        <label for="trash" class="block text-sm font-medium text-gray-700">Trash</label>
        <select id="trash" name="trash" v-model="trashed" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
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
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Product Code</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Variant</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stock</th>
                <th scope="col" class="relative py-3.5  pr-4 sm:pr-6">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white">
              <tr v-for="(product, productIdx) in products.data" :key="product.id" :class="productIdx % 2 === 0 ? undefined : 'bg-gray-50'">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">{{ (productIdx+ 1 + products.current_page * products.per_page) - products.per_page   }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.code }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                <div class="flex items-center">
                  <div class="h-20 w-20 flex-shrink-0">
                    <img class="h-20 w-20 rounded-lg" :src="imgUrl+product.photo"  alt="" />
                  </div>
                  <div class="ml-4">
                    <div class=" text-gray-500">{{ product.name }}</div>

                  </div>
                </div>
                </td>

                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.variant }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.price }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ product.current_stock }}</td>
                <td class="relative whitespace-nowrap py-4  pr-4 text-right text-sm font-medium sm:pr-6">
                  <AddStock :product="product" @passData="getData"></AddStock>
                  <Detail :product="product"></Detail>
                  <Edit @passData="getData" :brands="brands" :categories="categories" :suppliers="suppliers" :product="product"></Edit>
                  <RestoreModal :restore="product" :page="'product'" @passData="getData" v-if="product.deleted_at"></RestoreModal>
                  <DeleteModal :delete="product" :page="'product'" @passData="getData" v-else></DeleteModal>
                </td>
              </tr>
              <tr v-if="products.total === 0">
                <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-center" colspan="7">No products found.</td>
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
  <aside v-if="msg" class="fixed bottom-4 right-4 z-50 flex items-center justify-center gap-4 rounded-lg bg-green-400 px-5 py-3 text-white">
    <span class="text-sm font-medium hover:opacity-75">
      Hey! {{ msg }} 👋
    </span>
  </aside>
</template>

<script>

import {ref} from "vue";
import axiosInstance from "@/axios.js";
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";
import Create from "@/views/Dashboard/Product/Create.vue";
import Detail from "@/views/Dashboard/Product/Detail.vue";
import Edit from "@/views/Dashboard/Product/Edit.vue";
import AddStock from "@/views/Dashboard/Product/AddStock.vue";
import DeleteModal from "@/components/Dashboard/DeleteModal.vue";
import RestoreModal from "@/components/Dashboard/RestoreModal.vue";

export default {
  components:{
    Create,
    Detail,
    Edit,
    AddStock,
    DeleteModal,
    RestoreModal,
    VPagination
  },
  data(){
    let  products = ref([])
    let  brands = ref([])
    let  categories = ref([])
    let  suppliers = ref([])
    return{
      brands,
      categories,
      suppliers,
      products,
      page : 1,
      pageCount : null,
      search : null,
      brand: null,
      category: null,
      supplier: null,
      per_page : ref('10'),
      trashed : null,
      msg: ref(null),
      imgUrl : import.meta.env.VITE_API_BASE_URL+'/products/'
    }
  },
  mounted() {
    this.fetchdata();
  },
  watch:{
    search(after,before){
      this.fetchdata()
    },
    brand(after,before){
      this.fetchdata()
    },
    category(after,before){
      this.fetchdata()
    },
    supplier(after,before){
      this.fetchdata()
    },
    per_page(after,before){
      this.fetchdata()
    },
    trashed(after,before){
      this.fetchdata()
    }
  },
  methods:{
    async fetchdata(){
      const response = await axiosInstance.post('/api/product?page=' + this.page ,{
        search : this.search,
        brand : this.brand,
        category: this.category,
        supplier: this.supplier,
        perpage : this.per_page,
        trashed : this.trashed
      })
      this.products = response.data.products
      this.brands = response.data.brands
      this.categories = response.data.categories
      this.suppliers = response.data.suppliers
      this.pageCount = response.data.products.last_page
    },
    getData(value){
      this.fetchdata()
      this.msg = value
      this.alert()
    },
    alert(){
      setTimeout(()=>{
        this.msg = null
      },3000)
    }
  }
}
</script>