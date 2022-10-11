<template>
	<div>
		<b-button
			class="mt-2 mb-2" 
		    variant="warning"
		    v-on:click.prevent="ordenes">
		    <span class="text-nowrap">Ordenes</span>
		</b-button>
		<b-table
		  id="saleTable"
	      class="position-relative" 
	      striped hover
	      responsive
	      show-empty
	      empty-text="No matching records found"
	      :fields="fields"
	      :items="sales"
	      :per-page="perPage"
	      :current-page="currentPage">
	      	<template #cell(action)="data">
		        <b-button 
		          variant="warning"
		          v-on:click.prevent="proxPago(data.item.next_pay)"
		         >
		          <span class="text-nowrap">Acción</span>
		        </b-button>
		    </template>
	    </b-table>
	    <b-pagination
	      v-model="currentPage"
	      :per-page="perPage"
	      :total-rows="rows"
	      aria-controls="saleTable"
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
				sales: [],
				fields: [
		          {
		            key: 'id',
		            label: 'N°',
		            sortable: true
		          },
		          {
		            key: 'batch.project.name',
		            label: 'Proyecto',
		          },
		          {
		            key: 'batch.name',
		            label: 'Lote',
		          },
		          {
		            key: 'user.name',
		            label: 'Cliente',
		          },
		          {
		            key: 'status',
		            label: 'Estado',
		            formatter: value => {
		            	if(value == 1) return value = 'Parcialmente Pagado' 
		              	if(value == 2) return value = 'Pendiente de Pago'
		              	if(value == 3) return value = 'Pago Vencido' 
		              	if(value == 4) return value = 'Pagado'
		            }
		          },
		          {
		            key: 'amount',
		            label: 'Monto Adeudado',
		          },
		          {
		            key: 'amount_paid',
		            label: 'Monto Pagado',
		          },		         
		          {
		          	key: 'action',
		            label: 'Acción',
		          },		        
		        ]
			}
		},

		computed: {
	      rows() {
	        return this.sales.length
	      }
	    },

		created() {
			this.getSales()
		},

		methods: {
			getSales() {
				this.$http.get('/api/prueba/sale')
		        .then((res) => {
		           this.sales = res.data 
		        }).catch((e) => {       
		           console.log(e)
		        })
			}, 

			ordenes() {
				this.$router.push('/ordenes')
			},

			proxPago(pay) {			
				localStorage.setItem('pp', pay)
				this.$router.push('/estado/lotes/pago')
			}
		},
	}
</script>

<style></style>