import Profile from "./Profile";
import AddCarParts from "./AddCarParts";
import MyParts from "./MyParts";
import Settings from "./Settings";
import Search from "./Search";
import AddPartImages from "./AddPartImages";
export default [
  {
    path: '/profile',
    name: 'Profile',
    component: Profile,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/addpartimages/:part_id',
    name: 'AddPartImages',
    component: AddPartImages,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/addcarparts',
    name: 'AddCarParts',
    component: AddCarParts,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/myparts',
    name: 'MyParts',
    component: MyParts,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/settings',
    name: 'Settings',
    component: Settings,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  },
  {
    path: '/profile/search',
    name: 'Search',
    component: Search,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('token')){
        return next({
          name: 'Login'
        })
      }
      next()
    }
  }

]
