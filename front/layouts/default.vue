<template>
    <v-app>
        <v-app-bar
            app
            dark
            color="system-blue-darken"
        >
            <v-toolbar-title> B3 Sample Data Fetch and View </v-toolbar-title>
        </v-app-bar>

        <v-main>
            <nuxt/>
        </v-main>
    </v-app>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    name: "DefaultLayout"
})
</script>
