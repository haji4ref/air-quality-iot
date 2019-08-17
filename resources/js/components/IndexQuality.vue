<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Air Quality</div>

                    <div class="card-body">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">CO</th>
                        <th scope="col">time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item,index) in tableData" :key="index">
                            <th scope="row">{{item.id}}</th>
                            <td>{{item.CO}}</td>
                            <td>{{item.created_at}}</td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
    export default {
        data(){
            return{
                tableData:[]
            }
        },
        methods:{
            fetchData(){
                window.axios('http://185.55.226.137:8080/api/quality')
                .then((res)=>{
                    this.tableData = res.data;
                })
            }
        },
        created() {
            this.fetchData();
            setTimeout(this.fetchData,10000);
        }
    }
</script>
