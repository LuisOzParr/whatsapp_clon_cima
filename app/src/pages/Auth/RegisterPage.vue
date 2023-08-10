<template>
  <q-page>

    <div class="q-pa-md" style="max-width: 400px">

      <q-form
          @submit="onSubmit"
          @reset="onReset"
          class="q-gutter-md"
      >
        <q-input
            filled
            v-model="name"
            label="Nombre *"
            lazy-rules
            :rules="[ val => val && val.length > 0 || 'El campo nombre es requerido']"
        />

        <q-input
            filled
            type="tel"
            v-model="phone_number"
            label="Número de teléfono"
            lazy-rules
            :rules="[
          val => val !== null && val !== '' || 'El campo número de teléfono',
          //val => val.lenght = 10 || 'El campo número de teléfono debe tener 10 números'
        ]"
        />

        <q-input v-model="password" filled :type="isPwd ? 'password' : 'text'" label="Contraseña">
          <template v-slot:append>
            <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
            />
          </template>
        </q-input>

        <div class="column">
          <q-btn label="Registrarse" type="submit" color="primary"/>
          <q-btn flat label="¿Ya tienes una cuenta?" to="/login" color="primary"/>
        </div>
      </q-form>

    </div>

  </q-page>
</template>

<script>
import { useQuasar } from 'quasar'
import { ref } from 'vue'
import { api } from 'boot/axios'

export default {
  setup () {
    const $q = useQuasar()

    const name = ref(null)
    const phone_number = ref(null)
    const password = ref(null)
    const isPwd = ref(true)

    return {
      name,
      phone_number,
      password,
      isPwd,

      onSubmit () {
        api.post('/register', {
          'name': name.value,
          'phone_number': phone_number.value,
          'password': password.value
        }).then(res => {
        }).catch(error => {
          $q.notify({
            color: 'red-5',
            textColor: 'white',
            icon: 'warning',
            message: error.response.data.message
          })
        })
      },

      onReset () {
        name.value = null
        phone_number.value = null
      }
    }
  }
}
</script>
