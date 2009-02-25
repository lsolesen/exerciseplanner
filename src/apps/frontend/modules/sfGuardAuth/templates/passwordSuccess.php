<h1><?php echo __('Forgotten Password'); ?></h1>

<?php if( !$sf_user->hasFlash('notice') ): ?>
    <?php include_partial('form', array('form' => $form)) ?>
<?php else: ?>
    <?php echo __($sf_user->getFlash('notice')); ?>
<?php endif; ?>
