<!-- =========================================================================================
File Name: RegisterJWT.vue
Description: Register Page for JWT
----------------------------------------------------------------------------------------
Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div class="clearfix">

    <span class="text-success text-sm">{{verify}}</span>
    <span class="text-danger text-sm">{{error}}</span>
    <vs-input
      v-validate="'required|min:3'"
      data-vv-validate-on="blur"
      label-placeholder="Name"
      name="name"
      placeholder="Name"
      v-model="name"
      class="w-full" />
    <span class="text-danger text-sm">{{ errors.first('name') }}</span>

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
      class="w-full mt-6" />
    <span class="text-danger text-sm">{{ errors.first('confirm_password') }}</span>

    <vs-checkbox v-model="isTermsConditionAccepted" class="mt-6">By signing up, you confirm that you’ve read and accepted our Terms of Service and Privacy Policy.</vs-checkbox>
    <vs-button  type="border" to="/login" class="mt-6 mb-10">Login</vs-button>
    <vs-button class="float-right mt-6 mb-10" @click="registerUserJWt" :disabled="!validateForm">Register</vs-button>

    <div class="flex flex-wrap justify-between mb-3">
        <vs-button class="signin-google" @click="registerWithGoogle">
            <img class="mr-4" src="@assets/images/pages/login/google.svg"/>SignUp With Google
        </vs-button>
      <vs-button class="signin-facebook" @click="registerWithFacebook">
          <img class="mr-4" src="@assets/images/pages/login/facebook.png"/>SignUp With Facebook
      </vs-button>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            confirm_password: '',
            isTermsConditionAccepted: true,
            verify: null,
            error: null,
        }
    },
    computed: {
        validateForm() {
            return !this.errors.any() && this.name != '' && this.email != '' && this.password != '' && this.confirm_password != '' && this.isTermsConditionAccepted === true;
        }
    },
    methods: {
        checkLogin() {
          // If user is already logged in notify
          if(this.$store.state.auth.isUserLoggedIn()) {

            // Close animation if passed as payload
            // this.$vs.loading.close()

            this.$vs.notify({
              title: 'Login Attempt',
              text: 'You are already logged in!',
              iconPack: 'feather',
              icon: 'icon-alert-circle',
              color: 'warning'
            })

            return false
          }
          return true
        },
        registerUserJWt() {
            // If form is not validated or user is already login return
            if (!this.validateForm || !this.checkLogin()) return

            // Loading
            this.$vs.loading()

            const payload = {
              userDetails: {
                name: this.name,
                email: this.email,
                password: this.password,
                confirmPassword: this.confirm_password
              },
              notify: this.$vs.notify
            }
            this.$store.dispatch('auth/registerUserJWT', payload)
            .then((response) => {
                this.verify = 'We have sent verification email. Please Check.'
                this.error = null
                this.$vs.loading.close()
            })
            .catch(error => {
                this.error = error.message;
                this.verify = null
                this.$vs.loading.close()
            })
        },

        registerWithGoogle() {
            window.location.href = '/auth/redirect/google'
        },

        registerWithFacebook() {
            window.location.href = '/auth/redirect/facebook'
        }
    }
}
</script>
