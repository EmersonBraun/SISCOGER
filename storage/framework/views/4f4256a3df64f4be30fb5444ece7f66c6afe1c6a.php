<canvas id="<?php echo $element; ?>" width="<?php echo $size['width']; ?>" height="<?php echo $size['height']; ?>">
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        (function() {
    		"use strict";
            let ctx = document.getElementById("<?php echo $element; ?>");
            window.<?php echo $element; ?> = new Chart(ctx, {
                type: '<?php echo $type; ?>',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: <?php echo json_encode($datasets); ?>

                },
                <?php if(!empty($optionsRaw)): ?>
                    options: <?php echo $optionsRaw; ?>

                <?php elseif(!empty($options)): ?>
                    options: <?php echo json_encode($options); ?>

                <?php endif; ?>
            });
        })();
    });
</script>
</canvas>
