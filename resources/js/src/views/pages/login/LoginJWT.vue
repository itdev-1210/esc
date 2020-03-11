<template>
  <div>
    <span class="text-danger text-sm">{{error}}</span>
    <vs-input
        v-validate="'required|email|min:3'"
        data-vv-validate-on="blur"
        name="email"
        icon-no-border
        icon="icon icon-user"
        icon-pack="feather"
        label-placeholder="Email"
        v-model="email"
        class="w-full mb-3 pt-3"/>
    <span class="text-danger text-sm">{{ errors.first('email') }}</span>

    <vs-input
        data-vv-validate-on="blur"
        v-validate="'required|min:6'"
        type="password"
        name="password"
        icon-no-border
        icon="icon icon-lock"
        icon-pack="feather"
        label-placeholder="Password"
        v-model="password"
        class="w-full mt-6 pt-3" />
    <span class="text-danger text-sm">{{ errors.first('password') }}</span>

    <div class="flex flex-wrap justify-between my-5">
        <vs-checkbox v-model="checkbox_remember_me" class="mb-3">Remember Me</vs-checkbox>
        <router-link to="/forgot-password">Forgot Password?</router-link>
    </div>
    <div class="flex flex-wrap justify-between mb-10">
      <vs-button  type="border" @click="registerUser">Register</vs-button>
      <vs-button :disabled="!validateForm" @click="loginJWT">Login</vs-button>
    </div>

    <div class="flex flex-wrap justify-between">
        <vs-button class="signin-google" @click="loginWithGoogle">
            <img class="mr-4" src="@assets/images/pages/login/google.svg"/>SignIn With Google
        </vs-button>
      <vs-button class="signin-facebook" @click="loginWithFacebook">
          <img class="mr-4" src="@assets/images/pages/login/facebook.png"/>SignIn With Facebook
      </vs-button>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      email: 'admin@admin.com',
      password: 'adminadmin',
      checkbox_remember_me: false,
      error: null,
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any() && this.email != '' && this.password != '';
    },
  },
  methods: {
    checkLogin() {
      // If user is already logged in notify
    //   if (this.$store.state.auth.isUserLoggedIn()) {
    //     this.$router.push('/').catch(() => {})
    //     return false
    //   }
      return true
    },
    loginJWT() {

      if (!this.checkLogin()) return

      // Loading
      this.$vs.loading()

      const payload = {
        checkbox_remember_me: this.checkbox_remember_me,
        userDetails: {
          email: this.email,
          password: this.password
        }
      }

      this.$store.dispatch('auth/loginJWT', payload)
        .then(() => { this.$vs.loading.close() })
        .catch(error => {
          this.$vs.loading.close()
          this.error = error.message
        })
    },
    registerUser() {
      if (!this.checkLogin()) return
      this.$router.push('/register').catch(() => {})
    },

    loginWithGoogle() {
        window.location.href = '/auth/redirect/google'
    },

    loginWithFacebook() {
        window.location.href = '/auth/redirect/facebook'
    }
  },
  created() {
      this.checkLogin()
  }
}

</script>

