<template>
    <b-card title="Grupo de lotes">
        <!-- para vendedor -->
        {{groups}}
        <b-card-group class="pt-2" deck>

            <div v-for="(project, index) in projects" :key="index">

                <b-card :title="project.name" class="mb-2" img-top :img-alt="imgDescription(project)"
                    :img-src="project.featured_image" tag="article" style="max-width: 20rem;">

                </b-card>

            </div>

        </b-card-group>
    </b-card>
</template>
  
<script>
import { BCard, BCardText } from 'bootstrap-vue'

export default {
    components: {
        BCard,
        BCardText,
    },

    methods: {

        imgDescription(project) {
            if (project) return `${project.name}-${project.id}`;
            return 'alt description'
        },

        async getGroups() {
            let request = await this.$store.dispatch('groups/getBatchsForSale')

            if (request.data.length > 0) this.currentProjectList = request.data;
        },
    },

    computed: {
        groups: {
            get() {
                if (this.currentProjectList.length == 0) this.getGroups();

                return this.currentProjectList;
            },
        }
    },

}
</script>
  
<style>

</style>
  