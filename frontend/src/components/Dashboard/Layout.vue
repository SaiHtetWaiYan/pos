<template>
  <div>
    <TransitionRoot as="template" :show="sidebarOpen">
      <Dialog as="div" class="fixed inset-0 flex z-40 md:hidden" @close="sidebarOpen = false">
        <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
          <DialogOverlay class="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </TransitionChild>
        <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
          <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
              <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                  <span class="sr-only">Close sidebar</span>
                  <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                </button>
              </div>
            </TransitionChild>
            <div class="flex-shrink-0 flex items-center px-4">
              <img class="h-10 w-auto" src="@/assets/pos.png" alt="Workflow" />

            </div>
            <!-- <div class="flex-shrink-0 flex items-center px-4 mt-5 text-md font-medium text-white bg-blue-300 pt-3">
              <span class="mr-2">📆 </span>{{ currentDate }}
            </div>
            <div class="flex-shrink-0 flex items-center px-4 text-md font-medium text-white bg-blue-300 pb-3">
              <span class="mr-2 mt-2">⌛</span><p class="mt-2">{{ currentTime }}</p>
            </div> -->
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
              <nav class="space-y-1">
                <router-link  v-for="item in navigation" :key="item.name" v-bind:class="[currentRouteName === item.href ? 'border-s-[3px] border-blue-500 bg-blue-50 text-blue-700' : 'border-l-[3px] border-transparent text-gray-500 hover:border-gray-100 hover:bg-gray-50 hover:text-gray-700', 'flex  items-center gap-2 px-4 py-3']"  :to="item.href" >
                  <component :is="item.icon" class="h-5 w-5 opacity-75"   aria-hidden="true" />

                  <span class="text-md font-medium"> {{ item.name }} </span>
                </router-link>
              </nav>
            </div>
          </div>
        </TransitionChild>
        <div class="flex-shrink-0 w-14" aria-hidden="true">
          <!-- Dummy element to force sidebar to shrink to fit close icon -->
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
      <!-- Sidebar component, swap this element with another sidebar if you like -->
      <div class="flex flex-col flex-grow border-r border-gray-200 pt-5 bg-white overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
