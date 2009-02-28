<h1><?php echo __('Register'); ?></h1>

<form action="<?php echo url_for('sfGuardAuth/edit') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('register') ?>" />&nbsp;
</form>
