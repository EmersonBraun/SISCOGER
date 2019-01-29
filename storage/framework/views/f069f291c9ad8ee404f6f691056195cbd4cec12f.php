<select class="select2" name="opm">
<option value=''>Todas as OPM</option>
<?php $__currentLoopData = $opms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(trim($opm['CODIGOBASE'])==""): ?> <?php echo e($opm['CODIGOBASE']="0"); ?> <?php endif; ?>

    <?php if($opm['TITULO']=="COMANDO" || $opm['TITULO']=="COMANDO GERAL"): ?> 

        <?php if($firstGroup == "false"): ?>

            <?php echo e("</optgroup>"); ?>


       <?php endif; ?>

            <?php echo e($firstGroup = "true"); ?>

            <optgroup LABEL='<?php echo e($opm['ABREVIATURA']); ?>'>
            <option value='<?php echo e($opm['CODIGOBASE']); ?>'><?php echo e($opm['ABREVIATURA']); ?> (sede)</option>
    
    <?php endif; ?>

        <?php if((isset($cdopm_selected)) && ($opm['CODIGOBASE']==$cdopm_selected)): ?> <?php echo e($selected="selected"); ?>


        <?php else: ?> <?php echo e($selected=""); ?>


            <option <?php echo e($selected); ?> value='<?php echo e(corta_zeros($opm['CODIGO'])); ?>'><?php echo e($opm['ABREVIATURA']); ?></option>

        <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
</select>