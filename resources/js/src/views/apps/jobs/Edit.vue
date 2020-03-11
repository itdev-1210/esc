<!-- =========================================================================================
  File Name: Edit.vue
  Description: Job Edit Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-job-edit">
    <vs-alert color="danger" title="Job Not Found" :active.sync="job_not_found">
        <span>Job record with id: {{ $route.params.id }} not found. </span>
        <span>
            <span>Check </span><router-link :to="{name:'job-list'}" class="text-inherit underline">All Jobs</router-link>
        </span>
    </vs-alert>
    <div class="h-screen flex w-full bg-img" v-if="data">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card>
                <div class="mt-5">
                    <form>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CLIENT (optional)</label>
                                    <v-select label="contact_name" value="id" name="client" v-model="client" :options="usersData" class="w-full" :tabindex="1"/>
                                </div>
                                <div class="mt-5">
                                    <label class="vs-input--label">PROPERTY</label>
                                    <v-select label="contact_name" value="id" name="property" v-model="data_local.property_id" :options="propertyData" class="w-full" :tabindex="2"/>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full pt-5">
                                <label class="vs-input--label">DESCRIPTION OF WORK</label>
                                <vs-textarea v-validate="'required'" name="description" v-model="data_local.description" class="w-full" rows="4" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span>
                            </div>

                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">ENGINEER</label>
                                    <v-select label="contact_name" value="id" name="engineer" v-model="data_local.engineer_id" :options="engineerData" class="w-full" :tabindex="3"/>
                                    <span class="text-danger text-sm" v-show="errors.has('engineer')">{{ errors.first('engineer') }}</span>
                                </div>
                                <div class="mt-5">
                                    <label class="vs-input--label">START DATE</label>
                                    <datepicker v-validate="'required'" :minimumView="'day'" :maximumView="'day'" name="start_date" v-model="data_local.start_date" class="w-full" :format="dateFormat"/>
                                    <span class="text-danger text-sm" v-show="errors.has('start_date')">{{ errors.first('start_date') }}</span>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full pt-5">
                                <label class="vs-input--label">MATERIALS USED</label>
                                <vs-textarea v-validate="'required'" name="material_use" v-model="data_local.material_use" class="w-full" rows="4" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('material_use')">{{ errors.first('material_use') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full">
                                <vs-input v-validate="'required'" label="JOB REFERENCE" name="job_ref" v-model="data_local.job_ref" class="mt-5 w-full" :tabindex="4"/>
                                <span class="text-danger text-sm" v-show="errors.has('job_ref')">{{ errors.first('job_ref') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CUSTOMER SIGNATURE</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="data_local.signature_src" v-bind:src="data_local.signature_src"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadSignature">UPLOAD SIGNATURE</div>
                                        <input class="hidden" type="file" id="signature" ref="signature" accept="image/*" v-on:change="handleSignatureUpload"/>
                                    </div>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full"></div>
                            <div class="vx-col md:w-1/2 w-full">
                                <vs-input v-validate="'required'" label="CUSTOMER NAME" name="customer_name" v-model="data_local.customer_name" class="mt-5 w-full" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('customer_name')">{{ errors.first('customer_name') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full"></div>
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CUSTOMER COMPLETE DATE</label>
                                    <datepicker :minimumView="'day'" :maximumView="'day'" name="customer_complete_date" v-model="data_local.customer_complete_date" class="w-full" :format="dateFormat"/>
                                    <span class="text-danger text-sm" v-show="errors.has('customer_complete_date')">{{ errors.first('customer_complete_date') }}</span>
                                </div>
                            </div>
                            <all :timesheets="timesheets" v-on:updateData="updateData"></all>
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
import moduleJobManagement from '@/store/job-management/moduleJobManagement.js'
import { Validator } from 'vee-validate';
import Datepicker from 'vuejs-datepicker';
import vSelect from 'vue-select'
import axios from "@/axios.js"
import All from './Timesheets/All'

const dict = {
    custom: {
        property: {
            required: 'Please select property',
        },
        engineer: {
            required: 'Please select engineer',
        },
        start_date: {
            required: 'Please select date',
        },
        job_ref: {
            required: 'Please input job reference',
        },
        description: {
            required: 'Please input description',
        },
        material_use: {
            required: 'Please fill this field',
        },
        customer_name: {
            required: 'Please input customer name',
        },
        customer_complete_date: {
            required: 'Please select complete date',
        },
    }
};

// register custom messages
Validator.localize('en', dict);

export default {
    components: {
        All,
        Datepicker,
        'v-select': vSelect,
    },
    data() {
        return {
            data: null,
            data_local: null,
            job_not_found: false,
            usersData: [],
            propertyData: [],
            engineerData: [],
            client: null,
            file: null,
            timesheets: [],
            dateFormat: 'dd/MM/yyyy',
        }
    },
    computed: {
        validateForm() {
            return !this.errors.any()
        }
    },
    watch: {
        client: {
            handler: function(newClient) {
                axios.post("/job-management/property-data", {client_id: newClient.id})
                .then((response) => {
                    this.propertyData = response.data.propertyData
                })
                .catch((error) => { console.error(error) })
            }
        }
    },
    methods: {
        updateData(data) {
            this.timesheets = data;
        },
        fetch_job_data(id) {
            this.$store.dispatch("jobManagement/fetchJob", id)
            .then(res => {
                this.data = res.data
                this.data_local = JSON.parse(JSON.stringify(res.data))
                this.timesheets = this.data_local.timesheets
                axios.post("/job-management/job-data", {propertyId: this.data_local.property_id})
                .then((response) => {
                    this.usersData = response.data.usersData
                    this.engineerData = response.data.engineerData
                    this.propertyData = response.data.propertyData

                    const propertyIndex = this.propertyData.findIndex((u) => u.id == this.data_local.property_id)
                    this.data_local.property_id = this.propertyData[propertyIndex]

                    const userIndex = this.usersData.findIndex((u) => u.id == this.data_local.client_id)
                    this.client = this.usersData[userIndex]

                    const engineerIndex = this.engineerData.findIndex((u) => u.id == this.data_local.engineer_id)
                    this.data_local.engineer_id = this.engineerData[engineerIndex]
                })
                .catch((error) => { console.error(error) })
            })
            .catch(err => {
            if(err.response.status === 404) {
                this.job_not_found = true
                return
            }
            console.error(err) })
        },
        save_changes() {
            if(!this.validateForm) return

            this.$vs.loading()
            const payload = {
                job: {
                    client: this.client ? this.client.id : null,
                    property: this.data_local.property_id ? this.data_local.property_id.id : null,
                    engineer: this.data_local.engineer_id ? this.data_local.engineer_id.id : null,
                    start_date: this.data_local.start_date,
                    job_ref: this.data_local.job_ref,
                    description: this.data_local.description,
                    material_use: this.data_local.material_use,
                    customer_name: this.data_local.customer_name,
                    customer_complete_date: this.data_local.customer_complete_date,
                },
                signature: this.file,
                timesheets: this.timesheets,
                id: this.data_local.id
            }

            this.$store.dispatch('jobManagement/updateJob', payload)
            .then((res) => {
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
            const propertyIndex = this.propertyData.findIndex((u) => u.id == this.data_local.property_id)
            this.data_local.property_id = this.propertyData[propertyIndex]

            const userIndex = this.usersData.findIndex((u) => u.id == this.data_local.client_id)
            this.client = this.usersData[userIndex]

            const engineerIndex = this.engineerData.findIndex((u) => u.id == this.data_local.engineer_id)
            this.data_local.engineer_id = this.engineerData[engineerIndex]
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
        // Register Module JobManagement Module
        if(!moduleJobManagement.isRegistered) {
            this.$store.registerModule('jobManagement', moduleJobManagement)
            moduleJobManagement.isRegistered = true
        }
        this.fetch_job_data(this.$route.params.id)
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
