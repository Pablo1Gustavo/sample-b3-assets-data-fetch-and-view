<template>
    <v-menu
        v-model="menuOpened"
    >
        <template #activator="{ on, attrs }">
            <v-text-field
                outlined
                readonly
                label="Start date"
                v-model="date"
                v-bind="attrs"
                v-on="on"
            />
            <v-date-picker
                v-model="date"
                range
            />
        </template>
    </v-menu>
</template>

<script lang="ts">
import { defineComponent } from "vue"

export default defineComponent({
    name: 'DatePicker',

    data: () => ({
        menuOpened: false,
        date: null
    })
})
</script>
