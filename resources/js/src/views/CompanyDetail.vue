<!-- =========================================================================================
    File Name: CompanyDetail.vue
    Description: Company Detail Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img" v-if="data">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card title="Company Details">
                <div class="mt-5" v-if="data_local">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required|email'" label="EMAIL" name="email" v-model="data_local.email" class="mt-5 w-full" :tabindex="1"/>
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">COMPANY LOGO</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="data_local.company_logo_src" v-bind:src="data_local.company_logo_src"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadCompanyLogo">UPLOAD COMPANY LOGO</div>
                                        <input class="hidden" type="file" id="company_logo" ref="company_logo" accept="image/*" v-on:change="handleLogoUpload"/>
                                    </div>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input type="password"
                                    label="NEW PASSWORD"
                                    name="password"
                                    data-vv-validate-on="blur"
                                    v-model="password"
                                    ref="password"
                                    class="mt-5 w-full" :tabindex="2"/>
                                <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">ACCREDITATION LOGO1</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="data_local.logo1_src" v-bind:src="data_local.logo1_src"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadLogo1">UPLOAD ACCREDIATION LOGO1</div>
                                        <input class="hidden" type="file" id="acc_logo1" ref="acc_logo1" accept="image/*" v-on:change="handleLogo1Upload"/>
                                    </div>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input type="password"
                                    v-validate="'confirmed:password'"
                                    data-vv-as="password"
                                    data-vv-validate-on="blur"
                                    label="CONFIRM NEW PASSWORD"
                                    name="confirm_password"
                                    v-model="confirm_password"
                                    class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('confirm_password')">{{ errors.first('confirm_password') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">ACCREDITATION LOGO2</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="data_local.logo2_src" v-bind:src="data_local.logo2_src"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadLogo2">UPLOAD ACCREDIATION LOGO2</div>
                                        <input class="hidden" type="file" id="acc_logo2" ref="acc_logo2" accept="image/*" v-on:change="handleLogo2Upload"/>
                                    </div>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COMPANY NAME" name="company_name" v-model="data_local.name" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('company_name')">{{ errors.first('company_name') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address_1" v-model="data_local.address_1" class="mt-5 w-full" :tabindex="11"/>
                                <span class="text-danger text-sm" v-show="errors.has('address_1')">{{ errors.first('address_1') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">CONTACT TITLE</label>
                                    <v-select label="contact_name" name="contact_title" :tabindex="5" v-model="data_local.contact_title" :options="['Mr', 'Mrs', 'Ms', 'Miss']" class="w-full"/>
                                </div>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address_2" v-model="data_local.address_2" class="mt-5 w-full" :tabindex="12"/>
                                <span class="text-danger text-sm" v-show="errors.has('address_2')">{{ errors.first('address_2') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="data_local.first_name" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="data_local.city" class="mt-5 w-full" :tabindex="13"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="data_local.surname" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="data_local.county" class="mt-5 w-full" :tabindex="14"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input label="COMPANY WEBSITE" name="website" v-model="data_local.website" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('website')">{{ errors.first('website') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="data_local.postcode" class="mt-5 w-full" :tabindex="15"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input label="COMPANY REGISTERATION NUMBER" name="reg_number" v-model="data_local.reg_number" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('reg_number')">{{ errors.first('reg_number') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="data_local.country" :options="countryList" class="w-full" :tabindex="16"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input label="COMPANY VAT NUMBER" name="vat_number" v-model="data_local.vat_number" class="mt-5 w-full" :tabindex="10"/>
                                <span class="text-danger text-sm" v-show="errors.has('vat_number')">{{ errors.first('vat_number') }}</span>
                            </div>
                            <div class="vx-col w-1/2">
                                <vs-input label="PHONE" name="phone" v-model="data_local.phone" class="mt-5 w-full" :tabindex="17"/>
                                <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
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
import moduleCompanyManagement from '@/store/company-management/moduleCompanyManagement.js'
// For custom error message
import { Validator } from 'vee-validate';
const dict = {
  custom: {
    email: {
      required: 'Please input a email',
      email: 'Please input valid email',
    },
    company_name: {
      required: 'Please input company name',
    },
    contact_title: {
      required: 'Please input contact title',
    },
    first_name: {
      required: 'Please input contact first name',
    },
    surname: {
      required: 'Please input contact surname',
    },
    address_1: {
      required: 'Please input address1',
    },
    address_2: {
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
    website: {
      required: 'Please input company website',
    },
    reg_number: {
      required: 'Please input company registeration number',
    },
    vat_number: {
      required: 'Please input company vat number',
    },
    phone: {
      required: 'Please input phone number',
    },
  }
};

// register custom messages
Validator.localize('en', dict);
import vSelect from 'vue-select'
import countryList from "@/views/countryList.js"

export default {
    data() {
        return {
            data: null,
            data_local: null,
            password: "",
            confirm_password: "",
            company_logo: null,
            logo1: null,
            logo2: null,
            countryList: countryList,
        }
    },
    methods: {
        submitForm() {
            this.$validator.validateAll().then(result => {
                if(result) {
                    // if form have no errors
                    this.$vs.loading()
                    const payload = {
                        company: {
                            id: this.data_local.id,
                            name: this.data_local.name,
                            first_name: this.data_local.first_name,
                            surname: this.data_local.surname,
                            address_1: this.data_local.address_1,
                            address_2: this.data_local.address_2,
                            city: this.data_local.city,
                            county: this.data_local.county,
                            postcode: this.data_local.postcode,
                            country: this.data_local.country,
                            email: this.data_local.email,
                            password: this.password,
                            contact_title: this.data_local.contact_title,
                            website: this.data_local.website,
                            reg_number: this.data_local.reg_number,
                            vat_number: this.data_local.vat_number,
                            phone: this.data_local.phone,
                        },
                        company_logo: this.company_logo,
                        logo1: this.logo1,
                        logo2: this.logo2,
                    }

                    this.$store.dispatch('companyManagement/updateCompany', payload)
                    .then((res) => {
                        this.data = res
                        this.data_local = JSON.parse(JSON.stringify(res))
                        this.$vs.loading.close()
                        this.$vs.notify({
                            title: 'Success',
                            text: 'Update Successfully',
                            iconPack: 'feather',
                            icon: 'icon-alert-circle',
                            position:'top-right',
                            color: 'success'
                        })
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
        },
        fetch_company_data() {
            this.$store.dispatch("companyManagement/fetchCompany")
            .then(res => {
                this.data = res.data
                this.data_local = JSON.parse(JSON.stringify(res.data))
            })
            .catch(err => {
            if(err.response.status === 404) {
                // this.company_not_found = true
                return
            }
            console.error(err) })
        },
        uploadCompanyLogo() {
            this.$refs.company_logo.click();
        },
        uploadLogo1() {
            this.$refs.acc_logo1.click();
        },
        uploadLogo2() {
            this.$refs.acc_logo2.click();
        },
        handleLogoUpload(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.company_logo = files[0];
            this.data_local.company_logo_src = URL.createObjectURL(this.company_logo);
        },
        handleLogo1Upload(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.logo1 = files[0];
            this.data_local.logo1_src = URL.createObjectURL(this.logo1);
        },
        handleLogo2Upload(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.logo2 = files[0];
            this.data_local.logo2_src = URL.createObjectURL(this.logo2);
        },
    },
    created() {
        // Register Module CompanyManagement Module
        if(!moduleCompanyManagement.isRegistered) {
            this.$store.registerModule('companyManagement', moduleCompanyManagement)
            moduleCompanyManagement.isRegistered = true
        }
        this.fetch_company_data()
    },
    components: {
        'v-select': vSelect,
    },
}
</script>
<style lang="scss">
.img-logo {
    height: 35px;
    margin: 0;
}
.upload-btn {
    padding: 5px 7px;
    border-radius: 6px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    box-shadow: 0 0 0 0 rgba(0,0,0,.15);
}
</style>
