<div id="image_<?php echo $id; ?>">
    <h3><?php echo __('New Image'); ?></h3>
    <table style="width:50%;">
        <tr>
            <th width="20%"><?php echo $form['caption']->renderLabel(); ?></th>
            <td><?php echo $form['caption']->render(); ?></td>
        </tr>
        <tr>
            <th width="20%"><?php echo $form['filename']->renderLabel(); ?></th>
            <td><?php echo $form['filename']->render(); ?></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><?php echo link_to_function('Delete',"$('image_".$id."').remove();"); ?></td>
        </tr>
    </table>
</div>
