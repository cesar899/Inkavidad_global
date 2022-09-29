<template>
    <b-card>
        <template #header>
            <h4>Lote</h4>
            <b-button-icon to="/batchs/create" label="Agregar nuevo Lote" icon="PlusIcon"/>
        </template>

    </b-card>
</template>
  
<script>
import { BCard, BCardText, BLink } from 'bootstrap-vue'
import BButtonIcon from '@core/components/b-button-icon/BButtonIcon.vue';

export default {
    components: {
        BCard,
        BCardText,
        BLink,
        BButtonIcon,
    },
}
</script>
  
<style>

</style>
  