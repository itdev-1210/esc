/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"

export default {
    fetchProperties({ commit }) {
        return new Promise((resolve, reject) => {
        axios.get("/property-management/properties")
            .then((response) => {
                commit('SET_PROPERTIES', response.data)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    fetchProperty({}, id) {
        return new Promise((resolve, reject) => {
        axios.get(`/property-management/properties/${id}`)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecord({ commit }, id) {
        return new Promise((resolve, reject) => {
        axios.delete(`/property-management/properties/${id}`)
            .then((response) => {
                commit('REMOVE_RECORD', id)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecords({ commit }, ids) {
        return new Promise((resolve, reject) => {
        axios.post('/property-management/properties/remove', {ids: ids})
            .then((response) => {
                commit('REMOVE_RECORDS', ids)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    addProperty({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.post('/property-management/register', payload)
            .then((response) => {
                if (response.data.success) {
                    resolve(response)
                } else {
                    reject({message: response.data.message})
                }
            })
            .catch((error) => { reject(error) })
        })
    },
    updateProperty({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.patch(`/property-management/update/${payload.id}`, payload.data)
            .then((response) => {
                if (response.data.success) {
                    resolve(response)
                } else {
                    reject({message: response.data.message})
                }
            })
            .catch((error) => { reject(error) })
        })
    }
}
