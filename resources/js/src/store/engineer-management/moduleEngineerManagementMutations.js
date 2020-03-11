/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    SET_ENGINEERS(state, engineers) {
        state.engineers = engineers
    },
    REMOVE_RECORD(state, itemId) {
        const index = state.engineers.findIndex((u) => u.id == itemId)
        state.engineers.splice(index, 1)
    },
    REMOVE_RECORDS(state, ids) {
        ids.map((id) => {
            const engineerIndex = state.engineers.findIndex((u) => u.id == id)
            state.engineers.splice(engineerIndex, 1)
        })
    },
}
