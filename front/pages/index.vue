<template>
    <div class="pa-5">
        <v-row>
            <v-col cols="3">
                <asset-selector v-model="asset"/>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <date-line-chart
                    :title="`Lending open postions for the ${asset.name}`"
                    :line-colors="['#06C889','#DE9D1E']"
                    :fetcher="lendingOpenPositionsFetcher"
                />
            </v-col>
        </v-row>
    </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

type Asset = {
    id: number;
    name: string;
}

export default defineComponent({
    name: "Home",

    data: () => ({
        asset: {} as Asset
    }),

    computed: {
        lendingOpenPositionsFetcher(): object
        {
            return {
                url: 'lendingopenposition',
                params: [{
                    key: "asset",
                    value: this.asset.id,
                    required: true
                }],
                categoriesKey: 'date',
                seriesFetcher: [
                    {
                        name: 'Total balance',
                        key: 'total_balance',
                        formatter: 'currency_ptbr'
                    },
                    {
                        name: 'Average balance',
                        key: 'average_price',
                        formatter: 'currency_ptbr'
                    }
                ]
            }
        }
    }
})
</script>
