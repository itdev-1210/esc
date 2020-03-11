<!-- =========================================================================================
  File Name: Edit.vue
  Description: Engineer Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-engineer-edit">
    <vs-alert color="danger" title="Engineer Not Found" :active.sync="engineer_not_found">
        <span>Engineer record with id: {{ $route.params.id }} not found. </span>
        <span>
            <span>Check </span><router-link :to="{name:'engineer-list'}" class="text-inherit underline">All Engineers</router-link>
        </span>
    </vs-alert>
    <div class="h-screen flex w-full bg-img" v-if="data">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card>
                <div class="mt-5">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">TITLE</label>
                                    <v-select label="title" name="title" v-model="data_local.title" :options="['Mr', 'Mrs', 'Ms', 'Miss']" class="w-full" :tabindex="1"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('title')">{{ errors.first('title') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address1" v-model="data_local.address1" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('address1')">{{ errors.first('address1') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input type="password" label="APP PASSWORD" name="password" v-model="password" class="mt-5 w-full" :tabindex="12"/>
                                <span class="text-danger text-sm" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="data_local.first_name" class="mt-5 w-full" :tabindex="2"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address2" v-model="data_local.address2" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input type="password" v-validate="'confirmed:password'" label="CONFIRM APP PASSWORD" name="confirm_password" v-model="confirm_password" class="mt-5 w-full" data-vv-as="password" :tabindex="13"/>
                                <span class="text-danger text-sm" v-show="errors.has('confirm_password')">{{ errors.first('confirm_password') }}</span>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="data_local.surname" class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="data_local.city" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">SIGNATURE</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="data_local.signature_src" v-bind:src="data_local.signature_src"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadSignature">UPLOAD SIGNATURE</div>
                                        <input class="hidden" type="file" id="signature" ref="signature" accept="image/*" v-on:change="handleSignatureUpload" :tabindex="14"/>
                                    </div>
                                </div>
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required|email'" label="EMAIL" name="email" v-model="data_local.email" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="data_local.county" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="PHONE" name="phone" v-model="data_local.phone" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="data_local.postcode" class="mt-5 w-full" :tabindex="10"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                            </div>

                            <div class="vx-col md:w-1/3 w-full">
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="data_local.country" :options="countryList" class="w-full" :tabindex="11"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
                            </div>
                            <div class="vx-col md:w-1/3 w-full">
                            </div>
                        </div>
                        <div class="vx-row">
                            <div class="vx-col w-full">
                                <div class="mt-8 flex flex-wrap items-center justify-end">
                                    <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Save Changes</vs-button>
                                    <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset</vs-button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </vx-card>
        </div>
    </div>
  </div>
</template>

<script>

// Store Module
import moduleEngineerManagement from '@/store/engineer-management/moduleEngineerManagement.js'
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
    }
};

// register custom messages
Validator.localize('en', dict);
import countryList from "@/views/countryList.js"
import vSelect from 'vue-select'

export default {
    components: {
        'v-select': vSelect,
    },
    data() {
        return {
            data: null,
            data_local: null,
            engineer_not_found: false,
            password: "",
            confirm_password: "",
            file: null,
            countryList: countryList,
        }
    },
    computed: {
        validateForm() {
            return !this.errors.any()
        }
    },
    watch: {
    },
    methods: {
        fetch_engineer_data(id) {
            this.$store.dispatch("engineerManagement/fetchEngineer", id)
            .then(res => {
                this.data = res.data
                this.data_local = JSON.parse(JSON.stringify(res.data))
            })
            .catch(err => {
                if(err.response.status === 404) {
                    this.engineer_not_found = true
                    return
                }
                console.error(err)
            })
        },
        capitalize(str) {
            return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
        },
        save_changes() {
            if(!this.validateForm) return

            this.$vs.loading()
            const payload = {
                engineer: {
                    title: this.data_local.title,
                    first_name: this.data_local.first_name,
                    surname: this.data_local.surname,
                    email: this.data_local.email,
                    phone: this.data_local.phone,
                    password: this.password,
                    address1: this.data_local.address1,
                    address2: this.data_local.address2,
                    city: this.data_local.city,
                    county: this.data_local.county,
                    postcode: this.data_local.postcode,
                    country: this.data_local.country,
                },
                signature: this.file,
                id: this.data_local.id
            }

            this.$store.dispatch('engineerManagement/updateEngineer', payload)
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

        },
        reset_data() {
            this.data_local = JSON.parse(JSON.stringify(this.data))
        },
        uploadSignature() {
            this.$refs.signature.click();
        },
        handleSignatureUpload(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.file = files[0];
            this.data_local.signature_src = URL.createObjectURL(this.file);
        },
    },
    created() {
        // Register Module EngineerManagement Module
        if(!moduleEngineerManagement.isRegistered) {
            this.$store.registerModule('engineerManagement', moduleEngineerManagement)
            moduleEngineerManagement.isRegistered = true
        }
        this.fetch_engineer_data(this.$route.params.id)
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
