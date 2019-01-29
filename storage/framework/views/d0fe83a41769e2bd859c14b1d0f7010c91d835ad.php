
<?php if(!isset($indice)) $indice = $relacao['id_ligacao']; ?>
<input type="hidden" name="ligacao[<?php echo e($indice); ?>][id_ligacao]" value="<?php if(isset($relacao['id_ligacao'])): ?> <?php echo e($relacao['id_ligacao']); ?> <?php endif; ?>">
    <div class="col-lg-3 col-md-3 col-xs 3">
		<?php if(isset($relacao['origem_proc'])): ?> 
		<input type="hidden" name="ligacao[<?php echo e($indice); ?>][origem_proc]" value="<?php echo e($relacao['id_ligacao']); ?>">
		<?php else: ?>
			<select id="proc<?php echo e($indice); ?>" name="ligacao[<?php echo e($indice); ?>][origem_proc]" class="form-control">
			<option value=''>Escolha</option>
				<?php $__currentLoopData = config('sistema.pocedimentosOpcoes'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
					
					
					<?php if($proc=="apfd"): ?>
						<option value='apfdc'>apfd comum</option>
						<option value='apfdm'>apfd militar</option>
					<?php else: ?> 
						<option value='<?php echo e($proc); ?>'><?php echo e($proc); ?></option>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		<?php endif; ?>
	</div>
    <div class="col-lg-2 col-md-2 col-xs 2">
		<input class="numero form-control" id="ref<?php echo e($indice); ?>" onchange="ajaxLigacao('<?php echo e($indice); ?>')"
		type="text" maxlength='4' name="ligacao[<?php echo e($indice); ?>][origem_sjd_ref]" placeholder="Nº"
		value="<?php if(isset($relacao['origem_sjd_ref'])): ?> <?php echo e($relacao['origem_sjd_ref']); ?> <?php endif; ?>" >
    </div>
    <div class="col-lg-3 col-md-3 col-xs 3">
        <input class="numero form-control" id="ano<?php echo e($indice); ?>" onchange="ajaxLigacao('<?php echo e($indice); ?>')"
		type="text" maxlength='4' name="ligacao[<?php echo e($indice); ?>][origem_sjd_ref_ano]" placeholder="Ano com 4 digitos"
		value="<?php if(isset($relacao['origem_sjd_ref_ano'])): ?> <?php echo e($relacao['origem_sjd_ref_ano']); ?> <?php endif; ?>">
	</div>
    <div class="col-lg-3 col-md-3 col-xs 3">
		<input id="opm<?php echo e($indice); ?>" readonly type='text' size='35' name="ligacao[<?php echo e($indice); ?>][origem_opm]" placeholder="Apenas para conferência"
		value="<?php if(isset($relacao['origem_opm'])): ?> <?php echo e($relacao['origem_opm']); ?> <?php endif; ?>" class="form-control">
	</div>
    <div class="col-lg-1 col-md-1 col-xs 1">
        <a href="javascript:removerForm('ligacao',<?php echo e($indice); ?>);"><i class="fa fa-times" style='color: red'></i></a>
	</div>

	</tr>
</tbody>
</table>