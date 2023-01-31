<template>
    <v-app>
        <v-app-bar
            app
            dark
            color="sblue-darken-2"
        >
            <v-toolbar-title>
                <v-icon large class="ml-5 mr-2">
                    mdi-elephant
                </v-icon>
                B3 Sample Data Fetch and View
            </v-toolbar-title>
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
