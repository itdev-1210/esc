/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
  SET_JOBS(state, jobs) {
    state.jobs = jobs
  },
  REMOVE_RECORD(state, itemId) {
      const jobIndex = state.jobs.findIndex((u) => u.id == itemId)
      state.jobs.splice(jobIndex, 1)
  },
}
