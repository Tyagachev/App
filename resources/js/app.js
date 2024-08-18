import './bootstrap';
import { createApp } from 'vue'

import IndexComponent from './components/IndexComponent.vue'
import router from './router'
import store from './vuex/store';

const app = createApp(IndexComponent)

app.use(router).use(store).mount('#app')
