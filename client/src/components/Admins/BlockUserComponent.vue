<template>
  <div class="card" style="width: 18rem;">

    <div class="card-body">
      <h5 class="card-title">{{ users.email }}</h5>
      <h5 class="card-title">{{ users.name }}</h5>
      <h5 class="card-title">{{ users.phone }}</h5>
      <img :src="this.checkAvatar()" alt="" class="card-img-top"
           width="50%">
      <button @click="blockUser(users.id)" class="btn btn btn-warning mt-1">
        <h4 v-if="users.isBlocked ? userunblock='Unblock User' : userunblock='Block User' ">{{ userunblock }}</h4>
      </button>
    </div>
  </div>
</template>

<script>
export default {
name: "BlockUserComponent",
  data() {
    return {
      userunblock: 'false'
    }
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1492551557933-34265f7af79e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  props: {
    users: {
      type: Object, default: () => {
      },
    }
    },
  methods:{
    blockUser(id) {
      this.$emit("blockUser", id);
      console.log(444)
    },
    checkAvatar(){
      return this.users.avatar ? 'http://narek.test/api/auth/get_profile_image/' + this.users.avatar : 'http://narek.test/api/auth/get_profile_image/null_profile_image.png'
    }
  }

}
</script>

<style scoped>

</style>
