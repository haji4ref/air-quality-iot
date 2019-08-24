<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <el-card>
                    <div slot="header">Air Quality</div>

                    <el-table :data="tableData" border empty-text="There is no data:(">
                        <el-table-column prop='id' label="#"></el-table-column>
                        <el-table-column prop='CO' label="CO"></el-table-column>
                        <el-table-column prop='created_at' label="time"></el-table-column>
                    </el-table>

                    <el-pagination
                        class="text-center my-2"
                        layout="prev, pager, next"
                        :current-page.sync="currentPage"
                        @current-change="fetchData"
                        :total="50">
                    </el-pagination>
                </el-card>
            </div>
        </div>
    </div>
</template>

<script>
import { setTimeout, setInterval } from 'timers';
    export default {
        data(){
            return{
                tableData:[],
                currentPage:1,
            }
        },
        methods:{
            fetchData(){
                //185.55.226.137:8080
                // air

                window.axios(`http://185.55.226.137:8080/api/quality?page=${this.currentPage}`)
                .then((res)=>{
                    Vue.set(this,'tableData',res.data.data) ;
                })
            }
        },
        created() {
            this.fetchData();
            setInterval(this.fetchData,10000);
        }
    }
</script>
