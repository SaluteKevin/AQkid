import { defineStore } from 'pinia'

export const usePaginateStore = defineStore('paginate', {
  state: () => {
    return { count: 1,
            teacher_page: 1,
            student_page: 1,
            student_filter: 'all',
            enroll_page: 1,
            enrollHistory_page: 1,
            refund_page: 1,
            refundHistory_page: 1,  
            makeup_page: 1,
            makeupHistory_page: 1,     
    }
  },
  actions: {
    async setTeacherPage(page: number) {
        this.teacher_page = page;
    },
    
    async setStudentPage(page: number) {
      this.student_page = page;
    },

    async setStudentFilter(filter: string) {
      this.student_filter = filter;
    },
    
    async setEnrollPage(page: number) {
      this.enroll_page = page;
    },

    async setEnrollHistoryPage(page: number){
      this.enrollHistory_page = page;
    },

    async setRefundPage(page: number) {
      this.refund_page = page;
    },

    async setRefundHistoryPage(page: number){
      this.refundHistory_page = page;
    },

    async setMakeUpPage(page: number) {
      this.makeup_page = page;
    },

    async setMakeUpHistoryPage(page: number){
      this.makeupHistory_page = page;
    }
  },
	persist: true
})