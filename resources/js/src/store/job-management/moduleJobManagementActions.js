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
    fetchJobs({ commit }) {
        return new Promise((resolve, reject) => {
        axios.get("/job-management/jobs")
            .then((response) => {
                commit('SET_JOBS', response.data)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    fetchJob({}, id) {
        return new Promise((resolve, reject) => {
        axios.get(`/job-management/jobs/${id}`)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    fetchJobDetail({}, id) {
        return new Promise((resolve, reject) => {
        axios.get(`/job-management/job/${id}`)
            .then((response) => {
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecord({ commit }, id) {
        return new Promise((resolve, reject) => {
        axios.delete(`/job-management/jobs/${id}`)
            .then((response) => {
                commit('REMOVE_RECORD', id)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    removeRecords({ commit }, ids) {
        return new Promise((resolve, reject) => {
        axios.post('/job-management/jobs/remove', {ids: ids})
            .then((response) => {
                commit('REMOVE_RECORDS', ids)
                resolve(response)
            })
            .catch((error) => { reject(error) })
        })
    },
    addJob({commit}, payload) {
        let formData = new FormData();
        formData.append('job', JSON.stringify(payload.job))
        formData.append('timesheets', JSON.stringify(payload.timesheets))
        formData.append('signature', payload.signature)
        return new Promise((resolve, reject) => {
            axios.post('/job-management/register', formData)
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
    updateJob({commit}, payload) {
        let formData = new FormData();
        formData.append('job', JSON.stringify(payload.job))
        formData.append('timesheets', JSON.stringify(payload.timesheets))
        formData.append('signature', payload.signature)
        return new Promise((resolve, reject) => {
            axios.post(`/job-management/update/${payload.id}`, formData)
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
