/*=========================================================================================
  File Name: moduleCalendarMutations.js
  Description: Calendar Module Mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default {
    SET_PROPERTIES(state, properties) {
        state.properties = properties
    },
    REMOVE_RECORD(state, id) {
        const propertyIndex = state.properties.findIndex((u) => u.id == id)
        state.properties.splice(propertyIndex, 1)
    },
    REMOVE_RECORDS(state, ids) {
        ids.map((id) => {
            const propertyIndex = state.properties.findIndex((u) => u.id == id)
            state.properties.splice(propertyIndex, 1)
        })
    },
}
