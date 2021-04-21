<template>
  <div class="body">
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="searchbar">
          <input class="search_input" type="text" name="" placeholder="Search Parts By Name or Email..."
                 v-model="input.email">
          <button class="search_icon" @click="search">Ok</button>
        </div>
      </div>
    </div>
    <div class="row">
      <UsersProduct
        v-for="parts in GetAdminAllParts"
        :parts="parts"
        @block="block"
      ></UsersProduct>
    </div>
  </div>
</template>

<script>
import UsersProduct from "./UsersProduct";

export default {
  name: "SearchUser",
  data() {
    return {
      input: {
        email: ''
      }
    }
  },
  components: {
    UsersProduct
  },
  computed: {
    GetAdminAllParts() {
      return this.$store.getters.GetAdminAllParts.data
    }
  },
  mounted() {

  },
  methods: {
    search() {
      this.axios.post('http://narek.test/api/auth/searchdataadmin', this.input)
        .then((res) => {
          this.$store.commit('adminAllParts', res)
        })
    },
    beforeMount() {
      document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1492551557933-34265f7af79e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
      document.body.style.backgroundSize = 'cover'
    },
    block(id, Blocked) {
      Blocked = !Blocked
      let data = {
        id: id,
        block: Blocked
      }
      this.axios.post('http://narek.test/api/auth/blockuserpart', data)
        .then((res) => {
          console.log(res)
          this.search()
        })
    },

  }
}
</script>


<style scoped>
body, html {
  height: 100%;
  width: 100%;
  margin: 0;
  padding: 0;
  background: black !important;
}


.searchbar {
  margin-bottom: auto;
  margin-top: auto;
  height: 60px;
  background-color: #353b48;
  border-radius: 30px;
  padding: 10px;
}

.search_input {
  color: white;
  border: 0;
  outline: 0;
  background: none;
  width: 0;
  caret-color: transparent;
  line-height: 40px;
  transition: width 0.4s linear;
}

.searchbar:hover > .search_input {
  padding: 0 10px;
  width: 450px;
  caret-color: red;
  transition: width 0.4s linear;
}

.searchbar:hover > .search_icon {
  background: white;
  color: #e74c3c;
}

.search_icon {
  height: 40px;
  width: 40px;
  float: right;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  color: white;
  text-decoration: none;
}
</style>
