<!-- =========================================================================================
    File Name: RegisterCompany.vue
    Description: Register Company Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="h-screen flex w-full bg-img" id="subscription">
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-full">
            <vx-card title="Pick a Plan">
                <div id="card-element" v-if="old_type==null"></div>
                <div class="flex flex-wrap items-center justify-center mb-5 type-check mt-base">
                    <div class="flex items-center justify-center">
                        <vs-button :class="type==0 ? 'disable-button' : type==2 ? 'disable-button' : ''" @click="chooseType(1)">MONTHLY</vs-button>
                    </div>
                    <div class="flex items-center justify-center">
                        <vs-button :class="type==0? '' : type==1 ? 'disable-button' : ''" @click="chooseType(2)">ANNUALY (SAVE 25%)</vs-button>
                    </div>
                </div>
                <div class="flex flex-wrap items-center justify-center plan-check mb-base">
                    <div class="flex flex-col item-center ml-3 mr-5">
                        <div class="p-5 card-plan">
                            <div class="flex justify-start mb-base">PERSONAL</div>
                            <div class="flex justify-center mb-base">
                                <span class="sup mr-1">£</span>
                                <span class="money mr-1">{{type == 1 ? 10 : 10 * 12 * 0.75}}</span>
                                <span class="log">/{{type == 1 ? 'month' : 'year'}}</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>FREE TRIAL</span>
                                <span class="font-bold">14 DAYS</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Jobs</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Customers</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span class="mr-24">Worksheets</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Engineers</span>
                                <span class="font-bold">1</span>
                            </div>
                        </div>
                        <vs-button @click="upgradeSubscription(10)">{{old_type == type ? plan == 1 || plan == 4 ? 'CURRENT PLAN' : 'UPGRADE' : 'UPGRADE'}}</vs-button>
                    </div>
                    <div class="flex flex-col ml-5 mr-5 item-center">
                        <div class="p-5 card-plan">
                            <div class="flex justify-start mb-base">SMALL BUSINESS</div>
                            <div class="flex justify-center mb-base">
                                <span class="sup mr-1">£</span>
                                <span class="money mr-1">{{type == 1 ? 20 : 20 * 12 * 0.75}}</span>
                                <span class="log">/{{type == 1 ? 'month' : 'year'}}</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>FREE TRIAL</span>
                                <span class="font-bold">14 DAYS</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Jobs</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Customers</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span class="mr-24">Worksheets</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Engineers</span>
                                <span class="font-bold">Up to 5</span>
                            </div>
                        </div>
                        <vs-button @click="upgradeSubscription(20)">{{old_type == type ? plan == 2 || plan == 5 ? 'CURRENT PLAN' : 'UPGRADE' : 'UPGRADE'}}</vs-button>
                    </div>
                    <div class="flex flex-col ml-5 mr-3 item-center">
                        <div class="p-5 card-plan">
                            <div class="flex justify-start mb-base">ENTERPRISE</div>
                            <div class="flex justify-center mb-base">
                                <span class="sup mr-1">£</span>
                                <span class="money mr-1">{{type == 1 ? 40 : 40 * 12 * 0.75}}</span>
                                <span class="log">/{{type == 1 ? 'month' : 'year'}}</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>FREE TRIAL</span>
                                <span class="font-bold">14 DAYS</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Jobs</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Customers</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span class="mr-24">Worksheets</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                            <div class="flex justify-between mb-6">
                                <span>Engineers</span>
                                <span class="font-bold">UNLIMITED</span>
                            </div>
                        </div>
                        <vs-button @click="upgradeSubscription(40)">{{old_type == type ? plan == 3 || plan == 6 ? 'CURRENT PLAN' : 'UPGRADE' : 'UPGRADE'}}</vs-button>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import moduleSubscriptionManagement from '@/store/subscription-management/moduleSubscriptionManagement.js'

