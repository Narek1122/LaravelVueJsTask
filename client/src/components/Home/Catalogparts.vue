<template>
  <div class="col-md-4 card col-sm-2 col-sm-12" id="card">
    <div class="card-body">
      <h1>Name: {{ part.name }}</h1>
      <h1>Make: {{ part.make }}</h1>
      <h1>Partnumber: {{ part.partnumber }}</h1>
      <img :src="this.checkAvatar(part.id)" alt="" class="avatar" width="100%">
      <button @click="imagedown" class="btn btn-warning">Prev Image</button>
      <button @click="imageup" class="btn btn-warning">Next Image</button>
      <router-link class="btn btn-warning" :to="{name: 'HomeDetails', params: {part_id: part.id}}">
        Show
      </router-link>
    </div>

  </div>
</template>

<script>
export default {
  name: "Catalogparts",
  data() {
    return {
      image: 0
    }
  },

  mounted() {

    this.checkAvatar()
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1465929517729-473000af12ce?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
    this.checkAvatar()
  },
  methods: {
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
  props: {
    part: {
      type: Object, default: () => {
      }
    }
  },
}
</script>

<style scoped>
#card {
  background-color: rgba(88, 88, 88, 0.9);
  border-radius: 5%;
  color: whitesmoke;
}

</style>
