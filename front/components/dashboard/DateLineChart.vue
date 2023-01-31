<template>
    <panel-card
        title="Lending open postions"
    >
        <chart
            v-if="showChart"
            type="line"
            :options="chartOptions"
            :series="series"
            :height="380"
        />
        <div v-if="loading" class="text-center">
            <v-progress-circular
                size=70
                color="blue"
                class="my-16"
                indeterminate
            />
        </div>
        <p
            v-if="showParamSelectMessage"
            class="text-center text-body-1"
        >
            <v-icon>mdi-filter-off</v-icon>
            Please select a filter parameter to show the chart
        </p>
    </panel-card>
</template>

<script lang="ts">
import { PropType, defineComponent } from "vue"
import { ApexOptions } from "apexcharts";
import { AxiosResponse } from 'axios'

/*
|------------------------------
| Types and global variables
|------------------------------
*/
type LineChartSeriesFetcher = {
    name: string,
    key: string;
    formatter?: "currency_ptbr";
}

type LineChartFetcherParam = {
    key: string;
    value: any,
    required: boolean;
}

type DateLineFetcher = {
    url: string;
    params: LineChartFetcherParam[];
    categoriesKey: string;
    seriesFetcher: LineChartSeriesFetcher[];
}

type ApexLabelFormatters = {
    [key: string]: (val: number, opts?: any) => string | string[];
}

const FORMATTERS: ApexLabelFormatters =
{
    'currency_ptbr': val => val.toLocaleString('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    })
}

/*
|------------------------------
| Component
|------------------------------
*/
export default defineComponent({
    name: 'DateLineChart',

    props: {
        title: {
            type: String,
            default: ""
        },
        fetcher: {
            type: Object as PropType<DateLineFetcher>,
            required: true
        },
        lineColors: {
            type: Array as PropType<string[]>,
            default: undefined
        }
    },

    data: () => ({
        loading: false,
        series: [] as ApexAxisChartSeries,
        categories: [] as string[]
    }),

    computed: {
        canFetch(): boolean
        {
            return this.fetcher.params.every(
                item => item.required && item.value
            );
        },
        showParamSelectMessage(): boolean
        {
            return !this.loading && !this.canFetch;
        },
        showChart(): boolean
        {
            return !this.loading && this.canFetch;
        },

        chartOptions(): ApexOptions
        {
            return {
                colors: this.lineColors,
                chart: {
                    foreColor: "#d4d4d4",
                    background: '0',
                    toolbar: {
                        offsetY: -20,
                        offsetX: -10
                    }
                },
                theme: {
                    mode: "dark"
                },
                stroke: {
                    curve: 'smooth'
                },
                markers: {
                    size: 6,
                    strokeWidth: 0
                },
                legend: {
                    offsetY: 5,
                    fontSize: "15rem",
                    markers: {
                        width: 15,
                        height: 15,
                        radius: 0
                    }
                },
                xaxis: {
                    type: "datetime",
                    categories: this.categories,
                    labels: {
                        format: "MMM dd",
                        style: {
                            fontSize: "0.75rem"
                        }
                    }
                },
                yaxis: this.fetcher.seriesFetcher.map((fetcher, i) => ({
                    opposite: i > 0,
                    labels: {
                        formatter: fetcher.formatter && FORMATTERS[fetcher.formatter]
                    }
                }))

            }
        }
    },

    watch: {
        fetcher: {
            handler()
            {
                if (this.canFetch)
                {
                    this.loading = true;

                    this.setFetchData().finally(() => {
                        this.loading = false;
                    })
                }
            },
            deep: true,
            immediate: true
        }
    },

    methods: {
        setFetchData(): Promise<void | AxiosResponse<any>>
        {
            const { url, params, categoriesKey, seriesFetcher } = this.fetcher;

            const urlParams = this.extractUrlParams(params);

            return this.$axios.get(url, {
                params: urlParams
            }).then(res =>
            {
                this.categories = res.data.map((item: any) => item[categoriesKey]);

                this.series = seriesFetcher.map(fetcher => (
                    {
                        name: fetcher.name,
                        data: res.data.map((item: any) => item[fetcher.key])
                    }
                ));
            })
        },
        extractUrlParams(fetcherParams: LineChartFetcherParam[]): object
        {
            return fetcherParams.reduce((obj: {[key: string]: any}, param) => {
                obj[param.key] = param.value;
                return obj;
            }, {});
        }
    }
})
</script>
