<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
    <body>
        <h1 id="title"><?php echo __('Workout planner'); ?></h1>
        <div>
            <ul>
        <?php if($sf_user->isAuthenticated()): ?>
                <li><?php echo link_to(__('Logout'),'@sf_guard_signout'); ?> (<?php echo $sf_user->getGuardUser()->getUsername(); ?>)</li>
                <li><?php echo link_to(__('My Profile'),'sfGuardAuth/edit'); ?></li>
                <li><?php echo link_to(__('Muscles'),'muscles/index'); ?></li>
        <?php else: ?>
                <li><?php echo link_to(__('Login'),'@sf_guard_signin'); ?></li>
        <?php endif; ?>
                <li><?php echo link_to(__('Programs'),'programs/index'); ?></li>
                <li><?php echo link_to(__('Exercises'),'exercises/index'); ?></li>
                <li><?php echo link_to(__('Switch Language'),'sfGuardAuth/switchLanguage'); ?></li>
            </ul>
        </div>

        <?php echo $sf_content ?>
    </body>
</html>
