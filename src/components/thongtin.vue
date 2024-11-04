<script setup>
import { ref } from 'vue';

defineProps({
  mssv: {
    type: String,
    required: true
  },
  name: {
    type: String,
    required: true
  },
  age: {
    type: String,
  },
  lop: {
    type: String,
    required: true
  },
  hobby: {
    type: String,
    required: true
  },
  Strengths: {
    type: String,
    required: true
  },
  weakness: {
    type: String,
    required: true
  }
 
})
let avatar = ref('https://tse4.mm.bing.net/th?id=OIP.JwZL4zWedwMx65S7N6oEOwHaKi&pid=Api&P=0&h=220')
let Status = ref('loading........');
const changeStatus = () => { 
  let newStatus = prompt('edit status');
 if(newStatus !=""){
  Status.value = newStatus
 }
}

const changeAvatar = () => {
  let newAvatar = prompt('edit avatar');
 if(newAvatar != null){
  avatar.value = newAvatar
 }
}
</script>

<template>
 <div class="container">
  
  <div class="card">
    <div class="card-body">
      <div class="title">Thông tin</div>
  <div class="card">
    <div class="card-body">
      <img @click="changeAvatar" :src="avatar" class="card-img-top" alt="avatar">
      <h5 class="card-title">{{ name }}</h5>
      <p class="card-text">{{ Status }}</p>
      <button @click="changeStatus" type="button" class="btn btn-primary mt-5 mb-5">EDIT</button>
      <p class="card-text">{{hobby}}</p>
    </div>
  </div>
 </div>
 </div>
 </div>
</template>

<style scoped>
.contaienr{
 margin-top: 100px;
}
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

ul{
  /* display: flex; */
}
li{
  font-family: 'Courier New', Courier, monospace;
  margin: 20px 10px;
  /* list-style: none; */
  cursor: pointer;
  font-size: 25px;
  font-weight: 600;
}
li:hover{
  color: red;
  cursor: pointer;
}
h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>
