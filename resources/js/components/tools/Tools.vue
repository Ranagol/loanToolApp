<template>
    <div class="alert alert-dark">
        <p class="alert alert-warning mt-2 mb-2">
            On this page you can see the list of all your loan tools. Use the search field if you are looking for a specific tool.
        </p>
        <h3>Tools</h3>

        <!-- SEARCH FIELD -->
        <input v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search">

        <!-- If there is no data in the db... -->
        <div v-if="!tools.length" class="alert alert-info">
            <h5>Loading</h5>
        </div>

        <table class="table">
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Description</th>
                <th>SNR</th>
                <th>Price</th>
                <th>onStock</th>
            </tr>
            <tr v-for="(tool, i) in filteredTools" :key="i">
                <td>{{ tool.brand }}</td>
                <td>{{ tool.model }}</td>
                <td>{{ tool.description }}</td>
                <td>{{ tool.serial_number }}</td>
                <td>{{ tool.price }}</td>
                <td>{{ tool.onStock }}</td>
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
                return element.model.toLowerCase().match(this.searchTerm.toLowerCase());
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