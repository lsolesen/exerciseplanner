<?php
    include_stylesheets_for_form($form);
    include_javascripts_for_form($form);
    use_helper('Javascript');
    $obj      = $form->getObject();
    $can_edit = $obj->canBeEdited($sf_user);
    $is_owner = $obj->isOwner($sf_user);
?>
<?php if($can_edit): ?>
<form action="<?php echo url_for('programs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getid() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php endif; ?>

<?php if (!$obj->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
    <tr><th><?php echo $form['en']->renderLabel(); ?></th><td><?php echo $form['en']; ?></td></tr>
    <tr><th><?php echo $form['da']->renderLabel(); ?></th><td><?php echo $form['da']; ?></td></tr>
    <tr><th><?php echo $form['is_shareable']->renderLabel(); ?></th><td><?php echo $form['is_shareable']; ?></td></tr>

    <tr>
        <th valign="top"><?php if($is_owner || $obj->isNew()): ?> <?php echo link_to_remote('Add Rep Set',array('url'=>'programs/addSet?t=rep','update'=>'sets','position'=>'top')); ?>  <?php echo link_to_remote('Add Time Set',array('url'=>'programs/addSet?t=time','update'=>'sets','position'=>'top')); ?> <?php endif; ?></th>
        <td id="sets">
            <?php
                $p_id          = $form->getObject()->get('id');

                foreach($form['exercise_lists'] as $key => $setForm)
                {
                    // TODO find a better way to get the id?
                    $id = explode('_',$key);
                    echo '<div id="'.$key.'">';
                    echo '<h3>'.$form['exercise_lists'][$key]->renderLabel().'</h3>';

                    echo '<table style="width:50%;">
                        <tr>
                            <th width="20%">'.$form['exercise_lists'][$key]['exercise_id']->renderLabel().'</th>
                            <td>'. $form['exercise_lists'][$key]['exercise_id']->render().'</td>
                        </tr>
                        <tr>
                            <th width="20%">'. $form['exercise_lists'][$key]['s1']->renderLabel().'</th>
                            <td>'. $form['exercise_lists'][$key]['s1']->render().'</td>
                        </tr>
                        <tr>
                            <th width="20%">'. $form['exercise_lists'][$key]['s2']->renderLabel().'</th>
                            <td>'. $form['exercise_lists'][$key]['s2']->render().'</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">'.$form['exercise_lists'][$key]['otype']->render().$form['exercise_lists'][$key]['id']->render();

                    echo link_to_remote('Delete',array('url'=>'programs/removeSet?id='.$id[2].'&program_id='.$p_id,'confirm'=>__('This action is not reversable. Are you sure?'),'update'=>'data','after'=>"$('".$key."').remove();"));

                    echo '</td></tr>
                    </table></div>';
                }
            ?>
        </td>
    </tr>
        <tr>
            <th><?php echo __('Tags'); ?></th>
            <td>
                <input type="text" name="program_tags" /><br />
                <table>
                    <tr>
                        <th align="left"><?php echo __('Tag'); ?></th>
                        <th align="left"><?php echo __('Remove'); ?></th>
                    </tr>
                    <?php foreach($form->getObject()->getTags(array('lang'=>$sf_user->getCulture())) as $tag): ?>
                    <tr>
                        <td><?php echo $tag; ?></td>
                        <td><input type="checkbox" name="program_remove_tags[]" value="<?php echo $tag; ?>" /></td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </td>
        </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
            &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Cancel'); ?></a>

            <?php if($is_owner || $obj->isNew()): ?>
                <?php if (!$obj->isNew()): ?>
                    &nbsp;<?php echo link_to('Delete', 'programs/delete?id='.$obj->getid(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                <?php endif; ?>
                <input type="submit" value="Save" />
            <?php endif; ?>
        </td>
        <td>
            <?php if(!$is_owner && $can_edit && !$obj->isNew()): ?>
            <a href="<?php echo url_for('programs/duplicate?id='.$obj['id']); ?>"><?php echo __('Duplicate'); ?></a>
            <?php endif;?>

            &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Return to list'); ?></a>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
