<template>
    <li class="dropdown tasks-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">9</span>
        </a>
        <ul class="dropdown-menu">
            <li class="header">Você tem 9 processos/procedimentos</li>
            <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                    <li>
                        <!-- Task item -->
                        <a href="#">
                            <h3>
                                IT - 15/2019
                                <small class="pull-right">20%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">20% do prazo</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                    <li>
                        <!-- Task item -->
                        <a href="#">
                            <h3>
                                ADL - 42/2019
                                <small class="pull-right">40%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">40% do prazo</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                    <li>
                        <!-- Task item -->
                        <a href="#">
                            <h3>
                                FATD - 14/2019
                                <small class="pull-right">80%</small>
                            </h3>
                            <div class="progress xs">
                                <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                    <span class="sr-only">80% do prazo</span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <!-- end task item -->
                </ul>
            </li>
            <li class="footer">
                <a href="#">Visualizar tudo</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>

</style>