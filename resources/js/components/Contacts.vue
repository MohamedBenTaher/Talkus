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
            <img class="card-img-top" :src="contact.image" alt="Card image cap" style="height:20vw">
              <div class="card-body">
                <h5 class="card-title">{{contact.name}}</h5>
                <p class="card-text">EMAIL: {{contact.email}}</p>
                <p class="card-text">TEL: {{contact.phone}}</p>
                <p class="card-text">TEL: {{contact.department}}</p>
                <a class="btn btn-info" @click="redirect(contact.id)">Voir Profil</a>
                <a class="btn btn-outline-danger" @click="removeContact(contact.id,contact.name)">supprimer</a>
              </div>
          </div>
          <hr/>
      </div>
  </div>
  </div>        
</template>

<script>
import toastr from 'toastr';
import 'toastr/build/toastr.css';
export default {

  data() {
    return {
      contacts : '' ,
      error: '',
      search:"",
      user:User.isLogged().id
    }


  },
  created(){
      this.getContacts();
  },
  methods: {

    redirect(id) {
      this.$router.push('/users/'+id);
      //this.$router.go();
    },

    getContacts(){
      axios.get('http://localhost:8000/api/contacts/'+User.isLogged().id)
           .then(response =>{ 
              if(response.data.error) {
                  this.error=response.data.error ;
              }
              else {
                  this.contacts=response.data;
              }
          } 
        )
        .catch(err =>console.log(err))
    },

    removeContact(id,name){
        if(confirm("Voulez vous supprimer "+name.toUpperCase()+" de votre contacts ?")){
          axios.delete('http://localhost:8000/api/contacts/delete',{data:{user_id: this.user , contact_id: id}})
               .then(res => {
                 if(res.data.error){
                    return toastr.error(res.data.error)
                 }
                 else{
                     this.getContacts();
                     toastr.error(`${name.toUpperCase()} a été supprimer de votre liste de contacts`)
                 }
               })
               .catch(err => console.error(err))
        }
    }
  },
}
</script>