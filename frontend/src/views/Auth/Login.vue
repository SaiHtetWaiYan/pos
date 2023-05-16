<template>
  <section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
      <section class="relative flex h-32 items-end bg-gray-900 lg:col-span-8 lg:h-full xl:col-span-7">
        <img alt="POS" class="absolute inset-0 h-full w-full object-cover opacity-80" src="@/assets/login.jpg"/>

        <div class="hidden lg:relative lg:block lg:p-12">
          <div class="block text-white">
            <span class="sr-only">Home</span>
            <svg class="h-12 sm:h-14" viewBox="0 0 68.65 122.88" xmlns="http://www.w3.org/2000/svg">
              <g>
                <path d="M1.63,73.25c-0.57-2.11-0.97-3.69-1.24-5.82C0.12,65.32,0,62.77,0,58.76V41.5v-8.37c0-2.22,0.85-4.24,2.22-5.7 c1.37-1.47,3.27-2.38,5.35-2.38h2.38V5.99c0-1.65,0.67-3.15,1.76-4.24C12.8,0.67,14.3,0,15.95,0h35.8h5.69l0.06,0l0.06,0 c3.65,0,5.67,0.13,7.07,1.5c1.41,1.37,1.61,3.4,1.61,7.18v5.53c0,0.99-0.8,1.8-1.8,1.8h-5.21v9.04h1.64c2.09,0,3.99,0.91,5.36,2.39 c1.38,1.47,2.23,3.5,2.23,5.72v25.68v0c0.31,3.79,0.21,6.84-0.12,9.45c-0.34,2.68-0.9,4.87-1.51,6.94 c-2.98,10.15-2.8,19.1-2.6,29.09c0.05,2.75,0.11,5.56,0.11,8.08c0,0.03,0,0.05,0,0.08c0.09,3.32-0.62,5.93-2.25,7.74 c-1.65,1.84-4.13,2.76-7.55,2.65v0H13.42c-0.03,0-0.05,0-0.08,0c-3.25,0.09-5.49-0.85-6.96-2.6c-1.46-1.74-2.05-4.18-2.04-7.1H4.34 v-19c0-4.36-0.13-7.55-0.52-10.64C3.42,80.44,2.74,77.37,1.63,73.25L1.63,73.25z M11.83,35.36h45c0.76,0,1.44,0.33,1.94,0.86l0,0 l0,0c0.46,0.49,0.75,1.17,0.75,1.9v19.84c0,0.73-0.29,1.41-0.75,1.9c-0.05,0.06-0.11,0.11-0.17,0.16c-0.48,0.44-1.1,0.7-1.78,0.7 h-45c-0.76,0-1.44-0.33-1.94-0.86c-0.47-0.5-0.76-1.17-0.76-1.9V38.12c0-0.73,0.29-1.4,0.76-1.9 C10.39,35.69,11.07,35.36,11.83,35.36L11.83,35.36z M29.33,102.11h9.99v11.03h-9.99V102.11L29.33,102.11z M13.48,67.33h9.99v11.03 h-9.99V67.33L13.48,67.33z M29.33,67.33h9.99v11.03h-9.99V67.33L29.33,67.33z M45.18,67.33h9.99v11.03h-9.99V67.33L45.18,67.33z M45.18,84.72h9.99v28.37h-9.99V84.72L45.18,84.72z M29.33,84.72h9.99v11.03h-9.99V84.72L29.33,84.72z M13.48,84.72h9.99v11.03 h-9.99V84.72L13.48,84.72z M13.48,102.11h9.99v11.03h-9.99V102.11L13.48,102.11z M55.96,38.93H12.7v18.22h43.26V38.93L55.96,38.93z M59.23,3.6v1.94v6.87h3.41V8.68c0-2.77-0.07-4.17-0.52-4.61C61.79,3.74,60.86,3.63,59.23,3.6L59.23,3.6z M17.58,14.78h34.29v3.29 H17.58V14.78L17.58,14.78z M17.49,7.24h5.02v3.29h-5.02V7.24L17.49,7.24z M27.37,7.24h24.5v3.29h-24.5V7.24L27.37,7.24z M51.75,3.59h-35.8c-0.66,0-1.26,0.27-1.69,0.71c-0.44,0.44-0.71,1.04-0.71,1.69v18.55h42.1V5.55V3.59H51.75L51.75,3.59z M3.32,67 c0.24,1.88,0.62,3.37,1.16,5.38c1.14,4.23,1.84,7.43,2.26,10.73c0.42,3.3,0.56,6.61,0.56,11.06v19H7.3v0.01 c-0.01,2.17,0.36,3.89,1.28,4.99c0.88,1.05,2.38,1.62,4.67,1.55c0.05-0.01,0.11-0.01,0.17-0.01h41.13v0.01l0.05,0 c2.55,0.09,4.31-0.5,5.37-1.67c1.05-1.17,1.5-3.02,1.43-5.47c-0.01-0.06-0.01-0.12-0.01-0.18c0-3.04-0.05-5.56-0.1-8.02 c-0.2-10.27-0.39-19.47,2.73-30.09c0.57-1.95,1.1-3.99,1.4-6.41c0.3-2.42,0.39-5.24,0.11-8.77c-0.02-0.09-0.02-0.19-0.02-0.28 V33.16c0-1.37-0.52-2.61-1.36-3.5c-0.84-0.89-1.99-1.45-3.27-1.45h-2.44H29.68H7.57c-1.27,0-2.42,0.55-3.25,1.44 c-0.84,0.89-1.35,2.13-1.35,3.49v8.37v17.26C2.97,62.67,3.08,65.09,3.32,67L3.32,67z"
                    fill="currentColor"/>
              </g>
            </svg>

          </div>

          <h2 class="mt-6 text-2xl font-bold text-white sm:text-3xl md:text-4xl">
            Welcome to our online POS system!
          </h2>

          <p class="mt-4 leading-relaxed text-white/90">
            Our platform is designed to make it easy for multiple users to manage their business transactions all in one
            place. Whether you're a small business owner or part of a larger organization, our POS system has the
            features you need to help your business grow.
          </p>
        </div>
      </section>
      <main aria-label="Main" class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-4 lg:px-16 lg:py-12 xl:col-span-5">
        <div class="max-w-xl lg:max-w-3xl">
          <div class="relative -mt-16 block lg:hidden">
            <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-white text-blue-600 sm:h-20 sm:w-20">
              <span class="sr-only">Home</span>
              <svg class="h-12 sm:h-14" viewBox="0 0 68.65 122.88" xmlns="http://www.w3.org/2000/svg">
                <g>
                  <path d="M1.63,73.25c-0.57-2.11-0.97-3.69-1.24-5.82C0.12,65.32,0,62.77,0,58.76V41.5v-8.37c0-2.22,0.85-4.24,2.22-5.7 c1.37-1.47,3.27-2.38,5.35-2.38h2.38V5.99c0-1.65,0.67-3.15,1.76-4.24C12.8,0.67,14.3,0,15.95,0h35.8h5.69l0.06,0l0.06,0 c3.65,0,5.67,0.13,7.07,1.5c1.41,1.37,1.61,3.4,1.61,7.18v5.53c0,0.99-0.8,1.8-1.8,1.8h-5.21v9.04h1.64c2.09,0,3.99,0.91,5.36,2.39 c1.38,1.47,2.23,3.5,2.23,5.72v25.68v0c0.31,3.79,0.21,6.84-0.12,9.45c-0.34,2.68-0.9,4.87-1.51,6.94 c-2.98,10.15-2.8,19.1-2.6,29.09c0.05,2.75,0.11,5.56,0.11,8.08c0,0.03,0,0.05,0,0.08c0.09,3.32-0.62,5.93-2.25,7.74 c-1.65,1.84-4.13,2.76-7.55,2.65v0H13.42c-0.03,0-0.05,0-0.08,0c-3.25,0.09-5.49-0.85-6.96-2.6c-1.46-1.74-2.05-4.18-2.04-7.1H4.34 v-19c0-4.36-0.13-7.55-0.52-10.64C3.42,80.44,2.74,77.37,1.63,73.25L1.63,73.25z M11.83,35.36h45c0.76,0,1.44,0.33,1.94,0.86l0,0 l0,0c0.46,0.49,0.75,1.17,0.75,1.9v19.84c0,0.73-0.29,1.41-0.75,1.9c-0.05,0.06-0.11,0.11-0.17,0.16c-0.48,0.44-1.1,0.7-1.78,0.7 h-45c-0.76,0-1.44-0.33-1.94-0.86c-0.47-0.5-0.76-1.17-0.76-1.9V38.12c0-0.73,0.29-1.4,0.76-1.9 C10.39,35.69,11.07,35.36,11.83,35.36L11.83,35.36z M29.33,102.11h9.99v11.03h-9.99V102.11L29.33,102.11z M13.48,67.33h9.99v11.03 h-9.99V67.33L13.48,67.33z M29.33,67.33h9.99v11.03h-9.99V67.33L29.33,67.33z M45.18,67.33h9.99v11.03h-9.99V67.33L45.18,67.33z M45.18,84.72h9.99v28.37h-9.99V84.72L45.18,84.72z M29.33,84.72h9.99v11.03h-9.99V84.72L29.33,84.72z M13.48,84.72h9.99v11.03 h-9.99V84.72L13.48,84.72z M13.48,102.11h9.99v11.03h-9.99V102.11L13.48,102.11z M55.96,38.93H12.7v18.22h43.26V38.93L55.96,38.93z M59.23,3.6v1.94v6.87h3.41V8.68c0-2.77-0.07-4.17-0.52-4.61C61.79,3.74,60.86,3.63,59.23,3.6L59.23,3.6z M17.58,14.78h34.29v3.29 H17.58V14.78L17.58,14.78z M17.49,7.24h5.02v3.29h-5.02V7.24L17.49,7.24z M27.37,7.24h24.5v3.29h-24.5V7.24L27.37,7.24z M51.75,3.59h-35.8c-0.66,0-1.26,0.27-1.69,0.71c-0.44,0.44-0.71,1.04-0.71,1.69v18.55h42.1V5.55V3.59H51.75L51.75,3.59z M3.32,67 c0.24,1.88,0.62,3.37,1.16,5.38c1.14,4.23,1.84,7.43,2.26,10.73c0.42,3.3,0.56,6.61,0.56,11.06v19H7.3v0.01 c-0.01,2.17,0.36,3.89,1.28,4.99c0.88,1.05,2.38,1.62,4.67,1.55c0.05-0.01,0.11-0.01,0.17-0.01h41.13v0.01l0.05,0 c2.55,0.09,4.31-0.5,5.37-1.67c1.05-1.17,1.5-3.02,1.43-5.47c-0.01-0.06-0.01-0.12-0.01-0.18c0-3.04-0.05-5.56-0.1-8.02 c-0.2-10.27-0.39-19.47,2.73-30.09c0.57-1.95,1.1-3.99,1.4-6.41c0.3-2.42,0.39-5.24,0.11-8.77c-0.02-0.09-0.02-0.19-0.02-0.28 V33.16c0-1.37-0.52-2.61-1.36-3.5c-0.84-0.89-1.99-1.45-3.27-1.45h-2.44H29.68H7.57c-1.27,0-2.42,0.55-3.25,1.44 c-0.84,0.89-1.35,2.13-1.35,3.49v8.37v17.26C2.97,62.67,3.08,65.09,3.32,67L3.32,67z"
                      fill="currentColor"/>
                </g>
              </svg>
            </div>

            <h1 class="mt-2 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
              Welcome to our online POS system!
            </h1>

            <p class="mt-4 leading-relaxed text-gray-500">
              Our platform is designed to make it easy for multiple users to manage their business transactions all in
              one place. Whether you're a small business owner or part of a larger organization, our POS system has the
              features you need to help your business grow.
            </p>
          </div>


          <div class="hidden lg:block">
            <h2 class="text-2xl font-bold text-gray-900">Login</h2>
          </div>
          <ul class="list-disc mt-4 ml-4" v-if="error">
            <li class="text-sm font-medium text-red-600">{{error}}</li>
          </ul>
          <form @submit.prevent="Login" class="mt-6 grid grid-cols-6 gap-6">

            <div class="col-span-6">
              <label class="block text-sm font-medium text-gray-700" for="Email">
                Email
              </label>

              <input id="Email" class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" required v-model="email" name="email" type="email"/>
            </div>

            <div class="col-span-6">
              <label class="block text-sm font-medium text-gray-700" for="Password">
                Password
              </label>
              <div class="relative">
                <span class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2" @click="passwordVisibility">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </span>
              <input id="Password" class="mt-1 w-full rounded-md border-gray-200 bg-white text-sm text-gray-700 shadow-sm" required v-model="password" name="password" :type="passwordFieldType"/>
              </div>
            </div>
            <div class="col-span-6">
              <label class="flex gap-4" for="remember">
                <input id="remember" class="h-5 w-5 rounded-md border-gray-200 bg-white shadow-sm" name="remember" value="true"  v-model="remember"  type="checkbox"/>
                <span class="text-sm text-gray-700">
               Remember Me
              </span>
              </label>
            </div>
            <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
              <button class="inline-block shrink-0 rounded-md border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-blue-500">
                Login
              </button>

              <p class="mt-4 text-sm text-gray-500 sm:mt-0">
                Don't have an account?
                <router-link :to="{name: 'register'}" class="text-gray-700 underline" href="#">Register</router-link>.
              </p>
            </div>
          </form>
        </div>
      </main>
    </div>
  </section>

</template>

<script>
import axiosInstance from "@/axios.js";
import {useAuthStore} from "@/store/AuthStore.js";
import router from "@/router/index.js";


export default {

  data(){
    return{
      email:null,
      password:null,
      remember: false,
      error: null,
      passwordFieldType: 'password'
    }
  },
  mounted() {
    if(useAuthStore().remember){
      this.email = useAuthStore().remember
      this.remember = true
    }
  },
  methods:{
    async Login(){
      try {
        const response = await axiosInstance.post('/api/login', {
          email: this.email,
          password: this.password
        })
        useAuthStore().setUser(response)
        if(this.remember === true){
              useAuthStore().rememberEmail()
        }
        else {
              useAuthStore().removeRemember()
        }
        router.push('/app/dashboard')
      }catch (error)
      {
        this.error = error.response.data.error
      }
    },
    passwordVisibility(){
      this.passwordFieldType = this.passwordFieldType === "password" ? "text" : "password";

    },
  }
}
</script>