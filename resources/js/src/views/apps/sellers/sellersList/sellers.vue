<template>
    <div>
      <h3 class="ml-2 my-2">Lista de vendedores</h3>
      <b-table
        id="UserTable"
        class="position-relative" 
        striped hover
        responsive
        show-empty
        empty-text="No matching records found"
        :fields="fields"
        :items="sellers"
        :per-page="perPage"
        :current-page="currentPage">
        <template #cell(Action)="data">
          <b-button 
            variant="warning"
            v-on:click.prevent="showSeller(data.item.id)">
            <span class="text-nowrap">Show details</span>
          </b-button>
  
          <!-- <b-button 
            variant="danger"
            v-on:click.prevent="deleteUser(data.item.id)">
            <span class="text-nowrap">Delete</span>
          </b-button> -->
        </template>
  
        <template #cell(lots_sold)="data">
            {{data.item.batches_sold.length}}
        </template>
        <template #cell(total_amount)="data">
          {{getTotalAmount(data.item.sales)}}
        </template>
        <template #cell(clients_amount_indebted)="data">
          {{getAmountOwed(data.item.sales)}}
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
          perPage: 5,
          currentPage: 1,
          sellers: [],
          fields: [
            {
              key: 'id',
              sortable: true
            },
            {
              key: 'name',
              sortable: true
            },
            {
              key: 'last_name',
              sortable: true
            },
            {
              key: 'lots_sold',
              sortable: true
            },
            {
              key: 'total_amount',
              label: 'total amount',
              sortable: true
            },
            {
              key: 'clients_amount_indebted',
              label: 'Clients amount indebted',
              sortable: true
            },
            {
              key: 'Action',
            },
          ]
        }
      },
  
      computed: {
        rows() {
          return this.sellers.length
        }
      },
  
      created() {
        this.getSellers()
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
        getSellers() {
          this.$http.get('api/sellers')
            .then((res) => {
              console.log(res.data);
              this.sellers = res.data
            }).catch((error) => {       
              console.log(error);
          })
        },
  
        showSeller(id) {
          this.$router.push(`/seller/details/${id}`)
        },
        // deleteUser(id) {
        //   console.log(id)
        // },
      }
    }
  </script>
  |
  <style>
    
  </style>