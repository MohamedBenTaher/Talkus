<template>
<div>
    <div v-if="user.error">
      <center class="my-5" style="color:red"><h2>{{user.error}}<i class="fas fa-exclamation ml-2"></i></h2></center>
      <center><h6><router-link :to="home">retourner au page d'acceuil <i class="fas fa-external-link-alt"></i></router-link></h6></center>
  </div>
<div class="container" v-else>
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img :src="user.image" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{user.name}}</h4>
                      <p class="text-secondary mb-1">{{user.department.name}}</p>
                      <p class="text-muted font-size-sm">{{user.email}}</p>
                      <button class="btn btn-primary" v-if="this.$route.params.id != this.user.id">Follow</button>
                      <button class="btn btn-outline-primary" v-if="this.$route.params.id != this.user.id">Message</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{user.name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{user.email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{user.phone}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Emploi Professionnel</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      {{user.department.name}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
  data(){
    return{
      user:"",
      home:"/"
    }
  },
  created(){
    this.getUser();
  },
  methods:{
    getUser(){
      axios.get(`/api/users/${this.$route.params.id}`)
         .then(res => this.user = res.data)
         .catch(err => console.log(err))
    }
  }

}
</script>

<style>
body{
    margin-top:0px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
</style>