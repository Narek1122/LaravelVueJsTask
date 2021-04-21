import Vue from 'vue'
import Vuex from "vuex";
import axios from "axios";
import VueAxios from "vue-axios";

Vue.use(Vuex);

export default new Vuex.Store({
  state:{
    parts:'',
    loginUser:'',
    adminData:'',
    adminAllParts:'',
    visitorSearch:'',
    PartUserDetails:'',
    MyPartsData:'',
    SearchMyPartsData:'',
    adminAllUsersData:''
  },
  getters:{
    getterAllParts(state){
      return state.parts
    },
    getMyPartsImage(){

    },
    getterLoginUser(state){
      return state.loginUser
    },
    getAdminUser(state){
      return state.adminData
    },
    GetAdminAllParts(state){
      return state.adminAllParts
    },
    getVisitorSearch(state){
      return state.visitorSearch
    },
    getPartUserDetails(state){
      return state.PartUserDetails
    },
    getMyPartsData(state){
      return state.MyPartsData
    },
    getSearchMyPartsData(state){
      return state.SearchMyPartsData
    },
    getAdminAllUsersData(state){
      return state.adminAllUsersData
    }
  },
  actions:{

  },
  mutations:{
    allparts(state,data){
      state.parts = data
    },
    loginUser(state,data){
      state.loginUser = data.data
    },
    adminUser(state,data){
      state.adminData = data
    },
    adminAllParts(state,data){
      state.adminAllParts = data
    },
    visitorSearch(state,data){
      state.visitorSearch = data
    },
    PartUserDetails(state,data){
      state.PartUserDetails = data
    },
    MyPartsData(state,data){
      state.MyPartsData = data
    },
    SearchMyPartsData(state,data){
      state.SearchMyPartsData = data
    },
    adminAllUsersData(state,data){
      state.adminAllUsersData = data
    }
    }


})
