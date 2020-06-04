<template>
    <div>
        <h2>Create invoice</h2>

        <el-select
            v-model="value"
            filterable
            remote
            reserve-keyword
            placeholder="Please enter a keyword"
            :remote-method="remoteMethod"
            :loading="loading">
            <el-option
                v-for="item in options"
                :key="item.value"
                :label="item.label"
                :value="item.value">
            </el-option>
        </el-select>             

        <button @click="createInvoiceWithItems" class="btn btn-warning">Create invoice</button>
    </div>
</template>

<script>
import invoiceService from '../../service/invoiceService';
export default {
    name: 'CreateInvoice',
    data(){
        return {
            invoice: {
                customer_id: 1,
            },
            invoice_items: [
                { tool_id: 1, price: 2200, },
                { tool_id: 2, price: 2600, },
            ],
            invoiceWithItems: {},

            //elements select starts below------------------------------------
            options: [],//options are the offered options, after we type in some letters. If there are no letters typed in, there will be an empty options array = no options offered
            value: [],//this will be the selected value, which will be sent to the invoice creating
            list: [],
            loading: false,//this is the loading sign, which will appear, while we are downloading the data from the db
            states: [//this currently simulates the "db"
                "Alabama", "Alaska", "Arizona",
                "Arkansas", "California", "Colorado",
                "Connecticut", "Delaware", "Florida",
                "Georgia", "Hawaii", "Idaho", "Illinois",
                "Indiana", "Iowa", "Kansas", "Kentucky",
                "Louisiana", "Maine", "Maryland",
                "Massachusetts", "Michigan", "Minnesota",
                "Mississippi", "Missouri", "Montana",
                "Nebraska", "Nevada", "New Hampshire",
                "New Jersey", "New Mexico", "New York",
                "North Carolina", "North Dakota", "Ohio",
                "Oklahoma", "Oregon", "Pennsylvania",
                "Rhode Island", "South Carolina",
                "South Dakota", "Tennessee", "Texas",
                "Utah", "Vermont", "Virginia",
                "Washington", "West Virginia", "Wisconsin",
                "Wyoming"
            ]
        }
    },
    methods: {
        async createInvoiceWithItems(){
            this.invoiceWithItems.invoice = this.invoice;
            this.invoiceWithItems.invoice_items = this.invoice_items;
            console.dir(this.invoiceWithItems);
            try {
                await invoiceService.createInvoice(this.invoiceWithItems);
                console.log('Invoice sent to api');
            } catch (error) {
                console.dir(error);
                console.log('Something is wrong');
            }
            console.log('This is bad');
        },
        //elements select methods starts below
        remoteMethod(query) {
            if (query !== '') {
                this.loading = true;
                setTimeout(() => {//this here is simulating the waiting time for the requested data
                    this.loading = false;
                    this.options = this.list.filter(item => {
                        return item.label.toLowerCase()
                        .indexOf(query.toLowerCase()) > -1;
                    });
                }, 3000);
            } else {
                this.options = [];
            }
        }
        
    },
    mounted() {
        this.list = this.states.map(item => {//this is the active search part
            return { value: `value:${item}`, label: `label:${item}` };
        });
    },
}
</script>