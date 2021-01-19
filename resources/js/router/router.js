import Vue from 'vue';
import vueRouter from 'vue-router';
import Actualities from '../components/Actualities.vue';
import Login from '../components/Login.vue';
import Signin from '../components/Signin.vue';
import Contacts from '../components/Contacts.vue';
import User from '../components/User.vue';
import Messages from '../components/Messages.vue';


Vue.use(vueRouter);

const routes = [
    {
        path:'/',
        component:Actualities,
        name:'home' 
    },
    {
        path:'/login',
        component:Login,
        name:'login' 
    },
    {
        path:'/signin',
        component:Signin,
        name:'signin' 
    },
    {
        path:'/contacts',
        component:Contacts,
        name:'contacts' 
    },
    {
        path:'/users/:id',
        component:User,
        name:'user' 
    },
    {
        path:'/messages',
        component:Messages,
        name:'Messages'
    }
]

const router = new vueRouter({
    routes:routes,
    mode:'history'
})

export default router;