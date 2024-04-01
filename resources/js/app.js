import './bootstrap';
import { createApp } from 'vue'

import Counter from './components/Counter.vue'
import ChatBot from './components/ChatBot.vue'
import StatusBot from './components/Status.vue'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const app = createApp()
app.use(Toast);

app.component('font-awesome-icon', FontAwesomeIcon)
app.component('counter', Counter)
app.component('chat-bot', ChatBot)
app.component('status-bot', StatusBot)

app.mount('#app')