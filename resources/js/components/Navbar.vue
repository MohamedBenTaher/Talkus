<template>
     <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <router-link class="navbar-brand" :to="home">Talkus</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <router-link class="nav-link" :to="home">Actualities</router-link>
      </li>
      <li class="nav-item active">
        <router-link class="nav-link" :to="signup">Signup</router-link>
      </li>
      <li class="nav-item active">
        <router-link class="nav-link" :to="login">Login</router-link>
      </li>
      <li class="nav-item active ml-1">
        <router-link class="nav-link" :to="contacts">My Contacts</router-link>
      </li>
      <li class="nav-item active ml-1">
        <router-link class="nav-link" :to="messages">My Messages</router-link>
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
            messages:'/messages'
        }
    },

}
</script>