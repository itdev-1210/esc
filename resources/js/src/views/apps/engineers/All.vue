<!-- =========================================================================================
  File Name: All.vue
  Description: Engineers List page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>

  <div id="page-engineers-list">

    <div class="vx-card p-6">

        <div class="vx-card__header table-header">
            <div class="vx-card__title">
                <h6>Engineers</h6>
            </div>
            <span class="vx-card__actions cursor-pointer" @click="createNewEngineer">
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" class="mr-2" />
                <span>Create New Engineer</span>
            </span>
        </div>
      <div class="flex flex-wrap items-center">

        <!-- ITEMS PER PAGE -->
        <div class="flex-grow">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium">
              <span class="mr-2">{{ currentPage * paginationPageSize - (paginationPageSize - 1) }} - {{ engineersData.length - currentPage * paginationPageSize > 0 ? currentPage * paginationPageSize : engineersData.length }} of {{ engineersData.length }}</span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>

              <vs-dropdown-item @click="gridApi.paginationSetPageSize(10)">
                <span>10</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(25)">
                <span>25</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(30)">
                <span>30</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>

        <vs-input class="sm:mr-4 mr-0 sm:w-auto w-full sm:order-normal order-3 sm:mt-0 mt-4" v-model="searchQuery" @input="updateSearchQuery" placeholder="Search..." />
    </div>

    <!-- AgGrid Table -->
    <ag-grid-vue
        ref="agGridTable"
        :components="components"
        :gridOptions="gridOptions"
        class="ag-theme-material w-100 my-4 ag-grid-table"
        :columnDefs="columnDefs"
        :defaultColDef="defaultColDef"
        :rowData="engineersData"
        rowSelection="multiple"
        colResizeDefault="shift"
        :animateRows="true"
        :pagination="true"
        :paginationPageSize="paginationPageSize"
        :suppressPaginationPanel="true"
        :enableRtl="$vs.rtl"
        @row-selected="onRowSelected">
    </ag-grid-vue>

    <div class="flex flex-wrap items-center">
        <span class="flex items-center cursor-pointer pos-absolute" @click="confirmDeleteRecords">
            <feather-icon icon="TrashIcon" svgClasses="h-4 w-4" class="mr-2" />
            <span>Delete</span>
        </span>
        <vs-pagination
            :total="totalPages"
            :max="7"
        v-model="currentPage" />
    </div>

    </div>
  </div>

</template>

<script>
import { AgGridVue } from "ag-grid-vue"
import '@sass/vuexy/extraComponents/agGridStyleOverride.scss'
import vSelect from 'vue-select'

// Store Module
import moduleEngineerManagement from '@/store/engineer-management/moduleEngineerManagement.js'

// Cell Renderer
import CellRendererActions from "./cell-renderer/CellRendererActions.vue"

export default {
  components: {
    AgGridVue,
    vSelect,

    CellRendererActions,
  },
  data() {
    return {

      searchQuery: "",

      // AgGrid
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        sortable: true,
        resizable: true,
        suppressMenu: true
      },
      columnDefs: [
        {
          headerName: 'NAME',
          field: 'contact_name',
          filter: true,
          width: 375,
          checkboxSelection: true,
          headerCheckboxSelectionFilteredOnly: true,
          headerCheckboxSelection: true,
        },
        {
          headerName: 'EMAIL',
          field: 'email',
          filter: true,
          width: 375,
        },
        {
          headerName: 'PHONE',
          field: 'phone',
          filter: true,
          width: 375,
        },
        {
          headerName: 'IS ACTIVATED?',
          field: 'is_activate',
          filter: true,
          width: 175,
        },
        {
          headerName: 'ACTIONS',
          field: 'transactions',
          width: 175,
          cellRendererFramework: 'CellRendererActions',
        },
      ],
      ids: [],

      // Cell Renderer Components
      components: {
        CellRendererActions,
      }
    }
  },
  watch: {

  },
  computed: {
    engineersData() {
      return this.$store.state.engineerManagement.engineers
    },
    paginationPageSize() {
      if(this.gridApi) return this.gridApi.paginationGetPageSize()
      else return 10
    },
    totalPages() {
      if(this.gridApi) return this.gridApi.paginationGetTotalPages()
      else return 0
    },
    currentPage: {
      get() {
        if(this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1
        else return 1
      },
      set(val) {
        this.gridApi.paginationGoToPage(val - 1)
      }
    }
  },
  methods: {
    updateSearchQuery(val) {
      this.gridApi.setQuickFilter(val)
    },
    onRowSelected(event) {
        if (this.ids.includes(event.node.data.id)) {
            let index = this.ids.indexOf(event.node.data.id)
            if (index !== -1) this.ids.splice(index, 1)
        } else {
            this.ids.push(event.node.data.id)
        }
    },
    confirmDeleteRecords() {
        if (this.ids.length === 0) return;
        this.$vs.dialog({
            type: 'confirm',
            color: 'danger',
            title: `Confirm Delete`,
            text: `You are about to delete selected engineers`,
            accept: this.deleteRecord,
            acceptText: "Delete"
        })
    },
    deleteRecord() {
        this.$vs.loading()
        this.$store.dispatch("engineerManagement/removeRecords", this.ids)
        .then(()   => {
            this.$vs.loading.close()
            this.ids = [];
            this.showDeleteSuccess()
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
    showDeleteSuccess() {
        this.$vs.notify({
            color: 'success',
            title: 'Selected Engineers Deleted',
            position:'top-right',
            text: 'The selected engineers were successfully deleted'
        })
    },
    createNewEngineer() {
        this.$router.push("/engineers/engineer_add").catch(() => {})
    }
  },
  mounted() {
    this.gridApi = this.gridOptions.api

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
    if(!moduleEngineerManagement.isRegistered) {
      this.$store.registerModule('engineerManagement', moduleEngineerManagement)
      moduleEngineerManagement.isRegistered = true
    }
    this.$store.dispatch("engineerManagement/fetchEngineers").catch(err => { console.error(err) })
  }
}

</script>

<style lang="scss">
#page-engineers-list {
    .table-header {
        padding: .5rem ;
        margin-bottom: 0.5rem;
        h6 {
            font-size: 1.5rem;
            font-weight: 600;
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
        position: absolute;
        background-color: #e3342f;
        color: #FFF;
        border-color: #e3342f;
        border-radius: 50em;
        padding: 0.3rem 0.7rem;
    }
}
</style>
