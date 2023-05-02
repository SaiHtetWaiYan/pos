<template>
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

  </div>
  <div class="grid grid-cols-6 gap-6 mt-6">
    <div class="col-span-6 sm:col-span-3 bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
          <h2 class="sr-only">Products</h2>

          <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 xl:gap-x-8">

            <a href="#" class="group" v-for="product in products.data" :key="product.id">
              <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                <img :src="imgUrl+product.photo"  class="h-48 w-48 object-cover object-center group-hover:opacity-75">
              </div>
              <h3 class="mt-4 text-sm text-gray-700">{{product.name}}</h3>
              <p class="mt-1 text-lg font-medium text-gray-900">{{product.price}} Ks</p>
              <p class="text-red-400" v-if="product.current_stock === 0">Out of stock</p>
              <button type="button" v-else  @click="addToCart({ id: product.id, name: product.name,photo: product.photo, price: product.price,variant: product.variant, quantity: 1 , stock: product.current_stock})" class="text-yellow-400">Add to cart</button>
            </a>

          </div>
        </div>

    </div>
  <div class="col-span-6 sm:col-span-3 bg-white">
    <div class="max-w-lg mx-auto py-16 px-4 sm:py-12 sm:px-6 lg:px-0">
      <h1 class="text-2xl font-bold text-center tracking-tight text-gray-700 sm:text-2xl">Cart</h1>

      <div class="mt-6">
        <section aria-labelledby="cart-heading">

          <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
            <li v-for="(cart ,index) in carts" :key="cart.id" class="flex py-2">
              <div class="flex-shrink-0">
                <img :src="imgUrl+cart.photo" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32" />
              </div>

              <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                <div>
                  <div class="flex justify-between">
                    <h4 class="text-sm">
                      <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                        {{ cart.name }}
                      </a>
                    </h4>
                    <p class="ml-4 text-sm font-medium text-gray-500">{{ cart.quantity }} / {{cart.stock}}</p>
                    <p class="ml-4 text-sm font-medium text-gray-900">{{ cart.price }} Ks</p>
                  </div>
                  <p class="mt-1 text-sm text-gray-500">
                    {{ cart.variant}}
                  </p>

                </div>

                <div class="mt-4 flex-1 flex items-end justify-between">
                  <p class="flex items-center text-sm text-gray-700 space-x-2">

                  </p>
                  <div class="ml-4">
                    <button type="button" class="text-sm font-medium text-indigo-600 hover:text-indigo-500" @click="removeItem(index)">
                      <span>Remove</span>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </section>

        <!-- Order summary -->
        <section aria-labelledby="summary-heading" class="mt-10">
          <h2 id="summary-heading" class="sr-only">Order summary</h2>

          <div>
            <dl class="space-y-4">
              <div class="flex items-center justify-between">
                <dt class="text-base font-medium text-gray-900">Subtotal</dt>
                <dd class="ml-4 text-base font-medium text-gray-900">{{subtotalAmount}} Ks</dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-base font-medium text-gray-900">Payment Type</dt>
                <dd class="ml-4 text-base font-medium text-gray-900">
                  <select v-model="payment_type" class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Cash">Cash</option>
                    <option value="MPU">MPU</option>
                    <option value="Kpay">Kpay</option>
                    <option value="AYAPay">AYAPay</option>
                    <option value="Wave">Wave</option>

                  </select>
                </dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-base font-medium text-gray-900">Discount</dt>
                <dd><input type="number" min="0" v-model="discount" class="ml-4 text-base font-medium text-gray-900 focus:ring-indigo-500 focus:border-indigo-500  shadow-sm border-gray-100 rounded-md text-right" /> <span class="text-base font-medium text-gray-900">Ks</span></dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-base font-medium text-gray-900">Total</dt>
                <dd class="ml-4 text-base font-medium text-gray-900">{{total}} Ks</dd>
              </div>
            </dl>
          </div>

          <Summary :subtotal="subtotalAmount" :discount="discount" :total="total" :payment="payment_type" @passData="getData" v-if="carts.length > 0"></Summary>
        </section>
      </div>
    </div>
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
import { CheckIcon, ClockIcon } from '@heroicons/vue/20/solid'
import axiosInstance from "@/axios.js";
import { useCartStore } from '@/store/CartStore.js';
import Summary from "@/views/Dashboard/Order/Summary.vue";
export default {
  components: {
    CheckIcon,
    ClockIcon,
    Summary
  },
  data() {
    let products = ref([])
    let brands = ref([])
    let categories = ref([])
    let suppliers = ref([])
    let carts = ref(useCartStore().products)
    return {
      products,
      brands,
      categories,
      suppliers,
      carts,
      useCartStore,
      search : null,
      brand: null,
      category: null,
      supplier: null,
      imgUrl : import.meta.env.VITE_API_BASE_URL+'/products/',
      discount: 0,
      payment_type : 'Cash',
      msg: ref(null)
    }
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
  },
  mounted() {
    this.fetchdata();
  },
  computed: {
    subtotalAmount() {
      let subtotal = 0;
      this.carts.forEach(item => {
        subtotal += item.price * item.quantity;
      });
      return subtotal;

    },
    total() {
      return this.subtotalAmount - this.discount;
    },
  },
  methods: {
    async fetchdata() {
      const response = await axiosInstance.post('/api/product', {
        search: this.search,
        brand: this.brand,
        category: this.category,
        supplier: this.supplier,
        perpage: 10
      })
      this.products = response.data.products
      this.brands = response.data.brands
      this.categories = response.data.categories
      this.suppliers = response.data.suppliers

    },
    addToCart(product){
      useCartStore().addItem(product)
    },
    removeItem(index){
      useCartStore().removeItem(index)
    },
    getData(value){
      this.msg = value
      this.carts =[]

      this.discount = 0

      this.alert()

    },
    alert(){
      setTimeout(()=>{
        this.msg = null
        this.fetchdata()
        this.carts = ref(useCartStore().products)
      },3000)
    }
  }
}
</script>