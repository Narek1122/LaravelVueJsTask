
import Login from "./Login"
import Register from "./Register"

export default [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    beforeEnter:(to,from,next) =>{
      if(localStorage.getItem('token')){
        return next({
          name: 'Profile'
        })
      }
      next()
    }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    beforeEnter:(to,from,next) =>{
      if(localStorage.getItem('token')){
        return next({
          name: 'Profile'
        })
      }
      next()
    }
  },

]
