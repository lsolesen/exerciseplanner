EDIT
<?php use_helper('I18N') ?>

<form action="<?php echo url_for('sfGuardAuth/register') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('register') ?>" />&nbsp;
</form>
