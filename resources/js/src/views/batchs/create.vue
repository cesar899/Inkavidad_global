<template>
	<b-overlay :show="isLoading">

		<b-card title="Nuevo Lote">

			<validation-observer ref="batchsValidation">
				<b-form class="mt-2" @submit.prevent ref="batchForm">

					<b-form-group label="proyectos">
						<validation-provider #default="{ errors }" name="selectedProject" rules="required">
							<b-form-select v-model="selectedProject" :options="projectOptions"></b-form-select>
							<small class="text-danger">{{ errors[0] }}</small>

						</validation-provider>
					</b-form-group>

					<b-form-group label="Grupos">
						<validation-provider #default="{ errors }" name="selectedGroup" rules="required">
							<b-form-select v-model="selectedGroup" @change="getbacthsGroup()" :options="groupOptions"></b-form-select>
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label="Nombre de lote" label-for="batch-name">
						<validation-provider #default="{ errors }" name="batch_name" rules="required">
							<b-form-input id="batch-name" v-model="batchName" :state="errors.length > 0 ? false:null"
								name="batch-name" />
							<small class="text-danger">{{ errors[0] }}</small>
						</validation-provider>
					</b-form-group>

					<b-form-group label-class="font-weight-bold" label-size="lg" label="Metros">

						<b-form-group label="Metros Norte" label-for="mts-north">
							<validation-provider #default="{ errors }" name="mtsNorth" rules="required">
								<b-form-input id="mts-north" v-model="mtsNorth" :state="errors.length > 0 ? false:null"
									name="mts-north" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>

						<b-form-group label="Metros Sur" label-for="mts-south">
							<validation-provider #default="{ errors }" name="mtsSouth" rules="required">
								<b-form-input id="mts-south" v-model="mtsSouth" :state="errors.length > 0 ? false:null"
									name="mts-south" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>


						<b-form-group label="Metros Este" label-for="mts-est">
							<validation-provider #default="{ errors }" name="mtsEst" rules="required">
								<b-form-input id="mts-est" v-model="mtsEst" :state="errors.length > 0 ? false:null"
									name="mts-est" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>

						<b-form-group label="Metros Oeste" label-for="mts-west">
							<validation-provider #default="{ errors }" name="mtsWest" rules="required">
								<b-form-input id="mts-west" v-model="mtsWest" :state="errors.length > 0 ? false:null"
									name="mts-west" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>
					</b-form-group>

					<!--  -->
					<b-form-group label-class="font-weight-bold" label-size="lg" label="Colindantes">
						
						<b-form-group label="Colindante Norte con..." label-for="adjoins-north">
							<b-form-select class="mb-2" @change="handleAdjoins($event, 'adjoinsNorth')" v-model="adjoinsNorthSelect" :options="batchsOptions"/>

							<validation-provider v-if="adjoinsNorthSelect == ''" #default="{ errors }" name="Adjoins_north" rules="required">
								
								<div>
									<b-form-input id="adjoins-north" v-model="adjoinsNorth" :disabled="adjoinsNorthSelect != ''"
										:state="errors.length > 0 ? false:null" name="adjoins-north" />
								</div>

								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>

						<b-form-group label="Colindante Sur con..." label-for="adjoins-south">
							<b-form-select class="mb-2" @change="handleAdjoins($event, 'adjoinsSouth')" v-model="adjoinsSouthSelect" :options="batchsOptions"/>

							<validation-provider v-if="adjoinsSouthSelect == ''" #default="{ errors }" name="adjoinsSouth" rules="required">
								
								<div>
									<b-form-input id="adjoins-south" v-model="adjoinsSouth"
									:state="errors.length > 0 ? false:null" name="adjoins-south" />
								</div>

								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>


						<b-form-group label="Colindate Este con..." label-for="adjoins-est">
							<b-form-select class="mb-2" @change="handleAdjoins($event, 'adjoinsEst')" v-model="adjoinsEstSelect" :options="batchsOptions"/>
							
							<validation-provider v-if="adjoinsEstSelect == ''" #default="{ errors }" name="adjoinsEst" rules="required">
								
								<div>
									<b-form-input id="adjoins-est" v-model="adjoinsEst" :state="errors.length > 0 ? false:null"
										name="adjoins-est" />
								</div>

								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>

						<b-form-group label="Colindante Oeste con..." label-for="adjoins-west">
							<b-form-select class="mb-2" @change="handleAdjoins($event, 'adjoinsWest')" v-model="adjoinsWestSelect" :options="batchsOptions"/>
							
							<validation-provider v-if="adjoinsWestSelect == ''" #default="{ errors }" name="adjoinsWest" rules="required">

								<div>
									<b-form-input id="adjoins-west" v-model="adjoinsWest"
										:state="errors.length > 0 ? false:null" name="adjoins-west" />
								</div>

								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>
					</b-form-group>

					<b-form-group label-class="font-weight-bold" label-size="lg" label="Precios">

						<b-form-group label="precio de contado" label-for="amount-owed">
							<validation-provider #default="{ errors }" name="amountOwed" rules="required">
								<b-form-input id="amount-owed" v-model="amountOwed" :state="errors.length > 0 ? false:null"
									name="amount-owed" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>

						<b-form-group label="precio financiado" label-for="amount">
							<validation-provider #default="{ errors }" name="amount" rules="required">
								<b-form-input id="amount" v-model="amount" :state="errors.length > 0 ? false:null"
									name="amount" />
								<small class="text-danger">{{ errors[0] }}</small>
							</validation-provider>
						</b-form-group>
					</b-form-group>

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
	BCard, BCardText, BRow, BCol, BFormSelect, BLink, BFormGroup, BFormInput, BInputGroupAppend,
	BInputGroup, BFormCheckbox, BCardTitle, BImg, BForm, BButton, BOverlay
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
		BOverlay,
		BButton,
		BFormSelect,
		ValidationProvider,
		ValidationObserver
	},
	data() {
		return {
			batchName: 'batch-name',
			mtsNorth: 'test',
			mtsSouth: 'test',
			mtsEst: 'test',
			mtsWest: 'test',
			adjoinsNorth: '',
			adjoinsSouth: '',
			adjoinsEst: '',
			adjoinsWest: '',

			adjoinsNorthSelect: '',
			adjoinsSouthSelect: '',
			adjoinsEstSelect: '',
			adjoinsWestSelect: '',

			amountOwed: 0,
			amount: 0,

			selectedProject: null,
			selectedGroup: null,
			selectedBatch: null,
			isLoading: false,
			
			projectList: [ { value: null, text: 'Seleccione un proyecto' },],
			groupList: [{ value: null, text: 'Seleccione un grupo' }],
			batchList: [ { value: '', text: 'Seleccione el lote colindante' }],
			required
		}
	},
	methods: {

		handleAdjoins(value, name){
			console.log(value)
			this[name] = value;
		},

		initGroups(groupList){
			this.groupList = this.groupList.concat(groupList
				.map(group => ({ text: group.name, value: group.id })));
		},

		initProjects(projectList){
			this.projectList = this.projectList.concat(projectList
				.map(project => ({ text: project.name, value: project.id })));
		},

		initBatchs(batchList) {
			const initLetter = 65;
			const finalLetter = 90;
			this.batchList = this.batchList.concat(batchList
				.map( (batch, idx) => ({ text: `${String.fromCharCode(idx + initLetter)} - ${batch.name}`, 
					value: `${String.fromCharCode(idx + initLetter)} - ${batch.name}`}
				))
			);
		},

		async getGroupsByProject() {
			const projectId = this.selectedProject;
			let request = await this.$store.dispatch('groups/getGroupsByProject', projectId);

			if (request.data.length > 0) this.initGroups(request.data);
		},
		
		async getProjects() {
			let request = await this.$store.dispatch('projects/getProjects');
			
			if (request.data.length > 0) this.initProjects(request.data);
		},

		async getbacthsGroup() {
			console.log({selectedGroup:this.selectedGroup})
			if(!this.selectedGroup) return;
			let request = await this.$store.dispatch('batchs/getBatchByGroup', this.selectedGroup);

			if (request.data.length > 0) this.initBatchs(request.data);
		},

		async validationForm() {
			const batchData = {
				name: this.batchName,
				project_id: this.selectedProject,
				group_id: this.selectedGroup,
				mts_north: this.mtsNorth,
				mts_south: this.mtsSouth,
				mts_est: this.mtsEst,
				mts_west: this.mtsWest,
				adjoins_north: this.adjoinsNorth,
				adjoins_south: this.adjoinsSouth,
				adjoins_est: this.adjoinsEst,
				adjoins_west: this.adjoinsWest,
				amount_owed: this.amountOwed,
				amount: this.amount,
			}
			this.isLoading = true;

			this.$refs.batchsValidation.validate().then(success => {
				if (!success) return;
				console.log({batchData})
				this.$store.dispatch('batchs/save', batchData).then(({ data }) => {
					console.log(data)
					this.$toast({
						component: ToastificationContent,
						props: {
							title: 'Lote Creado',
							icon: 'CheckCircleIcon',
							variant: 'success',
						},
					})
				});
			}).finally(
				() => {
					this.$refs.batchForm.reset()
					this.isLoading = false;
				} 
			);
		},

		isListEmpty(objList) {
			return objList.length <= 1;
		}
	},
	computed: {
		projectOptions: {
			get() {
				if (this.isListEmpty(this.projectList)) this.getProjects();

				return this.projectList;
			},
		},

		groupOptions: {
			get() {
				if (this.isListEmpty(this.groupList) && this.selectedProject) this.getGroupsByProject();

				return this.groupList;
			},
		},

		batchsOptions: {
			get(){
				if (this.isListEmpty(this.groupList) && this.selectedGroup) this.getbacthsGroup();

				return this.batchList;
			}
		},
	}

}
</script>

<style>

</style>
