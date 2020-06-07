<template>
    <div>
        <h4>SelectTool</h4>
        <v-select  v-model="selectedTool" label="model" :options="toolsFromDb"></v-select>
        <!-- TODO there are a lot of warnings here, would be good to check... -->
        <p>Selected tool: {{ selectedTool }}</p>

        <hr>
    </div>
</template>

<script>
import vSelect from 'vue-select';
export default {
    name: 'SelectTool',
    components:{
        vSelect,
    },
    data(){
        return {
            selectedTool: {},

        }
    },
    props: {
        toolsFromDb: {
            type: Array,
            required:true,
            default: function(){
                return [];
            }
        }
        
    },
    watch: {
        selectedTool:function(){
            console.log('You just choose a new tool.');
            this.$emit('toolSelected', this.selectedTool);
        }
    }
}
</script>