/*=========================================================================================
  File Name: moduleCalendarActions.js
  Description: Calendar Module Actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

import axios from "@/axios.js"
import router from '@/router'

export default {
  fetchCompany({commit}) {
    return new Promise((resolve, reject) => {
      axios.get(`/company-management/company`)
        .then((response) => {
            resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  registerCompany({commit}, payload) {
    return new Promise((resolve, reject) => {
      axios.post("/company-management/company", {company: payload.company})
        .then((response) => {
            // commit('SET_COMPANY', response.data.company)
            router.push(response.data.redirectTo)
            resolve(response)
        })
        .catch((error) => { reject(error) })
    })
  },
  updateCompany({commit}, payload) {
      let formData = new FormData();
      formData.append('company', JSON.stringify(payload.company))
      formData.append('company_logo', payload.company_logo)
      formData.append('logo1', payload.logo1)
      formData.append('logo2', payload.logo2)
    return new Promise((resolve, reject) => {
      axios.post("/company-management/update", formData)
        .then((response) => {
            if(response.data.success) {
                resolve(response.data.company)
            }else {
                reject({message: response.data.message})
            }
        })
        .catch((error) => { reject(error) })
    })
  },
}
