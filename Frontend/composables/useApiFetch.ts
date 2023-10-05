import type { UseFetchOptions } from 'nuxt/app';
import { useRequestHeaders } from "nuxt/app";
import { useRuntimeConfig } from "nuxt/app";
import { useAuthStore } from "~/stores/useAuthStore";

export default async function <T>(path: string, options: UseFetchOptions<T> = {}) {

  const config = useRuntimeConfig();
  const auth = useAuthStore();

  let headers: any = {};

  headers['Accept'] = 'application/json';

  const XSRFToken = useCookie('XSRF-TOKEN');

  if (XSRFToken.value) {
    headers['X-XSRF-TOKEN'] = XSRFToken.value as string;
  }

  if (process.server) {
    headers = {
      ...headers,
      ...useRequestHeaders(["cookie"]),
      referer: "http://localhost:3000",
    };
  }

  if (auth.isLogin) {
    headers['Authorization'] = `Bearer ${auth.token}`;
  }

  return await useFetch(path, {
    credentials: "include",
    watch: false,
    baseURL: config.public.apiBaseURL,
    ...options,
    headers: {
      ...headers,
      ...options?.headers
    }
  });



}
