import { defineStore } from 'pinia'

export const useTimeStore = defineStore('timeRegister', {
  state: () => {
    return { time: 300,
    }
  },
  actions: {
    async setTime(time: number) {
        this.time = time;
    },
    timeDown() {
        if (this.time > 0)
        this.time -= 1;
    },
    
    
  },
	persist: true
})