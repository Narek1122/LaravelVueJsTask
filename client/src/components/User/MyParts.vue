<template>
<div class="container">

  <div class="row">
    <PartsCatalog
    v-for="parts in getMyPartsData"
    :parts="parts"
    :key="parts.id"
    @deletePart="deletePart"
    @ChangeParts="ChangeParts"
    @changeMyPartsImage="changeMyPartsImage"

    >

    </PartsCatalog>
  </div>
</div>

</template>

<script>
import PartsCatalog from "./PartsCatalog";
export default {
  name: "MyParts",
  data() {
    return {
      token:'',
      myParts:'',
      inp:'',
      selected:'',
      PartImages:''
    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
    this.getToken(),
      this.getMyParts()
  },
  components:{
    PartsCatalog
  },
  computed:{
    getMyPartsData(){
      return this.$store.getters.getMyPartsData
    }
  },
  mounted() {

  },

  methods:{

    getToken(){
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },



    getMyParts(){
      const authAxios = this.axios.create({
        baseURL:'http://narek.test/api/auth',
        headers:{
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.get('/getmyparts')
        .then((res)=>{
          this.$store.commit('MyPartsData',res.data.part)
          localStorage.setItem('mypartsimages',JSON.stringify(res.data.partimages))

        })
    },

    deletePart(id){
      this.axios.delete(`http://narek.test/api/auth/deletemypart/${id}`)
        .then((res)=>{
          this.getMyParts()
        })

    },

    ChangeParts(id, partschnage){
      this.axios.post(`http://narek.test/api/auth/changemypart/${id}`,partschnage)
        .then((res)=>{
          this.getMyParts()
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
          this.getMyParts()
        })

    },
    filter(){
      let type = this.selected
      let inp = this.inp
      this.$store.commit('getMyParts', [...this.getMyPartsData].filter(function (part) {
        return part[type] == inp
      }))
    }

  }
}
</script>

<style scoped>

</style>
