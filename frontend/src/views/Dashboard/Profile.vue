<template>
  <div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
          <p class="mt-1 text-sm text-gray-600">This information will be display.</p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="profileUpdate" enctype="multipart/form-data">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <ul class="list-disc mt-4 ml-4" v-if="nameError">
                <li class="text-sm font-medium text-red-600">{{nameError}}</li>
              </ul>
              <ul class="list-disc mt-4 ml-4" v-if="emailError">
                <li class="text-sm font-medium text-red-600">{{emailError}}</li>
              </ul>
              <ul class="list-disc mt-4 ml-4" v-if="passwordError">
                <li class="text-sm font-medium text-red-600" >{{passwordError}}</li>
              </ul>
              <ul class="list-disc mt-4 ml-4" v-if="newPasswordError" v-for="error in newPasswordError">
                <li class="text-sm font-medium text-red-600">{{error}}</li>
              </ul>
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="profile-name" class="block text-sm font-medium text-gray-700">Profile Name</label>
                  <input type="text" name="profile-name" id="profile-name" v-model="profile_name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" id="email" v-model="email" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700"> Photo </label>
                <div class="mt-1 flex items-center">
                  <div class="avatar" v-if="useAuthStore().photo">
                    <div class="w-14 rounded-full">
                      <img :src="imgUrl+useAuthStore().photo" />
                    </div>
                  </div>
                  <span class="inline-block h-14 w-14 rounded-full overflow-hidden bg-gray-100" v-else>
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
                    <label class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                      <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                      </svg>
                      <input type='file' name="photo" id="photo" class="hidden" v-on:change="onImageChange" />
                    </label>
                    <span class="ml-2" v-if="photo">{{ photo.name }}</span>
                </div>
              </div>

              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="current-password" class="block text-sm font-medium text-gray-700">Current Password</label>
                  <div class="relative">
                  <span class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2" @click="current_passwordVisibility">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </span>
                  <input :type="current_passwordFieldType" v-model="current_password" name="current-password" id="current-password"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="new-password" class="block text-sm font-medium text-gray-700">New Password</label>
                  <div class="relative">
                  <span class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2" @click="new_passwordVisibility">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </span>
                  <input :type="new_passwordFieldType" v-model="new_password" name="new-password" id="new-password"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="confirm-new-password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                  <div class="relative">
                  <span class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2" @click="confirm_new_passwordVisibility">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </span>
                  <input :type="confirm_new_passwordFieldType" v-model="confirm_new_password" name="confirm-new-password" id="confirm-new-password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                  </div>
                </div>
              </div>
            </div>

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
      <div class="border-t border-gray-200" />
    </div>
  </div>

  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
          <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="PersonalInfoUpdate">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="user-name" class="block text-sm font-medium text-gray-700">User name</label>
                  <input type="text" name="user-name" id="user-name" v-model="user_name" required autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="shop-name" class="block text-sm font-medium text-gray-700">Shop name</label>
                  <input type="text" name="shop-name" id="shop-name" v-model="shop_name" required autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                  <input type="tel" name="phone-number" id="phone-number" v-model="phone_number" required autocomplete="tel" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6">
                  <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                  <input type="text" name="street-address" id="street-address" v-model="street_address" required autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                  <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                  <input type="text" name="city" id="city" autocomplete="city" v-model="city" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                  <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                  <input type="text" name="region" id="region" autocomplete="state" v-model="state" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                  <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                  <input type="text" name="country" id="country" disabled v-model="country"  class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
      <div class="border-t border-gray-200" />
    </div>
  </div>
  <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-red-700">Permanently deleting your account</h3>
          <p class="mt-1 text-sm text-red-600">Are you sure you want to permanently delete your account? This action cannot be undone, and all your data will be lost. If you are certain you want to proceed, please enter your password to confirm the deletion.</p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="DeleteAccount">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <ul class="list-disc mt-4 ml-4" v-if="deletePasswordError">
                <li class="text-sm font-medium text-red-700">{{deletePasswordError}}</li>
              </ul>
              <div class="grid grid-cols-6 gap-6">

                <div class="col-span-6 sm:col-span-3">
                  <label for="delete-password" class="block text-sm font-medium text-red-700">Current Password</label>
                  <div class="relative">
                  <span class="absolute inset-y-0 right-0 flex items-center pl-2 mr-2" @click="delete_passwordVisibility">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                  </span>
                  <input :type="delete_passwordFieldType" name="delete-password" id="delete-password" v-model="delete_password"  class="mt-1 focus:ring-red-500 focus:border-red-500 block w-full shadow-sm sm:text-sm border-red-300 rounded-md" />
                  </div>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
            </div>
          </div>
        </form>
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
import {useAuthStore} from "@/store/AuthStore.js";
import axiosInstance from "@/axios.js";
import router from "@/router/index.js";
export default {
  data(){
    return{
      useAuthStore,
      id : useAuthStore().id,
      profile_name : useAuthStore().name,
      email : useAuthStore().email,
      photo : null,
      current_password : null,
      new_password : null,
      confirm_new_password : null,
      user_name : useAuthStore().user_name,
      shop_name : useAuthStore().shop_name,
      phone_number : useAuthStore().phone_number,
      street_address : useAuthStore().street_address,
      city: useAuthStore().city,
      state: useAuthStore().city,
      country: 'Myanmar',
      delete_password: null,
      current_passwordFieldType: 'password',
      new_passwordFieldType: 'password',
      confirm_new_passwordFieldType: 'password',
      delete_passwordFieldType: 'password',
      nameError: ref(null),
      emailError: ref(null),
      passwordError: ref(null),
      newPasswordError: ref(null),
      deletePasswordError: ref(null),
      msg: null,
      imgUrl : import.meta.env.VITE_API_BASE_URL+'/users/'
    }
  },
  methods:{
    current_passwordVisibility(){
      this.current_passwordFieldType = this.current_passwordFieldType === "password" ? "text" : "password";
    },
    new_passwordVisibility(){
      this.new_passwordFieldType = this.new_passwordFieldType === "password" ? "text" : "password";
    },
    confirm_new_passwordVisibility(){
      this.confirm_new_passwordFieldType = this.confirm_new_passwordFieldType === "password" ? "text" : "password";
    },
    delete_passwordVisibility(){
      this.delete_passwordFieldType = this.delete_passwordFieldType === "password" ? "text" : "password";
    },
    onImageChange(e){
      this.photo = e.target.files[0];
    },
    async profileUpdate(){
      try {
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }
        const response = await axiosInstance.post('/api/profile/update',{
          id: this.id,
          name: this.profile_name,
          email: this.email,
          photo: this.photo,
          current_password: this.current_password,
          new_password: this.new_password,
          new_password_confirmation: this.confirm_new_password
        },config)
        this.msg = 'Profile updated successfully!'
        this.alert()
        useAuthStore().updateUser(response)
        this.photo = null
        this.resetError()
      }catch (errors)
      {
        this.resetError()
        if(errors.response.data.errors){
          if (errors.response.data.errors.name){
            this.nameError = errors.response.data.errors.name[0]
          }
          if (errors.response.data.errors.email){
            this.emailError = errors.response.data.errors.email[0]
          }
          if (errors.response.data.errors.new_password){
            this.newPasswordError = errors.response.data.errors.new_password
          }
        }
        if(errors.response.data.passwordError){
            this.passwordError = errors.response.data.passwordError
        }

      }
    },
    async PersonalInfoUpdate(){
      try {
        const response = await axiosInstance.post('/api/personalInfo/update',{
          user_id: this.id,
          name: this.user_name,
          shop_name: this.shop_name,
          phone_number: this.phone_number,
          street_address: this.street_address,
          city: this.city,
          state: this.state,
          country: this.country
        })
        this.msg = 'Personal Information updated successfully!'
        this.alert()
        useAuthStore().updatePersonalInfo(response)
      }catch (errors)
      {
        console.log(errors)
      }
    },
    async DeleteAccount(){
      try{
        await axiosInstance.post('/api/account/delete',{
          id: this.id,
          password: this.delete_password
        })
        useAuthStore().destoryUser()
        router.push('/')
      }catch (error){
          this.deletePasswordError = error.response.data.passwordError
      }
    },
    resetError(){
        this.nameError = null
        this.emailError =null
        this.passwordError = null
        this.newPasswordError =null
    },
    alert(){
      setTimeout(()=>{
        this.msg =null
      },3000)
    }
  }
}
</script>

<style scoped>

</style>