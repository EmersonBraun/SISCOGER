<template>
    <div class="col-md-6 col-xs-12">
        <div class="box box-info collapsed-box">
        <div class="box-header with-border">
            <h3 class="box-title"> {{ titulo }}
            <span v-if="qtd > 0" class="badge bg-red">{{ qtd }}</span>
            </h3>

            <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
            <slot></slot>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
        </div>
        <!-- /.box-footer -->
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titulo','qtd']
    }
</script>

<style scoped>

</style>