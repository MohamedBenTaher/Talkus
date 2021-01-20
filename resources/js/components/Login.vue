<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card shadow">
                    <div class="body-header mx-auto mt-3"><strong>Se connecter</strong></div>
                    <div class="card-body">
                      <form>
                        <div class="form-group">
                            <input v-model="email" type="email" placeholder="email valide..." required class="form-control my-1">
                            <input v-model="password" id="password" type="password" placeholder="mot de passe" required class="form-control my-1">
                            <p style="cursor:pointer;color:blue;float:right" @click="showAndHidden">show password</p>
                            <p id="err" style="color:red" ></p>
                            <center class="pt-2"><button class="btn btn-block btn-primary" @click="login">Connection</button></center>
                            <small class="mt-2" style="float:right">Vous n'etes pas encore inscrit ? 
                              <router-link style="text-decoration: underline" :to="signup">s'inscrire</router-link>
                            </small>
                        </div>
                      </form>
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
            email:'',
            password:'',
            signup:'/signup'
        }
    },
    /*mounted(){
        if(User.isLogged()){
            this.$router.push({name:'home'});
        }
    },*/
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
        login(e){
            e.preventDefault();
            if(!this.password || !this.email){
                let err = document.getElementById('err');
                err.innerHTML = "Veulliez remplir tous les champs necessaire."
                return;
            }
            axios.post('/api/users/login',{email:this.email,password:this.password})
                 .then(res => {
                     console.log(res.data);
                     this.err='';
                     if(!res.data.error){
                       User.storeUser(JSON.stringify(res.data));
                       this.$router.push('/');
                       this.refresh();
                     }
                     else{
                      let err = document.getElementById('err');
                      err.innerHTML = res.data.error
                     }
                 })
                 .catch(err => console.log(err))
        },
        refresh(){
            this.$router.go();
        }
    }
}
</script>
