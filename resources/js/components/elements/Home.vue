<template>
    <div>
        <h3>Home</h3>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    name: 'Welcome',
    methods: {
        ...mapActions(['getCustomers']),
    },
    created(){
        this.getCustomers();
    }
}
</script>