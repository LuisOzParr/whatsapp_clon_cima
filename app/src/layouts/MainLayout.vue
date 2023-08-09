<template>
  <q-layout view="lHh lpR lFf" class="bg-whatsapp-secondary">

    <q-header class="text-white bg-whatsapp-primary">
      <q-toolbar>
        <q-toolbar-title>
          <q-avatar>
            <img src="~assets/default-avatar.jpeg" alt="">
          </q-avatar>
          User name
        </q-toolbar-title>
      </q-toolbar>
    </q-header>

    <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered class="bg-whatsapp-secondary">
      <q-toolbar class="bg-whatsapp-primary text-white">
        <q-avatar>
          <img src="~assets/default-avatar.jpeg" alt="">
        </q-avatar>
        <q-toolbar-title>
          {{ userName }}
        </q-toolbar-title>
        <q-btn flat round dense icon="groups" />
        <q-btn flat round dense icon="chat" />
        <q-btn flat round dense icon="more_vert" />
      </q-toolbar>
      <q-list bordered separator class="bg-whatsapp-secondary text-white">
        <UserContacts v-for="(contact, index) in contacts" :name="contact.fist_name" v-bind:key="index" />
      </q-list>

    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-footer class="bg-whatsapp-primary ">
      <q-toolbar >
        <q-btn round flat icon="insert_emoticon" class="q-mr-sm text-white" />
        <q-input borderless dark outlined dense class="col-grow" bg-color="blue-grey-10" v-model="message" placeholder="Escribe un mensaje aquí" />
      </q-toolbar>
    </q-footer>

  </q-layout>
</template>

<script>
import { ref } from 'vue'
import { api } from 'boot/axios'
import { useAuthStore } from 'stores/useAuthStore'
import UserContacts from 'components/UserContacts.vue'

export default {
  components: { UserContacts },
  setup () {
    const store = useAuthStore();
    const leftDrawerOpen = ref(false)
    const contacts = ref([])
    const message = ref('');

    api.get('v1/contacts').then(res => {
      console.log(res)
      contacts.value = res.data;
    });

    return {
      leftDrawerOpen,
      userName: store.userNames,
      contacts,
      message
    }
  }
}
</script>