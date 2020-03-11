<!-- =========================================================================================
  File Name: UserView.vue
  Description: User View page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="page-client-view">

    <vs-alert color="danger" title="Client Not Found" :active.sync="user_not_found">
        <span>Client record with id: {{ $route.params.userId }} not found. </span>
        <span>
            <span>Check </span><router-link :to="{name:'client-list'}" class="text-inherit underline">All Clients</router-link>
        </span>
    </vs-alert>

    <div id="user-data" v-if="user_data">

        <vx-card title="View Client" class="mb-base">
            <div class="vx-row">
                <!-- Information - Col 1 -->
                <div class="vx-col flex-1" id="account-info-col-1">
                    <table>
                    <tr>
                        <td class="font-semibold">CLIENT NAME</td>
                        <td>{{ user_data.company }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">CONTACT</td>
                        <td>{{ user_data.contact_name }}</td>
                    </tr>
                    </table>
                </div>
                <!-- /Information - Col 1 -->

                <!-- Information - Col 2 -->
                <div class="vx-col flex-1" id="account-info-col-2">
                    <table>
                    <tr>
                        <td class="font-semibold">ADDRESS</td>
                        <td>{{ user_data.address }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">EMAIL</td>
                        <td>{{ user_data.email }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">PHONE</td>
                        <td>{{ user_data.phone }}</td>
                    </tr>
                    </table>
                </div>
                <!-- /Information - Col 2 -->
                <div class="vx-col w-full flex" id="account-manage-buttons">
                    <vs-button icon-pack="feather" icon="icon-edit" class="mr-4" :to="{name: 'client-edit', params: { userId: $route.params.userId }}">Edit</vs-button>
                    <vs-button type="border" color="danger" icon-pack="feather" icon="icon-trash" @click="confirmDeleteRecord">Delete</vs-button>
                </div>

            </div>
        </vx-card>

        <!-- Properties -->
        <all :properties="user_data.properties" :id="user_data.id"></all>
    </div>
  </div>
</template>

<script>
import moduleUserManagement from '@/store/user-management/moduleUserManagement.js'
import All from '../properties/All'

export default {
    components: {
        All
    },
    data() {
        return {
            user_data: null,
            user_not_found: false,
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
                text: `You are about to delete "${this.user_data.contact_name}"`,
                accept: this.deleteRecord,
                acceptText: "Delete"
            })
        },
        deleteRecord() {
            /* Below two lines are just for demo purpose */
            this.$vs.loading()
            this.$store.dispatch("userManagement/removeRecord", this.user_data.id)
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
                title: 'Client Deleted',
                position:'top-right',
                text: 'The selected client was successfully deleted'
            })
        }
    },
    created() {
        // Register Module UserManagement Module
        if(!moduleUserManagement.isRegistered) {
        this.$store.registerModule('userManagement', moduleUserManagement)
        moduleUserManagement.isRegistered = true
        }

        const userId = this.$route.params.userId
        this.$store.dispatch("userManagement/fetchUser", userId)
        .then(res => { this.user_data = res.data })
        .catch(err => {
            if(err.response.status === 404) {
                this.user_not_found = true
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

#page-client-view {
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
