<template>
  <div class="q-pa-md q-gutter-sm">
    <q-dialog :model-value="isOpen" persistent>
      <q-card class="bg-whatsapp-secondary" style="min-width: 350px">
        <q-card-section>
          <div class="text-h6 tw-text-white">Reenviar mensaje</div>
        </q-card-section>

        <q-card-section class="q-pt-none ">
          <q-list  bordered separator class="bg-whatsapp-secondary text-white">
            <UserContacts
              v-for="contact in contacts"
              :title="contact.name"
              v-bind:key="`contact-resend${contact.id}`"
              @click="() => onResend(contact.id)"
            />
          </q-list>
        </q-card-section>

        <q-card-actions align="right" class="text-primary">
          <q-btn flat label="Cancel" type="button" @click="closeModal"/>
        </q-card-actions>

      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import UserContacts from "components/UserContacts.vue";
import {api} from "boot/axios";

export default {
  components: {UserContacts},
  props: ['isOpen', 'closeModal', 'contacts', 'onResend'],
  setup(props) {

  }
}
</script>
