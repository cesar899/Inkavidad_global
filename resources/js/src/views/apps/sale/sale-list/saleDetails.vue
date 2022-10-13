<template>
    <div>

        <template>
			<h4>Lotes del proyecto</h4>
		</template>
        <feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
        icon="ArrowLeftIcon" />
        <b-tooltip target="tooltip-back" triggers="hover">
        Volver
        </b-tooltip>
        <h3 class="ml-2 my-2" id="titleDetails"></h3>
        <b-table
        id="UserTable"
        class="position-relative"
        striped hover
        responsive
        show-empty
        empty-text="No matching records found"
        :fields="fields"
        :items="order"
        :per-page="perPage"
        :current-page="currentPage">
        <template #cell(created_at)="data">
                {{formatDate(data.item.created_at)}}
        </template>
        <template #cell(cliente)="data">
            {{data.item.user.name}}
        </template>
        <template #cell(vendedor)="data">
            {{data.item.seller.name}}
        </template>
        <template #cell(estado)="data">
            {{getStatus(data.item.status)}}
        </template>
        <template #cell(Action)="data">
            <b-button
                variant="danger"
                v-on:click.prevent="showSale(data.item.id)">
                <span class="text-nowrap">Download pdf</span>
            </b-button>
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
            order: [],
            fields: [
                {
                    key: 'id',
                    label: 'Id de Factura',
                    sortable: true
                },
                {
                    key: 'cliente',
                    sortable: true
                },
                {
                    key: 'vendedor',
                    sortable: true
                },
                {
                    key: 'bank_name',
                    label: 'Nombre del Banco',
                    sortable: true
                },
                {
                    key: 'ref_number',
                    label: 'Referencia N#',
                    sortable: true
                },
               {
                    key: 'estado',
                    sortable: true
                },
                {
                    key: 'amount',
                    label: 'Monto total',
                    sortable: true
                },
                {
                    key: 'created_at',
                    label: 'Fecha de creacion',
                    sortable: true
                },
                {
                    key: 'Action',
                    sortable: true
                },
            ]
        }
    },

    computed: {
        rows() {
            return this.order.length
        }
    },

    created() {
        this.index()
    },
    methods: {

        getStatus(status){
            let result
            switch (status) {
                case 0:
                    result = 'En Espera'
                    break;
                case 1:
                    result = 'Aprobado'
                    break;
                case 2:
                    result = 'Cancelado'
                    break;
                default:
                    break;
            }
           return result

        },

        redirectToBack() {
			this.$router.push('/sale-list');
		},

        formatDate(date) {
            return moment(date).format('DD/MM/YYYY')
        },
        index() {
            const id = this.$route.params.id;
            this.$http.get(`api/sale/details/${id}`, {
            headers: {'Authorization' : `Bearer ${this.token}`}
          })
            .then((res) => {
              this.order = res.data;
              console.log(res.data);
              const title = document.getElementById('titleDetails')
              title.textContent = `Cuotas de la venta N#${id}`
            }).catch((error) => {
              console.log(error);
          })
        }
    }
}
</script>
<style>

</style>
