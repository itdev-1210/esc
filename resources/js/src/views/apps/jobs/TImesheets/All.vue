<!-- =========================================================================================
  File Name: All.vue
  Description: Job List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

    <div id="page-timesheet-list">

        <div class="vx-card p-6">

            <div class="vx-card__header table-header">
                <div class="vx-card__title">
                    <h6>Timesheets for this Job</h6>
                </div>
            </div>
            <div class="vx-row my-5">
                <div class="vx-col md:w-1/4 w-full">
                    <div class="mt-5 flex flex-col">
                        <label class="vs-input--label mb-2">START DATE</label>
                        <flat-pickr v-model="start_date" placeholder="Choose date" :config="startDate"/>
                    </div>
                </div>
                <div class="vx-col md:w-1/4 w-full">
                    <div class="mt-5 flex flex-col">
                        <label class="vs-input--label mb-2">START TIME</label>
                        <flat-pickr :config="startTimePicker" v-model="start_time" placeholder="Choose time" />
                    </div>
                </div>
                <div class="vx-col md:w-1/4 w-full">
                    <div class="mt-5 flex flex-col">
                        <label class="vs-input--label mb-2">END TIME</label>
                        <flat-pickr :config="endTimePicker" v-model="end_time" placeholder="Choose time" />
                    </div>
                </div>
                <div class="flex items-end">
                    <div class="mt-5">
                        <span class="vx-card__actions cursor-pointer" @click="createNewTimesheet">
                            <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" class="mr-2" />
                            <span>Create New Timesheet</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center">

            <vs-table multiple v-model="ids" :data="realData">

                <template slot="thead">
                    <vs-th>START DATE</vs-th>
                    <vs-th>START TIME</vs-th>
                    <vs-th>END TIME</vs-th>
                    <vs-th>ACTIONS</vs-th>
                </template>

                <template slot-scope="{data}">
                    <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                    <vs-td :data="data[indextr].start_date">
                        <flat-pickr v-model="data[indextr].start_date" placeholder="Choose date" v-if="data[indextr].editable" :config="startDate"/>
                        <span v-else>{{ data[indextr].start_date }}</span>
                    </vs-td>

                    <vs-td :data="data[indextr].start_time">
                        <flat-pickr :config="configdateTimePicker" v-model="data[indextr].start_time" placeholder="Choose time" v-if="data[indextr].editable"/>
                        <span v-else>{{ data[indextr].start_time }}</span>
                    </vs-td>

                    <vs-td :data="data[indextr].end_time">
                        <flat-pickr :config="configdateTimePicker" v-model="data[indextr].end_time" placeholder="Choose time" v-if="data[indextr].editable"/>
                        <span v-else>{{ data[indextr].end_time }}</span>
                    </vs-td>

                    <vs-td>
                        <feather-icon icon="SaveIcon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord(indextr)" v-if="data[indextr].editable"/>
                        <feather-icon icon="Edit3Icon" svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer" @click="editRecord(indextr)" v-else/>
                        <feather-icon icon="Trash2Icon" svgClasses="h-5 w-5 hover:text-danger cursor-pointer" @click="confirmDeleteRecord(indextr)" />
                    </vs-td>

                    </vs-tr>
                </template>
            </vs-table>
        </div>

        <div class="flex flex-wrap items-center">
            <span class="flex items-center cursor-pointer pos-absolute" @click="confirmDeleteRecords">
                <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
                <span>Delete</span>
            </span>
        </div>

        </div>
    </div>

</template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

export default {
    props: {
        timesheets: {
            type: Array,
            required: true,
        },
    },
    components: {
        flatPickr,
    },
    data() {
        return {
            startDate: {
                dateFormat: 'd/m/yy'
            },
            startTimePicker: {
              enableTime: true,
              enableSeconds: true,
              noCalendar: true,
              defaultHour: 9,
            },
            endTimePicker: {
              enableTime: true,
              enableSeconds: true,
              noCalendar: true,
              defaultHour: 17,
            },

            ids: [],
            realData: [],
            start_date: null,
            start_time: null,
            end_time: null,
            activeIndex: null,
            dateFormat: 'dd/MM/yyyy',
        }
    },
    watch: {
        realData: {
            handler: function(newData) {
                this.$emit('updateData', newData)
            }
        }
    },
    computed: {
    },
    methods: {
        confirmDeleteRecords() {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Confirm Delete`,
                text: `You are about to delete selected timesheets`,
                accept: this.deleteRecords,
                acceptText: "Delete"
            })
        },
        editRecord(index) {
            this.realData[index].editable = !this.realData[index].editable
        },
        deleteRecords() {
            this.ids.map((id) => {
                const index = this.realData.findIndex((u) => u.index == id.index)
                this.realData.splice(index, 1)
            })
            this.ids = []
            this.showDeleteSuccess('Timesheets Deleted', 'The selected timesheets were successfully deleted')
        },
        showDeleteSuccess(title, text) {
            this.$vs.notify({
                color: 'success',
                position: 'top-right',
                title: title,
                text: text
            })
        },
        createNewTimesheet() {
            if (!this.start_date || !this.start_time || !this.end_time) return;
            let newTime = {
                index: this.index,
                start_date: this.start_date,
                start_time: this.start_time,
                end_time: this.end_time,
                editable: false,
            }

            this.realData.push(newTime)
            this.start_time = this.start_date = this.end_time = null
            this.index = this.index + 1
        },
        confirmDeleteRecord(index) {
            this.activeIndex = index
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Confirm Delete`,
                text: `You are about to delete this timesheet`,
                accept: this.deleteRecord,
                acceptText: "Delete"
            })
        },
        deleteRecord() {
            this.realData.splice(this.activeIndex, 1)
            this.activeIndex = null
            this.showDeleteSuccess('Timesheet Deleted', 'The timesheet was successfully deleted')
        },
    },
    mounted() {

        /* =================================================================
        NOTE:
        Header is not aligned properly in RTL version of agGrid table.
        However, we given fix to this issue. If you want more robust solution please contact them at gitHub
        ================================================================= */
        if(this.$vs.rtl) {
            const header = this.$refs.agGridTable.$el.querySelector(".ag-header-container")
            header.style.left = "-" + String(Number(header.style.transform.slice(11,-3)) + 9) + "px"
        }
    },
    created() {
        this.realData = this.timesheets
        this.index = this.realData.length + 1
    }
}

</script>

<style lang="scss">
#page-timesheet-list {
    .table-header {
        padding: .5rem ;
        margin-bottom: 0.5rem;
        h6 {
            font-size: 1.5rem;
            font-weight: 600;
        }
    }
    .vx-card__actions {
        color: #fff;
        background-color: #3490dc;
        border-color: #3490dc;
        border-radius: 50em;
        padding: 0.3rem 0.7rem;
        font-size: .9rem;
        display: flex;
    }
    .user-list-filters {
        .vs__actions {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-58%);
        }
    }
    .pos-absolute {
        // position: absolute;
        background-color: #e3342f;
        color: #FFF;
        border-color: #e3342f;
        border-radius: 50em;
        padding: 0.3rem 0.7rem;
    }
}
</style>
