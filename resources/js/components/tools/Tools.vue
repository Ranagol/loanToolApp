<template>
    <div>
        <h3>Tools</h3>

        <!-- SEARCH FIELD -->
        <input @input="getTools" v-model="searchTerm" name="searchTerm" class="form-control" type="search" placeholder="Search" aria-label="Search">

        <table class="table">
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Description</th>
                <th>SNR</th>
                <th>Price</th>
                <th>onStock</th>
            </tr>
            <tr v-for="(tool, i) in tools" :key="i">
                <td>{{ tool.brand }}</td>
                <td>{{ tool.model }}</td>
                <td>{{ tool.description }}</td>
                <td>{{ tool.serial_number }}</td>
                <td>{{ tool.price_for_24h }}</td>
                <td>{{ tool.onStock }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
import toolService from '../../service/toolService';
export default {
    name: 'Tools',
    data(){
        return {
            searchTerm: '',
            tools: [],
            selected: {},
        }
    },
    methods: {
        async getTools(){
            try {
                const response = await toolService.getTools(this.searchTerm);
                this.tools = response.data;
                console.dir(this.tools);
            } catch (error) {
                console.dir(error);
            }
        },
    },
    
    created(){
        this.getTools();
    }
}
</script>