<!-- =========================================================================================
  File Name: index.vue
  Description: Support
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="logout">
  </div>
</template>

<script>

export default {
    data() {
        return {
        }
    },
    components: {
    },
    methods: {
        logout() {
            localStorage.removeItem('userInfo')
            this.$store.dispatch('auth/logout')
            this.$router.push('/login').catch(() => {})
        }
    },
    created() {
        this.logout()
    }
}
</script>
