<template>
  
     
  <div class="album py-5 bg-light">
    <div class="container" v-if="error">
      <h3>{{error}}</h3>
      </div>
      <div class="container" v-else>     
    
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"  
        
       <div class="col" v-for="(contact,index) in contacts" 
       :key="index" >
      
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>

            <div class="card-body">
              <p class="card-text">{{contact[0].name}}</p>
         
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" @click="redirect(contact[0].id)" >View</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                </div>
                <small class="text-muted">9 mins</small>
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

  data() {
    return {
      contacts : '' ,
      error: ''
    }


  },
  created(){
    axios.get('http://localhost:8000/api/contacts/'+User.isLogged().id)
    .then(response =>{ 
     if(response.data.error) {
       this.error=response.data.error ;
     }
     else {
       this.contacts=response.data.users;
     }
     console.log(this.error);
    } 
    )
    .catch(err => 
    console.log(err)
    )
  },
  methods: {
    redirect(id) {
      this.$router.push('/users/'+id);
      this.$router.go();
    }
  },
}
</script>