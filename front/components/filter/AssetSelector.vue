<template>
    <v-select
        outlined
        hide-details
        label="Asset"
        :items='assets'
        v-model='asset'
        item-text="name"
        item-value="id"
        @change="$emit('input', asset)"
    />
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
    name: 'AssetSelector',

    data: () => ({
        asset: null,
        assets: [
            { id: 1, name: "ABCD01" },
            { id: 2, name: "ABCD02" },
            { id: 3, name: "ABCD03" }
        ]
    })
})
</script>
