<div id="exercise_<?php echo $id; ?>">
    <h3><?php echo $label ?></h3>

    <table style="width:50%;">
        <tr>
            <th width="20%"><?php echo $form['exercise_id']->renderLabel(); ?></th>
            <td><?php echo $form['exercise_id']->render(); ?></td>
        </tr>
        <tr>
            <th width="20%"><?php echo $form['s1']->renderLabel(); ?></th>
            <td><?php echo $form['s1']->render(); ?></td>
        </tr>
        <tr>
            <th width="20%"><?php echo $form['s2']->renderLabel(); ?></th>
            <td><?php echo $form['s2']->render(); ?></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <?php echo $form['otype']->render().$form['id']->render(); ?>
                <?php echo link_to_function('Remove',"$('exercise_".$id."').remove();"); ?>
            </td>
        </tr>
    </table>
</div>