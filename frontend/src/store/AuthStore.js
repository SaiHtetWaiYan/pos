import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        token: null,
        id: null,
        name: null,
        email: null,
        photo: null

    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        setUser(response){
            this.token= response.data.token
            this.id = response.data.user.id
            this.name = response.data.user.name
            this.email = response.data.user.email
            this.photo = response.data.user.photo

        },
        destoryUser(){
            this.token = null
            this.id = null
            this.name = null
            this.email = null
            this.photo = null

        }
    },
    persist: true,
})