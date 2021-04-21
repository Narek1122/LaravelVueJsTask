<template>


  <div class="col-md-3 card col-sm-10 col-sm-12" id="parts">
    <div>
      <h1>Name: {{ parts.name }}</h1>
      <h2>Model: {{ parts.model }}</h2>
      <h2>Year: {{ parts.year }}</h2>
      <h2>Part Number: {{ parts.partnumber }}</h2>
      <img :src="this.checkAvatar(parts.id)" alt="" class="avatar" width="100%">
      <button @click="imagedown" class="btn btn-warning">Prev Image</button>
      <button @click="imageup" class="btn btn-warning">Next Image</button>
    </div>
    <button class="btn btn-danger" @click="deletePart(parts.id)">Delete</button>
    <button class="btn btn-dark" @click="changeMenu">Change</button>
    <div>
      <router-link :to="{name:'AddPartImages', params: {part_id: parts.id}}" class="btn btn-warning">Add Images
      </router-link>
    </div>
    <div class="changeMenu" v-if="changeclick">
      <div class="form-group">
        <div>
          <label for="">Name</label>
          <input type="text" v-model="partschnage.name" class="form-control">
        </div>
        <div>
          <label for="">Model</label>
          <input type="text" v-model="partschnage.model" class="form-control">
        </div>
        <div>
          <label for="">Year</label>
          <input type="number" v-model="partschnage.year" class="form-control">
        </div>
        <div>
          <label for="">Make</label>
          <input type="text" v-model="partschnage.make" class="form-control">
        </div>
        <div>
          <label for="">Part Number</label>
          <input type="number" v-model="partschnage.partnumber" class="form-control">
        </div>
        <button class="btn btn-danger" @click="ChangeParts(parts.id)">Create</button>
      </div>
    </div>

  </div>
  </div>


</template>

<script>
export default {
  name: "MyParts",
  data() {
    return {
      changeclick: false,
      partschnage: {
        name: this.parts.name,
        model: this.parts.model,
        year: this.parts.year,
        make: this.parts.make,
        partnumber: this.parts.partnumber
      },
      image: 0

    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  mounted() {

    this.checkAvatar()
  },
  props: {
    parts: {
      type: Object, default: () => {
      }
    }
  },
  methods: {
    imagedown() {
      if (this.image == 0) {
        this.image = 3
      }
      this.image = this.image - 1
    },
    imageup() {
      this.image++
      if (this.image == 3) {
        this.image = 0
      }
    },
    checkAvatar(id) {
      let x = []
      let images = localStorage.getItem('mypartsimages')
      images = JSON.parse(images)
      let n = images.filter(function (item) {
        return item.part_id == id
      })

      for (let i = 0; i < n.length; i++) {
        x.push(n[i].avatar)
      }
      console.log(x[1])

      return x[this.image] ? 'http://narek.test/partImages/' + id + '/' + x[this.image] : 'http://narek.test/api/auth/get_product_image/usernullimage.png'

    },


    deletePart(id) {
      this.$emit("deletePart", id);
    },
    changeMenu() {
      this.changeclick = !this.changeclick
    },
    ChangeParts(id) {
      this.$emit("ChangeParts", id, this.partschnage);
      this.changeclick = !this.changeclick
    },
    changeMyPartsImage(e) {
      this.$emit("changeMyPartsImage", e, this.parts.id);
      this.changeclick = !this.changeclick

    }
  }
}

</script>


<style scoped>
.changeMenu {
  color: white;
  position: absolute;
  background: black;
  width: 80%;
  padding: 10px;

}

#parts {
  background-color: rgba(253, 187, 45, 0.3);
  border-radius: 5%;
}


</style>

