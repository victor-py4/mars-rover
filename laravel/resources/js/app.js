require('./bootstrap');

import { createApp } from 'vue'

import ElementPlus from 'element-plus'

import AppForm from './components/AppForm'

const app = createApp({});
app.component('app-form', AppForm)

app.use(ElementPlus);
app.mount('#app');
