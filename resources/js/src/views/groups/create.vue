<template>
	<b-overlay :show="isLoading">
		<b-card>
			<template #header>
				<h4>Nuevo Grupo</h4>

				<feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
					icon="ArrowLeftIcon" />
				<b-tooltip target="tooltip-back" triggers="hover">
					Volver
				</b-tooltip>
			</template>

			<validation-observer ref="projectsValidation">
				<b-form class="mt-2" @submit.prevent>

					<b-form-group label="Nombre de lote" label-for="batch-name">
						<validation-provider #default="{ errors }" name="Name" rules="required">
							<b-form-input id="batch-name" v-model="name" :state="errors.length > 0 ? false:null"
								name="batch-name" placeholder="Nombre de lote" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label="Proyecto" label-for="project">
						<validation-provider #default="{ errors }" name="Project" rules="required">

							<b-form-select id="project" name="project" class="mb-2" v-model="selectedProject"
								:options="projects" />

							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group class="pb-1" label="status" label-for="batch-status">
						<validation-provider #default="{ errors }" name="status" rules="required">
							<b-form-checkbox switch class="mr-n2" id="batch-status" name="batch-status" v-model="status"
								:state="errors.length > 0 ? false:null" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<!-- submit buttons -->
					<b-button type="submit" variant="primary" block @click="validationForm">
						Registrar Datos
					</b-button>

				</b-form>
			</validation-observer>

		</b-card>
	</b-overlay>
</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required } from '@validations'
import {
	BCard, BCardText, BRow, BCol, BLink, BTooltip, BFormSelect, BFormGroup, BFormInput,
	BInputGroup, BFormCheckbox, BCardTitle, BForm, BButton, BFormCheckboxGroup, BOverlay
} from 'bootstrap-vue'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
	components: {
		BCard,
		BCardText,
		BRow,
		BCol,
		BLink,
		BFormGroup,
		BFormInput,
		BInputGroup,
		BFormCheckbox,
		BCardTitle,
		BForm,
		BOverlay,
		BButton,
		BTooltip,
		BFormSelect,
		BFormCheckboxGroup,
		ValidationProvider,
		ValidationObserver
	},
	data() {
		return {
			name: 'group-name',
			status: false,
			projectList: [{ value: null, text: 'Seleccionar proyecto' }],
			selectedProject: null,
			isLoading: false,
			required,
		}
	},
	methods: {
		redirectToBack() {
			this.$router.push('./');
		},

		initProjects(projectList) {
			this.projectList = this.projectList.concat(projectList
				.map(project => ({
					text: project.name, value: project.id,
					maxGroupQuantity: project.group_quantity, currentGroupQuantity: project.total_groups
				})));
		},

		async getProjects() {
			this.isLoading = true;
			let request = await this.$store.dispatch('projects/getProjects');

			if (request.data.length > 0) this.initProjects(request.data);
			this.isLoading = false;
		},

		async validationForm() {
			const groupData = {
				name: this.name,
				status: this.status ? 1 : 0,
				project_id: this.selectedProject,
			}
			const currentProject = this.projectList.find(project => project.value === this.selectedProject);
			try {
				this.isLoading = true;

				if (currentProject.maxGroupQuantity - currentProject.currentGroupQuantity <= 1)
					throw new Error('Proyecto no acepta mas Grupos');

				const validationSuccess = await this.$refs.projectsValidation.validate();
				if (!validationSuccess)
					throw new Error('Validacion Fallida');

				await this.$store.dispatch('groups/save', groupData);
				this.$toast({
					component: ToastificationContent,
					props: {
						title: 'Grupo Creado',
						icon: 'CheckIcon',
						variant: 'success',
					},
				})
			} catch (error) {
				const messageError = error.response?.data?.message || error.message;
				this.$toast({
					component: ToastificationContent,
					props: {
						title: messageError,
						icon: 'XIcon',
						variant: 'danger',
					},
				})

			}
			this.isLoading = false;
		},
	},
	computed: {
		projects: {
			get() {
				if (this.projectList.length <= 1) this.getProjects();

				return this.projectList;
			},
			set(value) { }
		}
	}
}
</script>

<style>
.icon--back:hover {
	color: rgba(0, 0, 0);
}
</style>
