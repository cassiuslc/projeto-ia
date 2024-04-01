import './bootstrap';
import { createApp } from 'vue'

import Counter from './components/Counter.vue'
import ChatBot from './components/ChatBot.vue'
import StatusBot from './components/Status.vue'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import PrimeVue from 'primevue/config';
import Skeleton from 'primevue/skeleton';
import 'primevue/resources/themes/aura-light-green/theme.css'

const app = createApp()
app.use(Toast);
app.use(PrimeVue);

app.component('Skeleton', Skeleton)
app.component('counter', Counter)
app.component('chat-bot', ChatBot)
app.component('status-bot', StatusBot)

app.mount('#app')