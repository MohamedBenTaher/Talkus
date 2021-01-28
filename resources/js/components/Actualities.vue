<template>

  <div class="container ">
    <div class="row my-4">
      <div class="col md-8 "></div>
      <div class="card">
        <div class="card-header">Posts</div>
      <h1>posts</h1>
        <div class="card-body" v-for="(post,index) in posts.data"
        :key="index">
        <div class="media">
          <div class="media-body">
            <h3>{{post.title}}</h3>

          </div>
          <div class="lead">{{post.content}}</div>
        </div>
        <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: post.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
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
                posts: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/posts')
                .then(response => {
                    this.posts = response.data;
                });
        },
        methods: {
            deletePost(id) {
                this.axios
                    .delete(`http://localhost:8000/api/post/delete/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); // find index of your object
                        this.posts.splice(i, 1)
                    });
            }
        }
    }     


 

</script>