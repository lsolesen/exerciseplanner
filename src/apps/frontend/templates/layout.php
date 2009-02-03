<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
    <body>
        <?php if($sf_user->isAuthenticated()): ?>
        <div>
            <ul>
                <li><?php echo link_to(__('Muscles'),'muscles/index'); ?></li>
                <li><?php echo link_to(__('Programs'),'exerciseset/index'); ?></li>
                <li><?php echo link_to(__('Exercise Sets'),'exercises/index'); ?></li>
                <li><?php echo link_to(__('Exercises'),'exercises/index'); ?></li>
                <li><?php echo link_to(__('Logout'),'@sf_guard_signout'); ?></li>
                <li><?php echo link_to(__('Switch Language'),'sfGuardAuth/switchLanguage'); ?></li>
            </ul>
        <div>
        <?php endif; ?>

        <?php echo $sf_content ?>
    </body>
</html>
