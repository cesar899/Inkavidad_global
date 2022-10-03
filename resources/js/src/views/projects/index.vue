<template>
    <b-card header-class="pb-2">
        <template #header>
            <h4>Lista de proyectos</h4>
            <b-button-icon to="/projects/create" label="Agregar nuevo Proyecto" icon="PlusIcon" />
        </template>

        <b-card-group class="pt-2" deck>

            <div class="col-lg-5 col-md-6 col-12 mb-1" v-for="(project, index) in projects" :key="index">
                <div class="wrapper__card__project">
                    <b-card :title="project.name" class="text-center" img-top :img-alt="imgDescription(project)"
                        :img-src="project.featured_image" tag="article" style="max-width: 20rem;">

                        <div class="d-flex flex-column align-items-center pb-2">
                            
                            <div class="pb-2">
                                <b-card-text>
                                    Estado
                                </b-card-text>
                                <b-card-text>
                                    {{statusString(project)}}
                                    <feather-icon :class="statusColor(project)" size="20" :icon="statusIcon(project)" />
                                </b-card-text>
                            </div>

                            <div>
                                <b-card-text>
                                    Resumen de Lotes:
                                </b-card-text>

                                <div class="d-flex flex-wrap justify-content-center">
                                    <div class="d-flex flex-column align-items-center col-lg-4 col-md-6 col-6" variant="light">
                                        Totales
                                        <div>
                                            <b-badge pill variant="secondary">{{project.total_batchs}}</b-badge>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-column col-lg-4 col-md-6 col-6 pr-2" variant="light">
                                        Disponibles
                                        <div>
                                            <b-badge pill variant="secondary">{{project.available_batchs_count}}</b-badge>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-column col-lg-4 col-md-6 col-6" variant="light">
                                        Apartados
                                        <div>
                                            <b-badge pill variant="secondary">{{project.pending_batchs_count}}</b-badge>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-column col-lg-4 col-md-6 col-6" variant="light">
                                        Vendidos
                                        <div>
                                            <b-badge pill variant="secondary">{{project.sold_batchs_count}}</b-badge>
                                        </div>
                                    </div>
                                </div>

                            </div>
                           
                        </div>

                        <b-button class="" :href="'/projects/'+ project.id" variant="primary">Ir a Grupo de lotes
                        </b-button>
                    </b-card>
                </div>
            </div>

        </b-card-group>
    </b-card>

</template>
  
<script>
import { BCardGroup, BCard, BCardText, BButton, BLink, BBadge, BIconBack, BListGroup, BListGroupItem } from 'bootstrap-vue'
import BButtonIcon from '@core/components/b-button-icon/BButtonIcon.vue';

export default {
    components: {
        BCardGroup,
        BCard,
        BCardText,
        BButton,
        BLink,
        BButtonIcon,
        BBadge,
        BListGroup,
        BListGroupItem,
    },
    data() {
        return {
            currentProjectList: [],
        }
    },

    methods: {

        statusString(project) {
            return project?.status == 1 ? 'Activo' : 'Inactivo';
        },

        statusIcon(project) {
            return project?.status == 1 ? 'CheckIcon' : 'XCircleIcon';
        },

        statusColor(project) {
            return project?.status == 1 ? 'icon--active' : 'icon--inactive';
        },

        imgDescription(project) {
            if (project) return `${project.name}-${project.id}`;
            return 'alt description'
        },

        async getProjects() {
            let request = await this.$store.dispatch('projects/getProjects')
            console.log(request)
            if (request.data.length > 0) this.currentProjectList = request.data;
        },
    },

    computed: {
        projects: {
            get() {
                if (this.currentProjectList.length == 0) this.getProjects();

                return this.currentProjectList;
            },
            set(value) { }
        },
    },

}
</script>
  
<style>
.wrapper__card__project {
    display: flex;
    justify-content: center;
    border: 1px solid var(--primary);
    border-radius: 10px;
    padding: 0.75em 0.25em 0.25em;
}

.icon--inactive {
    color: red;
}

.icon--active {
    color: green;
}
</style>
  