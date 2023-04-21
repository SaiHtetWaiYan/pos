import { defineStore } from 'pinia'

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => ({
        token: null,
        name: null,
    }),
    getters: {
        isAuthenticated: (state) => !!state.token,
    },
    actions: {
        setUser(response){
            this.token= response.data.token
            this.name = response.data.user.name
        }
    },
    persist: true,
})