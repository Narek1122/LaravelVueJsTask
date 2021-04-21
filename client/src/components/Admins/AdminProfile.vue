<template>
  <div>
    <div class="container">
      <div class="card" >
        <div style="width: 100px">
          <button class="btn btn-primary with-3d-shadow" @click="logout">Logout</button>
        </div>
        <h1>{{ getAdminUser.name }}</h1>
        <h1>{{ getAdminUser.email }}</h1>
      </div>
      <div class="card">
        <router-link :to="{name:'BlockUsers'}" class="btn btn-warning">Block Users</router-link>
      </div>
    </div>
    <div>
      <SearchUser></SearchUser>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import SearchUser from "./SearchUser";

export default {
  name: "AdminProfile",
  computed: {
    getAdminUser() {
      return this.$store.getters.getAdminUser
    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1492551557933-34265f7af79e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  mounted() {
    this.getLocToken()
    this.updateAdminUser()

  },
  components: {
    SearchUser
  },
  data() {
    return {
      token: ''
    }
  },
  methods: {

    getLocToken() {
      let token = localStorage.getItem('admintoken')
      token = JSON.parse(token)
      this.token = token
    },
    updateAdminUser() {
      const authAxios = axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })
      authAxios.get('/updateuser')
        .then((res) => {
          this.$store.commit('adminUser', res.data)
        })

    },
    logout(){
      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.post('/logout')
        .then((res) => {
          localStorage.removeItem('admintoken')
          this.$router.push({name : "AdminPage"})
        })
    }
  }
}
</script>

<style scoped>
h1{
  margin-left: 30px;
}
</style>
