import axios from 'axios';
import {useAuthStore} from "@/store/AuthStore.js";
const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    withCredentials: true
});

await axiosInstance.get("/sanctum/csrf-cookie");
axiosInstance.interceptors.request.use(function (config) {
    const authStore = useAuthStore()
    if (authStore.token) {
        config.headers.Authorization = `Bearer ${authStore.token}`
    }
    return config
});

export default axiosInstance;