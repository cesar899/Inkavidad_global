<template>
    <b-card>
        <template #header>
            <h4>Selección de lote</h4>

            <feather-icon id="tooltip-back" @click="redirectToBack()" class="cursor-pointer icon--back" size="25"
                icon="ArrowLeftIcon" />
            <b-tooltip target="tooltip-back" triggers="hover">
                Volver
            </b-tooltip>
        </template>

        step: {{stepView}}
        <br />

        <div class="mt-2" v-if="stepView === 1">
            <validation-observer ref="userInfoValidation">

                <b-form>
                    <b-form-group label-class="font-weight-bold" label-size="lg" label="Comprador">

                        <b-form-group label="Nombre" label-for="first-name">
                            <validation-provider #default="{ errors }" name="FirstName" rules="required">
                                <b-form-input id="first-name" v-model="selectedBatchForm.firstName"
                                    :state="errors.length > 0 ? false:null" name="first-name" placeholder="Nombre" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Apellido" label-for="last-name">
                            <validation-provider #default="{ errors }" name="LastName" rules="required">
                                <b-form-input id="last-name" v-model="selectedBatchForm.lastName" :state="errors.length > 0 ? false:null"
                                    name="last-name" placeholder="Apellido" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="DNI" label-for="dni">
                            <validation-provider #default="{ errors }" name="Dni" rules="required">
                                <b-form-input id="dni" v-model="selectedBatchForm.dni" :state="errors.length > 0 ? false:null" name="dni"
                                    placeholder="DNI" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Dirección" label-for="address">
                            <validation-provider #default="{ errors }" name="Adress" rules="required">
                                <b-form-input id="address" v-model="selectedBatchForm.adress" :state="errors.length > 0 ? false:null"
                                    name="address" placeholder="Dirección" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Número Telefónico" label-for="phone-number">
                            <validation-provider #default="{ errors }" name="Phone_number" rules="required">
                                <b-form-input id="phone-number" v-model="selectedBatchForm.phoneNumber"
                                    :state="errors.length > 0 ? false:null" name="phone-number"
                                    placeholder="Número Telefónico" type="tel" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Saldo Inicial" label-for="starting-balance">
                            <validation-provider #default="{ errors }" name="Starting_balance" rules="required">
                                <b-form-input id="starting-balance" v-model="selectedBatchForm.startingBalance"
                                    :state="errors.length > 0 ? false:null" name="starting-balance"
                                    placeholder="Saldo Inicial" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                    </b-form-group>
                </b-form>

                <b-button type="submit" variant="primary" block @click="validationUserInfoForm">
                    {{currentTextButton}}
                </b-button>
         
            </validation-observer>
        </div>

        <div v-if="stepView === 2 && selectedBatchForm.startingBalance != 0">
            <validation-observer ref="paidInfoValidation">

                <b-form>

                    <b-form-group label="Banco" label-for="bank">
                        <validation-provider #default="{ errors }" name="Bank" rules="required">
                            <b-form-input :disabled="selectedBatchForm.startingBalance == 0" id="bank" 
                                v-model="selectedBatchForm.bank" name="bank" placeholder="Banco"
                                :state="errors.length > 0 ? false:null"  
                            />
                            <small class="text-danger">{{ errors[0] }}</small>
                        </validation-provider>
                    </b-form-group>
                    
                    <b-form-group label="Comprobante de Pago" label-for="paymentProof">
	    				<validation-provider #default="{ errors }" name="payment_proof" rules="required">
                            <b-form-file id="paymentProof" name="paymentProof" 
                                v-model="selectedBatchForm.paymentProof" accept="image/*"
                                :state="errors.length > 0 ? false:null" placeholder="Sube aqui comprobante de pago"
                                drop-placeholder="Deja el archivo aqui..." />
                            <div class="mt-3">Archvio elegido: {{ selectedBatchForm.paymentProof ? selectedBatchForm.paymentProof.name : '' }}</div>
                            <small class="text-danger">{{ errors[0] }}</small>
					    </validation-provider>
				    </b-form-group>

                    <b-form-group label="N° de Referencia" label-for="ref-number">
                        <validation-provider #default="{ errors }" name="Ref_number" rules="required">
                            <b-form-input :disabled="selectedBatchForm.startingBalance == 0" id="ref-number" 
                                v-model="selectedBatchForm.refNumber" name="ref-number" placeholder="N° de Referencia"
                                :state="errors.length > 0 ? false:null"  
                            />
                            <small class="text-danger">{{ errors[0] }}</small>
                        </validation-provider>
                    </b-form-group>

                </b-form>
            </validation-observer>
            <b-button type="submit" variant="primary" block @click="validationPaidForm">
                Registrar
            </b-button>

        </div>


        <!-- <validation-observer ref="formValidation">
            <b-form class="mt-2" @submit.prevent>
                <div v-if="view == 'client-info'">

                    <b-form-group label-class="font-weight-bold" label-size="lg" label="Comprador">

                        <b-form-group label="Nombre" label-for="first-name">
                            <validation-provider #default="{ errors }" name="FirstName" rules="required">
                                <b-form-input id="first-name" v-model="firstName"
                                    :state="errors.length > 0 ? false:null" name="first-name" placeholder="Nombre" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Apellido" label-for="last-name">
                            <validation-provider #default="{ errors }" name="LastName" rules="required">
                                <b-form-input id="last-name" v-model="lastName" :state="errors.length > 0 ? false:null"
                                    name="last-name" placeholder="Apellido" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="DNI" label-for="dni">
                            <validation-provider #default="{ errors }" name="Dni" rules="required">
                                <b-form-input id="dni" v-model="dni" :state="errors.length > 0 ? false:null" name="dni"
                                    placeholder="DNI" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Dirección" label-for="address">
                            <validation-provider #default="{ errors }" name="Adress" rules="required">
                                <b-form-input id="address" v-model="adress" :state="errors.length > 0 ? false:null"
                                    name="address" placeholder="Dirección" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Número Telefónico" label-for="phone-number">
                            <validation-provider #default="{ errors }" name="Phone_number" rules="required">
                                <b-form-input id="phone-number" v-model="phoneNumber"
                                    :state="errors.length > 0 ? false:null" name="phone-number"
                                    placeholder="Número Telefónico" type="tel" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Saldo Inicial" label-for="starting-balance">
                            <validation-provider #default="{ errors }" name="Starting_balance" rules="required">
                                <b-form-input id="starting-balance" v-model="startingBalance"
                                    :state="errors.length > 0 ? false:null" name="starting-balance"
                                    placeholder="Saldo Inicial" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="Banco" label-for="bank">
                            <validation-provider #default="{ errors }" name="Bank" rules="required">
                                <b-form-input :disabled="startingBalance == 0" id="bank" v-model="bank"
                                    :state="errors.length > 0 ? false:null" name="bank" placeholder="Banco" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                        <b-form-group label="N° de Referencia" label-for="ref-number">
                            <validation-provider #default="{ errors }" name="Ref_number" rules="required">
                                <b-form-input :disabled="startingBalance == 0" id="ref-number" v-model="RefNumber"
                                    :state="errors.length > 0 ? false:null" name="ref-number"
                                    placeholder="N° de Referencia" />
                                <small class="text-danger">{{ errors[0] }}</small>
                            </validation-provider>
                        </b-form-group>

                    </b-form-group>
                </div>

                <div v-if="view == 'paid-ref' && startingBalance != 0">

                    <b-form-group label="Banco" label-for="bank">
                        <validation-provider #default="{ errors }" name="Bank" rules="required">
                            <b-form-input :disabled="startingBalance == 0" id="bank" v-model="bank"
                                :state="errors.length > 0 ? false:null" name="bank" placeholder="Banco" />
                            <small class="text-danger">{{ errors[0] }}</small>
                        </validation-provider>
                    </b-form-group>

                    <b-form-group label="N° de Referencia" label-for="ref-number">
                        <validation-provider #default="{ errors }" name="Ref_number" rules="required">
                            <b-form-input :disabled="startingBalance == 0" id="ref-number" v-model="RefNumber"
                                :state="errors.length > 0 ? false:null" name="ref-number"
                                placeholder="N° de Referencia" />
                            <small class="text-danger">{{ errors[0] }}</small>
                        </validation-provider>
                    </b-form-group>

                </div>

                <b-button type="submit" variant="primary" block @click="validationForm">
                    Registrar
                </b-button>

            </b-form>
        </validation-observer> -->

    </b-card>
