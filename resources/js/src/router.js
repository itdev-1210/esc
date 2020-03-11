/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  Object Strucutre:
                    path => router path
                    name => router name
                    component(lazy loading) => component to load
                    meta : {
                      rule => which user can have access (ACL)
                      breadcrumb => Add breadcrumb to specific page
                      pageTitle => Display title besides breadcrumb
                    }
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    scrollBehavior () {
        return { x: 0, y: 0 }
    },
    routes: [

        {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
        // =============================================================================
        // Theme Routes
        // =============================================================================
                {
                    path: '/',
                    redirect: '/dashboard',
                },
                {
                    path: '/dashboard',
                    name: 'dashboard',
                    component: () => import('./views/Dashboard.vue'),
                    meta: {
                        rule: 'admin',
                        authRequired: true,
                    }
                },

        // =============================================================================
        // Application Routes
        // =============================================================================
                // Clients Routes
                {
                    path: '/clients/client_list',
                    name: 'client-list',
                    component: () => import('./views/apps/clients/All.vue'),
                    meta: {
                        pageTitle: 'CLIENTS',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'CLIENTS', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/clients/client_view/:userId',
                    name: 'client-view',
                    component: () => import('./views/apps/clients/View.vue'),
                    meta: {
                        pageTitle: 'View a Client',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Client', url: {name:'client-list'}},
                            { title: 'View', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/clients/client_edit/:userId',
                    name: 'client-edit',
                    component: () => import('./views/apps/clients/Edit.vue'),
                    meta: {
                        pageTitle: 'Edit a Client',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Client', url: {name:'client-list'}},
                            { title: 'Edit', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/clients/client_add',
                    name: 'client-add',
                    component: () => import('./views/apps/clients/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Client',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Client', url: {name:'client-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Properties Routes
                {
                    path: '/properties/property_list',
                    name: 'property-list',
                    component: () => import('./views/apps/properties/All.vue'),
                    meta: {
                        pageTitle: 'PROPERTIES',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'PROPERTIES', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/properties/property_view/:id',
                    name: 'property-view',
                    component: () => import('./views/apps/properties/View.vue'),
                    meta: {
                        pageTitle: 'View a Property',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Property', url: {name:'property-list'}},
                            { title: 'View', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/properties/property_edit/:id',
                    name: 'property-edit',
                    component: () => import('./views/apps/properties/Edit.vue'),
                    meta: {
                        pageTitle: 'Edit a Property',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Property', url: {name:'property-list'}},
                            { title: 'Edit', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/properties/property_add/:clientId',
                    name: 'property-add-client',
                    component: () => import('./views/apps/properties/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Property',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Property', url: {name:'property-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/properties/property_add',
                    name: 'property-add',
                    component: () => import('./views/apps/properties/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Property',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Property', url: {name:'property-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Job Routes
                {
                    path: '/jobs/job_list',
                    name: 'job-list',
                    component: () => import('./views/apps/jobs/All.vue'),
                    meta: {
                        pageTitle: 'JOBS',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'JOBS', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/jobs/job_view/:id',
                    name: 'job-view',
                    component: () => import('./views/apps/jobs/View.vue'),
                    meta: {
                        pageTitle: 'View a Job',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Job', url: {name:'job-list'}},
                            { title: 'View', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/jobs/job_edit/:id',
                    name: 'job-edit',
                    component: () => import('./views/apps/jobs/Edit.vue'),
                    meta: {
                        pageTitle: 'Edit a Job',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Job', url: {name:'job-list'}},
                            { title: 'Edit', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/jobs/job_add',
                    name: 'job-add',
                    component: () => import('./views/apps/jobs/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Job',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Job', url: {name:'job-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/jobs/property_job_add/:property_id',
                    name: 'property-job-add',
                    component: () => import('./views/apps/jobs/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Job',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Job', url: {name:'job-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/jobs/engineer_job_add/:engineer_id',
                    name: 'engineer-job-add',
                    component: () => import('./views/apps/jobs/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Job',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Job', url: {name:'job-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Engineer Routes
                {
                    path: '/engineers/engineer_list',
                    name: 'engineer-list',
                    component: () => import('./views/apps/engineers/All.vue'),
                    meta: {
                        pageTitle: 'ENGINEERS',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'ENGINEERS', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/engineers/engineer_view/:id',
                    name: 'engineer-view',
                    component: () => import('./views/apps/engineers/View.vue'),
                    meta: {
                        pageTitle: 'View a Engineer',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Engineer', url: {name:'engineer-list'}},
                            { title: 'View', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/engineers/engineer_edit/:id',
                    name: 'engineer-edit',
                    component: () => import('./views/apps/engineers/Edit.vue'),
                    meta: {
                        pageTitle: 'Edit a Engineer',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Engineer', url: {name:'engineer-list'}},
                            { title: 'Edit', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                {
                    path: '/engineers/engineer_add',
                    name: 'engineer-add',
                    component: () => import('./views/apps/engineers/Add.vue'),
                    meta: {
                        pageTitle: 'Add a Engineer',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Engineer', url: {name:'engineer-list'}},
                            { title: 'Add', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Upgrade Account
                {
                    path: '/upgrade-account',
                    name: 'upgrade-account',
                    component: () => import('./views/UpgradeAccount.vue'),
                    meta: {
                        pageTitle: 'Upgrade Account',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Upgrade Account', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Company Detail
                {
                    path: '/company_detail',
                    name: 'company-detail',
                    component: () => import('./views/CompanyDetail.vue'),
                    meta: {
                        pageTitle: 'COMPANY DETAILS',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Company Detail', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Support
                {
                    path: '/support',
                    name: 'support',
                    component: () => import('./views/Support.vue'),
                    meta: {
                        pageTitle: 'Support',
                        breadcrumb: [
                            { title: 'Home', url: '/' },
                            { title: 'Support', active: true },
                        ],
                        rule: 'editor',
                        no_scroll: true,
                        authRequired: true,
                    }
                },
                // Logout
                {
                    path: '/logout',
                    name: 'logout',
                    component: () => import('./views/Logout.vue'),
                    meta: {
                        rule: 'editor',
                        no_scroll: true,
                    }
                }
            ],
        },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
        // =============================================================================
        // PAGES
        // =============================================================================
                {
                    path: '/login',
                    name: 'login',
                    component: () => import('@/views/pages/login/Login.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/register',
                    name: 'register',
                    component: () => import('@/views/pages/register/Register.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/forgot-password',
                    name: 'forgot-password',
                    component: () => import('@/views/pages/ForgotPassword.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/reset-password/*',
                    name: 'reset-password',
                    component: () => import('@/views/pages/ResetPassword.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/error-404',
                    name: 'error-404',
                    component: () => import('@/views/pages/Error404.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/error-500',
                    name: 'error-500',
                    component: () => import('@/views/pages/Error500.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/not-authorized',
                    name: 'not-authorized',
                    component: () => import('@/views/pages/NotAuthorized.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/register-company',
                    name: 'register-company',
                    component: () => import('@/views/pages/RegisterCompany.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
                {
                    path: '/subscription',
                    name: 'subscription',
                    component: () => import('@/views/pages/Subscription.vue'),
                    meta: {
                        rule: 'editor'
                    }
                },
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/error-404'
        }
    ],
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

router.beforeEach((to, from, next) => {
    // If auth required, check login. If login fails redirect to login page
    // if(to.meta.authRequired) {
    //     if (!(localStorage.getItem('userInfo'))) {
    //         router.push({ path: '/login'})
    //     }
    // }

    return next()
});

export default router