export default {
    data() {
        return {
            type: 0,
            plan: 0,
            amount: 0,
            old_type: null,

            cardElement: null,
            stripeKey: null,
            stripe: null,
        }
    },
    methods: {
        chooseType(type) {
            this.type = type;
        },
        fetch_subscription_data() {
            this.$store.dispatch('subscriptionManagement/getSubscription')
            .then((response) => {
                if (response.data != null) {
                    switch (response.data.stripe_plan) {
                        case 'Monthly1':
                            this.type = this.old_type = 1
                            this.plan = 1
                            this.amount = 10
                            break;
                        case 'Monthly2':
                            this.type = this.old_type = 1
                            this.plan = 2
                            this.amount = 20
                            break;
                        case 'Monthly3':
                            this.type = this.old_type = 1
                            this.plan = 3
                            this.amount = 40
                            break;
                        case 'Yearly1':
                            this.type = this.old_type = 2
                            this.plan = 4
                            this.amount = 90
                            break;
                        case 'Yearly2':
                            this.type = this.old_type = 2
                            this.plan = 5
                            this.amount = 180
                            break;
                        case 'Yearly3':
                            this.type = this.old_type = 2
                            this.plan = 6
                            this.amount = 360
                            break;
                        default:
                            break;
                    }
                } else {
                    this.stripe = Stripe(this.stripeKey);
                    const elements = this.stripe.elements();
                    this.cardElement = elements.create('card');

                    this.cardElement.mount('#card-element');
                }
            })
            .catch(error => {
                this.$vs.notify({
                    title: 'Error',
                    text: error.message,
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'danger'
                })
            })
        },
        async upgradeSubscription(amount) {
            if (this.old_type == null) {
                this.$vs.loading()
                this.amount = this.type == 1 ? amount : amount * 12 * 0.75;
                const { paymentMethod, error } = await this.stripe.createPaymentMethod(
                    'card', this.cardElement
                );

                if (error) {
                    // Display "error.message" to the user...
                    this.$vs.notify({
                        title: 'Error',
                        text: error.message,
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        position:'top-right',
                        color: 'danger'
                    })
                    this.$vs.loading.close()
                } else {
                    this.sendTokenToServer(paymentMethod.id)
                }
            } else {
                if (this.amount == (this.type == 1 ? amount : amount * 12 * 0.75))
                    return;
                let payload = {amount: this.type == 1 ? amount : amount * 12 * 0.75};
                this.$store.dispatch('subscriptionManagement/upgradeSubscription', payload)
                .then((response) => {
                    console.log(response)
                    switch (response.data.stripe_plan) {
                        case 'Monthly1':
                            this.type = this.old_type = 1
                            this.plan = 1
                            this.amount = 10
                            break;
                        case 'Monthly2':
                            this.type = this.old_type = 1
                            this.plan = 2
                            this.amount = 20
                            break;
                        case 'Monthly3':
                            this.type = this.old_type = 1
                            this.plan = 3
                            this.amount = 40
                            break;
                        case 'Yearly1':
                            this.type = this.old_type = 2
                            this.plan = 4
                            this.amount = 90
                            break;
                        case 'Yearly2':
                            this.type = this.old_type = 2
                            this.plan = 5
                            this.amount = 180
                            break;
                        case 'Yearly3':
                            this.type = this.old_type = 2
                            this.plan = 6
                            this.amount = 360
                            break;
                        default:
                            break;
                    }
                    this.$vs.notify({
                        title: 'Success',
                        text: 'Upgrade Succesfully',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        position:'top-right',
                        color: 'success'
                    })
                })
                .catch(error => {
                    this.$vs.notify({
                        title: 'Error',
                        text: error.message,
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        position:'top-right',
                        color: 'danger'
                    })
                })
            }
        },
        sendTokenToServer (id) {
            let payload = {paymentMethod: id, amount: this.amount};
            // Send to server
            this.$store.dispatch('subscriptionManagement/subscription', payload)
            .then(() => {this.$vs.loading.close()})
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
    },
    created() {
        // Register Module SubscriptionManagement Module
        if(!moduleSubscriptionManagement.isRegistered) {
            this.$store.registerModule('subscriptionManagement', moduleSubscriptionManagement)
            moduleSubscriptionManagement.isRegistered = true
        }
        this.stripeKey = process.env.MIX_STRIPE_KEY
        this.fetch_subscription_data()
    }
}
</script>
<style lang="scss">
#subscription {
    .type-check {
        button {
            width: 210px;
        }
    }
    .plan-check {
        button {
            border-radius: 0;
        }
        .sup {
            position: relative;
            bottom: -1ex;
            font-size: 80%;
        }
        .money {
            font-size: 200%;
            font-weight: 600;
        }
        .log {
            position: relative;
            top: 3ex;
            font-size: 80%;
        }
        .font-bold {
            font-weight: bold;
        }
    }
    .disable-button {
        background-color: #8bc6ee !important;
    }
    .card-plan {
        border: 5px solid #348fdc;
        color: #348fdc;
    }
}
</style>
