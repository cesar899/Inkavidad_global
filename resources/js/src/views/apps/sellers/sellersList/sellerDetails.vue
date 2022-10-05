<template>
    <div>
        <h3 class="ml-2 my-2" id="titleDetails"></h3>
        <b-table
        id="UserTable"
        class="position-relative" 
        striped hover
        responsive
        show-empty
        empty-text="No matching records found"
        :fields="fields"
        :items="sales"
        :per-page="perPage"
        :current-page="currentPage">
        <template #cell(created_at)="data">
                {{formatDate(data.item.created_at)}}
        </template>
      </b-table>
      <b-pagination
        v-model="currentPage"
        :per-page="perPage"
        :total-rows="rows"
        aria-controls="UserTable"
      ></b-pagination>
    </div>
</template>
  
<script>
import {
    // BCard,
    // BRow,
    // BCol,
    // BFormInput,
    BButton,
    BTable,
    // BMedia,
    // BAvatar,
    // BLink,
    // BBadge,
    // BDropdown,
    // BDropdownItem,
    BPagination,
} from 'bootstrap-vue'
import moment from 'moment';    
export default {
    components: {
        // BCard,
        // BRow,
        // BCol,
        // BFormInput,
        BButton,
        BTable,
        // BMedia,
        // BAvatar,
        // BLink,
        // BBadge,
        // BDropdown,
        // BDropdownItem,
        BPagination,
    },

    data() {
        return {
            loaderRol: null,
            token: sessionStorage.getItem('jwt'),
            rol: sessionStorage.getItem('rol'),
            perPage: 5,
            currentPage: 1,
            sales: [],
            fields: [
                {
                    key: 'id',
                    label: 'Id de venta',
                    sortable: true
                },
                {
                    key: 'user_id',
                    label: 'Id del cliente',
                    sortable: true
                },
                {
                    key: 'batch_id',
                    label: 'Id del lote',
                    sortable: true
                },
                {
                    key: 'status',
                    label: 'Estado',
                    sortable: true
                },
                {
                    key: 'amount',
                    label: 'Monto total',
                    sortable: true
                },
                {
                    key: 'amount_paid',
                    label: 'Monto pagado',
                    sortable: true
                },
                {
                    key: 'dues',
                    label: 'Deuda',
                    sortable: true
                },
                {
                    key: 'created_at',
                    label: 'Fecha de creacion',
                    sortable: true
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
        this.getSeller()
    },
    methods: {
        formatDate(date) {
            return moment(date).format('DD/MM/YYYY')
        },
        getSeller() {
            const id = this.$route.params.id;
            this.$http.get(`api/seller/details/${id}`, {
            headers: {'Authorization' : `Bearer ${this.token}`}
          })
            .then((res) => {
              console.log(res.data);
              const title = document.getElementById('titleDetails')
              title.textContent = `Detalles del vendedor #${id}`
              this.sales = res.data
            }).catch((error) => {       
              console.log(error);
          })
        }
    }
}
</script>
<style>

</style>