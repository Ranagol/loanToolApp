<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">LoanToolApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        
        <li class="nav-item">
          <router-link class="nav-link" to="/login" >Login</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to="/register" >Register</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to="/customers" >Customers</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" to="/tools" >Tools</router-link>
        </li>

        <li class="nav-item">
          <a @click="logout" class="nav-link" href="#">Logout</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</template>


<script>
import { authService } from '../service/authService';
export default {
  name: 'Navbar',
  methods: {
    logout(){
      authService.logout();
      this.$router.push('/login');
    }
  }
}
</script>