<template>
    <div class="container" v-if="error">
      <h3>{{error}}</h3>
      </div>
      <div class="container mt-2" v-else > 
        <div class="row md-auto my-5">
          <input type="text" class="form-control sm" placeholder="rechercher par nom ou numéro de telephone" v-model="search">
        </div>
      <div class="row">
        <div class="col-md-4" v-for="(contact,index) in contacts" :key="index" v-if="search.trim()==='' || contact.name.includes(search) || contact.phone.includes(search)">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" :src="contact.image" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">{{contact.name}}</h5>
                <p class="card-text">EMAIL: {{contact.email}}</p>
                <p class="card-text">TEL: {{contact.phone}}</p>
                <a class="btn btn-info" @click="redirect(contact.id)">Voir Profil</a>
              </div>
          </div>
          <hr/>
      </div>
  </div>
  </div>        
</template>

<script>
export default {

  data() {
    return {
      contacts : '' ,
      error: '',
      search:""
    }


  },
  created(){
    axios.get('http://localhost:8000/api/contacts/'+User.isLogged().id)
    .then(response =>{ 
     if(response.data.error) {
       this.error=response.data.error ;
     }
     else {
       this.contacts=response.data;
     }
     //console.log(this.error);
    } 
    )
    .catch(err => 
    console.log(err)
    )
  },
  methods: {
    redirect(id) {
      this.$router.push('/users/'+id);
      //this.$router.go();
    }
  },
}
</script>