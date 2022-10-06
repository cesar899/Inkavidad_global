<template>
	<div>
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
		          },
		          {
		            key: 'created_at',
		            label: 'creación',
		          },
		          {
		            key: 'updated_at',
		            label: 'aprobación',
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
		        }).catch((e) => {       
		           console.log(e)
		        })
			}
		},
	}
</script>

<style></style>