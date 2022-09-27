<template>
  <div>
    <div class="mb-2" v-if="loaderRol">
      <b-button 
        variant="success"
        v-on:click.prevent="create">
        <span class="text-nowrap">Create</span>
      </b-button>
    </div>

    <b-table
      id="UserTable"
      class="position-relative" 
      striped hover
      responsive
      show-empty
      empty-text="No matching records found"
      :fields="fields"
      :items="users"
      :per-page="perPage"
      :current-page="currentPage">

      <template #cell(Action)="data" v-if="loaderRol">
        <b-button 
          variant="warning"
          v-on:click.prevent="editUser(data.item.id)">
          <span class="text-nowrap">Edit</span>
        </b-button>

        <!-- <b-button 
          variant="danger"
          v-on:click.prevent="deleteUser(data.item.id)">
          <span class="text-nowrap">Delete</span>
        </b-button> -->
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
        loaderRol: null,
        token: sessionStorage.getItem('jwt'),
        rol: sessionStorage.getItem('rol'),
        perPage: 5,
        currentPage: 1,
        users: [],
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
            key: 'email',
            sortable: true
          },
          {
            key: 'roles.name',
            label: 'Rol',
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
        return this.users.length
      }
    },

    created() {
      this.showUsers()
      this.userRol()
    },

    methods: {
      userRol(){
        this.rol == 1 || this.rol == 4
          ? this.loaderRol = true
          : this.loaderRol = false
      },

      showUsers() {
        this.$http.get('api/users', {
          headers: {'Authorization' : `Bearer ${this.token}`}
        })
          .then((res) => {
            this.users = res.data
          }).catch((error) => {       
            console.log(error);
        })
      },

      editUser(id) {
        sessionStorage.setItem('user', id)
        this.$router.push('/apps/users/edit')
      },

      create() {
        this.$router.push('/apps/users/create')
      }

      // deleteUser(id) {
      //   console.log(id)
      // },
    }
  }
</script>

<style>
  
</style>