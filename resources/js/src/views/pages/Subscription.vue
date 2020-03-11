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
        <div class="vx-col sm:w-full md:w-full lg:w-full xl:w-8/12 mx-auto self-center">
            <vx-card title="Pick a Plan">
                <!-- <div class='credit-card-inputs flex justify-between items-center' :class='{ complete }'>
                    <div class='flex-1'>
                        <card-number class='stripe-element card-number'
                            ref='cardNumber'
                            :stripe='stripeKey'
                            @change='number = $event.complete'
                        />
                    </div>
                    <div class='flex justify-end items-center flex-1'>
                        <card-expiry class='stripe-element card-expiry flex-1'
                            ref='cardExpiry'
                            :stripe='stripeKey'
                            @change='expiry = $event.complete'
                        />
                        <card-cvc class='stripe-element card-cvc flex-1'
                            ref='cardCvc'
                            :stripe='stripeKey'
                            @change='cvc = $event.complete'
                        />
                    </div>
                </div> -->
                <div id="card-element"></div>
                <div class="flex flex-wrap items-center justify-center mb-5 type-check mt-base">
                    <div class="flex items-center justify-center">
                        <vs-button :class="type==2 ? 'disable-button' : ''" @click="chooseType(1)">MONTHLY</vs-button>
                    </div>
                    <div class="flex items-center justify-center">
                        <vs-button :class="type==1 ? 'disable-button' : ''" @click="chooseType(2)">ANNUALY (SAVE 25%)</vs-button>
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
                        <vs-button @click="subscribe(10)">SUBSCRIBE</vs-button>
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
                        <vs-button @click="subscribe(20)">SUBSCRIBE</vs-button>
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
                        <vs-button @click="subscribe(40)">SUBSCRIBE</vs-button>
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import axios from "@/axios.js"
import moduleSubscriptionManagement from '@/store/subscription-management/moduleSubscriptionManagement.js'

export default {
    data() {
        return {
            loading: false,
            type: 1,
            token: null,
            amount: 0,
            cardElement: null,
            stripeKey: null,
            stripe: null,
        }
    },
    mounted() {
        this.stripe = Stripe(this.stripeKey);
        const elements = this.stripe.elements();
        this.cardElement = elements.create('card');

        this.cardElement.mount('#card-element');
    },
    methods: {
        chooseType(type) {
            this.type = type;
        },

        async subscribe (amount) {
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
    },
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
    .credit-card-inputs.complete {
        border: 2px solid green;
    }
}
</style>
