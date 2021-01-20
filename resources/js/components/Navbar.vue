<template>
     <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <router-link class="navbar-brand" :to="home" v-if="logged">Talkus</router-link>
  <router-link class="navbar-brand" :to="login" v-else>Talkus</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <router-link class="nav-link" :to="home" v-if="logged">Actualities</router-link>
      </li>
      <li class="nav-item active">
        <router-link class="nav-link" :to="signup" v-if="!logged">Signup</router-link>
      </li>
      <li class="nav-item active">
        <router-link class="nav-link" :to="login" v-if="!logged">Login</router-link>
      </li>
      <li class="nav-item active ml-1">
        <router-link class="nav-link" :to="contacts" v-if="logged">My Contacts</router-link>
      </li>
      <li class="nav-item active ml-1">
        <router-link class="nav-link" :to="messages" v-if="logged">My Messages</router-link>
      </li>
    <!--  <li class="nav-item active mr-1">
        <router-link class="nav-link" :to="messages" v-if="logged">{{user_name.toUpperCase()}} </router-link>
      </li>
      <li class="nav-item active my-2 my-lg-0" style="float:right">
        <a class="nav-link" style="cursor:pointer" v-if="logged" @click="userLogout" >Deconnexion</a>
      </li> -->
      <li class="nav-item dropdown" v-if="logged">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{user_name.toUpperCase()}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#"><i class="fas fa-user mr-1"></i> Profile</a>
          <a class="dropdown-item" style="cursor:pointer" @click="userLogout"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
</template>


<script>
export default {
 data(){
        return{
            home:'/',
            signup:'/signup',
            login:'/login',
            contacts:'/contacts',
            messages:'/messages',
            logged:User.isLogged().logged,
            user_name:User.isLogged().name,
            isAdmin: User.isAdmin()
        }
  },

  methods:{
      userLogout(){
        User.logout();
        this.logged = false;
        console.log(this.logged)
        this.$router.push({name:'login'});
        this.$router.go();
      }
  }
}
</script>