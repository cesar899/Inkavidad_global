<template>
	<b-overlay :show="isGroupsLoading || isCardLoading" >
		<b-card>
			<template #header>
				<h4>Administrar Proyecto</h4>
				<feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
					icon="ArrowLeftIcon" />
				<b-tooltip target="tooltip-back" triggers="hover">
					Volver
				</b-tooltip>
			</template>

			<b-card-group class="d-flex justify-content-between" deck>
					<b-card>

						<template #header>
							<h4>Grupo de lotes</h4>
						</template>

						<b-form-group class="scroll-body-car card-body--size" label="lotes disponibles"
							v-slot="{ ariaDescribedby }">
							<b-form-checkbox-group @change="handlechangeGroupList()" v-model="currentActiveGroups"
								:options="groups" name="groups" stacked>
							</b-form-checkbox-group>
						</b-form-group>

						<b-button type="submit" variant="primary" block :disabled="hasChange" @click="saveGroupChanges">
							Guardar Cambios
						</b-button>

					</b-card>

					<b-card v-if="project != null" class="card__project"
						body-class="d-flex justify-content-center flex-column text-center" :title="project.name" img-top
						:img-alt="imgDescription(project)" :img-src="project.featured_image" tag="article"
						style="max-width: 20rem;">
						<b-card-text>
							Estado
						</b-card-text>
						<b-card-text>
							{{statusString}}
							<feather-icon :class="statusColor" size="20" :icon="statusIcon" />
						</b-card-text>
					</b-card>
					<b-card v-else title="Cargando proyecto..." style="max-width: 20rem;" />

			</b-card-group>

		</b-card>
	</b-overlay>
</template>

<script>
import {
	BCard, BCardText, BCardGroup, BFormGroup, BInputGroup, BFormCheckbox, BTooltip, BCardTitle, BImg,
	BForm, BButton, BFormFile, BModal, BFormCheckboxGroup, BOverlay
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
		BCardGroup,
		BOverlay,
		BFormCheckboxGroup,
		BTooltip,
	},
	data() {
		return {
			currentProject: null,
			availableGroups: [],
			currentActiveGroups: [],
			hasListChange: true,
			isCardLoading: false,
			isGroupsLoading: false,
		}
	},
	methods: {

		redirectToBack() {
			this.$router.push('./');
		},

		imgDescription(project) {
			if (project) return `${project.name}-${project.id}`;
			return 'alt description'
		},

		handlechangeGroupList() {
			const oldCheckedList = this.availableGroups
				.filter((group) => (group.checked)).map((group) => (group.value));
			const sortedCurrentActiveGroups = [...this.currentActiveGroups].sort((a, b) => a - b);

			if (oldCheckedList.length !== sortedCurrentActiveGroups.length)
				return this.hasChange = false;

			return this.hasChange = oldCheckedList.every((group, index) => (group == sortedCurrentActiveGroups[index]));
		},

		initGroups(groupList) {
			this.availableGroups = groupList
				.map(group => ({ text: group.name, value: group.id, checked: Boolean(group.status) }))
				.sort((a, b) => (a.value - b.value));

			this.currentActiveGroups = this.availableGroups
				.filter(group => (group.checked)).map(group => group.value);
		},

		async getGroups() {
			const projectId = this.$route.params.project_id;
			this.isGroupsLoading = true;
			let request = await this.$store.dispatch('groups/getGroupsByProject', projectId);

			if (request.data.length > 0) this.initGroups(request.data);
			this.isGroupsLoading = false;
		},

		async getProject() {
			const projectId = this.$route.params.project_id;
			try {
				this.isCardLoading = true;
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
			this.isCardLoading = false;
		},

		async saveGroupChanges() {
			const projectId = this.$route.params.project_id;
			let groupsToUpdate = [];

			this.availableGroups.forEach((group) => {
				if (group.checked && !this.currentActiveGroups.includes(group.value))
					groupsToUpdate.push(group.value);
				if (!group.checked && this.currentActiveGroups.includes(group.value))
					groupsToUpdate.push(group.value);
			});
			const newData = { groups: groupsToUpdate, projectId };

			this.hasChange = true;

			try {
				let request = await this.$store.dispatch('groups/saveGroupChangesByProject', newData)

				if (request.data) this.$toast({
					component: ToastificationContent,
					props: {
						title: 'Cambios realizados',
						icon: 'CheckCircleIcon',
						variant: 'succes',
					},
				});
				this.getGroups();

			} catch (error) {
				this.$toast({
					component: ToastificationContent,
					props: {
						title: 'Sucedio un error no pudieron guardarse los cambios',
						icon: 'XIcon',
						variant: 'danger',
					},
				})
			}
		}
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

		hasChange: {
			get() { return this.hasListChange },
			set(value) { this.hasListChange = value }
		},

		statusString() {
			return this.project?.status == 1 ? 'Activo' : 'Inactivo';
		},

		statusIcon() {
			return this.project?.status == 1 ? 'CheckIcon' : 'XCircleIcon';
		},

		statusColor() {
			return this.project?.status == 1 ? 'icon--active' : 'icon--inactive';
		}
	}
}
</script>

<style>
.scroll-body-car {
	overflow-y: auto;
}

.card-body--size {
	max-height: 150px;
}

.icon--inactive {
	color: red;
}

.icon--active {
	color: green;
}

.card__project {
	border: 1px solid var(--primary);
	border-radius: 10px;
	padding: 0.25em
}
</style>
