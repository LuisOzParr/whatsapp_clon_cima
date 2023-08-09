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

        <div class="flex column">
          <q-btn label="Login" type="submit" color="primary"/>
          <q-btn flat color="primary" label="Crear una cuneta" to="/register"/>
        </div>
      </q-form>

    </div>

  </q-page>
</template>

<script>
import { useQuasar } from 'quasar'
import { ref } from 'vue'
import { api } from 'boot/axios'
import { useAuthStore } from 'stores/useAuthStore'
import { useRouter } from 'vue-router'

export default {
  setup () {
    const $q = useQuasar()
    const store = useAuthStore();
    const router = useRouter()

    const phone_number = ref(null)
    const password = ref(null)
    const isPwd = ref(true)

    return {
      name,
      phone_number,
      password,
      isPwd,

      onSubmit () {
        api.post('/login', {
          'phone_number': phone_number.value,
          'password': password.value
        }).then(res => {
          store.saveAuth(res.data);
          router.push({ path: '/' })
        }).catch(error => {
          console.log(error.response);
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