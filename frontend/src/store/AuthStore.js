import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        token: null,
        name: null,
        id: null
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        setUser(response){
            this.token= response.data.token
            this.name = response.data.user.name
            this.id = response.data.user.id
        },
        destoryUser(){
            this.token = null
            this.name = null
            this.id = null
        }
    },
    persist: true,
})