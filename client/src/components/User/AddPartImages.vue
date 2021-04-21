<template>
  <div class="container mt-5">
    <div>
      <div class="row">
        <div class="card m-auto text-center col-md-4 col-sm-2 col-sm-12" style="width: 50rem; background-color: azure">
          <div class="form-group">
            <div>
              <label for=""></label>
              <select name="" id="" v-model="select">
                <option disabled value="" selected="">First Select To Add Image</option>
                <option value="1">1 Image</option>
                <option value="2">2 Image</option>
                <option value="3">3 Image</option>
              </select>
            </div>
            <div>
              <input type="file" class="form-control" @change="addImage">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AddPartImages",
  data() {
    return {
      select:'',
      token:''
    }
  },
  beforeMount() {
    this.getToken()
  },
  methods:{

    getToken(){
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },

    addImage(e){
        let id = this.$route.params.part_id


        let formData = new FormData();
        formData.append('file', e.target.files[0]);

        const authAxios = this.axios.create({
          baseURL: 'http://narek.test/api/auth',
          headers: {
            Authorization: `Bearer ` + this.token,
            'content-type': 'multipart/form-data'
          }
        })

        authAxios.post('/addpartimages' + '/' + id + '/' + this.select, formData)
          .then((res) => {
            console.log(res)
          })
      }
    },

}
</script>

<style scoped>

</style>
