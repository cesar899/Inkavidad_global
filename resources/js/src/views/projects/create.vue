<template>
	<b-overlay
		:show="isLoading"
		spinner-variant="primary"
		blur="0"
		opacity=".75"
		rounded="sm"
	>

		<b-card>
			<template #header>
				<h4>Nuevo Proyecto</h4>

				<feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
					icon="ArrowLeftIcon" />
				<b-tooltip target="tooltip-back" triggers="hover">
					Volver
				</b-tooltip>
			</template>

			<validation-observer ref="projectsValidation">
				<b-form class="mt-2" @submit.prevent ref="projectForm">

					<b-form-group label="name" label-for="batch-name">
						<validation-provider #default="{ errors }" name="Name" rules="required">
							<b-form-input id="batch-name" v-model="name" :state="errors.length > 0 ? false:null"
								name="batch-name" placeholder="batch name" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label="plan" label-for="batch-plan">
						<validation-provider #default="{ errors }" name="Plan" rules="required">
							<b-form-input id="batch-plan" v-model="plan" :state="errors.length > 0 ? false:null"
								name="batch-plan" placeholder="batch Plan" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label="Cantidad de Grupos" label-for="group-quantity">
						<validation-provider #default="{ errors }" name="group_quantity" rules="required">
							<b-form-input id="group-quantity" name="group-quantity" v-model="groupQuantity" min="1"
								type="number" placeholder="Cantidad de Grupos"
								:state="errors.length > 0 ? false:null" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>


					<b-form-group label="imagen comercial" label-for="batch-image">
						<validation-provider #default="{ errors }" name="image" rules="required">
							<b-form-file id="batch-image" name="batch-image" v-model="featuredImage" accept="image/*"
								:state="errors.length > 0 ? false:null" placeholder="Choose a file or drop it here..."
								drop-placeholder="Drop file here..." />
							<div class="mt-3">Selected file: {{ featuredImage ? featuredImage.name : '' }}</div>
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label="status" label-for="batch-status">
						<validation-provider #default="{ errors }" name="status" rules="required">
							<b-form-checkbox switch class="mr-n2" id="batch-status" name="batch-status" v-model="status"
								:state="errors.length > 0 ? false:null" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>
					<!-- <b-row class="pb-2">
							<b-form-group label="status" label-for="batch-status">
								<validation-provider #default="{ errors }" name="status" rules="required">
									<b-form-checkbox switch class="mr-n2" id="batch-status" name="batch-status"
										v-model="status" :state="errors.length > 0 ? false:null" />
									<small class="text-danger">{{ errors[0] }}</small>
								</validation-provider>
							</b-form-group>
						<b-col>

							
						</b-col>

						<b-button v-b-modal.groups-modal variant="primary">
							Añadir Grupos
						</b-button>
					</b-row> -->

					<!-- groups Modal -->
					<!-- <b-modal id="groups-modal" title="Grupo de lotes" ok-only>
						<b-form-group label="lotes disponibles" v-slot="{ ariaDescribedby }">
							<b-form-checkbox-group v-model="selectedGroups" :options="groups" 
								:aria-describedby="ariaDescribedby" name="groups" stacked
							></b-form-checkbox-group>
						</b-form-group>

					</b-modal> -->
					<!-- groups Modal -->

					<!-- submit buttons -->
					<b-button type="submit" variant="primary" block @click="validationForm">
						Guardar Datos
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
	BCard, BCardText, BRow, BCol, BLink, BTooltip, BFormGroup, BFormInput, BInputGroupAppend, BInputGroup,
	BFormCheckbox, BCardTitle, BImg, BForm, BButton, BFormFile, BModal, BFormCheckboxGroup, BOverlay
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
		BInputGroupAppend,
		BInputGroup,
		BFormCheckbox,
		BCardTitle,
		BImg,
		BForm,
		BButton,
		BFormFile,
		BTooltip,
		BModal,
		BOverlay,
		BFormCheckboxGroup,
		ValidationProvider,
		ValidationObserver
	},
	data() {
		return {
			name: 'project-name',
			plan: 'plan',
			status: false,
			featuredImage: [],
			groupQuantity: 1,
			availableGroups: [],
			selectedGroups: [],
			isLoading: false,
			required,
		}
	},
	methods: {
		redirectToBack() {
			this.$router.push('./');
		},

		initGroups(groupList) {
			this.availableGroups = groupList
				.map(group => ({ text: group.name, value: group.id, checked: Boolean(group.project_id) }));
			this.selectedGroups = this.availableGroups.filter(group => (group.checked)).map(group => group.value);
		},

		async getGroups() {
			let request = await this.$store.dispatch('groups/getGroups');

			if (request.data.length > 0) this.initGroups(request.data);
		},

		async validationForm() {
			const projectData = {
				name: this.name,
				plan: this.plan,
				status: this.status ? 1 : 0,
				featured_image: this.featuredImage,
				group_quantity: this.groupQuantity,
				selectedGroups: this.selectedGroups,
			}
			
			this.$refs.projectsValidation.validate().then(success => {
				if (!success) return;
				this.isLoading = true;

				this.$store.dispatch('projects/save', projectData).then(({ data }) => {
					console.log(data)
					this.$toast({
						component: ToastificationContent,
						props: {
							title: 'project Created',
							icon: 'CheckCircleIcon',
							variant: 'success',
						},
					})
					this.isLoading = false;
				});

			})
			this.$refs.projectForm.reset();
		},
	},
	computed: {
		groups: {
			get() {
				if (this.availableGroups.length == 0) this.getGroups();

				return this.availableGroups;
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
