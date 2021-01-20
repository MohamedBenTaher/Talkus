<template>
    <div class="container">
        <div class="row mt-3">
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
                            <center class="pt-2"><button class="btn btn-block btn-primary">S'inscrire</button></center>
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
    methods:{
        showAndHidden(){
            if(document.querySelector('p').innerHTML=="show password"){
                document.getElementById('password').type="text"
                document.querySelector('p').innerHTML="hide password"
            }else{
                document.getElementById('password').type="password"
                document.querySelector('p').innerHTML="show password"                
            }
        }
    }
}
</script>
