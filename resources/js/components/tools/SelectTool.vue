<template>
    <div>
        <p>Select a tool:
            <v-select multiple v-model="selectedTool" label="model" :options="tools"></v-select>
        </p>
    </div>
</template>

<script>
import vSelect from 'vue-select';
import { EventBus } from '../../eventbus';
export default {
    name: 'SelectTool',
    components:{
        vSelect,
    },
    data(){
        return {
            selectedTool: '',

        }
    },
    props: {
        tools: {//this component is receiving all the tool options from the parent
            type: Array,
            required:true,
            default: function(){
                return [];
            }
        },
        
    },
    watch: {
        selectedTool:function(){//we are watching the selectedTool, because as soon the user has selected a tool, the value of the this.selectedTool will change from an empty {} to a real tool object. When this happens, we want to send this tool object to the parent component.
            console.log('You just choose a new tool.');
            this.$emit('toolSelected', this.selectedTool);
        }
    },
    created(){
        EventBus.$on('invoiceCreated', () => {
            this.selectedTool = '';//once the invoice was created, the parent will send an invoiceCreated event, and then we empty the selectedTool.
        })
    }
    
}
</script>