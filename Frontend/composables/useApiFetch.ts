import type {UseFetchOptions} from 'nuxt/app';
import {useRequestHeaders} from "nuxt/app";
// import nuxtStorage from 'nuxt-storage';
import Cookies from 'js-cookie';

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
  let headers: any = {}

  headers['Accept'] = 'application/json';

  const token = useCookie('XSRF-TOKEN');
  if (token.value) {
    headers['X-XSRF-TOKEN'] = token.value as string;
  }

  if (process.server) {
    headers = {
      ...headers,
      ...useRequestHeaders(["cookie"]),
  	  referer: "http://localhost:3000",
    }
  }

  // const apiToken = nuxtStorage.localStorage.getData('ApiToken');
  const apiToken = Cookies.get("ApiToken");
  if (apiToken != null) {
    headers['Authorization'] = `Bearer ${apiToken}`;
  }

  return useFetch("http://localhost" + path, {
    credentials: "include",
    watch: false,
    ...options,
    headers: {
      ...headers,
      ...options?.headers
    }
  });
}