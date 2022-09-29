<template>
    <b-link class="btn btn-primary btn-icon" :to="to">
        <feather-icon :icon="icon" />
        {{ label }}
    </b-link>
</template>
  
<script>
import { BLink } from 'bootstrap-vue'

export default {
    components: {
        BLink,
    },

    props: {
        label: {
            type: String,
            requried: true,
        },
        icon: {
            type: String,
            default: 'PlusIcon',
        },
        to: {
            type: String,
            default: '/',
        },
    },
}
</script>
  