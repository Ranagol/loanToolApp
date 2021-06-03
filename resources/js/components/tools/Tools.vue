<template>
    <div class="alert alert-dark my-content-page">
        <p class="alert alert-warning mt-2 mb-2 my-instructions">
            On this page you can see the list of all your loan tools. Use the search field if you are looking for a specific tool.
        </p>
        <hr>
        <div class="d-flex flex-row justify-content-between">
            <h3>Tools</h3>
            <router-link 
                class="nav-link btn btn-success" 
                to="/create-tool" 
            >Create new tool</router-link>
        </div>
        
        <br>

        <!-- SEARCH FIELD -->
        <input 
            v-model="searchTerm" 
            name="searchTerm" 
            class="form-control input-background" 
            type="search" 
            placeholder="Search by brand, model, description, serial number..."
        >
        <br>

        <!-- If there is no data in the db... -->
        <div v-if="!tools.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table table-text">
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Description</th>
                <th>Serial number</th>
                <th>Loan price/day</th>
                <!-- <th>onStock</th> -->
            </tr>
            <tr v-for="(tool, i) in filteredTools" :key="i">
                <td>{{ tool.brand }}</td>
                <td>{{ tool.model }}</td>
                <td>{{ tool.description }}</td>
                <td>{{ tool.serial_number }}</td>
                <td>{{ tool.price }}</td>
                <!-- <td>{{ tool.onStock }}</td> -->
            </tr>
        </table>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'Tools',
    data(){
        return {
            searchTerm: '',
        }
    },
    computed: {
        ...mapGetters(['tools']),
        filteredTools(){
            return this.tools.filter((element) => {
                return element.model.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.brand.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.description.toLowerCase().match(this.searchTerm.toLowerCase())
                    || element.serial_number.toLowerCase().match(this.searchTerm.toLowerCase())
                ;
            });
        }
    },
    methods: {
        ...mapActions(['getTools']),
    },
    mounted() {
        console.log('called from Tools'),
        this.getTools();
    }
}
</script>