<?php
    include_stylesheets_for_form($form);
    include_javascripts_for_form($form);
    $obj      = $form->getObject();
    $can_edit = $obj->canBeEdited($sf_user);
    $is_owner = $obj->isOwner($sf_user);
?>

<form action="<?php echo url_for('exercises/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getid() : '')) ?>" method="post" enctype="multipart/form-data">
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php echo $form->renderGlobalErrors(); ?>
  <table border="1">
    <tbody>
        <tr>
            <th><?php echo $form['en']->renderLabel(); ?></th>
            <td><?php echo $form['da']->render(); ?></td>
        </tr>
        <tr>
            <th><?php echo $form['en']->renderLabel(); ?></th>
            <td><?php echo $form['da']->render(); ?></td>
        </tr>
        <tr>
            <th><?php echo $form['is_shareable']->renderLabel(); ?></th>
            <td><?php echo $form['is_shareable']->render(); ?></td>
        </tr>
        <tr>
            <th><?php echo $form['exercises_list']->renderLabel(); ?></th>
            <td><?php echo $form['exercises_list']->render(); ?></td>
        </tr>
        <tr>
            <th><?php echo $form['muscles_list']->renderLabel(); ?></th>
            <td><?php echo $form['muscles_list']->render(); ?></td>
        </tr>
        <tr>
            <th valign="top"><?php echo __('Images'); ?> <?php if($is_owner || $obj->isNew()): ?> <?php echo link_to_remote('Add Image',array('url'=>'exercises/addImage','update'=>'images','position'=>'top')); ?><?php endif; ?></th>
            <td id="images">
            <?php
                $p_id = $form->getObject()->get('id');

                foreach($form['images'] as $key => $imageForm)
                {
                    // TODO find a better way to get the id?
                    $id = explode('_',$key);
                    echo '<div id="'.$key.'">';
                    echo '<h3>'.$form['images'][$key]->renderLabel().'</h3>';

                    echo '<table style="width:50%;">
                        <tr>
                            <th width="20%">'.$form['images'][$key]['caption']->renderLabel().'</th>
                            <td>'. $form['images'][$key]['caption']->render().'</td>
                        </tr>
                        <tr>
                            <th width="20%">'. $form['images'][$key]['filename']->renderLabel().'</th>
                            <td>'. $form['images'][$key]['filename']->render().'</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right">';

                    echo link_to_remote('Delete',array('url'=>'programs/removeSet?id='.$id[2].'&owner_id='.$p_id,'confirm'=>__('This action is not reversable. Are you sure?'),'update'=>'data','after'=>"$('".$key."').remove();"));

                    echo '</td></tr>
                    </table></div>';
                }
            ?>
            </td>
        </tr>

    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="<?php echo url_for('exercises/index') ?>">Cancel</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'exercises/delete?id='.$form->getObject()->getid(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
          &nbsp;<a href="<?php echo url_for('exercises/index') ?>">Return to List</a>
        </td>
      </tr>
    </tfoot>

  </table>
</form>
