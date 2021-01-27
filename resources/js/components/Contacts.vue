<template>
  <div>
      <p>
          Liste de Mes Contacts
      </p>
  </div>
</template>

<script>
export default {

  data() {
    return {
      contacts = '' 
    }


  } 
  created(){
    axios.get('http://localhost:8000/api/contacts/'+User.islogged().id)
    .then(response => 
    console.log(response.data)

    )
    .catch(err => 
    console.log(err)
    )
  }
}
</script>