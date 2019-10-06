<template>
    <highcharts :options="chartOptions"></highcharts>
</template>

<script>
    export default {
        name: "MonthConcentration",
        props: ['data', 'pollutant'],
        watch: {
            data(v) {
                this.chartOptions.series = [];
                this.chartOptions.title = {text: ` به صورت ماه به ماه ${this.pollutant} میانگین غلظت آلاینده `};
                this.chartOptions.series.push({
                    name: this.pollutant,
                    data: v.map(e => e.avg)
                });
                this.chartOptions.xAxis.categories = v.map(e => e.month)
            },
        },
        data() {
            return {
                chartOptions: {
                    series: [],
                    tooltip: {
                        formatter: function () {
                            return `ماه : ${new persianDate(new Date().setMonth(this.x - 1)).format('MMMM')} مقدار : ${englishToPersian(this.y + '')}`
                        }
                    },
                    xAxis: {
                        labels: {
                            formatter: function () {
                                return new persianDate(new Date().setMonth(this.value - 1)).format('MMMM');
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'ppm مقادیر بر حسب '
                        },
                        labels: {
                            formatter: function () {
                                return englishToPersian(this.value + '');
                            }
                        }
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>