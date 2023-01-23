import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHistory } from 'vue-router';

import App from "./components/App.vue"
import Checker from "./components/Checker.vue"
import History from "./components/History.vue"

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', name: 'checker', component: Checker},
        {path: '/history', name: 'history', component: History},
    ]
});

const app = createApp({
    components: {
        App
    }
});

app.use(router).mount('#app')