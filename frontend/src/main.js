import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import { createPinia } from 'pinia';
import router from './router'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import VueHtmlToPaper from "./VueHtmlToPaper";

const pinia = createPinia();
pinia.use(piniaPluginPersistedstate)


const options = {
    "name": "_blank",
    "specs": [
        "fullscreen=yes",
        "titlebar=yes",
        "scrollbars=yes"
    ],
    "styles": [
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
        "https://unpkg.com/kidlat-css/css/kidlat.css"
    ],
    "timeout": 1000,
    "autoClose": true,
    "windowTitle": "Invoice Printing."

}

createApp(App).use(pinia).use(router).use(VueHtmlToPaper, options).mount('#app')
