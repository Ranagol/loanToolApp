<template>
    <div class="alert alert-dark my-content-page">
        <p class="alert alert-warning mt-2 mb-2 my-instructions">
            If you add a new loan tool to your already existing fleet of loan tools, this is the place where you can write the new loan
            tools data into the database. Once you created your new tool with the click on the 'Create tool' button, you can check
            if this newly created tool has appeared on the <a href="/tools">Tools</a> page, which contains all the loan tools in your shop.
        </p>
        <h3>Create tool</h3>
        
        <p>Brand: <input v-model="tool.brand" name="brand" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Model: <input v-model="tool.model" name="model" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Description: <input v-model="tool.description" name="description" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Serial number: <input v-model="tool.serial_number" name="serial_number" class="form-control input-background" type="text" @input="validateInputText"></p>
        <p>Price: <input v-model="tool.price" name="price" class="form-control input-background" type="text" @input="validateForPositiveNumbers"></p>
        <p>Picture url: <input v-model="tool.tool_picture_url" name="tool_picture_url" class="form-control input-background" type="text"></p>
        <p>Comments: <input v-model="tool.comments" name="comments" class="form-control input-background" type="text"></p>
        
<!--         VALIDATION ERROR DISPLAYING PART -->
        <div
            v-if="errorsFrontend.length > 0"
            class="alert alert-danger"
        >
            <div>Please correct the following error(s):</div>
            <ul>
                <li v-for="(error,i) in errorsFrontend" :key="i">{{ error }}</li>
            </ul>
    
        </div>


        <button @click="addTool" class="btn btn-success">Create tool</button>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import _ from 'lodash';
export default {
    name: 'CreateTool',
    computed: {
        ...mapGetters(['tools']),
    },
    data(){
        return {
            tool: {},
            errorsFrontend: [],//here we collect all the input field validation errors
        }
    },
    methods: {
        ...mapActions(['createTool']),
        addTool(){
            this.checkForEmptyInputFields();
            if (this.errorsFrontend.length === 0) {//the user can't submit data, if it is not valid
                this.$store.dispatch('createTool', this.tool);//here we submit data, if there are no errors
                this.tool = {};//after a tool is created, empty the input fields...
            }    
        },

        validateInputText(event){//this is doing the validation work
            this.errorsFrontend = [];//before validation, we empty the previous errors
            if  (event.target.value.length < 3) {//there must be at least 3 letters
                this.errorsFrontend.push('Brand, model, description nad serial number of the tool must be more than 3 characters.');//
            }
        },

        validateForPositiveNumbers(event){//this is doing the validation work
            this.errorsFrontend = [];//before validation, we empty the previous errors
            if  (isNaN(event.target.value) || event.target.value < 0) {//the variable must be a number + must be bigger than zero
                this.errorsFrontend.push('The entered value must be a positive number');//
            }
        },

        checkForEmptyInputFields(){
            if(_.isEmpty(this.tool)) {
                this.errorsFrontend.push('You need to fill the input fields with tool description...');
            }
            if(_.isEmpty(this.tool.brand)) {
                this.errorsFrontend.push('Brand must be filled.');
            }
            if(_.isEmpty(this.tool.model)) {
                this.errorsFrontend.push('Model must be filled.');
            }
            if(_.isEmpty(this.tool.description)) {
                this.errorsFrontend.push('Description must be filled.');
            }
            if(_.isEmpty(this.tool.serial_number)) {
                this.errorsFrontend.push('Serial number must be filled.');
            }
            if(_.isEmpty(this.tool.price)) {
                this.errorsFrontend.push('Price must be filled.');
            }
            this.errorsFrontend = _.uniq(this.errorsFrontend);//removes potential error mesage duplicates.
        }
    },
}
</script>