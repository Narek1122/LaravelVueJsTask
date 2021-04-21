<template>
<div class="d-flex justify-content-center ">
  <div class="container">
    <div class="row main">
      <div class="panel-heading">
        <div class="panel-title text-center">
          <h1 class="title">User Setting</h1>
          <hr />
        </div>
      </div>
      <div class="main-login main-center">
        <form class="form-horizontal" method="post" action="#">

          <div class="form-group">
            <label for="name" class="cols-sm-2 control-label">Your Name</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                <input v-model="users.name" type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name">
              </div>
            </div>
          </div>



          <div class="form-group">
            <label  class="cols-sm-2 control-label">Phone Number</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                <input v-model="users.phone" type="text" class="form-control" name="username"   placeholder="Enter your Phone"/>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label  class="cols-sm-2 control-label">Address</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                <input v-model="users.address" type="text" class="form-control" name="address"   placeholder="Enter your Address"/>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="cols-sm-2 control-label">Password</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                <input v-model="users.password" type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
              </div>
            </div>
          </div>



          <div class="form-group ">
            <button type="button" class="btn btn-primary btn-lg btn-block login-button" @click="change">Change Data</button>
          </div>

        </form>
        <div class="card">
          <div class="card-body">
            <label for="">Change Image</label>
            <input type="file" class="form-control" @change="updateImage">
          </div>
        </div>
      </div>
    </div>

  </div>
<div>
  <label for="">imag</label>
  <input type="file" @change="nn">
</div>
</div>
</template>

<script>
export default {
  name: "Settings",
  data() {
    return {
      users:{
        name:'',
        password:'',
        address:'',
        phone:''
      },
      token:''
    }
  },
  mounted() {
    this.getToken()
    console.log(this.token)
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  methods:{
    change(){
      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token
        }
      })

      authAxios.post('/usersettings', this.users)
        .then((res) => {
          console.log(res)
          this.$router.push({name: "Profile"});
        })
    },
    getToken() {
      let token = localStorage.getItem('token')
      token = JSON.parse(token)
      this.token = token
    },
    updateImage(e){

      let formData = new FormData();
      formData.append('file', e.target.files[0]);

      const authAxios = this.axios.create({
        baseURL: 'http://narek.test/api/auth',
        headers: {
          Authorization: `Bearer ` + this.token,
         'content-type': 'multipart/form-data'
        }
      })

      authAxios.post('/userupdateimage', formData)
        .then((res) => {
          this.$router.push({name: "Profile"});
        })
    },


  }
}
</script>

<style scoped>
.main{
  margin-top: 70px;
}

h1.title {
  font-size: 50px;
  font-family: 'Passion One', cursive;
  font-weight: 400;
}

hr{
  width: 10%;
  color: #fff;
}

.form-group{
  margin-bottom: 15px;
}

label{
  margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
  font-size: 11px;
  padding-top: 3px;
}

.main-login{
  background-color: #fff;
  /* shadows and rounded borders */
  -moz-border-radius: 2px;
  -webkit-border-radius: 2px;
  border-radius: 2px;
  -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
  margin-top: 30px;
  margin: 0 auto;
  max-width: 330px;
  padding: 40px 40px;

}

.login-button{
  margin-top: 5px;
}

.login-register{
  font-size: 11px;
  text-align: center;
}

</style>
