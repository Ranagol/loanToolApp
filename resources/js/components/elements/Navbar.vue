<template>
  <nav class="navbar navbar-expand navbar-light bg-light">
    <a class="navbar-brand" href="#">LoanToolApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
        <li v-if="!userHasToken" class="nav-item">
          <router-link class="nav-link" to="/login" >Login</router-link>
        </li>

        <li v-if="!userHasToken" class="nav-item">
          <router-link class="nav-link" to="/register" >Register</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/home" >Home</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/create-customer" >Create customer</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/customers" >Customers</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/create-tool" >Create tool</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/tools" >Tools</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/create-invoice" >Create invoice</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/open-invoices" >Close invoice</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/invoices" >All invoices</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <router-link class="nav-link" to="/invoiceitems" >History</router-link>
        </li>

        <li v-if="userHasToken" class="nav-item">
          <a @click="logout" class="nav-link" href="#">Logout</a>
        </li>


      </ul>
    </div>
  </nav>
</template>


<script>
import { authService } from '../../service/authService';
import { EventBus } from '../../eventbus';
export default {
  name: 'Navbar',
  data() {
    return {
      userHasToken: false,
    }
  },
  methods: {
    logout(){
      authService.logout();
      this.userHasToken = false;
      this.$router.push('/login');
    }
  },
  created(){
    if (window.localStorage.getItem('loginToken') !==null && window.localStorage.getItem('loginToken') !=='') {
      this.userHasToken = true;
    } else {
      this.userHasToken = false;
    }
  },
  mounted(){
    EventBus.$on('loginSuccesfullyDone', () => {
      this.userHasToken = true;
    });
  },
  beforeDestroy() {//Losi advice
    EventBus.$off('loginSuccesfullyDone');
  }
  
  
}
</script>