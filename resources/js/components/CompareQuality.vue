<template>
    <el-card class="h-100">
        <highcharts :options="chartOptions"></highcharts>
    </el-card>
</template>

<script>
    export default {
        name: "CompareQuality",
        created() {
            let today     = new Date(),
                yesterday = new Date();
            yesterday.setDate(today.getDate() - 1);
            window
                .axios
                .get(`qualityByDate/${new Date().toISOString()}`)
                .then((res) => {
                    this.chartOptions.title.text = `غلظت آلاینده ها در ساعت ${new persianDate(today).format('HH:mm')} و مقایسه آن با روز گذشته`
                    this.chartOptions.series.push({
                        name: 'امروز',
                        color: '#409EFF',
                        data: Object.keys(res.data).map(e => res.data[e])
                    });
                    return window.axios.get(`qualityByDate/${yesterday.toISOString()}`);
                })
                .then((res) => {
                    this.chartOptions.series.push({
                        name: 'دیروز',
                        color: '#67C23A',
                        data: Object.keys(res.data).map(e => res.data[e])
                    });
                })
                .catch((e) => {
                    console.log(e);
                });


        },
        data() {
            return {
                chartOptions: {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: ''
                    },
                    yAxis: {
                        title: {
                            text: 'ppm مقدار بر حسب '
                        },
                        labels: {
                            formatter: function () {
                                return englishToPersian(this.value + '');
                            }
                        }
                    },
                    xAxis: {
                        categories: [
                            'CO',
                            'SO2',
                            'O3',
                            'NO2',
                            'PM25',
                            'PM10'
                        ]
                    },
                    tooltip: {
                        // headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        // pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        //     '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                        // footerFormat: '</table>',
                        // shared: true,
                        // useHTML: true
                    },
                    series: []
                }
            }
        }
    }

</script>

<style scoped>

</style>