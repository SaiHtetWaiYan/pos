import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        token: null,
        id: null,
        name: null,
        email: null,
        photo: null,
        user_name: null,
        shop_name: null,
        phone_number: null,
        street_address: null,
        city: null,
        state: null,
        country: null,
        remember: null,
        notification : 0
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        setUser(response){
            this.token= response.data.token
            this.updateUser(response)
            this.updatePersonalInfo(response)
        },
        updateUser(response){
            this.id = response.data.user.id
            this.name = response.data.user.name
            this.email = response.data.user.email
            this.photo = response.data.user.photo
        },
        updatePersonalInfo(response){
            this.user_name = response.data.userInfo.name
            this.shop_name = response.data.userInfo.shop_name
            this.phone_number = response.data.userInfo.phone_number
            this.street_address = response.data.userInfo.street_address
            this.city = response.data.userInfo.city
            this.state = response.data.userInfo.state
            this.country = response.data.userInfo.country
            this.notification = 1
        },
        destoryUser(){
            this.token = null
            this.id = null
            this.name = null
            this.email = null
            this.photo = null
            this.user_name = null
            this.shop_name = null
            this.phone_number = null
            this.street_address = null
            this.city = null
            this.state = null
            this.country = null
        },
        rememberEmail(){
            this.remember = this.email
        },
        removeRemember(){
            this.remember = null
        }
    },
    persist: true,
})