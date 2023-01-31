<template>
    <v-autocomplete
        outlined
        hide-details
        return-object
        background-color="sgrey"
        label="Asset"
        :items='assets'
        v-model='asset'
        item-text="name"
        @change="$emit('input', asset)"
    />
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
    name: 'AssetSelector',

    data: () => ({
        asset: null,
        assets: []
    }),

    mounted()
    {
        this.$axios.get('tickersymbol').then(res => {
            this.assets = res.data;
        })
    }
})
</script>
