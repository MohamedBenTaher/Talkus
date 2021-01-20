<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card shadow">
                    <div class="body-header mx-auto mt-3"><strong>Inscription</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <input v-model="name" type="text" placeholder="Nom Complet..." required class="form-control my-1">
                            <input v-model="email" type="email" placeholder="email valide..." required class="form-control my-1">
                            <input v-model="password" id="password" type="password" placeholder="mot de passe" required class="form-control my-1">
                            <p style="cursor:pointer;color:blue;float:right" @click="showAndHidden">show password</p>
                            <p id="err" style="color:red"></p>
                            <center class="pt-2"><button class="btn btn-block btn-primary" @click="inscription">S'inscrire</button></center>
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
            name:'',
            email:'',
            password:'',
        }
    },
    mounted(){
        if(User.isLogged()){
            this.$router.push({name:'home'});
        }
    },
    methods:{
        showAndHidden(){
            if(document.querySelector('p').innerHTML=="show password"){
                document.getElementById('password').type="text"
                document.querySelector('p').innerHTML="hide password"
            }else{
                document.getElementById('password').type="password"
                document.querySelector('p').innerHTML="show password"                
            }
        },
        inscription(){
            if(!this.name || !this.password || !this.email){
                let err = document.getElementById('err');
                err.innerHTML = "Veulliez remplir tous les champs necessaire."
                return;
            }
            axios.post('/api/users/signup',{name:this.name,email:this.email,password:this.password})
                 .then(res => {
                     console.log(res.data);
                     User.storeUser(JSON.stringify(res.data));
                     this.$router.push('/')
                     this.refresh()
                 })
                 .catch(err => console.log(err))
        },
        refresh(){
            this.$router.go();
        }
    }
}
</script>
