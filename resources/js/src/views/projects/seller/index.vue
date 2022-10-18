<template>
	<b-overlay :show="isLoading">    
        <b-card title="Proyectos disponibles">
            <!-- para vendedor -->
            <b-card-group class="pt-2" deck>

                <div class="col-lg-4 col-md-6 col-12 mb-1" v-for="(project, index) in projects" :key="index">
                    <div class="wrapper__card__project">
                        <b-card :title="project.name" body-class="text-center" class="mb-1" img-top :img-alt="imgDescription(project)"
                            :img-src="project.featured_image" tag="article" style="max-width: 20rem;">

                            <b-button :href="'/projects/'+ project.id + '/groups/sell'" variant="primary">
                                Ver Grupo de lotes
                            </b-button>
                        </b-card>
                    </div>

                </div>

            </b-card-group>
        </b-card>
    </b-overlay>

</template>
  
<script>
import { BCard, BCardText, BCardGroup, BButton, BOverlay} from 'bootstrap-vue'

export default {
    components: {
        BCard,
        BCardText,
        BCardGroup,
        BButton,
        BOverlay
    },
    data() {
        return {
            currentProjectList: [],
            isLoading: false,
        }
    },
    methods: {

        imgDescription(project) {
            if (project) return `${project.name}-${project.id}`;
            return 'alt description'
        },

        async getProjects() {
            this.isLoading = true;
            let request = await this.$store.dispatch('projects/getAvailableProjects')

            if (request.data.length > 0) this.currentProjectList = request.data;
            this.isLoading = false;
        },
    },

    computed: {
        projects: {
            get() {
                if (this.currentProjectList.length == 0) this.getProjects();

                return this.currentProjectList;
            },
        }
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

    .wrapper__card__project:hover {
        box-shadow: 0 8px 25px -8px var(--primary);
    }

</style>
  