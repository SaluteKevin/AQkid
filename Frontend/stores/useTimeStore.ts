import { defineStore } from 'pinia'

export const useTimeStore = defineStore('timeRegister', {
  state: () => {
    return { time: new Date,
             
    }
  },
  actions: {
    async setTime() {
      const currentTime = new Date();
      const newTime = new Date(currentTime.getTime() + 5 * 60 * 1000); // เพิ่ม 5 นาที
  
      this.time = newTime;
    },
    async updateTime() {
      if (this.time == null){
        this.time = new Date();
      }
    }

    
    
    
    
  },
	persist: true
})