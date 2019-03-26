
<?php if(!isset($indice)) $indice = $relacao['id_ofendido']; ?>
<input type="hidden" name="ofendido[<?php echo e($indice); ?>][id_ofendido]" value="<?php if(isset($relacao['id_ofendido'])): ?> <?php echo e($relacao['id_ofendido']); ?> <?php endif; ?>">
<input type="hidden" name="ofendido[<?php echo e($indice); ?>][id_<?php echo e($proc); ?>]" value="<?php if(isset($relacao['id_'.$proc])): ?> <?php echo e($relacao['id_'.$proc]); ?> <?php endif; ?>">
<input type="hidden" name="ofendido[<?php echo e($indice); ?>][situacao]" value='<?php echo e($situacao ?? $relacao['situacao']); ?>'>
<div class="col-lg-2 col-md-2 col-xs 2">
    RG:<br><input type="text" size='12' name="ofendido[<?php echo e($indice); ?>][rg]"
    value="<?php if(isset($relacao['rg'])): ?> <?php echo e($relacao['rg']); ?> <?php endif; ?>" class="form-control">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    Nome:<br><input type="text" size="30" name="ofendido[<?php echo e($indice); ?>][nome]"
    value="<?php if(isset($relacao['nome'])): ?> <?php echo e($relacao['nome']); ?> <?php endif; ?>" class="form-control">
</div>
<?php if($proc=="ipm"): ?>
    <div class="col-lg-3 col-md-3 col-xs 3">
    Resultado:<br>
    <select name="ofendido[<?php echo e($indice); ?>][resultado]" class="form-control">
        <?php $__currentLoopData = config('sistema.ofendidoResultado'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <option value="<?php echo e($r); ?>" <?php if(isset($relacao['resultado'])): ?> selected <?php endif; ?>><?php echo e($r); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    </div>
<?php endif; ?>
<div class="col-lg-2 col-md-2 col-xs 2">
    Sexo:<br>
    <select name="ofendido[<?php echo e($indice); ?>][resultado]" class="form-control">
        <?php $__currentLoopData = config('sistema.ofendidoSexo'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <option value="<?php echo e($r); ?>" <?php if(isset($relacao['sexo'])): ?> selected <?php endif; ?>><?php echo e($r); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<?php if($proc=="sai"): ?> 

    <div class="col-lg-2 col-md-2 col-xs 2">
    Fone:<br>
        <input size='10' maxlength='20' name='ofendido[<?php echo e($indice); ?>][fone]' type='text'
        value="<?php if(isset($relacao['fone'])): ?> <?php echo e($relacao['fone']); ?> <?php endif; ?>" class="form-control">
    </div>
    <div class="col-lg-2 col-md-2 col-xs 2">
    E-mail:<br>
        <input size='20' maxlength='40' name='ofendido[<?php echo e($indice); ?>][email]' type='text'
        value="<?php if(isset($relacao['email'])): ?> <?php echo e($relacao['email']); ?> <?php endif; ?>" class="form-control">
    </div>

<?php else: ?>
    <div class="col-lg-1 col-md-1 col-xs 1">    
    Idade:<br>
        <input size='3' maxlength='3' name='ofendido[<?php echo e($indice); ?>][idade]' type='text'
        value="<?php if(isset($relacao['nome'])): ?> <?php echo e($relacao['nome']); ?> <?php endif; ?>" class="form-control">
    </div>
    <div class="col-lg-3 col-md-3 col-xs 3">
    Escolaridade:<br>
        <select name="ofendido[<?php echo e($indice); ?>][escolaridade]" class="form-control">
            <?php $__currentLoopData = config('sistema.escolaridade'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <option value="<?php echo e($e); ?>" <?php if(isset($relacao['escolaridade'])): ?> selected <?php endif; ?>><?php echo e($e); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php endif; ?>
<?php if($proc=="sai" || $proc=="proc_outros"): ?> 
    <div class="col-lg-3 col-md-3 col-xs 3">    
    Envolvimento:<br>
    <select name="ofendido[<?php echo e($indice); ?>][situacao]" class="form-control">
        <?php $__currentLoopData = config('sistema.ofendidoSituacao'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <option value="<?php echo e($s); ?>" <?php if(isset($relacao['situacao'])): ?> selected <?php endif; ?>><?php echo e($s); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php endif; ?>
</div>
<?php if(!$unico): ?>
<div class="col-lg-1 col-md-1 col-xs 1">
<br>
    <a href="javascript:removerForm('ofendido',<?php echo e($indice); ?>);"> 
    <i class="fa fa-times" style="color: red"></i>
    </a>
</div> 
<?php endif; ?>

