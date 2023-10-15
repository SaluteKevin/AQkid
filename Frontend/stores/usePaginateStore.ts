import { defineStore } from 'pinia'

export const usePaginateStore = defineStore('paginate', {
  state: () => {
    return { count: 1,
            teacher_page: 1,      
    }
  },
  actions: {
    setTeacherPage(page: number) {
        this.teacher_page = page;
    }
  },
	persist: true
})