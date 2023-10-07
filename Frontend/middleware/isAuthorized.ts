import {useAuthStore} from "~/stores/useAuthStore";

export default defineNuxtRouteMiddleware(async (to, from) => {
  const auth = useAuthStore(); 

  const isAuthorized = await auth.isAuthorized;

  if (!isAuthorized) {
    return navigateTo(`/`); 
  }
  
})
