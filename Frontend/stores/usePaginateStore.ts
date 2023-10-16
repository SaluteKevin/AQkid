import { defineStore } from 'pinia'

export const usePaginateStore = defineStore('paginate', {
  state: () => {
    return { count: 1,
            teacher_page: 1,
            student_page: 1,      
    }
  },
  actions: {
    async setTeacherPage(page: number) {
        this.teacher_page = page;
    },
    async setStudentPage(page: number) {
      this.student_page = page;
  }
  },
	persist: true
})