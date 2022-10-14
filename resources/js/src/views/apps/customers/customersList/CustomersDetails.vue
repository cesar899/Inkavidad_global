<template>
	<div>
		<b-button
			class="mt-2 mb-2" 
		    variant="warning"
		    v-on:click.prevent="clientes">
		    <span class="text-nowrap">Clientes</span>
		</b-button>
		<h3 class="ml-2 my-2" id="titleDetails"></h3>
		<b-table
			id="CustomerTable"
			class="position-relative" 
	        striped hover
	        responsive
	        show-empty
	        empty-text="No matching records found"
	        :fields="fields"
	        :items="customer">      

	        <template #cell(lots_purchased)="data">
            	{{data.item.batches.length}}
        	</template>

        	<template #cell(orders_purchased)="data">
            	{{data.item.orders.length}}
        	</template>

	        <template #cell(total_amount)="data">
          		{{getTotalAmount(data.item.buy)}}
        	</template>

			<template #cell(amount_indebted)="data">
          		{{getAmountOwed(data.item.buy)}}
        	</template>

        	<template #cell(statu)="data">
          		{{checkStatus()}}
        	</template>

		</b-table>
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
				customer: '',
				statu: null,
				fields: [
					{
		              key: 'id',
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
		              key: 'email',
		              label: 'correo',
		            },
		            {
		              key: 'countrie_id',
		              label: 'país',
		            },
		            {
		              key: 'prefix_id',
		              label: 'prefijo',
		            },
		            {
		              key: 'type_dni',
		              label: 'tipo dni',
		            },
		            {
		              key: 'dni',
		              label: 'dni',
		            },
		            {
		              key: 'phone',
		              label: 'celular',
		            },
		            {
		              key: 'address',
		              label: 'dirección',
		            },
		            {
		              key: 'lots_purchased',
		              label: 'lotes comprados',
		            },
		            {
		              key: 'orders_purchased',
		              label: 'oredenes generadas'
		            },
		            {
		              key: 'total_amount',
		              label: 'total pagado',
		            },
		            {
		              key: 'amount_indebted',
		              label: 'deuda total',
		            },
		            {
		              key: 'statu',
		              label: 'estado',
		            },
				]
			}
		},

		created() {
			this.getCustomer()
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
	          		this.statu = x + y
	          		return x + y
	          	}, 0) : 0
	        },

	        checkStatus() {
	        	var statu = null
	        	this.statu == 0 
	        		? statu = 'Solvente'
	        		: statu = 'Moroso'

	        	return statu
	        },

			getCustomer() {
				const id = this.$route.params.id

				this.$http.get(`api/customer/details/${id}`)
	            .then((res) => {
	              const title = document.getElementById('titleDetails')
	              title.textContent = `Detalles del cliente #${id}`
	              this.customer = res.data
	            }).catch((error) => {       
	              console.log(error)
	          	})
			},

			clientes() {
				this.$router.push('/clientes/lista')
			},
		},
	}
</script>

<style>
	
</style>