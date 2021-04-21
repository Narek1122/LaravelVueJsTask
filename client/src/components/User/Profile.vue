<template>
  <div class="card" v-if="getLoginUser">
    <div class="box">
      <div class="img">
        <img :src="this.checkAvatar()" alt="" class="avatar"
             width="50%">
      </div>
      <div >
        <h1 style="color: whitesmoke">Name: {{ getLoginUser.name }}</h1>
        <h1 style="color: whitesmoke">Email: {{ getLoginUser.email }}</h1>
        <button class="btn btn-primary" @click="logout">Logout</button>
      </div>
      <div>
        <ul>
          <li>
            <router-link :to="{name:'AddCarParts'}" class="btn btn-warning">Add Car Parts</router-link>
          </li>
          <li>
            <router-link :to="{name:'Settings'}" class="btn btn-warning">Settings</router-link>
          </li>
          <li>
            <router-link :to="{name:'MyParts'}" class="btn btn-warning">MyParts</router-link>
          </li>
          <li>
            <router-link :to="{name:'Search'}" class="btn btn-warning">Search</router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Profile",
  data() {
    return {
      users: '',
      token: ''
    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  computed: {
    getLoginUser() {
      return this.$store.getters.getterLoginUser

    }

  },
  mounted() {
    this.getLocToken()
    this.LoginUserUpdate()


  },
  methods: {
    getLocToken() {
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },

    checkAvatar() {
      return this.getLoginUser.avatar ? 'http://narek.test/api/auth/get_profile_image/' + this.getLoginUser.avatar : 'http://narek.test/api/auth/get_profile_image/null_profile_image.png'
    },

    LoginUserUpdate() {

      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.get('/updateuser')
        .then((res) => {
          this.$store.commit('loginUser', res)

        })
    },
    logout() {
      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.post('/logout')
        .then((res) => {
          localStorage.removeItem('token')
          this.$router.push({name: "Login"})
        })
    }
  }
}
</script>

<style scoped>
.card {
  position: relative;
  margin-top: 140px;


}

.card .box {
  position: absolute;
  top: 50%;
  left: 0;
  text-align: center;
  padding: 20px;
  box-sizing: border-box;
  width: 100%;
}

.card .box .img {
  width: 200px;
  height: 200px;
  margin: 0 auto;
  border-radius: 50%;
  overflow: hidden;
}

.card .box .img img {
  width: 100%;
  height: 100%;
}

.card .box h1 {
  font-size: 20px;
  color: #262626;
  margin: 20px auto;
}


.card .box ul {
  margin: 0;
  padding: 0;
}

.card .box ul li {
  list-style: none;
  float: left;
  margin-left: 50px;
}


</style>
