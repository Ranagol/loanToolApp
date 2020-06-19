<template>
    <div>
        <h3>Create tool</h3>
        <p>Brand: <input v-model="tool.brand" name="brand" class="form-control" type="text"></p>
        <p>Model: <input v-model="tool.model" name="model" class="form-control" type="text"></p>
        <p>Description: <input v-model="tool.description" name="description" class="form-control" type="text"></p>
        <p>Serial number: <input v-model="tool.serial_number" name="serial_number" class="form-control" type="text"></p>
        <p>Price: <input v-model="tool.price" name="price" class="form-control" type="text"></p>
        <p>Picture url: <input v-model="tool.tool_picture_url" name="tool_picture_url" class="form-control" type="text"></p>
        <p>Comments: <input v-model="tool.comments" name="comments" class="form-control" type="text"></p>
        
        <button @click="addTool" class="btn btn-success">Create tool</button>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    name: 'CreateTool',
    computed: {
        ...mapGetters(['tools']),
    },
    data(){
        return {
            tool: {},
        }
    },
    methods: {
        ...mapActions(['createTool']),
        addTool(){
            this.$store.dispatch('createTool', this.tool);
        }
    },
    
    
}
</script>