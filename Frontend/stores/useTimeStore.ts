import { defineStore } from 'pinia'

export const useTimeStore = defineStore('timeRegister', {
  state: () => {
    return { time: null,
             
    }
  },
  actions: {
    setTime() {

      if (this.timer() >= 0 ) {
        return false;
      }

      const five_minutes_timer = new Date(new Date().getTime() + 5 * 60 * 1000); // เพิ่ม 5 นาที
  
      this.time = five_minutes_timer;
      
      return true;

    },

    clearTime() {

      this.time = null;
      
    },

    timer() { 
      
      if (this.time == null) {
        return -1;
      }

      const localDate = new Date(this.time);

      const currentDate = new Date();

      const timeDifferenceMs = localDate.getTime() - currentDate.getTime();

      const secondsBefore = Math.floor(timeDifferenceMs / 1000);

      return secondsBefore;

    },
   
    
  },
	persist: true
})