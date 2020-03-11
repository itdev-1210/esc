<!-- =========================================================================================
    File Name: Add.vue
    Description: Add Engineer Page
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
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">TITLE</label>
                                    <v-select label="title" name="title" v-model="title" :options="['Mr', 'Mrs', 'Ms', 'Miss']" class="w-full" :tabindex="1"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address1" v-model="address1" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('address1')">{{ errors.first('address1') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input type="password"
                                    v-validate="'required'"
                                    label="APP PASSWORD"
                                    name="password"
                                    data-vv-validate-on="blur"
                                    v-model="password"
                                    ref="password"
                                    class="mt-5 w-full" :tabindex="12"/>
                                <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="first_name" class="mt-5 w-full" :tabindex="2"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address2" v-model="address2" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input type="password"
                                    v-validate="'confirmed:password'"
                                    data-vv-as="password"
                                    data-vv-validate-on="blur"
                                    label="CONFIRM APP PASSWORD"
                                    name="confirm_password"
                                    v-model="confirm_password"
                                    class="mt-5 w-full" :tabindex="13"/>
                                <span class="text-danger text-sm" v-show="errors.has('confirm_password')">{{ errors.first('confirm_password') }}</span>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="surname" class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="city" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">SIGNATURE</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="signature" v-bind:src="signature"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadSignature">UPLOAD SIGNATURE</div>
                                        <input class="hidden" type="file" id="signature" ref="signature" accept="image/*" v-on:change="handleSignatureUpload" :tabindex="14"/>
                                    </div>
                                </div>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required|email'" label="EMAIL" name="email" v-model="email" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="county" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="PHONE" name="phone" v-model="phone" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="postcode" class="mt-5 w-full" :tabindex="10"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="country" :options="countryList" class="w-full" :tabindex="11"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
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
    password: {
        required: 'Please input password',
    },
    confirm_password: {
        required: 'Please input confirm password',
    },
  }
};

// register custom messages
Validator.localize('en', dict);
import moduleEngineerManagement from '@/store/engineer-management/moduleEngineerManagement.js'
import countryList from "@/views/countryList.js"
import vSelect from 'vue-select'

export default {
    data() {
        return {
            password: "",
            confirm_password: "",
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
            signature: "",
            file: null,
            countryList: countryList,
        }
    },
    methods: {
        submitForm() {
            this.$validator.validateAll().then(result => {
                if(result) {
                    this.$vs.loading()
                    const payload = {
                        engineer: {
                            title: this.title,
                            first_name: this.first_name,
                            surname: this.surname,
                            email: this.email,
                            phone: this.phone,
                            password: this.password,
                            address1: this.address1,
                            address2: this.address2,
                            city: this.city,
                            county: this.county,
                            postcode: this.postcode,
                            country: this.country,
                        },
                        signature: this.file,
                    }

                    this.$store.dispatch('engineerManagement/addEngineer', payload)
                    .then((res) => {
                        this.$vs.loading.close()
                        this.$vs.notify({
                            title: 'Success',
                            text: 'Added Successfully',
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
        },
        uploadSignature() {
            this.$refs.signature.click();
        },
        handleSignatureUpload(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.file = files[0];
            this.signature = URL.createObjectURL(this.file);
        },
    },
    created() {
        // Register Module EngineerManagement Module
        if(!moduleEngineerManagement.isRegistered) {
            this.$store.registerModule('engineerManagement', moduleEngineerManagement)
            moduleEngineerManagement.isRegistered = true
        }
    },
    components: {
        'v-select': vSelect,
    }
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
