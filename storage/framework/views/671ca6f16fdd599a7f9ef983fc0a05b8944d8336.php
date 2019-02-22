
<?php if(!isset($indice)) $indice = $relacao['id_envolvido']; ?>
<div style="display: none">
    <input class="form-control" type="hidden" name="envolvido[<?php echo e($indice); ?>][id_envolvido]" value="<?php if(isset($relacao['id_envolvido'])): ?>  <?php echo e($relacao['id_envolvido']); ?><?php endif; ?>">
    <input class="form-control" type="hidden" name="envolvido[<?php echo e($indice); ?>][id_<?php echo e($proc); ?>]" value="<?php if(isset($relacao['id_'.$proc])): ?> <?php echo e($relacao['id_'.$proc]); ?><?php endif; ?>">
    <input class="form-control" type="hidden" name="envolvido[<?php echo e($indice); ?>][situacao]" value="<?php echo e($situacao ?? $relacao['situacao']); ?>">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">    
    <input class="form-control" required="true" size="12" type="text" name="envolvido[<?php echo e($indice); ?>][rg]" value="<?php if(isset($relacao['rg'])): ?> <?php echo e($relacao['rg']); ?><?php endif; ?>" onblur="completaDados($(this).val(),'<?php echo e($indice); ?>nome', '<?php echo e($indice); ?>cargo');" placeholder="RG">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    <input class="form-control" readonly="true" type="text" size="30" value="<?php if(isset($relacao['nome'])): ?> <?php echo e($relacao['nome']); ?><?php endif; ?>" name="envolvido[<?php echo e($indice); ?>][nome]" id="<?php echo e($indice); ?>nome" placeholder="Nome">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    <input class="form-control" readonly="true" type="text" size="10" value="<?php if(isset($relacao['cargo'])): ?> <?php echo e($relacao['cargo']); ?><?php endif; ?>" name="envolvido[<?php echo e($indice); ?>][cargo]" id="<?php echo e($indice); ?>cargo" placeholder="Posto/Grad.">
</div>
<div class="col-lg-2 col-md-2 col-xs 2">
    <?php if($proc == 'apfd'): ?>
    <input class="form-control" value="Acusado" readonly name="envolvido[<?php echo e($indice); ?>][resultado]" id="<?php echo e($indice); ?>cargo" placeholder="Resultado">  
    <?php else: ?>
        <select class="form-control" name="envolvido[<?php echo e($indice); ?>][resultado]">
            <?php $__currentLoopData = config('sistema.envolvido'.ucfirst($proc)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <option value="<?php echo e($r); ?>" <?php if(isset($relacao['resultado'])): ?> selected <?php endif; ?>><?php echo e($r); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    <?php endif; ?>
</div>
<div class="col-lg-1 col-md-1 col-xs 1">
    <?php if(!$unico): ?>
        <a href="javascript:removerForm('envolvido',<?php echo e($indice); ?>);"> 
        <i class="fa fa-times" style="color: red"></i>
        </a>
    <?php endif; ?> 
</div>