</svg>

          <h4 class="text-lg font-medium ml-1 text-gray-600">Point of Sale</h4>
        </div>
        <!-- <div class="flex items-center flex-shrink-0 px-5 mt-5 text-md font-medium text-white bg-blue-300 pt-3">
          <span class="mr-2">📆 </span>{{ currentDate }}
        </div>
        <div class="flex items-center flex-shrink-0 px-5 text-md font-medium text-white bg-blue-300 pb-3">

          <span class="mr-2 mt-2">⌛</span><p class="mt-2">{{ currentTime }}</p>
        </div> -->
        <div class="mt-5 flex-grow flex flex-col">

          <nav aria-label="Main Nav" class="flex flex-col  pb-4 space-y-1">

            <router-link  v-for="item in navigation" :key="item.name" v-bind:class="[currentRouteName === item.href ? 'border-s-[3px] border-blue-500 bg-blue-50 text-blue-700' : 'border-l-[3px] border-transparent text-gray-500 hover:border-gray-100 hover:bg-gray-50 hover:text-gray-700', 'flex  items-center gap-2 px-4 py-3']"  :to="item.href" >
              <component :is="item.icon" class="h-5 w-5 opacity-75"   aria-hidden="true" />

              <span class="text-md font-medium"> {{ item.name }} </span>
            </router-link>


          </nav>

        </div>
      </div>
    </div>
    <div class="md:pl-64 flex flex-col flex-1">
      <div class="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button type="button" class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden" @click="sidebarOpen = true">
          <span class="sr-only">Open sidebar</span>
          <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
        <div class="flex-1 px-4 flex justify-between">
          <div class="flex-1 flex">
          </div>
          <div class="ml-4 flex items-center md:ml-6 ">
            <Popover class="relative border-r-2 border-gray-300 h-8 ">
              <PopoverButton class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none mr-4">
                  <span class="sr-only">View notifications</span>
                  <BellIcon class="h-7 w-7" aria-hidden="true" />
                <span class="absolute -top-2 -right-1 h-4 w-4 rounded-full bg-red-600 text-white flex justify-center items-center items mr-4" v-if="useAuthStore().user_name === null"><span>1</span></span>
              </PopoverButton>
              <transition
                  enter-active-class="transition duration-200 ease-out"
                  enter-from-class="translate-y-1 opacity-0"
                  enter-to-class="translate-y-0 opacity-100"
                  leave-active-class="transition duration-150 ease-in"
                  leave-from-class="translate-y-0 opacity-100"
                  leave-to-class="translate-y-1 opacity-0"
              >
              <PopoverPanel class="origin-top-right absolute right-0 mt-2 w-72 rounded-md shadow-lg py-1 bg-white">
                <div class="mx-4 my-2 flex items-center" v-if="useAuthStore().user_name === null">
                  <ExclamationTriangleIcon class="h-10 w-10 text-red-600" aria-hidden="true"/>
                  <div class="ml-2">
                  <p class="text-inline text-sm text-gray-500">Please provide your information in profile tab for purpose order invoice print!</p>
                  </div>
                </div>
                <div class="mx-4 my-2 flex items-center" v-else>
                  <ExclamationTriangleIcon class="h-6 w-6 text-yellow-600" aria-hidden="true"/>

                  <div class="ml-2">
                    <p class="text-inline text-sm text-gray-500">There's no announcement yet !</p>
                  </div>
                </div>
              </PopoverPanel>
              </transition>
            </Popover>

            <!-- Profile dropdown -->
            <Menu as="div" class="ml-3 relative">
              <div>
                <MenuButton class="max-w-xs bg-white flex items-center text-sm">
                  <span class="sr-only">Open user menu</span>
                  <img v-if="useAuthStore().photo" class="h-10 w-10 rounded-full" :src="imgUrl+useAuthStore().photo" alt="" />
                  <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-blue-700" v-else>
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
                  <p class="ml-3 text-sm font-semibold text-gray-900">{{useAuthStore().name}}</p>
                  <ChevronDownIcon class="h-4 w-4 ml-2 mt-1 text-gray-900" aria-hidden="true"/>

                </MenuButton>

              </div>
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                  <router-link :to="{name: 'app.profile'}" class="block px-4 py-2 text-sm hover:bg-blue-50 hover:text-blue-700 text-gray-500">Profile</router-link>
                  <button @click="logout" class="block w-full text-left px-4 py-2 text-sm hover:bg-blue-50 hover:text-blue-700 text-gray-500">Log out</button>
                </MenuItems>
              </transition>
            </Menu>
          </div>
        </div>
      </div>

      <main class="flex-1" >
        <div class="py-6">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
            <!-- Replace with your content -->
            <router-view></router-view>
            <!-- /End replace -->
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import axiosInstance from "@/axios.js";
import {useAuthStore} from'@/store/AuthStore.js'
import router from "@/router/index.js";
import {
  Dialog,
  DialogOverlay,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
  Popover,
  PopoverButton,
  PopoverPanel
} from '@headlessui/vue'
import {
  BellIcon,
  ChartPieIcon,
  Bars3Icon,
  XMarkIcon,
  TagIcon,
  Square3Stack3DIcon,
  CubeIcon,
  ExclamationTriangleIcon,
  TruckIcon,
  ShoppingCartIcon,
  DocumentChartBarIcon,
  ChevronDownIcon
} from '@heroicons/vue/24/outline'

const navigation = [
  { name: 'Dashboard', href: '/app/dashboard', icon: ChartPieIcon  },
  { name: 'Brand', href: '/app/brand', icon: TagIcon  },
  { name: 'Category', href: '/app/category', icon: Square3Stack3DIcon },
  { name: 'Supplier', href: '/app/supplier', icon: TruckIcon },
  { name: 'Product', href: '/app/product', icon: CubeIcon },
  { name: 'Order', href: '/app/order', icon: ShoppingCartIcon },
  { name: 'Order History', href: '/app/order/history', icon: DocumentChartBarIcon },
]
const imgUrl = import.meta.env.VITE_API_BASE_URL+'/users/'
export default {
  components: {
    Dialog,
    DialogOverlay,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    TransitionChild,
    TransitionRoot,
    BellIcon,
    Bars3Icon,
    XMarkIcon,
    Popover,
    PopoverButton,
    PopoverPanel,
    ExclamationTriangleIcon,
    ShoppingCartIcon,
    DocumentChartBarIcon,
    ChevronDownIcon
  },
  data() {
    const sidebarOpen = ref(false)

    return {
      useAuthStore,
      navigation,
      sidebarOpen,
      imgUrl,
      currentTime: '',
      currentDate: ''

    }
  },
  methods:{
    logout(){
      axiosInstance.post('/api/logout',{
        id: useAuthStore().id
      })
      useAuthStore().destoryUser()
      router.push('/')
    },
  },
  mounted() {
    setInterval(() => {
      const date = new Date();
      const hours = date.getHours().toString().padStart(2, "0");
      const minutes = date.getMinutes().toString().padStart(2, "0");
      const seconds = date.getSeconds().toString().padStart(2, "0");
      this.currentTime = `${hours}:${minutes}:${seconds}`;
      this.currentDate = date.toLocaleDateString();
    }, 1000);
  },
  computed: {
    currentRouteName() {
      return this.$route.path;
    }
  }
}
</script>