</template>
  
<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required } from '@validations'
import { BForm, BFormGroup, BFormInput, BFormFile, BCard, BCardText, BTooltip, BButton } from 'bootstrap-vue'

export default {
    components: {
        BForm,
        BFormGroup,
        BFormInput,
        BFormFile,
        BCard,
        BCardText,
        BTooltip,
        BButton,
        ValidationProvider,
        ValidationObserver
    },
    data() {
        return {
            selectedBatchForm: {
                firstName: '',
                lastName: '',
                dni: '',
                adress: '',
                phoneNumber: '',
                startingBalance: 0,
                paymentProof: null,
                bank: '',
                refNumber: '',
            },
            stepView: 1,
            required
        }
    },
    methods: {
        redirectToBack() {
            this.$router.push('./');
        },

        async validationUserInfoForm(){
            const balanceStatus = this.selectedBatchForm.startingBalance;

            try {
                const validatedSuccess = await this.$refs.userInfoValidation.validate();
                if (!validatedSuccess) return;
                    
                if(balanceStatus !== 0)
                    this.stepView = 2;
                
                if(balanceStatus === 0 && this.stepView === 1)
                    this.saveOrder();
                
            } catch (error) {
                console.log(error)
            }
        },

        async validationPaidForm(){
            // const balanceStatus = this.selectedBatchForm.startingBalance;

            try {
                const validatedSuccess = await this.$refs.paidInfoValidation.validate();
                if (!validatedSuccess) return;
                console.log("already")

                this.saveOrder();
                
            } catch (error) {
                
            }

        },

        async saveOrder(){
            // let request = await this.$store.dispatch('orders/save', this.selectedBatchForm)

            console.log('guardando registro')
        },
    },

    computed: {
        currentTextButton(){
            return this.selectedBatchForm.startingBalance != 0 ? 'Siguiente' : 'Registrar';
        }
    },

}
</script>
  
<style>

</style>
  