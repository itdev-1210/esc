<!-- =========================================================================================
    File Name: ResetPassword.vue
    Description: Reset Password Page
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
                            <div class="vx-col sm:w-full md:w-full lg:w-full mx-auto self-center  d-theme-dark-bg">
                                <div class="p-8">
                                    <div class="vx-card__title mb-8">
                                        <h4 class="mb-4">Reset Password</h4>
                                        <p>Please enter your new password.</p>
                                    </div>

                                    <vs-input
                                    v-validate="'required|email'"
                                    data-vv-validate-on="blur"
                                    name="email"
                                    type="email"
                                    label-placeholder="Email"
                                    placeholder="Email"
                                    v-model="email"
                                    class="w-full mt-6" />
                                    <span class="text-danger text-sm">{{ errors.first('email') }}</span>

                                    <vs-input
                                    ref="password"
                                    type="password"
                                    data-vv-validate-on="blur"
                                    v-validate="'required|min:6'"
                                    name="password"
                                    label-placeholder="Password"
                                    placeholder="Password"
                                    v-model="password"
                                    class="w-full mt-6" />
                                    <span class="text-danger text-sm">{{ errors.first('password') }}</span>

                                    <vs-input
                                    type="password"
                                    v-validate="'min:6|confirmed:password'"
                                    data-vv-validate-on="blur"
                                    data-vv-as="password"
                                    name="confirm_password"
                                    label-placeholder="Confirm Password"
                                    placeholder="Confirm Password"
                                    v-model="confirm_password"
                                    class="w-full mt-6 mb-3" />
                                    <span class="text-danger text-sm">{{ errors.first('confirm_password') }}</span>

                                    <div class="flex flex-wrap justify-between flex-col-reverse sm:flex-row">
                                        <vs-button type="border" to="/login" class="w-full sm:w-auto mb-8 sm:mb-auto mt-3 sm:mt-auto">Go Back To Login</vs-button>
                                        <vs-button class="w-full sm:w-auto" @click="resetPassword" :disabled="!validateForm">Reset</vs-button>
                                    </div>

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
            email: '',
            password: '',
            confirm_password: '',
        }
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.email != '' && this.password != '' && this.confirm_password != '';
        }
    },
    methods: {
        resetPassword() {
            const payload = {
                email: this.email,
                password: this.password,
            }
            this.$store.dispatch('auth/resetPassword', payload)
            .then((response) => {
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
