<template>
	<b-row class="justify-content-center">
	<b-col cols="6" md="6" lg="6">
	<b-card>
		<h2 class="text-center">Edit User</h2>   
	    <b-form class="mt-1" @submit.stop.prevent="updateUser">
			<b-row class="justify-content-center" >
		        <!-- Field: Name -->
		        <b-col
		          cols="12"
		          md="8"
		          lg="8" 
		        >
		          <b-form-group		          	
		            label="Name"
		            label-for="name"
		          >
		            <b-form-input
		              id="name"
                  type="text"
		              v-model="user.name"
		            />
		          </b-form-group>

		          <b-form-group		          	
		            label="Last Name"
		            label-for="last-name"
		          >
		            <b-form-input
		              id="last-name"
                  type="text"
		              v-model="user.last_name"
		            />
		          </b-form-group>

		          <b-form-group	          	
		            label="Email"
		            label-for="email"
		          >
		            <b-form-input
		              id="email"
                  type="email"
		              v-model="user.email"
		            />
		          </b-form-group>

		          <b-form-group
		            label="Rol"
		            label-for="rol"
                v-if="loaderRol"
		          >
		            <b-form-select 
		            	v-model="user.rol" 
		            	:options="roles"
		            	value-field="id"
      					text-field="name">
		            </b-form-select>
		          </b-form-group>
		          <b-form-group class="text-center mt-2">
		            <b-button
		          		type="submit"
		            	variant="primary"
		            	class="mb-1 mb-sm-0 mr-0 mt-1">
		            Save changes
		          	</b-button>

                <b-button          
                  variant="warning"
                  class="mb-1 mb-sm-0 mr-0 mt-1"
                  v-on:click.prevent="back">
                Come Back
                </b-button>
		          </b-form-group>      
		        </b-col>	                    
	      	</b-row>
		</b-form>
    </b-card>
    </b-col>
    </b-row>
</template>

<script>
import {
  BTab, BTabs, BCard, BAlert, BLink, BRow, BCol, BForm, BFormGroup, BFormInput, BFormSelect, BFormRadioGroup, BFormCheckboxGroup, BButton, BCardText
} from 'bootstrap-vue'

export default {
  components: {
  	BCardText,
    BTab,
    BTabs,
    BCard,
    BAlert,
    BLink,
    BRow,
    BCol,
    BForm,
    BFormGroup,
    BFormInput,
    BFormRadioGroup,
    BFormSelect,
    BFormCheckboxGroup,
    BButton,
  },

  data() {
  	return {
      loaderRol: null,
  		token: sessionStorage.getItem('jwt'),
      rol: sessionStorage.getItem('rol'),
  		us: sessionStorage.getItem('user'),
  		roles: [],
  		user: {
  			name: '',
  			last_name: '',
  			email: '',
  			rol: Number,
  		},
  	}
  },

  mounted() {
    this.userRol()
  	this.getRoles()
  	this.getUser()
  },

  methods: {
    userRol() {
      this.rol == 1 
        ? this.loaderRol = true
        : this.loaderRol = false
    },

  	getRoles() {
  		this.$http.get('/api/roles', {
  			headers: {'Authorization' : `Bearer ${this.token}`} 
  		})
  		.then(res => {
  			this.roles = res.data
  		})
  		.catch(e => {
  			console.log(e)
  		})
  	},

  	getUser() {
  		this.$http.get(`/api/user/${this.us}`, {
  			headers: {'Authorization' : `Bearer ${this.token}`} 
  		})
  		.then(res => {
  			const {
	  			name,
	  			last_name,
	  			email,
	  			rol,
  			} = res.data

  			this.user.name = name
  			this.user.last_name = last_name
  			this.user.email = email
  			this.user.rol = rol
  		})
  		.catch(e => {
  			console.log(e)
  		})
  	},

  	updateUser() {
  		this.$http.put(`/api/edit/user/${this.us}`, this.user, {
  			headers: {'Authorization' : `Bearer ${this.token}`} 
  		})
  		.then(resp => {
  			sessionStorage.removeItem('user')

        this.$toast({
          component: ToastificationContent,
          props: {
            title: resp.data,
            icon: 'EditIcon',
            variant: 'success',
          },
        })

  			this.$router.push('/apps/users/list')
  		})
  		.catch(e => {
  			this.$toast({
          component: ToastificationContent,
          props: {
            title: 'Incorrect Data',
            icon: 'EditIcon',
            variant: 'danger',
          },
        })
  		})
  	},

    back() {
      sessionStorage.removeItem('user')
      this.$router.push('/apps/users/list')
    }
  },
}
</script>

<style>

</style>
