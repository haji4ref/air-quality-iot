<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <el-card>

                    <div class="d-flex">
                        <div class="flex-grow-1 m-2">
                            <div>
                                : آلاینده
                            </div>

                            <el-select class="w-100" v-model="pollutant" placeholder="Select"
                                       @change="fetchData">
                                <el-option
                                        v-for="item in pollutants"
                                        :key="item"
                                        :label="item"
                                        :value="item">
                                </el-option>
                            </el-select>
                        </div>

                        <div class="flex-grow-1 m-2">
                            <div>
                               : بازه زمانی
                            </div>

                            <el-select class="w-100" v-model="range" placeholder="Select"
                                       @change="changeChart">
                                <el-option
                                        v-for="item in rangeOptions"
                                        :key-value="item.value"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item">
                                </el-option>
                            </el-select>
                        </div>

                    </div>


                    <div v-loading="!loaded">
                        <component :is="range.value" :data="chartData" :pollutant="pollutant"/>
                    </div>

                </el-card>
            </div>
        </div>
    </div>
</template>

<script>
    import TodayConcentration from "./TodayConcentration";
    import DaysInWeekConcentration from './DaysInWeekConcentration';
    import DaysInMonthConcentration from './DaysInMonthConcentration';

    export default {
        components: {TodayConcentration, DaysInWeekConcentration,DaysInMonthConcentration},
        data() {
            return {
                tableData: [],
                rangeOptions: [
                    {
                        value: 'today-concentration',
                        label: 'امروز',
                        fetchFunction: async () => {
                            let res = await window.axios(`qualityToday/${this.pollutant.replace('.', '')}`);
                            this.chartData = res.data;
                        }
                    },
                    {
                        value: 'days-in-week-concentration',
                        label: 'در طول یک هفته گذشته',
                        fetchFunction: async () => {
                            let res = await window.axios(`qualityDaysInWeek/${this.pollutant.replace('.', '')}`);
                            this.chartData = res.data;
                        }
                    },
                    {
                        value: 'days-in-month-concentration',
                        label: 'در طول ماه گذشته',
                        fetchFunction: async () => {
                            let res = await window.axios(`qualityDaysInMonth/${this.pollutant.replace('.', '')}`);
                            this.chartData = res.data;
                        }
                    },
                    {
                        value: 'month-concentration',
                        label: 'ماه به ماه'
                    },
                ],
                range: null,
                pollutant: 'CO',
                currentPage: 1,
                pollutants: null,
                chartData: null,
                loaded: false
            }
        },
        methods: {
            async fetchData() {
                //185.55.226.137:8080
                // air
                this.loaded = false;
                await this.range.fetchFunction();
                this.loaded = true;
            },
            changeChart() {
                this.fetchData();
            }
        },
        created() {
            this.range = this.rangeOptions[2];
            this.pollutants = window.pollutants;
            this.fetchData();
            // setInterval(this.fetchData, 10000);
        }
    }
</script>
