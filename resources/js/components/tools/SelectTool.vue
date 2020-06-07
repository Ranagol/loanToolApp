<template>
    <div>
        <h4>SelectTool</h4>
        <p>Selected tool: {{ selectedTool }}</p>

        <hr>
    </div>
</template>

<script>
export default {
    name: 'SelectTool',
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
        
    }
}
</script>