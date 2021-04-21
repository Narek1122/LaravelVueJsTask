<template>
  <div class="container mt-5">
    <div v-if="getPartUserData">
      <div class="row">
        <div class="card m-auto text-center col-md-4 col-sm-2 col-sm-12" style="width: 50rem; background-color: azure">
          <div class="img">
            <img :src="this.checkAvatar(getPartUserData.parts.id)" alt="" class="avatar" width="100%">
            <button @click="imagedown" class="btn btn-warning">Prev Image</button>
            <button @click="imageup" class="btn btn-warning">Next Image</button>
          </div>
          <h2>Name: {{ getPartUserData.parts.name }}</h2>
          <h2>Partnumber: {{ getPartUserData.parts.partnumber }}</h2>
          <h2>Model: {{ getPartUserData.parts.model }}</h2>
          <h2>Year: {{ getPartUserData.parts.year }}</h2>
          <h2>Phone Number: {{ getPartUserData.users.phone }}</h2>
          <h2>Address: {{ getPartUserData.users.address }}</h2>
          <router-link class="btn btn-warning" :to="{name: 'HomePage'}">
            Home
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HomeDetails",
  data() {
    return {
      image: 0
    }
  },

  beforeMount() {
    this.getAllPart()
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1465929517729-473000af12ce?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  computed: {
    getPartUserData() {
      return this.$store.getters.getPartUserDetails.data
    }
  },
  methods: {
    getAllPart() {
      let id = this.$route.params.part_id
      this.axios.get(`http://narek.test/api/auth/getpartbyid/${id}`)
        .then((res) => {
          this.$store.commit('PartUserDetails', res)
        })
    },
    imageup() {
      this.image++
      if (this.image == 3) {
        this.image = 0
      }
    },
    imagedown() {
      if (this.image == 0) {
        this.image = 3
      }
      this.image = this.image - 1
    },
    checkAvatar(id) {
      let x = []
      let images = localStorage.getItem('allpartsimages')
      images = JSON.parse(images)
      let n = images.filter(function (item) {
        return item.part_id == id
      })

      for (let i = 0; i < n.length; i++) {
        x.push(n[i].avatar)
      }
      console.log(x[1])

      return x[this.image] ? 'http://narek.test/partImages/' + id + '/' + x[this.image] : 'http://narek.test/api/auth/get_product_image/visitornullimage.png'

    },

  },


}
</script>

<style scoped>

</style>
