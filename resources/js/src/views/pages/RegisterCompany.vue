<!-- =========================================================================================
    File Name: RegisterCompany.vue
    Description: Register Company Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img">
        <div class="vx-col sm:w-full md:w-full lg:w-1/2 xl:w-1/2 mx-auto self-center">
            <vx-card title="Company Details">
                <div class="mt-5">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COMPANY NAME" name="company_name" v-model="company_name" class="mt-5 w-full" :tabindex="1"/>
                                <span class="text-danger text-sm" v-show="errors.has('company_name')">{{ errors.first('company_name') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address_1" v-model="address_1" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('address_1')">{{ errors.first('address_1') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="first_name" class="mt-5 w-full" :tabindex="2"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address_2" v-model="address_2" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('address_2')">{{ errors.first('address_2') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="surname" class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="city" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="county" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="postcode" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="country" :options="countryList" class="w-full" :tabindex="9"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
                            </div>
                        </div>
                        <vs-button type="filled" @click.prevent="submitForm" class="mt-5 mr-0 m-auto block">COMPLETE REGISTERATION</vs-button>
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
    company_name: {
      required: 'PLEASE ENTER COMPANY NAME',
    },
    first_name: {
      required: 'PLEASE ENTER CONTACT FIRST NAME',
    },
    surname: {
      required: 'PLEASE ENTER CONTACT SURNAME',
    },
    address_1: {
      required: 'PLEASE ENTER ADDRESS1',
    },
    address_2: {
      required: 'PLEASE ENTER ADDRESS2',
    },
    city: {
      required: 'PLEASE ENTER CITY/TOWN',
    },
    county: {
      required: 'PLEASE ENTER COUNTY/STATE',
    },
    postcode: {
      required: 'PLEASE ENTER POSTCODE/ZIP',
    },
    country: {
      required: 'PLEASE ENTER COUNTRY',
    },
  }
};

// register custom messages
Validator.localize('en', dict);
import moduleCompanyManagement from '@/store/company-management/moduleCompanyManagement.js'
import vSelect from 'vue-select'
import countryList from "@/views/countryList.js"

export default {
    data() {
        return {
            company_name: "",
            first_name: "",
            surname: "",
            address_1: "",
            address_2: "",
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
                    const payload = {
                        company: {
                            name: this.company_name,
                            first_name: this.first_name,
                            surname: this.surname,
                            address_1: this.address_1,
                            address_2: this.address_2,
                            city: this.city,
                            county: this.county,
                            postcode: this.postcode,
                            country: this.country,
                        }
                    }

                    this.$store.dispatch('companyManagement/registerCompany', payload)
                        .then(() => {})
                        .catch(error => {
                            this.$vs.notify({
                                title: 'Error',
                                text: error.message,
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
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
        // Register Module CompanyManagement Module
        if(!moduleCompanyManagement.isRegistered) {
            this.$store.registerModule('companyManagement', moduleCompanyManagement)
            moduleCompanyManagement.isRegistered = true
        }
    },
    components: {
        'v-select': vSelect,
    }
}
</script>