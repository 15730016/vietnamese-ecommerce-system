import './bootstrap';
import '../css/app.css';

import { createApp } from 'vue';
import axios from 'axios';

const app = createApp({});

app.config.globalProperties.$axios = axios;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

app.mount('#app');
