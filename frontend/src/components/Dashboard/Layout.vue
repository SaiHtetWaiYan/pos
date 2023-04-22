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
          <img class="h-10 w-auto" src="@/assets/pos.png" alt="Workflow" />
        </div>
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
          <div class="ml-4 flex items-center md:ml-6">
            <button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">View notifications</span>
              <BellIcon class="h-6 w-6" aria-hidden="true" />
            </button>

            <!-- Profile dropdown -->
            <Menu as="div" class="ml-3 relative">
              <div>
                <MenuButton class="max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  <span class="sr-only">Open user menu</span>
                  <img v-if="useAuthStore().photo" class="h-10 w-10 rounded-full" :src="imgUrl+useAuthStore().photo" alt="" />
                  <span class="inline-block h-10 w-10 rounded-full overflow-hidden bg-gray-400" v-else>
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
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
} from '@headlessui/vue'
import {
  BellIcon,
  HomeIcon,
  Bars3Icon,
  XMarkIcon,
  UsersIcon,
  FolderIcon
} from '@heroicons/vue/24/outline'

const navigation = [
  { name: 'Dashboard', href: '/app/dashboard', icon: HomeIcon  },
  { name: 'Team', href: '#', icon: UsersIcon },
  { name: 'Projects', href: '#', icon: FolderIcon },
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
  },
  setup() {
    const sidebarOpen = ref(false)

    return {
      useAuthStore,
      navigation,
      sidebarOpen,
      imgUrl
    }
  },
  methods:{
    logout(){
      axiosInstance.post('/api/logout',{
        id: useAuthStore().id
      })
      useAuthStore().destoryUser()
      router.push('/')
    }
  },
  computed: {
    currentRouteName() {
      return this.$route.path;
    }
  }
}
</script>