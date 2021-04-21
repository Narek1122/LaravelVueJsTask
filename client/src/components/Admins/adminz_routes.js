
import AdminPage from "./AdminPage";
import AdminProfile from "./AdminProfile";
import SearchUser from "./SearchUser";
import BlockUsers from "./BlockUsers";



export default [
  {
    path: '/admin',
    name: 'AdminPage',
    component: AdminPage
  },
  {
    path: '/admin/profile',
    name: 'AdminProfile',
    component: AdminProfile,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('admintoken')){
        return next({
          name: 'AdminPage'
        })
      }
      next()
  }
  },
  {
    path: '/admin/search',
    name: 'SearchUser',
    component: SearchUser,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('admintoken')){
        return next({
          name: 'AdminPage'
        })
      }
      next()
    }
  },
  {
    path: '/admin/profile/blockusers',
    name: 'BlockUsers',
    component: BlockUsers,
    beforeEnter:(to,from,next) =>{
      if(!localStorage.getItem('admintoken')){
        return next({
          name: 'AdminPage'
        })
      }
      next()
    }
  }



]
