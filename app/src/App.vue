<template>
  <router-view />
</template>

<script>
import { defineComponent } from 'vue'

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

/*window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'app-key',
  wsHost: 'localhost',
  wsPort: '6001',
  forceTLS: false,
  encrypted: false,
  disableStats: true,
  enabledTransports: ['ws'],
  cluster: "mt1"
});*/

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.env.PUSHER_APP_KEY,
  wsHost: process.env.env.PUSHER_HOST,
  wsPort: process.env.env.PUSHER_PORT,
  forceTLS: false,
  encrypted: false,
  disableStats: true,
  enabledTransports: ['ws'],
  cluster: process.env.env.PUSHER_APP_CLUSTER
});



export default defineComponent({
  name: 'App'
})
</script>
