<template>
  <div>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">CarParts</a>
        <div>
          <router-link :to="{name:'Login'}" class="btn btn-primary">Login</router-link>
          <router-link :to="{name:'Register'}" class="btn btn-danger">SignUp</router-link>
          <router-link :to="{name:'HomeSearch'}" class="btn btn-white">Search Car Parts</router-link>
        </div>
      </nav>
    </header>
    <main class="container">
      <div class="row">
        <Catalogparts
          v-for="part in getterAllParts"
          :key="part.id"
          :part="part"
        >

        </Catalogparts>
      </div>
    </main>
  </div>
</template>

<script>
import Catalogparts from "./Catalogparts";

export default {
  name: "HomePage",
  components: {
    Catalogparts,
  },
  created() {
    this.getAllParts()
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1465929517729-473000af12ce?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  mounted() {


  },
  computed: {
    getterAllParts() {
      return this.$store.getters.getterAllParts

    }
  },
  data() {
    return {
      parts: ''
    }
  },
  methods: {
    getAllParts() {
      this.axios.get('http://narek.test/api/auth/getallparts')
        .then((res) => {
          let parts = res.data.data
          this.$store.commit('allparts', parts)
          localStorage.setItem('allpartsimages',JSON.stringify(res.data.partimages))
        })
    },

  }
}
</script>

<style scoped>
body{
  background-color: #0c5460;
}
header {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
</style>
