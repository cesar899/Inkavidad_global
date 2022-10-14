<template>
	<div>
		<h3 class="ml-2 my-2">Lista de Clientes</h3>

		<b-table
			id="CustomerTable"
	        class="position-relative" 
	        striped hover
	        responsive
	        show-empty
	        empty-text="No matching records found"
	        :fields="fields"
	        :items="customers"
	        :per-page="perPage"
	        :current-page="currentPage">
			
		    <template #cell(Action)="data">
	          <b-button 
	            variant="warning"
	            v-on:click.prevent="showCustomer(data.item.id)">
	            <span class="text-nowrap">Detalles</span>
	          </b-button>
	        </template>

	        <template #cell(lots_purchased)="data">
            	{{data.item.batches.length}}
        	</template>

        	<template #cell(total_amount)="data">
          		{{getTotalAmount(data.item.buy)}}
        	</template>

        	<template #cell(customers_amount_indebted)="data">
          		{{getAmountOwed(data.item.buy)}}
        	</template>
          
		</b-table>

		<b-pagination
	        v-model="currentPage"
	        :per-page="perPage"
	        :total-rows="rows"
	        aria-controls="CustomerTable"
      	></b-pagination>
	</div>
</template>

<script>
	import {
      BButton,
      BTable,
      BPagination,
    } from 'bootstrap-vue'

    export default {
    	components: {
	        BButton,
	        BTable,
	        BPagination,
      	},

      	data() {
      		return {
      			perPage: 5,
	            currentPage: 1,
	            customers: [],
	            fields: [
	            	{
		              key: 'id',
		              sortable: true,
		            },
		            {
		              key: 'name',
		              label: 'nombre',
		            },
		            {
		              key: 'last_name',
		              label: 'apellido',
		            },
		            {
		              key: 'lots_purchased',
		              label: 'lotes comprados',
		            },
		            {
		              key: 'total_amount',
		              label: 'total facturado',
		            },
		            {
		              key: 'customers_amount_indebted',
		              label: 'total adeudado',
		            },
		            {
		              key: 'Action',
		            },
	            ]
      		}
      	},

      	computed: {
	        rows() {
	          return this.customers.length
	        }
	    },

	    created() {
	    	this.getCustomers()
	    },

	    methods: {
	    	getTotalAmount(solds) {
	          return solds.length > 0 ? solds.reduce((accumulator, object) => { 
	          		var x = parseFloat(accumulator) 
	          		var y = parseFloat(object.amount_paid)
	          		return x + y 
	          	  }, 0) : 0
	        },

	        getAmountOwed(owed) { 
	          return owed.length > 0 ? owed.reduce((accumulator, object) => { 
	          		var x = parseFloat(accumulator) 
	          		var y = parseFloat(object.dues)
	          		return x + y
	          	}, 0) : 0
	        },
	        
	    	getCustomers() {
	          this.$http.get('api/customers')
	            .then((res) => {
	              console.log(res.data);
	              this.customers = res.data
	            }).catch((error) => {       
	              console.log(error);
	          })
	        },

	    	showCustomer(id) {
	    		this.$router.push(`/clientes/detalles/${id}`)
	    	},
	    }
    }
</script>

<style>
	
</style>