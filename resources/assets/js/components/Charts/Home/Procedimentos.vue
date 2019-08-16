<template>
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Quantitativo procedimetos por ano</h3>
        </div>
        <div class="box-body">
            <canvas ref="procedimentoChart" width="500" height="300"></canvas>
            <div class="d-flex flex-row">
                <div class="p-6"><strong>Total procedimentos: {{total}}</strong></div>
                <div class="p-6">Fonte: RHPARANA - data {{today}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {
        props: ['procedimentos'],
        name: 'procedimentos-anos-chart',
         computed: {
            total() {
                let fatd = this.procedimentos['fatd_ano'].reduce((total, amount) => total + amount) 
                let ipm = this.procedimentos['ipm_ano'].reduce((total, amount) => total + amount)
                let sindicancia = this.procedimentos['sindicancia_ano'].reduce((total, amount) => total + amount)
                let cd = this.procedimentos['cd_ano'].reduce((total, amount) => total + amount)
                return fatd + ipm + sindicancia + cd
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
            new Chart(this.$refs.procedimentoChart, {
                type: 'line',
                data: {
                    labels: this.procedimentos['anos'],
                    datasets: [
                        {
                            label: "FATD",
                            backgroundColor: "rgba(0, 0, 0, 0.05)",
                            borderColor: "rgba(51, 102, 204, 0.5)",
                            pointBorderColor: "rgba(51, 102, 204, 0.5)",
                            pointBackgroundColor: "rgba(51, 102, 204, 0.5)",
                            pointHoverBackgroundColor: "rgba(51, 102, 204, 0.5)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            data: this.procedimentos['fatd_ano'],
                        },
                        {
                            label: "IPM",
                            backgroundColor: "rgba(0, 0, 0, 0.05)",
                            borderColor: "rgba(220, 57, 18, 0.5)",
                            pointBorderColor: "rgba(220, 57, 18, 0.5)",
                            pointBackgroundColor: "rgba(220, 57, 18, 0.5)",
                            pointHoverBackgroundColor: "rgba(220, 57, 18, 0.5)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            data: this.procedimentos['ipm_ano'],
                        },
                        {
                            label: "Sindicância",
                            backgroundColor: "rgba(0, 0, 0, 0.05)",
                            borderColor: "rgba(255, 153, 0, 0.5)",
                            pointBorderColor: "rgba(255, 153, 0, 0.5)",
                            pointBackgroundColor: "rgba(255, 153, 0, 0.5)",
                            pointHoverBackgroundColor: "rgba(255, 153, 0, 0.5)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            data: this.procedimentos['sindicancia_ano'],
                        },
                        {
                            label: "CD",
                            backgroundColor: "rgba(0, 0, 0, 0.05)",
                            borderColor: "rgba(16, 150, 24, 0.5)",
                            pointBorderColor: "rgba(16, 150, 24, 0.5)",
                            pointBackgroundColor: "rgba(16, 150, 24, 0.5)",
                            pointHoverBackgroundColor: "rgba(16, 150, 24, 0.5)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            data: this.procedimentos['cd_ano'],
                        }
                    ]
                },
            });
        }
    }
</script>
<style scoped>

</style>