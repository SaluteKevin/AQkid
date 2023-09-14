import type {UseFetchOptions} from 'nuxt/app';
import {useRequestHeaders} from "nuxt/app";
import { useAuthStore } from '~/store/useAuthStore';
import nuxtStorage from 'nuxt-storage';

export function useApiFetch<T>(path: string, options: UseFetchOptions<T> = {}) {
  let headers: any = {}

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

  const apiToken = nuxtStorage.localStorage.getData('ApiToken');
  if (apiToken != null) {
    headers['Authorization'] = `Bearer ${apiToken}`;
  }

  return useFetch("http://localhost:8000" + path, {
    credentials: "include",
    watch: false,
    ...options,
    headers: {
      ...headers,
      ...options?.headers
    }
  });
}