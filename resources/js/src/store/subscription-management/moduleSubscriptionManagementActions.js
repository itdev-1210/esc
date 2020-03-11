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
  subscription({commit}, payload) {
    return new Promise((resolve, reject) => {
      axios.post("/subscription", {paymentMethod: payload.paymentMethod, amount: payload.amount})
        .then((response) => {
            if (response.data.success) {
                router.push(response.data.redirectTo)
                resolve(response)
            } else {
                reject({message: response.data.message})
            }
        })
        .catch((error) => { reject(error) })
    })
  },
  getSubscription({commit}) {
    return new Promise((resolve, reject) => {
        axios.get("/subscriptionDetail")
          .then((response) => {
              if (response.data.success) {
                  resolve(response.data)
              } else {
                  reject({message:response.data.message})
              }
          })
          .catch((error) => { reject(error) })
      })
  },
  upgradeSubscription({commit}, payload) {
    return new Promise((resolve, reject) => {
        axios.post("/upgradeSubscription", {amount: payload.amount})
          .then((response) => {
              if (response.data.success) {
                  resolve(response.data)
              } else {
                  reject({message: response.data.message})
              }
          })
          .catch((error) => { reject(error) })
      })
  }
}
