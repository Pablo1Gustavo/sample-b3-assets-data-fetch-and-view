<template>
    <v-card
        dark
        :height="height"
        :rounded="flat ? '0' : 'md'"
        :elevation="flat ? 0 : 3"
    >
        <v-card-title class='text-break'>
            {{ title }}

            <v-spacer/>
            <slot name="tools"/>
        </v-card-title>
        
        <v-card-text :class="{ 'd-flex justify-center': centered }">
            <slot/>
        </v-card-text>
    </v-card>
</template>

<script lang="ts">
export default {
    name: 'TitleCard',

    props: {
        title: {
            type: String,
            required: true
        },
        centered: {
            type: Boolean,
            default: false
        },
        height: {
            type: Number,
            default: undefined
        },
        flat: {
            type: Boolean,
            default: false
        }
    }
}
</script>
