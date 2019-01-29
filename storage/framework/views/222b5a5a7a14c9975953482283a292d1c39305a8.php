<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Acusado</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    <div class='col-md-3 col-xs-12'>

        <table>
            <thead>
                <tr>
                    <td style="display: none">Índice</td>
                    <td>RG</td>
                    <td>Nome</td>
                    <td>Posto/Graduação</td>
                    <td>Situação</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="display: none"><input type="text" value="<?php echo e($i ?? '0'); ?>"></td>
                    <td><?php echo Form::text('rg',$envolvido['rg'],['onblur' => "completaDados($(this).val(),'nome','posto')"]); ?></td>
                    <td><?php echo Form::text('nome',$envolvido['nome'],['readonly']); ?></td>
                    <td><?php echo Form::text('posto',$envolvido['cargo'],['readonly']); ?></td>
                    <td> <?php echo Form::select('resultado',config('sistema.envolvidoFatd'),$proc['resultado']); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <button><i class="fa fa-plus">Adicionar</i></button>
            </tfoot>
        </table> 

    </div>
    </div>
</div>