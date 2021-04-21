import Vue from 'vue'
import Router from 'vue-router'
import auth_routes from "../components/Auth/auth_routes";
import profile_routes from "../components/User/profile_routes";
import home_routes from "../components/Home/home_routes";
import PageError from "../components/Errors/PageError";
import adminz_routes from "../components/Admins/adminz_routes";


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      redirect: {name: "HomePage"}
    },

    {
      path: '*',
      name: 'PageError',
      component: PageError
    },
    ...auth_routes,
    ...profile_routes,
    ...home_routes,
    ...adminz_routes,

  ]
})
