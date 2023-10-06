import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
        token: "",
        user: ref<any | null>(null)
    }
  },
  getters: {
    isLogin: (state) => state.token !== ""
  },

  actions: {
    async setCSRFCookie() {
        await useApiFetch("/sanctum/csrf-cookie", {});
    },

    async fetchAuthUser() {
        const {data} = await useApiFetch("/api/user", {});
        this.user.value = data.value 
    },

    setJWTToken(token: string){
        this.token = token
    },

    clearAuth(){
        this.token = ''
        this.user.value = null
    }

  },
    persist: true
})