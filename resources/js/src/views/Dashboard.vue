<!-- =========================================================================================
  File Name: Dashboard.vue
  Description: Dashboard
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="dashboard">
    <div class="vx-row mb-5" v-if="trialDays">
      <vx-card
        content-color="#fff"
        card-background="primary">
        <p class="text-center"><strong>Subscription Trial:</strong> {{trialDays}} Days remaining. <a href="/upgrade-account" class="underline text-white">Upgrade Now</a></p>
      </vx-card>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-base">
        <statistics-card-line
          icon="UsersIcon"
          :statistic="totalClients | k_formatter"
          statisticTitle="Total Clients"
          type='area' />
      </div>
      <div class="vx-col w-full sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-base">
        <statistics-card-line
          icon="ShoppingBagIcon"
          :statistic="totalProperties | k_formatter"
          statisticTitle="Total Properties"
          type='area' />
      </div>
      <div class="vx-col w-full sm:w-1/3 md:w-1/3 lg:w-1/3 xl:w-1/3 mb-base">
        <statistics-card-line
          icon="UserIcon"
          :statistic="totalEngineers | k_formatter"
          statisticTitle="Total Engineers"
          type='area' />
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full md:w-1/3 mb-base">
        <vx-card title="Job Overview">
          <template slot="actions">
            <feather-icon icon="HelpCircleIcon" svgClasses="w-6 h-6 text-grey"></feather-icon>
          </template>

          <!-- CHART -->
          <template slot="no-body"> 
            <div class="mt-10">
              <!-- <vue-apex-charts type=radialBar height=240 :options="analyticsData.goalOverviewRadialBar.chartOptions" :series="goalOverview.series" /> -->
            </div>
          </template>

          <!-- DATA -->
          <div class="flex justify-between text-center mt-6" slot="no-body-bottom">
            <div class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0">
              <p class="mt-4">Completed</p>
              <p class="mb-4 text-3xl font-semibold">{{ completeJob }}</p>
            </div>
            <div class="w-1/2 border border-solid d-theme-border-grey-light border-r-0 border-b-0">
              <p class="mt-4">Not Complete</p>
              <p class="mb-4 text-3xl font-semibold">{{ inCompleteJob }}</p>
            </div>
          </div>
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import StatisticsCardLine from '@/components/statistics-cards/StatisticsCardLine.vue'
import VueApexCharts from 'vue-apexcharts'
import axios from "@/axios.js"

export default {
    data() {
      return {
        totalClients: 0,
        totalProperties: 0,
        totalEngineers: 0,
        completeJob: 0,
        inCompleteJob: 0,
        trialDays: null,
      }
    },
    components: {
      StatisticsCardLine,
      VueApexCharts,
    },
    created() {
      axios.get('/getDashboardInfo')
      .then((response) => {
        this.totalClients = response.data.totalClients
        this.totalProperties = response.data.totalProperties
        this.totalEngineers = response.data.totalEngineers
        this.completeJob = response.data.completeJob
        this.inCompleteJob = response.data.inCompleteJob
        this.trialDays = response.data.trialDays
      })
      .catch((error) => { console.log(error) })
    }
}
</script>

<style lang="scss">
/*! rtl:begin:ignore */
#dashboard {
  .greet-user{
    position: relative;

    .decore-left{
      position: absolute;
      left:0;
      top: 0;
    }
    .decore-right{
      position: absolute;
      right:0;
      top: 0;
    }
  }
  .line-area-chart {
    display: none;
  }

  @media(max-width: 576px) {
    .decore-left, .decore-right{
      width: 140px;
    }
  }
}
/*! rtl:end:ignore */
</style>
