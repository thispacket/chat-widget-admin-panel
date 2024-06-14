import './bootstrap';
import {createApp} from 'vue';
import PrimeVue from 'primevue/config';
import 'primevue/resources/primevue.css'
import 'primeicons/primeicons.css'
import 'primevue/resources/themes/aura-light-green/theme.css'
import "primevue/resources/primevue.min.css"
import {router} from "@/router/index.js";

const app = createApp({});

Object.entries(import.meta.glob('./**/*.vue', {eager: true})).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.use(PrimeVue);
app.use(router);
app.mount('#app');
