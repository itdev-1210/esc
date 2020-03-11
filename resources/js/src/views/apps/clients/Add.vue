<!-- =========================================================================================
    File Name: Add.vue
    Description: Add Client Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card>
                <div class="mt-5">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COMPANY NAME" name="company" v-model="company" class="mt-5 w-full" :tabindex="1"/>
                                <span class="text-danger text-sm" v-show="errors.has('company')">{{ errors.first('company') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address1" v-model="address1" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('address1')">{{ errors.first('address1') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">CONTACT TITLE</label>
                                    <v-select label="contact_name" name="title" v-model="title" :options="['Mr', 'Mrs', 'Ms', 'Miss']" class="w-full" :tabindex="2"/>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address2" v-model="address2" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="first_name" class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="city" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="surname" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="county" class="mt-5 w-full" :tabindex="10"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required|email'" label="EMAIL" name="email" v-model="email" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="postcode" class="mt-5 w-full" :tabindex="11"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="PHONE" name="phone" v-model="phone" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="country" :options="countryList" class="w-full" :tabindex="12"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
                            </div>
                        </div>
                        <vs-button type="filled" @click.prevent="submitForm" class="mt-5 mr-0 m-auto block">SAVE</vs-button>
                    </form>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
// For custom error message
import { Validator } from 'vee-validate';
const dict = {
  custom: {
    company: {
      required: 'Please input company name',
    },
    title: {
      required: 'Please input contact title',
    },
    first_name: {
      required: 'Please input contact first name',
    },
    surname: {
      required: 'Please input contact surname',
    },
    email: {
      required: 'Please input a email',
      email: 'Please input a valid email address'
    },
    phone: {
      required: 'Please input phone number',
    },
    address1: {
      required: 'Please input address1',
    },
    address2: {
      required: 'Please input address2',
    },
    city: {
      required: 'Please input city/town',
    },
    county: {
      required: 'Please input county/state',
    },
    postcode: {
      required: 'Please input postcode/zip',
    },
    country: {
      required: 'Please input country',
    },
  }
};

// register custom messages
Validator.localize('en', dict);
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'
import vSelect from 'vue-select'
import countryList from "@/views/countryList.js"

export default {
    data() {
        return {
            company: "",
            title: "",
            first_name: "",
            surname: "",
            email: "",
            phone: "",
            address1: "",
            address2: "",
            city: "",
            county: "",
            postcode: "",
            country: "United Kingdom",
            countryList: countryList,
        }
    },
    methods: {
        submitForm() {
            this.$validator.validateAll().then(result => {
                if(result) {
                    this.$vs.loading()
                    // if form have no errors
                    let post_data = {
                        company: this.company,
                        title: this.title,
                        first_name: this.first_name,
                        surname: this.surname,
                        email: this.email,
                        phone: this.phone,
                        address1: this.address1,
                        address2: this.address2,
                        city: this.city,
                        county: this.county,
                        postcode: this.postcode,
                        country: this.country,
                    }
                    this.$store.dispatch("userManagement/addUser", post_data)
                    .then(res => {
                        this.$vs.loading.close()
                        this.$vs.notify({
                            title: 'Success',
                            text: 'Client added successfully',
                            iconPack: 'feather',
                            icon: 'icon-alert-circle',
                            position:'top-right',
                            color: 'success'
                        })
                        this.$router.back()
                    })
                    .catch(error => {
                        this.$vs.loading.close()
                        this.$vs.notify({
                            title: 'Error',
                            text: error.message,
                            iconPack: 'feather',
                            icon: 'icon-alert-circle',
                            position:'top-right',
                            color: 'danger'
                        })
                    })
                }else{
                    // form have errors
                }
            })
        }
    },
    created() {
        // Register Module UserManagement Module
        if(!moduleUserManagement.isRegistered) {
            this.$store.registerModule('userManagement', moduleUserManagement)
            moduleUserManagement.isRegistered = true
        }
    },
    components: {
        'v-select': vSelect,
    }
}
</script>
