<template>
  <div class="card col-md-4 col-sm-2 col-sm-12" style="width: 25rem;"
       v-bind:class="parts.isBlocked == '1' ? 'block' : 'unblock'">
    <img :src="this.checkAvatar(parts.id)" alt="" class="rounded float-right"
         width="300px">
    <div>
      <button @click="imagedown" class="btn btn-warning">Prev Image</button>
      <button @click="imageup" class="btn btn-warning">Next Image</button>
    </div>

    <div class="card-body">
      <h1>{{ parts.name }}</h1>
      <h4>{{ parts.partnumber }}</h4>
      <button @click="block(parts.id,parts.isBlocked)" class="btn btn btn-warning">
        <h4 v-if="parts.isBlocked ? unblock='Unblock Part' : unblock='Block Part' ">{{ unblock }}</h4>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "UsersProduct",

  data() {
    return {
      unblock: 'false',
      image:0

    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1492551557933-34265f7af79e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  props: {
    parts: {
      type: Object, default: () => {
      },

    },
  },
  methods: {
    imageup() {
      this.image++
      if (this.image == 3) {
        this.image = 0
      }
    },
      imagedown(){
        if(this.image == 0){
          this.image = 3
        }
        this.image = this.image - 1
    },
    checkAvatar(id) {
      let x = []
      let images = localStorage.getItem('allpartsimages')
      images = JSON.parse(images)
      let n = images.filter(function(item){
        return item.part_id == id
      })

      for(let i= 0;i<n.length;i++){
        x.push(n[i].avatar)
      }
      console.log(x[1])

      return x[this.image] ? 'http://narek.test/partImages/' + id + '/' + x[this.image] : 'http://narek.test/api/auth/get_product_image/visitornullimage.png'

    },
    block(id, Blocked) {
      this.$emit("block", id, Blocked);
    },



  }

}
</script>

<style scoped>
.block {
  background: #9B2335;
  color: white;
}

.unblock {
  background: #0072B5;
  color: white;
}

</style>
