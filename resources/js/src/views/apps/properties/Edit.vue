<!-- =========================================================================================
  File Name: Edit.vue
  Description: Client Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-property-edit">
    <vs-alert color="danger" title="Property Not Found" :active.sync="property_not_found">
        <span>Property record with id: {{ $route.params.id }} not found. </span>
        <span>
            <span>Check </span><router-link :to="{name:'property-list'}" class="text-inherit underline">All Properties</router-link>
        </span>
    </vs-alert>
    <div class="h-screen flex w-full bg-img" v-if="data">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card>
                <div class="mt-5">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">BELONGS TO CLIENT (optional)</label>
                                    <v-select label="contact_name" value="id" name="client" v-model="data_local.client" :options="usersData" class="w-full" :tabindex="1"/>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 1" name="address1" v-model="data_local.address1" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('address1')">{{ errors.first('address1') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">CONTACT TITLE</label>
                                    <v-select label="contact_name" name="title" v-model="data_local.title" :options="['Mr', 'Mrs', 'Ms', 'Miss']" class="w-full" :tabindex="2"/>
                                </div>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="ADDRESS 2" name="address2" v-model="data_local.address2" class="mt-5 w-full" :tabindex="8"/>
                                <span class="text-danger text-sm" v-show="errors.has('address2')">{{ errors.first('address2') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT FIRST NAME" name="first_name" v-model="data_local.first_name" class="mt-5 w-full" :tabindex="3"/>
                                <span class="text-danger text-sm" v-show="errors.has('first_name')">{{ errors.first('first_name') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CITY/TOWN" name="city" v-model="data_local.city" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('city')">{{ errors.first('city') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="CONTACT SURNAME" name="surname" v-model="data_local.surname" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('surname')">{{ errors.first('surname') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="COUNTY/STATE" name="county" v-model="data_local.county" class="mt-5 w-full" :tabindex="10"/>
                                <span class="text-danger text-sm" v-show="errors.has('county')">{{ errors.first('county') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required|email'" label="EMAIL" name="email" v-model="data_local.email" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="POSTCODE/ZIP" name="postcode" v-model="data_local.postcode" class="mt-5 w-full" :tabindex="11"/>
                                <span class="text-danger text-sm" v-show="errors.has('postcode')">{{ errors.first('postcode') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <vs-input v-validate="'required'" label="PHONE" name="phone" v-model="data_local.phone" class="mt-5 w-full" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                            </div>

                            <div class="vx-col w-1/2">
                                <div class="mt-5">
                                    <label class="vs-input--label">COUNTRY</label>
                                    <v-select label="contact_name" name="country" v-model="data_local.country" :options="countryList" class="w-full" :tabindex="12"/>
                                </div>
                                <span class="text-danger text-sm" v-show="errors.has('country')">{{ errors.first('country') }}</span>
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
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'
import modulePropertyManagement from '@/store/property-management/modulePropertyManagement.js'
import { Validator } from 'vee-validate';
import vSelect from 'vue-select'
import countryList from "@/views/countryList.js"

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

export default {
    components: {
        'v-select': vSelect,
    },
    data() {
        return {
            data: null,
            data_local: null,
            property_not_found: false,
            countryList: countryList,
        }
    },
    computed: {
        usersData() {
            return this.$store.state.userManagement.users
        },
        validateForm() {
            return !this.errors.any()
        }
    },
    watch: {
    },
    methods: {
        fetch_property_data(id) {
            this.$store.dispatch("propertyManagement/fetchProperty", id)
            .then(res => {
                this.data = res.data
                this.data_local = JSON.parse(JSON.stringify(res.data))
            })
            .catch(err => {
            if(err.response.status === 404) {
                this.property_not_found = true
                return
            }
            console.error(err) })
        },
        capitalize(str) {
            return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
        },
        save_changes() {
            if(!this.validateForm) return

            this.$vs.loading()
            // if form have no errors
            let post_data = {
                id: this.data_local.id,
                data: {
                    client_id: this.data_local.client ? this.data_local.client.id : -1,
                    title: this.data_local.title,
                    first_name: this.data_local.first_name,
                    surname: this.data_local.surname,
                    email: this.data_local.email,
                    phone: this.data_local.phone,
                    address1: this.data_local.address1,
                    address2: this.data_local.address2,
                    city: this.data_local.city,
                    county: this.data_local.county,
                    postcode: this.data_local.postcode,
                    country: this.data_local.country,
                }
            }
            this.$store.dispatch("propertyManagement/updateProperty", post_data)
            .then(res => {
                this.$vs.loading.close()
                this.$vs.notify({
                    title: 'Success',
                    text: 'Property updated successfully',
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
        update_avatar() {
            // You can update avatar Here
            // For reference you can check dataList example
            // We haven't integrated it here, because data isn't saved in DB
        }
    },
    created() {
        // Register Module UserManagement Module
        if(!moduleUserManagement.isRegistered) {
            this.$store.registerModule('userManagement', moduleUserManagement)
            moduleUserManagement.isRegistered = true
        }
        this.$store.dispatch("userManagement/fetchUsers").catch(err => { console.error(err) })

        if(!modulePropertyManagement.isRegistered) {
            this.$store.registerModule('propertyManagement', modulePropertyManagement)
            modulePropertyManagement.isRegistered = true
        }
        this.fetch_property_data(this.$route.params.id)
    }
}

</script>