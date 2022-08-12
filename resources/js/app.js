import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue'

import Alpine from 'alpinejs';
import 'animate.css';

window.Alpine = Alpine;

Alpine.start();

createApp(App).mount("#app")