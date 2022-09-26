<template>
	<b-overlay :show="isLoading">

	<b-card>
		<template #header>
			<h4>Lotes del proyecto</h4>
			<feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
				icon="ArrowLeftIcon" />
			<b-tooltip target="tooltip-back" triggers="hover">
				Volver
			</b-tooltip>
		</template>

		<b-card-group class="d-flex flex-column justify-content-between">
			<div v-if="groups.length <= 1">
				<h4>No hay Grupos Disponibles</h4>
			</div>
			<b-card v-for="(group, index) in groups" :key="index">
				<template #header>
					<h4>{{group.name}}</h4>
				</template>

				<b-card-group class="d-flex" deck>

					<div v-for="(batch, indB) in group.batchs" :key="indB" class="pb-1">
						
						<b-link
							:to="'/batchs/'+ batch.id + '/selection'"
						>
							<b-card :class="['card__batchs', borderStatus(batch.status)]">
								<template #header>
									<h4>{{batch.name}}</h4>
								</template>

								<b-card-text>
									Precio financiado: {{batch.amount_owed}}
								</b-card-text>
								<b-card-text>
									Precio de contado: {{batch.amount}}
								</b-card-text>

							</b-card>
						</b-link>

					</div>

				</b-card-group>

			</b-card>

		</b-card-group>

	</b-card>
</b-overlay>

</template>

<script>
import {
	BCard, BCardText, BCardGroup, BFormGroup, BInputGroup, BFormCheckbox, BTooltip, BCardTitle, BImg, 
	BForm, BButton, BFormFile, BModal, BFormCheckboxGroup, BLink, BOverlay
} from 'bootstrap-vue'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
	components: {
		BCard,
		BCardText,
		BFormGroup,
		BInputGroup,
		BFormCheckbox,
		BCardTitle,
		BImg,
		BForm,
		BButton,
		BFormFile,
		BModal,
		BLink,
		BOverlay,
		BCardGroup,
		BFormCheckboxGroup,
		BTooltip,
	},
	data() {
		return {
			currentProject: null,
			availableGroups: [],
			currentActiveGroups: [],
			hasListChange: true,
			isLoading: false,
		}
	},
	methods: {

		redirectToBack() {
			this.$router.push('/projects/available');
		},

		borderStatus(status){
			return status === 1 ? 'available--border' : 'pending--border';  			
		},

		initGroups(groupList) {
			this.availableGroups = groupList;
		},

		async getGroups() {
			this.isLoading = true;
			const projectId = this.$route.params.project_id;
			let request = await this.$store.dispatch('groups/getGroupsByProjectForSale', projectId);

			if (request.data.length > 0) this.initGroups(request.data);
			this.isLoading = false;
		},

		async getProject() {
			this.isLoading = true;
			const projectId = this.$route.params.project_id;
			try {
				let request = await this.$store.dispatch('projects/getProject', projectId)

				if (request.data) this.currentProject = request.data;

			} catch (error) {
				this.$toast({
					component: ToastificationContent,
					props: {
						title: 'proyecto no existe',
						icon: 'XIcon',
						variant: 'danger',
					},
				})
				this.$router.push('./');
			}
			this.isLoading = false;
		},
	},
	computed: {
		groups: {
			get() {
				if (this.availableGroups.length == 0) this.getGroups();

				return this.availableGroups;
			},
		},
		project: {
			get() {
				if (!this.currentProject) this.getProject();

				return this.currentProject;
			},
		},
	}
}
</script>

<style>

.card__batchs {
	display: flex;
	justify-content: center;
	border: 1px solid;
	border-radius: 10px;
	padding: 0.15em;
	transition: transform 0.5s;
}

.pending--border {
	--color-temp: 234, 84, 85, 0.4;
	border-color: var(--danger);
	background-color: rgba(234, 84, 85, 0.5);
}

.available--border {
	--color-temp: 40, 199, 111, 0.4;
	border-color: var(--success);
	background-color: rgba(40, 199, 111, 0.5);
}

.card__batchs:hover {
	transform: translateY(-5px);
	background-color: rgba(var(--color-temp));
}

</style>
