<!-- =========================================================================================
    File Name: ForgotPassword.vue
    Description: FOrgot Password Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/3 mx-auto self-center">
            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col sm:w-full md:w-full lg:w-full mx-auto self-center d-theme-dark-bg">
                                <div class="p-8">
                                    <div class="vx-card__title mb-8">
                                        <h4 class="mb-4">Recover your password</h4>
                                        <p>Please enter your email address and we'll send you instructions on how to reset your password.</p>
                                    </div>

                                    <vs-input type="email" label-placeholder="Email" v-validate="'required|email|min:3'" v-model="email" class="w-full mb-8" />
                                    <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                                    <vs-button type="border" to="/login" class="px-4 w-full md:w-auto">Back To Login</vs-button>
                                    <vs-button class="float-right px-4 w-full md:w-auto mt-3 mb-8 md:mt-0 md:mb-0" :disabled="!validateForm" @click="resetPassword">Recover Password</vs-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: ''
        }
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.email != '';
        },
    },
    methods: {
        resetPassword() {
            let payload = {email: this.email}
            this.$store.dispatch('auth/forgotPassword', payload)
            .then((response) => {
                console.log(response)
                this.$vs.notify({
                    title: 'Success',
                    text: response.data.message,
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'success'
                })
            })
            .catch(error => {
                this.$vs.notify({
                    title: 'Error',
                    text: error.message,
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'danger'
                })
            })
        }
    }
}
</script>
