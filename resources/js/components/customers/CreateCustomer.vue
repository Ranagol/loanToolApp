<template>
    <div class="alert alert-dark my-content-page">
        
        <p class="alert alert-warning my-instructions">
            On this page you can write your new customers data into the database. The first step is to check if this
            customer is already in the database. Use the search field for this in the <a href="/customers">Customers</a>.
            If you already did this, and your customer has selected the tool that he wants to loan, you can go to to the
            <a href="/create-invoice">Create invoice</a>.
        </p>
        <h3>Create customer</h3>
        
        <p>Name: <input v-model="customer.name" name="name" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>City: <input v-model="customer.city" name="city" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Address: <input v-model="customer.address" name="address" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Phone: <input v-model="customer.phone" name="phone" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Comment: <input v-model="customer.comments" name="comments" class="form-control input-background" type="text"></p>

        <!-- <form>
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload customers scanned ID data:</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </form> -->

<!--         VALIDATION ERROR DISPLAYING PART -->
        <div
            v-if="errors.length > 0"
            class="alert alert-danger"
        >
            <div>Please correct the following error(s):</div>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>

        <button @click="addCustomer" class="btn btn-success">Create customer</button>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'CreateCustomer',
    computed: {
        ...mapGetters(['customers']),
    },
    data(){
        return {
            customer: {},
            errors: [],//here we collect all the errors
        }
    },
    methods: {
        ...mapActions(['createCustomer']),
        addCustomer(){
            this.checkForEmptyInputFields();
            if (this.errors.length === 0) {//the user can't submit data, if it is not valid
                this.$store.dispatch('createCustomer', this.customer);
                this.customer = {};
            }
        },

        validateInputText(event){//this is doing the validation work
            this.errors = [];//before validation, we empty the previous errors
            if  (event.target.value.length < 3) {//the variable must be a number + must be bigger than zero
                this.errors.push('The customers name, city, address, etc. ... all of them must be more than 3 characters.');//
            }
        },

        checkForEmptyInputFields(){
            if(_.isEmpty(this.customer)) {
                this.errors.push('You need to fill the input fields with customer data...');
            }
            if(_.isEmpty(this.customer.name)) {
                this.errors.push('Name must be filled.');
            }
            if(_.isEmpty(this.customer.city)) {
                this.errors.push('City must be filled.');
            }
            if(_.isEmpty(this.customer.address)) {
                this.errors.push('Address must be filled.');
            }
            if(_.isEmpty(this.customer.phone)) {
                this.errors.push('Phone number must be filled.');
            }
            this.errors = _.uniq(this.errors);//removes potential error mesage duplicates.
        }

    },
    
    
}
</script>