import { createApp } from 'vue'

import router from './router'

import Intrf from './Intrf.vue'

const intrf = createApp(Intrf)


intrf.use(router)

intrf.mount('#intrf')