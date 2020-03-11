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
                        <div class="vx-row mb-5">
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CLIENT (optional)</label>
                                    <v-select label="contact_name" value="id" name="client" v-model="client" :options="usersData" class="w-full" :tabindex="1"/>
                                </div>
                                <div class="mt-5">
                                    <label class="vs-input--label">PROPERTY</label>
                                    <v-select label="contact_name" value="id" name="property" v-model="property" :options="propertyData" class="w-full" :tabindex="2"/>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full pt-5">
                                <label class="vs-input--label">DESCRIPTION OF WORK</label>
                                <vs-textarea v-validate="'required'" name="description" v-model="description" class="w-full" rows="4" :tabindex="6"/>
                                <span class="text-danger text-sm" v-show="errors.has('description')">{{ errors.first('description') }}</span>
                            </div>

                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">ENGINEER</label>
                                    <v-select label="contact_name" value="id" name="engineer" v-model="engineer" :options="engineerData" class="w-full" :tabindex="3"/>
                                    <span class="text-danger text-sm" v-show="errors.has('engineer')">{{ errors.first('engineer') }}</span>
                                </div>
                                <div class="mt-5">
                                    <label class="vs-input--label">START DATE</label>
                                    <datepicker v-validate="'required'" :tabindex="4" :minimumView="'day'" :maximumView="'day'" name="start_date" v-model="start_date" class="w-full" :format="dateFormat"/>
                                    <span class="text-danger text-sm" v-show="errors.has('start_date')">{{ errors.first('start_date') }}</span>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full pt-5">
                                <label class="vs-input--label">MATERIALS USED</label>
                                <vs-textarea v-validate="'required'" name="material_use" v-model="material_use" class="w-full" rows="4" :tabindex="7"/>
                                <span class="text-danger text-sm" v-show="errors.has('material_use')">{{ errors.first('material_use') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full">
                                <vs-input v-validate="'required'" label="JOB REFERENCE" name="job_ref" v-model="job_ref" class="mt-5 w-full" :tabindex="5"/>
                                <span class="text-danger text-sm" v-show="errors.has('job_ref')">{{ errors.first('job_ref') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CUSTOMER SIGNATURE</label>
                                    <div class="flex">
                                        <img alt="" class="img-logo mr-5" v-if="signature" v-bind:src="signature"/>
                                        <div class="cursor-pointer upload-btn" @click="uploadSignature">UPLOAD SIGNATURE</div>
                                        <input class="hidden" type="file" id="signature" ref="signature" accept="image/*" v-on:change="handleSignatureUpload" :tabindex="8"/>
                                    </div>
                                </div>
                            </div>
                            <div class="vx-col md:w-1/2 w-full"></div>
                            <div class="vx-col md:w-1/2 w-full">
                                <vs-input v-validate="'required'" label="CUSTOMER NAME" name="customer_name" v-model="customer_name" class="mt-5 w-full" :tabindex="9"/>
                                <span class="text-danger text-sm" v-show="errors.has('customer_name')">{{ errors.first('customer_name') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full"></div>
                            <div class="vx-col md:w-1/2 w-full">
                                <div class="mt-5">
                                    <label class="vs-input--label">CUSTOMER COMPLETE DATE</label>
                                    <datepicker :minimumView="'day'" :maximumView="'day'" name="customer_complete_date" v-model="customer_complete_date" class="w-full" :tabindex="10" :format="dateFormat"/>
                                    <span class="text-danger text-sm" v-show="errors.has('customer_complete_date')">{{ errors.first('customer_complete_date') }}</span>
                                </div>
                            </div>
                        </div>
                        <all :timesheets="timesheets" v-on:updateData="updateData"></all>
                        <vs-button type="filled" @click.prevent="submitForm" class="mt-5 mr-0 m-auto block">SAVE</vs-button>
                    </form>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
// For custom error message
import { Validator } from 'vee-validate';
const dict = {
  custom: {
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
import vSelect from 'vue-select'
import moduleJobManagement from '@/store/job-management/moduleJobManagement.js'
import axios from "@/axios.js"
import All from './Timesheets/All'

export default {
    data() {
        return {
            client: null,
            property: null,
            engineer: null,
            start_date: null,
            job_ref: "",
            description: "",
            material_use: "",
            signature: null,
            customer_name: "",
            customer_complete_date: null,
            usersData: [],
            propertyData: [],
            engineerData: [],
            file: null,
            timesheets: [],
            dateFormat: 'dd/MM/yyyy',
        }
    },
    methods: {
        updateData(data) {
            this.timesheets = data;
        },
        submitForm() {
            this.$validator.validateAll().then(result => {
                if(result) {
                    this.$vs.loading()
                    const payload = {
                        job: {
                            client: this.client ? this.client.id : null,
                            property: this.property ? this.property.id : null,
                            engineer: this.engineer ? this.engineer.id : null,
                            start_date: this.start_date,
                            job_ref: this.job_ref,
                            description: this.description,
                            material_use: this.material_use,
                            customer_name: this.customer_name,
                            customer_complete_date: this.customer_complete_date,
                        },
                        timesheets: this.timesheets,
                        signature: this.file,
                    }

                    this.$store.dispatch('jobManagement/addJob', payload)
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
    computed: {
    },
    created() {
        if(!moduleJobManagement.isRegistered) {
            this.$store.registerModule('jobManagement', moduleJobManagement)
            moduleJobManagement.isRegistered = true
        }

        axios.post("/job-management/job-data", {propertyId: this.$route.params.property_id})
        .then((response) => {
            this.usersData = response.data.usersData
            this.engineerData = response.data.engineerData
            if (this.$route.params.property_id) {
                this.propertyData = response.data.propertyData
                const propertyIndex = this.propertyData.findIndex((u) => u.id == this.$route.params.property_id)
                this.property = this.propertyData[propertyIndex]
                const userIndex = this.usersData.findIndex((u) => u.id == this.property.client_id)
                this.client = this.usersData[userIndex]
            }
            if (this.$route.params.engineer_id) {
                const engineerIndex = this.engineerData.findIndex((u) => u.id == this.$route.params.engineer_id)
                this.engineer = this.engineerData[engineerIndex]
            }
        })
        .catch((error) => { console.error(error) })
    },
    components: {
        All,
        Datepicker,
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
