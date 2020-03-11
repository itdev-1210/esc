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
    fetchUsers({ commit }) {
        return new Promise((resolve, reject) => {
        axios.get("/user-management/users")
            .then((response) => {
                commit('SET_USERS', response.data)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    fetchUser({}, userId) {
        return new Promise((resolve, reject) => {
        axios.get(`/user-management/users/${userId}`)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecord({ commit }, userId) {
        return new Promise((resolve, reject) => {
        axios.delete(`/user-management/users/${userId}`)
            .then((response) => {
                commit('REMOVE_RECORD', userId)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecords({ commit }, ids) {
        return new Promise((resolve, reject) => {
        axios.post('/user-management/users/remove', {ids: ids})
            .then((response) => {
                commit('REMOVE_RECORDS', ids)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    addUser({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.post('/user-management/register', payload)
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
    updateUser({commit}, payload) {
        return new Promise((resolve, reject) => {
            axios.patch(`/user-management/update/${payload.id}`, payload.data)
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
