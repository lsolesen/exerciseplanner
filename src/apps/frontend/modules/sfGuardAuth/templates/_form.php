<?php
include_stylesheets_for_form($form);
include_javascripts_for_form($form);
use_helper('Javascript');

?>
<form action="<?php echo url_for('sfGuardAuth/password') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<table>
    <tbody>
    <?php echo $form; ?>
    </tbody>
    <tfoot>
        <tr>
            <td>
                &nbsp;<a href="<?php echo url_for('@homepage') ?>"><?php echo __('Cancel'); ?></a>
                <input type="submit" value="<?php echo __('Submit'); ?>" />
            </td>
        </tr>
    </tfoot>
</table>
</form>
