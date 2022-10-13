<template>
    <div>
      <h3 class="ml-2 my-2">Lista de ventas</h3>
        <b-table
            id="UserTable"
            class="position-relative"
            striped hover
            responsive
            show-empty
            empty-text="No matching records found"
            :fields="fields"
            :items="sale"
            :per-page="perPage"
            :current-page="currentPage">
            <template #cell(Action)="data">
                <b-button
                    variant="warning"
                    v-on:click.prevent="showSale(data.item.id)">
                    <span class="text-nowrap">Show details</span>
                </b-button>
                <b-button
                    variant="success">
                    <span class="text-nowrap">Pay fee</span>
                </b-button>

                <!--<b-button
                    variant="danger"
                    v-on:click.prevent="deleteUser(data.item.id)">
                    <span class="text-nowrap">Delete</span>
                </b-button>-->
            </template>
            <template #cell(estado)="data">
                {{getStatus(data.item.status)}}
            </template>
            <template #cell(nombre)="data">
                {{data.item.user.name}}
            </template>
            <template #cell(last_name)="data">
                {{data.item.user.last_name}}
            </template>
            <template #cell(dni)="data">
                {{data.item.user.dni}}
            </template>
            <template #cell(proyecto)="data">
                {{data.item.lote.project.name}}
            </template>
            <template #cell(grupo)="data">
                {{data.item.lote.group.name}}
            </template>
        </b-table>

        <b-pagination
            v-model="currentPage"
            :per-page="perPage"
            :total-rows="rows"
            aria-controls="UserTable"
        >
        </b-pagination>
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
          sale: [],
          fields:
            [
                {
                key: 'id',
                sortable: true
                },
                {
                key: 'nombre',
                sortable: true
                },
                {
                key: 'last_name',
                sortable: true
                },
                {
                key: 'dni',
                sortable: true
                },
                {
                key: 'proyecto',
                sortable: true
                },
                {
                key: 'grupo',
                sortable: true
                },
                {
                key: 'batch_id',
                label: 'lote n#',
                sortable: true
                },
                {
                key: 'estado',
                sortable: true
                },
                {
                key: 'Action',
                }
            ]
        }
      },

      computed: {
        rows() {
          return this.sale.length
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
        getTotalAmount(solds) {
          return solds.length > 0 ? solds.reduce((accumulator, object) => { return accumulator + object.amount }, 0) : 0
        },
        getAmountOwed(owed) {
          return owed.length > 0 ? owed.reduce((accumulator, object) => { return accumulator + object.amount_owed }, 0) : 0
        },
        index() {
          this.$http.get('api/sales', {
            headers: {'Authorization' : `Bearer ${this.token}`}
          })
            .then((res) => {
              console.log(res.data);
              this.sale = res.data
            }).catch((error) => {
              console.log(error);
          })
        },

        showSale(id) {
          this.$router.push(`/sale/details/${id}`)
        }
        // deleteUser(id) {
        //   console.log(id)
        // },
      }
    }
  </script>
  |
  <style>

  </style>


