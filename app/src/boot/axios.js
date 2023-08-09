import { boot } from 'quasar/wrappers'
import axios from 'axios'
import { useAuthStore } from 'stores/useAuthStore'
import { useQuasar } from 'quasar'

// Be careful when using SSR for cross-request state pollution
// due to creating a Singleton instance here;
// If any client changes this (global) instance, it might be a
// good idea to move this instance creation inside of the
// "export default () => {}" function below (which runs individually
// for each client)
const api = axios
  .create({ baseURL: 'http://127.0.0.1:8000/api' })


api.interceptors
  .response
  .use((res) => {
    return res;
  }, (error) => {
    const store = useAuthStore();
    const $q = useQuasar()

    switch (error.response.status) {
      case 401:
        store.destroy()
        break
      case 403:
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'warning',
          message: error.response.data.message
        })
        break
    }
    return Promise.reject(error);
  });


export default boot(({ app }) => {
  // for use inside Vue files (Options API) through this.$axios and this.$api

  app.config.globalProperties.$axios = axios
  // ^ ^ ^ this will allow you to use this.$axios (for Vue Options API form)
  //       so you won't necessarily have to import axios in each vue file

  app.config.globalProperties.$api = api
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
})

export { api }
