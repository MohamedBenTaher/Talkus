<template>
<div class="container mt-2"> 
    <div class="row md-auto my-5">
        <input type="text" class="form-control sm" placeholder="rechercher par nom ou numéro de telephone" v-model="search">
    </div>
    <div class="row">
        <div class="col-md-4" v-for="(user,index) in users.data" :key="index" v-if="search.trim()==='' || user.name.includes(search) || user.phone.includes(search)">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="user.image" alt="Card image cap" >
                <div class="card-body">
                    <h5 class="card-title">{{user.name}}</h5>
                    <p class="card-text">EMAIL: {{user.email}}</p>
                    <p class="card-text">TEL: {{user.phone}}</p>
                    <a class="btn btn-info" @click="redirect(user.id)">Voir Profil</a>
                    <a class="btn btn-success" @click="addContact(user.id,user.name)">Ajouter</a>
                </div>
            </div>
          <hr/>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            <pagination :data="users" @pagination-change-page="getUsers"></pagination>
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
            users:"",
            search:"",
            department_id:User.isLogged().department_id,
            user_id:User.isLogged().id
        }
    },
    created() {
        this.getUsers();
    },
    methods: {
        getUsers(page = 1){
            axios.get(`/api/users/${this.user_id}/${this.department_id}?page=${page}`)
                 .then(res => this.users = res.data)
                 .catch(err => console.error(err))
        },
        redirect(id) {
            this.$router.push('/users/'+id);
        },
        addContact(id,name){
            axios.post('/api/contacts/add',{
                user_id: this.user_id,
                contact_id: id
            })
            .then(res => {
                if(res.data.error){
                   return toastr.error(res.data.error);
                }
                else{
                    toastr.success("Vous pouvez le trouver parmis vos contact","Vous avez ajouter "+name.toUpperCase());
                    this.getUsers();
                }
            })
            .catch(err => console.error(err))
            
        }
    }
}
</script>