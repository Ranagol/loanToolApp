<template>
  <form @submit.prevent="register">
    <h3>Register</h3>

    <!-- VALIDATION ERRORS-->
    <div class="alert alert-danger" v-for="(validationError, fieldName) in validationErrors" :key="`validation-errors-${fieldName}`">
      {{ `${fieldName}: ${validationError[0]}` }}
    </div>

    <!-- Loading displaying -->
    <h3 v-if="loading" class="alert alert-warning">
      Loading...
    </h3>

    <div class="form-group">
      <label for="first_name">First name</label>
      <input v-model="first_name" type="text" name="first_name" class="form-control" id="first_name" required>
    </div>

    <div class="form-group">
      <label for="last_name">Last name</label>
      <input v-model="last_name"  type="text" name="last_name"  class="form-control" id="last_name" required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input v-model="email"  type="email"  name="email"  class="form-control" id="email" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input v-model="password"  type="password" name="password"  class="form-control" id="password" required>
    </div>

    <div class="form-group">
      <label for="password_confirmation">Password confirmation</label>
      <input v-model="password_confirmation"  type="password_confirmation"  name="password_confirmation"  class="form-control" id="password_confirmation" required>
    </div>


    <div class="form-group form-check">
      <input type="checkbox" class="form-check-input" id="terms" required>
      <label class="form-check-label"  name="terms"  for="terms">Accepted terms and conditions</label>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>

  </form>
</template>

<script>
import { mapActions } from 'vuex';
import { authService } from '../../service/authService';
export default {
  name: 'Register',
  data(){
    return{
      first_name:'',
      last_name: '',
      email: '',
      password: '',
      password_confirmation: '',
      validationErrors: {},
      loading: false,
    }
  },
  methods: {
    ...mapActions(['setLoggedIn']),
    register(){
      this.loading = true;
      authService.register(this.first_name, this.last_name, this.email, this.password, this.password_confirmation)
      .then(() => {
        this.setLoggedIn();
        this.loading = false;
        this.$router.push('/');
        
      })
      .catch((error) => {
        console.dir(error);
        if (error.response && error.response.status === 422) {
          this.validationErrors = Object.assign({}, {}, error.response.data.errors);
        } else {
          console.dir(error);
        }
        this.loading = false;
      });
    }
  }
}
</script>