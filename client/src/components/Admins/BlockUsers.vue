<template>
<div class="row">
  <BlockUserComponent
    v-for="users in getAdminAllUsersData"
    :users="users"
    @blockUser="blockUser"
  >

  </BlockUserComponent>
</div>
</template>

<script>
import BlockUserComponent from "./BlockUserComponent";

export default {
name: "BlockUsers",
  components:{
    BlockUserComponent
  },
  data() {
    return {

    }
  },
  mounted() {
  this.getAllUsersData()
  },
  computed:{
    getAdminAllUsersData(){
     return this.$store.getters.getAdminAllUsersData.data
    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1492551557933-34265f7af79e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  methods:{

    getAllUsersData(){
      this.axios.post('http://narek.test/api/auth/admingetallusers')
        .then((res)=>{
          this.$store.commit('adminAllUsersData',res)

        })

    },
    blockUser(id){

      let data = {
        id:id,

      }

      this.axios.post('http://narek.test/api/auth/blockuser',data)
        .then((res)=>{
          this.getAllUsersData()
        })
    }
  }
}
</script>

<style scoped>

</style>
