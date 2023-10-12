import {useAuthStore} from "~/stores/useAuthStore";

export default defineNuxtRouteMiddleware(async (to, from) => {
  const auth = useAuthStore(); 

  if (auth.user.value.role !== "TEACHER") {
    return navigateTo(`/`); 
  }
  
})
