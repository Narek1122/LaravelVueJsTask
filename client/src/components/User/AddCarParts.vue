<template>
  <div class="container" id="addPart">
    <div class="form-group">
      <div>
        <label for="">Name</label>
        <input type="text" v-model="parts.name" class="form-control">
      </div>
      <div>
        <label for="">Model</label>
        <input type="text" v-model="parts.model" class="form-control">
      </div>
      <div>
        <label for="">Year</label>
        <input type="text" v-model="parts.year" class="form-control">
      </div>
      <div>
        <label for="">Make</label>
        <input type="text" v-model="parts.make" class="form-control">
      </div>
      <div>
        <label for="">Part Number</label>
        <input type="text" v-model="parts.partnumber" class="form-control">
      </div>
      <button class="btn btn-danger" @click="create">Create</button>

    </div>
  </div>
</template>

<script>
export default {
  name: "AddCarParts",
  data() {
    return {
      parts: {
        name: '',
        model: '',
        year: '',
        make: '',
        partnumber: ''
      },
      token: ''
    }
  },
  mounted() {
    this.getToken()
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  methods: {

    getToken() {
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },
    nn(e){

      let formData = new FormData();
      formData.append('file', e.target.files[0]);

      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token,
          'content-type': 'multipart/form-data'
        }
      })

      authAxios.post('/addpartimages/5/1', formData)
        .then((res) => {
          console.log(res)
        })
    },


    onFileChange(e) {

      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('file', e.target.files[0]);

      this.axios.post('http://narek.test/api/auth/file_upload_parts', formData, config)
        .then((res) => {
          this.parts.avatar = res.data.name

        })

    },
    create() {
      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.post('/addcarpart', this.parts)
        .then((res) => {
          console.log(res)
          this.$router.push({name: "MyParts"});
        })

    },
  }
}
</script>

<style scoped>
#addPart {
  background-image: url("https://wallpapercave.com/wp/wp4043145.jpg");
  background-size: cover;
  padding: 100px;
  border-radius: 10px;
}
</style>
