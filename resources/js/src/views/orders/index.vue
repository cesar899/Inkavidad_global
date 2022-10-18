<template>
	<div>
		<b-button
			class="mt-2 mb-2" 
		    variant="warning"
		    v-on:click.prevent="estados">
		    <span class="text-nowrap">Estado de Lotes</span>
		</b-button>
		<b-table
		  id="orderTable"
	      class="position-relative" 
	      striped hover
	      responsive
	      show-empty
	      empty-text="No matching records found"
	      :fields="fields" 
	      :items="orders"
	      :per-page="perPage"
	      :current-page="currentPage">
	    </b-table>
	    <b-pagination
	      v-model="currentPage"
	      :per-page="perPage"
	      :total-rows="rows"
	      aria-controls="orderTable"
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

		data(){
			return {
				perPage: 5,
        		currentPage: 1,
				orders: [],
				fields: [
		          {
		            key: 'id',
		            label: 'N°',
		            sortable: true
		          },
		          {
		            key: 'user.name',
		            label: 'nombre',
		          },
		          {
		            key: 'user.last_name',
		            label: 'apellido',
		          },
		          {
		            key: 'seller.name',
		            label: 'vendedor',
		          },
		          {
		            key: 'batch.project.name',
		            label: 'projecto',
		          },
		          {
		            key: 'batch.group.name',
		            label: 'grupo',
		          },
		          {
		            key: 'batch.name',
		            label: 'lote',
		          },
		          {
		            key: 'amount',
		            label: 'monto',
		          },
		          {
		            key: 'status',
		            label: 'status',
		            formatter: value => {
		            	if(value == 1) return value = 'Pendiente' 
		              	if(value == 2) return value = 'Completado'
		              	if(value == 3) return value = 'Cancelado'
		            }
		          },
		          {
		            key: 'created_at',
		            label: 'creación',
		            formatter: value => {
		            	const date = new Date(value)
		            	return date.toLocaleDateString()
		            }
		          },
		          {
		            key: 'updated_at',
		            label: 'aprobación',
		            formatter: value => {
		            	const date = new Date(value)
		            	return date.toLocaleDateString()
		            }
		          },
		        ]
			}
		},

		computed: {
	      rows() {
	        return this.orders.length
	      }
	    },

		created() {
			this.getOrders()
		},

		methods: {
			getOrders() {
				this.$http.get('/api/prueba/order')
		        .then((res) => {
		           this.orders = res.data 
				   console.log(this.orders)
		        }).catch((e) => {       
		           console.log(e)
		        })
			},

			estados() {
				this.$router.push('/estado/lotes')
			}
		},
	}
</script>

<style></style>