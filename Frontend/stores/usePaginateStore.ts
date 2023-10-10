import { defineStore } from 'pinia'

export const usePaginateStore = defineStore('paginate', {
  state: () => {
    return { count: 1 }
  },
  actions: {
    setPage(page: number) {
        this.count = page;
    }
  },
	persist: true
})