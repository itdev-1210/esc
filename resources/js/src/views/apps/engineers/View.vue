<!-- =========================================================================================
  File Name: View.vue
  Description: Engineer View page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-engineer-view">

    <vs-alert color="danger" title="Engineer Not Found" :active.sync="engineer_not_found">
        <span>Engineer record with id: {{ $route.params.id }} not found. </span>
        <span>
            <span>Check </span><router-link :to="{name:'engineer-list'}" class="text-inherit underline">All Engineers</router-link>
        </span>
    </vs-alert>

    <div id="engineer-data" v-if="engineer_data">

        <vx-card title="View Engineer" class="mb-base">
            <div class="vx-row">
                <!-- Information - Col 1 -->
                <div class="vx-col flex-1" id="account-info-col-1">
                    <table>
                    <tr>
                        <td class="font-semibold">NAME</td>
                        <td>{{ engineer_data.contact_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">EMAIL</td>
                        <td>{{ engineer_data.email }}</td>
                    </tr>
                    </table>
                </div>
                <!-- /Information - Col 1 -->

                <!-- Information - Col 2 -->
                <div class="vx-col flex-1" id="account-info-col-2">
                    <table>
                    <tr>
                        <td class="font-semibold">ADDRESS</td>
                        <td>{{ engineer_data.address }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">PHONE</td>
                        <td>{{ engineer_data.phone }}</td>
                    </tr>
                    </table>
                </div>
                <!-- /Information - Col 2 -->
                <div class="vx-col w-full flex" id="account-manage-buttons">
                    <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'engineer-edit', params: { id: $route.params.id }}">Edit</vs-button>
                    <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Delete</vs-button>
                </div>

            </div>
        </vx-card>

        <!-- Jobs for this Engineer -->
        <all title="Jobs for this Engineer" :jobs="engineer_data.jobs" :engineer_id="engineer_data.id"></all>
    </div>
  </div>
</template>

<script>
import moduleEngineerManagement from '@/store/engineer-management/moduleEngineerManagement.js'
import All from '../jobs/All'

export default {
    components: {
        All
    },
    data() {
        return {
            engineer_data: null,
            engineer_not_found: false,
        }
    },
    computed: {
    },
    methods: {
        confirmDeleteRecord() {
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Confirm Delete`,
                text: `You are about to delete "${this.engineer_data.contact_name}"`,
                accept: this.deleteRecord,
                acceptText: "Delete"
            })
        },
        deleteRecord() {
            this.$vs.loading()
            this.$store.dispatch("engineerManagement/removeRecord", this.user_data.id)
            .then(()   => {
                this.$vs.loading.close()
                this.$router.back();
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
                title: 'Engineer Deleted',
                position:'top-right',
                text: 'The selected engineer was successfully deleted'
            })
        }
    },
    created() {
        // Register Module EngineerManagement Module
        if(!moduleEngineerManagement.isRegistered) {
            this.$store.registerModule('engineerManagement', moduleEngineerManagement)
            moduleEngineerManagement.isRegistered = true
        }

        const id = this.$route.params.id
        this.$store.dispatch("engineerManagement/fetchEngineer", id)
        .then(res => { this.engineer_data = res.data })
        .catch(err => {
            if(err.response.status === 404) {
                this.engineer_not_found = true
                return
            }
            console.error(err)
        })
    }
}

</script>

<style lang="scss">
#avatar-col {
  width: 10rem;
}

#page-engineer-view {
  table {
    td {
      vertical-align: top;
      min-width: 140px;
      padding-bottom: .8rem;
      word-break: break-all;
    }

    &:not(.permissions-table) {
      td {
        @media screen and (max-width:370px) {
          display: block;
        }
      }
    }
  }
}

// #account-info-col-1 {
//   // flex-grow: 1;
//   width: 30rem !important;
//   @media screen and (min-width:1200px) {
//     & {
//       flex-grow: unset !important;
//     }
//   }
// }


@media screen and (min-width:1201px) and (max-width:1211px),
only screen and (min-width:636px) and (max-width:991px) {
  #account-info-col-1 {
    width: calc(100% - 12rem) !important;
  }

  // #account-manage-buttons {
  //   width: 12rem !important;
  //   flex-direction: column;

  //   > button {
  //     margin-right: 0 !important;
  //     margin-bottom: 1rem;
  //   }
  // }

}

</style>
