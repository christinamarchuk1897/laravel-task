import './bootstrap';
import '../sass/app.scss'
import Router from './components/router/index'
import store from './components/store/index'
import { createApp } from 'vue/dist/vue.esm-bundler';
import axios from "axios";

const app = createApp({});

const api =  axios.create({
    baseURL: 'http://localhost:80',
});

app.config.globalProperties.$axios = api;
store.$axios = api;
store.$router = Router;

app.use(Router)
app.use(store)
app.mount('#app')