<template>
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Efetivo OPM/OBM</h3>
        </div>
        <div class="box-body">
            <canvas ref="efetivoChart" width="500" height="300"></canvas>
            <div class="d-flex flex-row">
                <div class="p-6"><strong>Total efetivo: {{total}}</strong></div>
                <div class="p-6">Fonte: RHPARANA - data {{today}}</div>
            </div> 
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        props: ['efetivo'],
        name: 'efetivo-opm-chart',
        data(){
            return {
                defaultColors: [
                        '#3366CC',
                        '#DC3912',
                        '#FF9900',
                        '#109618',
                        '#990099',
                        '#3B3EAC',
                        '#0099C6',
                        '#DD4477',
                        '#66AA00',
                        '#B82E2E',
                        '#316395',
                        '#994499',
                        '#22AA99',
                        '#AAAA11',
                        '#6633CC',
                        '#E67300',
                        '#8B0707',
                        '#329262',
                        '#5574A6',
                        '#3B3EAC'
                    ]
            }
        },
        computed: {
            total() {
               return this.efetivo['qtd'].reduce((total, amount) => total + amount) 
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
        mounted() {
            new Chart(this.$refs.efetivoChart, {
                type: 'pie',
                data: {
                    labels: this.efetivo['cargos'],
                    datasets: [
                        {
                            backgroundColor: this.defaultColors,
                            hoverBackgroundColor: this.defaultColors,
                            data: this.efetivo['qtd']
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