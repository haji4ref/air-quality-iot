<template>
    <highcharts :options="chartOptions"></highcharts>
</template>

<script>
    export default {
        name: "DaysConcentration",
        props: ['data', 'pollutant'],
        watch: {
            data(v) {
                this.chartOptions.series = [];
                this.chartOptions.title = {text: ` در طول هفته گذشته ${this.pollutant} میانگین غلظت آلاینده `};
                this.chartOptions.series.push({
                    name: this.pollutant,
                    data: v.map(e => e.avg)
                });
                this.chartOptions.xAxis.categories = v.map(e => e.day)
            },
        },
        data() {
            return {
                chartOptions: {
                    series: [],
                    tooltip: {
                        formatter: function () {
                            return `ساعت : ${new persianDate(new Date(this.x)).format('HH:mm')} مقدار : ${englishToPersian(this.y + '')}`
                        }
                    },
                    xAxis: {
                        labels: {
                            formatter: function () {
                                return new persianDate(new Date(this.value)).format('dddd');
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