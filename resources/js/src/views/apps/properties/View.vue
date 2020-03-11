<!-- =========================================================================================
  File Name: UserView.vue
  Description: User View page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-property-view">

    <vs-alert color="danger" title="Property Not Found" :active.sync="property_not_found">
      <span>Property record with id: {{ $route.params.id }} not found. </span>
      <span>
        <span>Check </span><router-link :to="{name:'property-list'}" class="text-inherit underline">All Properties</router-link>
      </span>
    </vs-alert>

    <div id="user-data" v-if="property_data">

      <vx-card title="View Property" class="mb-base">

        <!-- Avatar -->
        <div class="vx-row">

          <!-- Information - Col 1 -->
          <div class="vx-col flex-1" id="account-info-col-1">
            <table>
                <tr>
                    <td class="font-semibold">CONTACT</td>
                    <td>{{ property_data.contact_name }}</td>
                </tr>
                <tr>
                    <td class="font-semibold">EMAIL</td>
                    <td>{{ property_data.email }}</td>
                </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div class="vx-col flex-1" id="account-info-col-2">
                <table>
                    <tr>
                        <td class="font-semibold">ADDRESS</td>
                        <td>{{ property_data.address }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">PHONE</td>
                        <td>{{ property_data.phone }}</td>
                    </tr>
                </table>
          </div>
          <!-- /Information - Col 2 -->
          <div class="vx-col w-full flex" id="account-manage-buttons">
            <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'property-edit', params: { id: $route.params.id }}">Edit</vs-button>
            <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Delete</vs-button>
          </div>
        </div>

      </vx-card>
      <!-- Jobs -->
        <all title="Jobs for this Property" :jobs="property_data.jobs" :property_id="property_data.id"></all>
    </div>
  </div>
</template>

<script>
import modulePropertyManagement from '@/store/property-management/modulePropertyManagement.js'
import All from '../jobs/All'

export default {
    components: {
        All
    },
    data() {
        return {
            property_data: null,
            property_not_found: false,
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
            text: `You are about to delete "${this.property_data.contact_name}"`,
            accept: this.deleteRecord,
            acceptText: "Delete"
        })
        },
        deleteRecord() {
            this.$vs.loading()
            this.$store.dispatch("propertyManagement/removeRecord", this.property_data.id)
            .then(()   => {
                this.$vs.loading.close()
                this.$router.back()
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
                title: 'Property Deleted',
                position:'top-right',
                text: 'The selected Property was successfully deleted'
            })
        }
    },
    created() {
        // Register Module UserManagement Module
        if(!modulePropertyManagement.isRegistered) {
            this.$store.registerModule('propertyManagement', modulePropertyManagement)
            modulePropertyManagement.isRegistered = true
        }

        const id = this.$route.params.id
        this.$store.dispatch("propertyManagement/fetchProperty", id)
        .then(res => { this.property_data = res.data })
        .catch(err => {
            if(err.response.status === 404) {
                this.property_not_found = true
                return
            }
            console.error(err) })
    }
}

</script>

<style lang="scss">
#avatar-col {
  width: 10rem;
}

#page-property-view {
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
