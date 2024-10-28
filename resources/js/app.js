import './bootstrap';
import '../css/app.css'

import { createApp } from 'vue'
import { CkeditorPlugin } from '@ckeditor/ckeditor5-vue';

import App from './components/App.vue'

import router from './router'
import store from './vuex/store';

const app = createApp(App)
app.use(router)
    .use(store)
    .use(CkeditorPlugin)
    .mount('#app')
