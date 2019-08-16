<template>
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">{{ label }}</h3>
        </div>
        <div class="box-body">
            <canvas ref="valuesChart" width="500" height="300"></canvas>
            <div class="d-flex flex-row">
                <div class="p-6"><strong>Total pendencias: {{total}}</strong></div>
                <div class="p-6">Fonte: RHPARANA - data {{today}}</div>
            </div> 
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        props: ['values','label','name'],
        name: this.name,
        data(){
            return {
               val: [] 
            }
        },
        computed: {
            total() {
               return this.val.reduce((total, amount) => total + amount) 
            },
            today() {
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();

                today = `${dd}/${mm}/${yyyy}`;
                return today
            },
        },
        created(){
            this.val = Object.values(this.values)
        },
        mounted() {
            console.log(this.values)
            new Chart(this.$refs.valuesChart, {
                type: 'bar',
                data: {
                    labels: [this.label],
                    datasets: [
                        {
                            label: "CG",
                            backgroundColor: '#3366CC',
                            data: [this.values.cg]        
                        },
                        {
                            label: "EM",
                            backgroundColor: '#DC3912',
                            data: [this.values.em]         
                        },
                        {
                            label: "1CRPM",
                            backgroundColor: '#FF9900',
                            data: [this.values.crpm1]         
                        },
                        {
                            label: "2CRPM",
                            backgroundColor: '#990099',
                            data: [this.values.crpm2]          
                        },
                        {
                            label: "3CRPM",
                            backgroundColor: '#3B3EAC',
                            data: [this.values.crpm3]         
                        },
                        {
                            label: "4CRPM",
                            backgroundColor: '#0099C6',
                            data: [this.values.crpm4]           
                        },
                        {
                            label: "5CRPM",
                            backgroundColor: '#DD4477',
                            data: [this.values.crpm5]           
                        },
                        {
                            label: "6CRPM",
                            backgroundColor: '#66AA00',
                            data: [this.values.crpm6]        
                        },
                        {
                            label: "CCB",
                            backgroundColor: '#B82E2E',
                            data: [this.values.ccb]         
                        }
                    ]
                },
                options: {
                    animationEasing: 'easeOutCirc',
                    legend: {
                        display: true,
                        position: 'left'
                    }
                }
            });
        }
    }
</script>
<style scoped>

</style>