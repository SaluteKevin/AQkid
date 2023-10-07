import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => {
    return {
        token: "",
        user: ref<any>({}) // ควรกำหนด type
    }
  },
  getters: {
    isLogin: (state) => state.token !== "",

    async isAuthorized() {
      const {data} = await useApiFetch("api/auth/me", {
        method: "POST",
      }); 
      
      if (data.value) {
        return true
      }
    
      else {
        return false
      }
      
    },
  },

  actions: {
    async setCSRFCookie() {
        await useApiFetch<any>("sanctum/csrf-cookie", {});
    },

    async fetchAuthUser() {
        const {data} = await useApiFetch("api/auth/me", {
          method: "POST",
        });

        this.user.value = data.value
    },

    async setJWTToken(token: string){
        this.token = token
    },

    clearAuth(){
        this.token = ''
        this.user.value = {}
    }

  },
    persist: true
})