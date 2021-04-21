<template>
  <div class="container">
    <div class="input-group">
      <input type="input" class="form-control" v-model="input.name">
      <button class="btn btn-danger" @click="search">Search</button>
      <div class="container" v-if="none">
        <select id="" v-model="filter.type">
          <option disabled value="" selected="">Select To Filter</option>
          <option value="model">Model</option>
          <option value="partnumber">Part Number</option>
          <option value="make">Make</option>
        </select>
        <input type="text" v-model="filter.inp" placeholder="Insert Filter Data">
        <button @click="filterBy" class="btn btn-primary">Filter</button>
      </div>
    </div>
    <div>
      <h1 v-if="notFound">Resoult Not Found</h1>
    </div>
    <div v-if="getVisitorSearch">
      <div class="row">
        <Catalogparts
          v-for="part in getVisitorSearch"
          :part="part"
          :key="part.id"
        >
        </Catalogparts>
      </div>
    </div>
  </div>
</template>

<script>
import Catalogparts from "./Catalogparts";

export default {
  name: "Search",
  data() {
    return {
      input: {
        name: ''
      },
      filter: {
        type: '',
        inp: ''
      },
      none: false,
      notFound: false
    }
  },
  computed: {
    getVisitorSearch() {
      return this.$store.getters.getVisitorSearch
    }
  },
  components: {
    Catalogparts
  },
  mounted() {
    this.filterBy()
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1465929517729-473000af12ce?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  methods: {
    search() {
      this.axios.post('http://narek.test/api/auth/searchdata', this.input)
        .then(response => {
          this.$store.commit('visitorSearch', response.data)
          if (response.data.length == '') {
            this.notFound = true
          } else {
            this.notFound = false
          }
          this.none = true

        })
    },
    filterBy() {

      let type = this.filter.type
      let inp = this.filter.inp
      this.$store.commit('visitorSearch', [...this.getVisitorSearch].filter(function (part) {
        return part[type] == inp
      }))


    }


  }
}
</script>

<style scoped>

</style>

