<template>
    <highcharts :options="chartOptions"></highcharts>
</template>

<script>
    export default {
        name: "TodayConcentration",
        props: ['data', 'pollutant'],
        watch: {
            data(v) {
                this.chartOptions.series = [];
                this.chartOptions.title = {text: ` درامروز ${this.pollutant} غلظت آلاینده `};
                this.chartOptions.series.push({
                    name: this.pollutant,
                    data: v.map(e => e.avg)
                });
                this.chartOptions.xAxis.categories = v.map(e => e.hour)
            },
        },
        data() {
            return {
                chartOptions: {
                    series: [],
                    tooltip: {
                        formatter: function () {
                            return `ساعت : ${new persianDate(new Date().setHours(this.x,0)).format('HH:mm')} مقدار : ${englishToPersian(this.y + '')}`
                        }
                    },
                    xAxis: {
                        labels: {
                            formatter: function () {
                                return new persianDate(new Date().setHours(this.value,0)).format('HH:mm');
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