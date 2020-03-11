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
    fetchEngineers({ commit }) {
        return new Promise((resolve, reject) => {
            axios.get("/engineer-management/engineers")
            .then((response) => {
                commit('SET_ENGINEERS', response.data)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    fetchEngineer({}, id) {
        return new Promise((resolve, reject) => {
            axios.get(`/engineer-management/engineers/${id}`)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecord({ commit }, id) {
        return new Promise((resolve, reject) => {
            axios.delete(`/engineer-management/engineers/${id}`)
            .then((response) => {
                commit('REMOVE_RECORD', id)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecords({ commit }, ids) {
        return new Promise((resolve, reject) => {
        axios.post('/engineer-management/engineers/remove', {ids: ids})
            .then((response) => {
                commit('REMOVE_RECORDS', ids)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    addEngineer({commit}, payload) {
        let formData = new FormData();
        formData.append('engineer', JSON.stringify(payload.engineer))
        formData.append('signature', payload.signature)
        return new Promise((resolve, reject) => {
            axios.post('/engineer-management/register', formData)
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
    updateEngineer({commit}, payload) {
        let formData = new FormData();
        formData.append('engineer', JSON.stringify(payload.engineer))
        formData.append('signature', payload.signature)
        return new Promise((resolve, reject) => {
            axios.post(`/engineer-management/update/${payload.id}`, formData)
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
