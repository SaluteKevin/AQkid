import { defineStore } from 'pinia'

export const useTimeStore = defineStore('timeRegister', {
  state: () => {
    return { time: null,
            time_semaphore: false,
             
    }
  },
  actions: {
    setTime() {

      if (this.time_semaphore == true ) {
        return false;
      }

      const five_minutes_timer = new Date(new Date().getTime() + 0.1 * 60 * 1000); // เพิ่ม 5 นาที
  
      this.time = five_minutes_timer;
      this.time_semaphore = true;

      return true;

    },

    clearTime() {

      this.time = null;
      this.time_semaphore = false;

    },

    timer() { 

      const localDate = new Date(this.time);

      const currentDate = new Date();

      const timeDifferenceMs = localDate.getTime() - currentDate.getTime();

      const secondsBefore = Math.floor(timeDifferenceMs / 1000);

      return secondsBefore;

    },
   
    
  },
	persist: true
})