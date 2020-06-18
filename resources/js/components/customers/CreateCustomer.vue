<template>
    <div>
        <h3>Create customer</h3>
        <p>Name: <input v-model="customer.name" name="name" class="form-control" type="text"></p>
        <p>City: <input v-model="customer.city" name="city" class="form-control" type="text"></p>
        <p>Address: <input v-model="customer.address" name="address" class="form-control" type="text"></p>
        <p>Phone: <input v-model="customer.phone" name="phone" class="form-control" type="text"></p>
        <p>Comment: <input v-model="customer.comments" name="comments" class="form-control" type="text"></p>
        <form>
            <div class="form-group">
                <label for="exampleFormControlFile1">Upload ID data:</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>
        </form>
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
        }
    },
    methods: {
        ...mapActions(['createCustomer']),
        addCustomer(){
            this.$store.dispatch('createCustomer', this.customer);
        }
    },
    
    
}
</script>