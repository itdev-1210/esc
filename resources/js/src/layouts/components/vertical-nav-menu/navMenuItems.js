/*=========================================================================================
  File Name: sidebarItems.js
  Description: Sidebar Items list. Add / Remove menu items from here.
  Strucutre:
          url     => router path
          name    => name to display in sidebar
          slug    => router path name
          icon    => Feather Icon component/icon name
          tag     => text to display on badge
          tagColor  => class to apply on badge element
          i18n    => Internationalization
          submenu   => submenu of current item (current item will become dropdown )
                NOTE: Submenu don't have any icon(you can add icon if u want to display)
          isDisabled  => disable sidebar item/group
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


export default [
  {
    name: "Dashboard",
    icon: "HomeIcon",
    i18n: "Dashboard",
    url: '/dashboard',
    slug: 'dashboard'
  },
  {
    name: "CLIENTS",
    icon: "UsersIcon",
    i18n: "Clients",
    url: '/clients/client_list',
    slug: 'clients-client_list'
  },
  {
    name: "PROPERTIES",
    icon: "ShoppingBagIcon",
    i18n: "Properties",
    url: '/properties/property_list',
    slug: 'properties-property_list'
  },
  {
    name: "JOBS",
    icon: "BoxIcon",
    i18n: "Jobs",
    url: '/jobs/job_list',
    slug: 'jobs-job_list'
  },
  {
    name: "ENGINEERS",
    icon: "UserIcon",
    i18n: "Engineers",
    url: '/engineers/engineer_list',
    slug: 'engineers-engineer_list'
  },
  {
    name: "UPGRADE ACCOUNT",
    icon: "InfoIcon",
    i18n: "UpgradeAccount",
    url: '/upgrade-account',
    slug: 'upgrade-account'
  },
  {
    name: "COMPANY DETAILS",
    icon: "SettingsIcon",
    i18n: "CompanyDetail",
    url: '/company_detail',
    slug: 'company_detail'
  },
  {
    url: '/support',
    slug: 'support',
    name: "SUPPORT",
    icon: "SmileIcon",
    i18n: "Support",
  },
  {
    url: '/logout',
    name: "LOG OUT",
    icon: "LogOutIcon",
    i18n: "Logout",
    slug: 'logout',
  }
]

