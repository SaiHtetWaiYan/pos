import axios from 'axios';

const axiosInstance = axios.create({
    baseURL: '/api'
});

axiosInstance.interceptors.request.use(function (config) {
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]');

    if (csrfToken) {
        config.headers['X-CSRF-TOKEN'] = csrfToken.content;
    }

    return config;
});

export default axiosInstance;