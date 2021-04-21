<template>
<div>
  <div class="container">
    <br/>
    <div class="row justify-content-center">
      <div class="col-12 col-md-10 col-lg-8">
        <form class="card card-sm">
          <div class="card-body row no-gutters align-items-center">
            <div class="col-auto">
              <i class="fas fa-search h4 text-body"></i>
            </div>
            <div class="col">
              <select name="" id="" v-model="select" class="form-select" aria-label="Default select example">
                <option value="name">Name</option>
                <option value="partnumber">Part number</option>
              </select>
              <input v-model="inp" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords">
            </div>
            <div class="col-auto">
              <button class="btn btn-lg btn-success" type="submit" @click="GetSearchData">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div v-if="getSearchMyPartsData">
    <div class="row">
      <PartsCatalog
        v-for="part in getSearchMyPartsData"
        :parts="part"
        :key="part.id"
        @deletePart="deletePart"
        @ChangeParts="ChangeParts"
        @changeMyPartsImage="changeMyPartsImage"
      ></PartsCatalog>
    </div>
  </div>
</div>
</template>

<script>
import PartsCatalog from "./PartsCatalog";
export default {
name: "Search",
  data() {
    return {
      inp:'',
      select:'',
      token:''
    }
  },
  components:{
    PartsCatalog
  },
  mounted(){
  this.getToken()
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  computed:{
    getSearchMyPartsData(){
      return this.$store.getters.getSearchMyPartsData.data
    }
  },
  methods:{
    getToken() {
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },
    GetSearchData(){
      let data ={
        inp:this.inp,
        select:this.select
      }
      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.post('/searchmypartsselected', data)
        .then((res) => {
          console.log(res)
          this.$store.commit('SearchMyPartsData',res)
        })

    },
    deletePart(id){
      this.axios.delete(`http://narek.test/api/auth/deletemypart/${id}`)
        .then((res)=>{
          this.GetSearchData()
        })

    },

    ChangeParts(id, partschnage){
      this.axios.post(`http://narek.test/api/auth/changemypart/${id}`,partschnage)
        .then((res)=>{
          this.GetSearchData()
        })
    },

    changeMyPartsImage(e,id){
      const config = {
        headers: {'content-type': 'multipart/form-data'}
      }

      let formData = new FormData();
      formData.append('file', e.target.files[0]);

      this.axios.post(`http://narek.test/api/auth/changemypartimage/${id}`, formData, config)
        .then((res) => {
          this.GetSearchData()
        })

    }

    }

}
</script>

<style scoped>

</style>
