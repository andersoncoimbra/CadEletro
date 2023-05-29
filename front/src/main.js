import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8888/api';

createApp(App).mount('#app')
