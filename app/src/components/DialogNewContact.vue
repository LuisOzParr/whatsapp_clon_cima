<template>
  <div class="q-pa-md q-gutter-sm">
    <q-dialog :model-value="isOpen" persistent>
      <q-card class="bg-whatsapp-secondary" style="min-width: 350px">
        <q-card-section>
          <div class="text-h6 tw-text-white">Nuevo contacto</div>
        </q-card-section>

        <q-form @submit="() => onSubmit({name, phone_number})">
          <q-card-section class="q-pt-none ">
            <q-input
              dark
              dense
              type="text"
              v-model="name"
              label="Nombre"
              lazy-rules
              :rules="[
                val => val !== null && val !== '' || 'El campo número de teléfono',
              ]"
            />
            <q-input
              dark
              dense
              type="tel"
              v-model="phone_number"
              label="Número de teléfono"
              lazy-rules
              :rules="[
                val => val !== null && val !== '' || 'El campo número de teléfono',
              ]"
            />
          </q-card-section>

          <q-card-actions align="right" class="text-primary">
            <q-btn flat label="Cancel" type="button" @click="closeModal"/>
            <q-btn flat label="agregar" type="submit"/>
          </q-card-actions>
        </q-form>

      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import {ref, toRefs} from 'vue'

export default {
  props: ['isOpen', 'onSubmit', 'closeModal'],
  setup(props) {
    return {
      address: ref(''),
      phone_number: ref(''),
      name: ref('')
    }
  }
}
</script>
