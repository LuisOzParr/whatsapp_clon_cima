import { defineStore } from 'pinia';
import { useRouter } from 'vue-router'

export const useAuthStore = defineStore('auth_store', {
  state: () => ({
    token: localStorage.getItem('access_token') || null,
    user: localStorage.getItem('user')
      ? JSON.parse(localStorage.getItem('user'))
      : {id: null, name: null, phone_number: null},
  }),
  getters: {
    tokenIsSet: (state) => state.token !== null,
    userNames: (state) => state.user.name,
  },
  actions: {
    saveAuth({access_token, user}) {
      localStorage.setItem('access_token', access_token);
      localStorage.setItem('user', JSON.stringify(user));
      this.token = access_token;
      this.user = user;
    },
    destroy() {
      const router = useRouter()
      this.token = null;
      this.user = {id: null, name: null, phone_number: null};
      localStorage.removeItem('user');
      localStorage.removeItem('access_token');

      router.push('/login');
    }
  },
});
