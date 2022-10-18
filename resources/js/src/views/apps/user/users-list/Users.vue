<template>
  <div>
    <div class="mb-2" v-if="showCreateButton">
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

      <template #cell(Action)="data" v-if="showCreateButton">
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
  import { throws } from 'assert'
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
  import {mapGetters} from 'vuex' 

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
        ]
      }
    },

    computed: {
      rows() {
        return this.users.length
      },
      ...mapGetters({
        role: 'auth/role'
      }),
      showCreateButton() {
        return this.role === 1 || this.role === 4
      }
    },

    created() {
      this.showUsers()
      if (this.role === 1 || this.role === 4 ) {
        this.fields.push({
          key: 'Action',
        })
      }
    },

    methods: {
      showUsers() {
        this.$http.get('api/users')
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