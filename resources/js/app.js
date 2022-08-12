import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue'

import Alpine from 'alpinejs';
import 'animate.css';

/** Componentes */
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

/** Opciones para uso del Toast o ventana de mensajes */
const options = {
    position: "top-right",
    timeout: 1778,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false
};


window.Alpine = Alpine;

Alpine.start();

createApp(App)
    .use(Toast, options)
    .mount("#app")