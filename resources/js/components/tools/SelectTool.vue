<template>
    <div>
        <h4>SelectTool</h4>
        <v-select  v-model="selectedTool" label="model" :options="tools"></v-select>
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
        tools: {
            type: Array,
            required:true,
            default: function(){
                return [];
            }
        }
        
    },
    watch: {
        selectedTool:function(){//we are watching the selectedTool, because as soon the user has selected a tool, the value of the this.selectedTool will change from an empty {} to a real tool object. When this happens, we want to send this tool object to the parent component.
            console.log('You just choose a new tool.');
            this.$emit('toolSelected', this.selectedTool);
        }
    }
}
</script>