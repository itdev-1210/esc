<!-- =========================================================================================
  File Name: JobView.vue
  Description: Job View page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="job-page">

        <div class="flex flex-wrap items-center justify-end">
          <div class="flex items-center">
            <vs-button v-if="job_data && allData.length > 0" class="mb-base mr-3" icon-pack="feather" icon="icon icon-file" @click="printInvoice">Print</vs-button>
          </div>
        </div>

        <div id="job-container" v-if="job_data && allData.length > 0">
            <vx-card v-for="(data, index) in allData" :key="index" class="mb-2">

                <!-- INVOICE METADATA -->
                <div class="vx-row leading-loose p-base">
                    <div class="vx-col w-full md:w-2/3 mt-base">
                        <img v-if="company_data.company_logo_src" v-bind:src="company_data.company_logo_src" alt="company-logo" class="img-logo">
                        <img v-else />
                    </div>
                    <div class="vx-col w-full md:w-1/3 text-right">
                    </div>
                </div>

                <!-- CLIENT DETAIL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>
                            <span>CUSTOMER NAME/ SITE NAME</span>
                            <span class="s-underline w-break pr-1">{{job_data.client.contact_name}}</span>
                        </div>

                        <div>
                            <span>ADDRESS</span>
                            <span class="s-underline w-break pr-1">{{ job_data.client.address }}</span>
                        </div>

                        <div>
                            <span>TEL</span>
                            <span class="s-underline w-break pr-1">{{ job_data.client.phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- JOB DETAIL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <span>DATE</span>
                        <span class="s-underline w-break pr-1">{{job_data.start_date_parse}}</span>

                        <span>JOB REF</span>
                        <span class="s-underline w-break pr-1">{{ job_data.job_ref }}</span>

                        <span>OPERATIVE NAME</span>
                        <span class="s-underline w-break pr-1">{{ job_data.customer_name }}</span>
                    </div>
                </div>

                <!-- JOB TIMESHEET -->
                <div class="px-8 py-1">
                    <!-- JOB TIMESHEET TABLE -->
                    <div class="flex">
                        <div v-for="(weeks, index) in data.weeks" :key="index" class="w-1/7 timesheet-cell">
                            {{weeks.str}} <span class="pl-1 s-underline">{{ weeks.date }}</span>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                        <div class="w-1/14 timesheet-cell">Start Time</div>
                        <div class="w-1/14 timesheet-cell">End Time</div>
                    </div>

                    <div class="flex" v-for="(timesheets, index) in data.timesheets" :key="index" v-bind:class="{'b-bottom': index==data.timesheets.length-1}">
                        <div class="w-1/14 timesheet-cell">{{ timesheets.MON.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.MON.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.TUE.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.TUE.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.WED.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.WED.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.THUR.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.THUR.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.FRI.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.FRI.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.SAT.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.SAT.end_time }}</div>

                        <div class="w-1/14 timesheet-cell">{{ timesheets.SUN.start_time }}</div>
                        <div class="w-1/14 timesheet-cell">{{ timesheets.SUN.end_time }}</div>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>DESCRIPTION OF WORK CARRIED OUT</div>

                        <div>
                            <span class="s-underline w-break pr-1">{{ job_data.description }}</span>
                        </div>
                    </div>
                </div>

                <!-- MATERIAL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>MATERIAL USED</div>

                        <div>
                            <span class="s-underline w-break pr-1">{{ job_data.material_use }}</span>
                        </div>
                    </div>
                </div>

                <!-- SIGNATURE -->
                <div class="px-8 py-1">
                    <div>
                        <div class="pb-5">Work has been carried out to a satisfactory level.</div>
                        <div class="flex">
                            <span>Customer Signature</span>
                            <img alt="" class="sign-logo" v-if="job_data.signature_src" v-bind:src="job_data.signature_src"/>
                            <img v-else />
                        </div>
                        <div>
                            <span>Name</span>
                            <span class="s-underline w-break pr-2">{{ job_data.customer_name }}</span>
                            <span>Date</span>
                            <span class="s-underline w-break pr-2">{{ job_data.complete_date_parse ? job_data.complete_date_parse : '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- INVOICE FOOTER -->
                <div class="flex flex-wrap items-center p-base justify-between" v-if="company_data">
                    <img v-if="company_data.logo1_src" v-bind:src="company_data.logo1_src" alt="accrediation-logo" class="img-logo">
                    <img v-else />
                    <div class="flex items-center flex-col">
                        <div><span class="font-medium">{{ company_data.company_name }}</span>{{ company_data.address }}</div>
                        <div>
                            <span class="font-medium pr-2">Tel:</span>{{company_data.phone}}
                            <span class="font-medium pr-2">Website:</span>{{company_data.website}}
                        </div>
                        <div>
                            <span class="font-medium pr-2">Email:</span>{{company_data.email}}
                        </div>
                        <div>
                            <span class="font-medium pr-2">V.A.T.</span>{{company_data.vat_number}}
                            <span class="font-medium pr-2">Company Reg No.</span>{{company_data.reg_number}}
                        </div>
                    </div>
                    <img v-if="company_data.logo2_src" v-bind:src="company_data.logo2_src" alt="accrediation-logo" class="img-logo">
                    <img v-else />
                </div>
            </vx-card>
        </div>
        <div id="job-container" v-else-if="job_data && allData.length == 0">
            <vx-card>

                <!-- INVOICE METADATA -->
                <div class="vx-row leading-loose p-base">
                    <div class="vx-col w-full md:w-2/3 mt-base">
                        <img v-if="company_data.company_logo_src" v-bind:src="company_data.company_logo_src" alt="company-logo" class="img-logo">
                        <img v-else />
                    </div>
                    <div class="vx-col w-full md:w-1/3 text-right">
                    </div>
                </div>

                <!-- CLIENT DETAIL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>
                            <span>CUSTOMER NAME/ SITE NAME</span>
                            <span class="s-underline w-break pr-1">{{job_data.client.contact_name}}</span>
                        </div>

                        <div>
                            <span>ADDRESS</span>
                            <span class="s-underline w-break pr-1">{{ job_data.client.address }}</span>
                        </div>

                        <div>
                            <span>TEL</span>
                            <span class="s-underline w-break pr-1">{{ job_data.client.phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- JOB DETAIL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <span>DATE</span>
                        <span class="s-underline w-break pr-1">{{job_data.start_date_parse}}</span>

                        <span>JOB REF</span>
                        <span class="s-underline w-break pr-1">{{ job_data.job_ref }}</span>

                        <span>OPERATIVE NAME</span>
                        <span class="s-underline w-break pr-1">{{ job_data.customer_name }}</span>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>DESCRIPTION OF WORK CARRIED OUT</div>

                        <div>
                            <span class="s-underline w-break pr-1">{{ job_data.description }}</span>
                        </div>
                    </div>
                </div>

                <!-- MATERIAL -->
                <div class="px-8 py-1">
                    <div class="p-2 client-detail">
                        <div>MATERIAL USED</div>

                        <div>
                            <span class="s-underline w-break pr-1">{{ job_data.material_use }}</span>
                        </div>
                    </div>
                </div>

                <!-- SIGNATURE -->
                <div class="px-8 py-1">
                    <div>
                        <div class="pb-5">Work has been carried out to a satisfactory level.</div>
                        <div class="flex">
                            <span>Customer Signature</span>
                            <img alt="" class="sign-logo" v-if="job_data.signature_src" v-bind:src="job_data.signature_src"/>
                            <img v-else />
                        </div>
                        <div>
                            <span>Name</span>
                            <span class="s-underline w-break pr-2">{{ job_data.customer_name }}</span>
                            <span>Date</span>
                            <span class="s-underline w-break pr-2">{{ job_data.complete_date_parse ? job_data.complete_date_parse : '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- INVOICE FOOTER -->
                <div class="flex flex-wrap items-center p-base justify-between" v-if="company_data">
                    <img v-if="company_data.logo1_src" v-bind:src="company_data.logo1_src" alt="accrediation-logo" class="img-logo">
                    <img v-else />
                    <div class="flex items-center flex-col">
                        <div><span class="font-medium">{{ company_data.company_name }}</span>{{ company_data.address }}</div>
                        <div>
                            <span class="font-medium pr-2">Tel:</span>{{company_data.phone}}
                            <span class="font-medium pr-2">Website:</span>{{company_data.website}}
                        </div>
                        <div>
                            <span class="font-medium pr-2">Email:</span>{{company_data.email}}
                        </div>
                        <div>
                            <span class="font-medium pr-2">V.A.T.</span>{{company_data.vat_number}}
                            <span class="font-medium pr-2">Company Reg No.</span>{{company_data.reg_number}}
                        </div>
                    </div>
                    <img v-if="company_data.logo2_src" v-bind:src="company_data.logo2_src" alt="accrediation-logo" class="img-logo">
                    <img v-else />
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import moduleJobManagement from '@/store/job-management/moduleJobManagement.js'
import moduleCompanyManagement from '@/store/company-management/moduleCompanyManagement.js'

export default {
    data() {
        return {
            job_data: null,
            job_not_found: false,
            company_data: null,
            allData: [],
        }
    },
    computed: {
    },
    methods: {
        printInvoice() {
            window.print()
        },
        fetch_company_data() {
            this.$store.dispatch("companyManagement/fetchCompany")
            .then(res => {
                this.company_data = res.data
            })
            .catch(err => {
            if(err.response.status === 404) {
                // this.company_not_found = true
                return
            }
            console.error(err) })
        },
    },
    created() {
        // Register Module JobManagement Module
        if(!moduleJobManagement.isRegistered) {
        this.$store.registerModule('jobManagement', moduleJobManagement)
            moduleJobManagement.isRegistered = true
        }

        const id = this.$route.params.id
        this.$store.dispatch("jobManagement/fetchJobDetail", id)
        .then(res => {
            this.job_data = res.data.job
            this.allData = res.data.data
        })
        .catch(err => {
            if(err.response.status === 404) {
                this.job_not_found = true
                return
            }
            console.error(err) })

        // Register Module CompanyManagement Module
        if(!moduleCompanyManagement.isRegistered) {
            this.$store.registerModule('companyManagement', moduleCompanyManagement)
            moduleCompanyManagement.isRegistered = true
        }
        this.fetch_company_data()
    },
    mounted() {
        this.$emit("setAppClasses", "job-page")
    }
}

</script>
<style lang="scss">
#job-container {
    .w-1\/7 {
        width: 14.287%;
    }
    .w-1\/14 {
        width: 7.1425%;
    }
    .timesheet-cell {
        padding: .5rem;
        border-top: 1px solid #777;
        border-left: 1px solid #777;
        flex: 1;
    }
    .timesheet-cell:last-child {
        border-right: 1px solid #777;
    }
    .b-bottom {
        border-bottom: 1px solid #777;
        flex: 1;
    }
}
.client-detail {
    border: 1px solid #777;
    div {
        padding-bottom: 0.3rem;
    }
    div:last-child {
        padding-bottom: 0 !important;
    }
}
.s-underline {
    text-decoration: underline;
}
.w-break {
    word-break: break-all;
}
.img-logo {
    width: 60px;
    height: 60px;
}
.sign-logo {
    width: 40px;
    height: 20px;
}
@media print {
  .job-page {
    * {
      visibility: hidden;
    }

    #content-area {
      margin: 0 !important;
    }

    #job-container,
    #job-container * {
      visibility: visible;
    }
    #job-container {
        page-break-after: always;
        position: absolute;
        left: 0;
        top: 0;
        box-shadow: none;
        .timesheet-cell {
            padding: .2rem;
        }
    }
  }
}
</style>
