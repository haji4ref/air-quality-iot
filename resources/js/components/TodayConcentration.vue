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
                    data: v.map(e => e[this.pollutant.replace('.', '')])
                });
                this.chartOptions.xAxis.categories = v.map(e => e.created_at)
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
                                return new persianDate(new Date(this.value)).format('HH:mm');
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