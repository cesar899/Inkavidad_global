<template>
	<div>
		<b-button
			class="mt-2 mb-2" 
		    variant="warning"
		    v-on:click.prevent="estados">
		    <span class="text-nowrap">Estados</span>
		</b-button>
		<b-card>
			<b-card-text>
				Fecha para realizar proximo pago: 
				<b>{{statu}}</b>
			</b-card-text>
		</b-card>
	</div>
</template>

<script>
	import {
	   BButton,
	   BCard,
	   BCardText,
	} from 'bootstrap-vue'

	export default {
		components: {
	      	BButton,
	   		BCard,
	   		BCardText,	
	    },

		data() {
			return {
				statu: '',
			}
		},

		created() {
			this.status()
		},

		methods: {
			estados() {
				this.$router.push('/estado/lotes')
			},

			status() {
				const date = localStorage.getItem('pp')
				const fe = new Date(date)
				this.statu = fe.toLocaleDateString()
				return this.statu
			}
		}
	}
</script>

<style></style>