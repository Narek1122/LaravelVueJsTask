<template>
  <div class="container ">
    <div class="d-flex justify-content-center h-100 mt-5" >
      <div class="user_card">
        <div class="d-flex justify-content-center">
          <h1 style="color: whitesmoke">LOGIN</h1>
        </div>
        <div class="d-flex justify-content-center form_container">
          <form>
            <div class="input-group mb-3">
              <div class="input-group-append">
                <span class="input-group-text logo"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" name="" class="form-control input_user" value="" placeholder="Email" spellcheck="false"
                     v-model="email">
              <small v-if="!$v.email.required" class="alert alert-danger" role="alert">Email is not required</small>
              <small v-if="!$v.email.email" class="alert alert-danger" role="alert">Email is invalid</small>
            </div>
            <div class="input-group mb-2">
              <div class="input-group-append">
                <span class="input-group-text logo"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="" class="form-control input_pass" value=""
                     placeholder="password" spellcheck="false" v-model="password">
              <small v-if="!$v.password.required" class="alert alert-danger" role="alert">Password is not
                required</small>
              <small v-if="!$v.password.minLength" class="alert alert-danger" role="alert">Password must be 6
                characters</small>
            </div>
            <div class="d-flex justify-content-center mt-3 login_container">
              <button type="button" name="button" class="btn login_btn" @click="login">Login</button>
            </div>
          </form>
        </div>


      </div>
    </div>
  </div>

</template>

<script>
import {required, email, minLength} from 'vuelidate/lib/validators'

export default {
  name: "Login",
  data() {
    return {

      email: '',
      password: ''

    }
  },
  validations: {
    email: {required, email},
    password: {required, minLength: minLength(4)}
  },
  beforeMount() {
    document.body.style.backgroundImage = "url('https://images.unsplash.com/photo-1509822929063-6b6cfc9b42f2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"
    document.body.style.backgroundSize = 'cover'
  },
  methods: {
    login() {
      let users = {
        email: this.email,
        password: this.password
      }
      if (this.$v.password.minLength && this.$v.password.required && this.$v.email.required && this.$v.email.email) {
        this.axios.post('http://narek.test/api/auth/login', users)
          .then((res) => {
            const token = res.data.access_token;
            const user = res.data.user;
            localStorage.setItem("token", JSON.stringify(token));
            this.$router.push({name: "Profile"})
          })

      }


    }
  }
}
</script>

<style scoped>
* {

}

*::selection {
  background-color: #2b71c05b;
}


body, html {
  margin: 0;
  padding: 0;
  height: 100%;
  background: #353535 !important;
  overflow-x: hidden;
  min-height: 100%;
  user-select: none;
}

.user_card {
  height: 500px;
  width: 450px;
  margin-top: auto;
  margin-bottom: auto;
  position: relative;
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding: 10px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-radius: 5px;

}

/*  */
.brand_logo {
  height: 150px;
  width: 150px;
  border-radius: 50%;
  border: 2px solid white;
}

.form_container {
  margin-top: 30px;
}

h1 {
  font-weight: bold;
  font-size: 43px;
}

.logo {
  width: 40px;
}

.login_btn {
  width: 100%;
  background: #2b71c0 !important;
  color: white !important;
}

.login_btn:hover {
  background: #2b71c0 !important;
  color: white !important;
  box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  -webkit-box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  -moz-box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

}

.login_btn:active {
  width: 100%;
  background: #353535 !important;
  color: white !important;
}

.login_btn:focus {
  box-shadow: none !important;
  outline: 0px !important;
}

.input-group-text {
  background: #2b71c0 !important;
  color: white !important;
  border: 0 !important;
  border-radius: 0.25rem 0 0 0.25rem !important;
}

.input_user,
.input_pass:focus {
  box-shadow: none !important;
  outline: 0px !important;
}


.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
  background-color: #2b71c0 !important;
}

.groupe-liens {
  margin-top: 15px;
}

.liens {
  color: #2865aa;
}

.liens:hover {
  color: #353535;
}

</style>
