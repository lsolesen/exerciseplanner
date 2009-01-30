<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('Login') ?>" />&nbsp;
  <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __('Forgot your password?') ?></a>&nbsp;
  <a href="<?php echo url_for('sfGuardAuth/register') ?>"><?php echo __('Register') ?></a>
</form>