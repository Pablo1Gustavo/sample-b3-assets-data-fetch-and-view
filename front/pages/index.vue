<template>
    <div class="pa-5">
        <v-row>
            <v-col cols="3">
                <asset-selector v-model="asset"/>
            </v-col>
        </v-row>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: "Home",

    data: () => ({
        asset: null
    })
})
</script>
