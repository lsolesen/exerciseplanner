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
            <td><?php echo $form['en']->render(); ?></td>
        </tr>
        <tr>
            <th><?php echo $form['da']->renderLabel(); ?></th>
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
            <th><?php echo __('Tags'); ?></th>
            <td>
                <input type="text" name="exercise_tags" /><br />
                <table>
                    <tr>
                        <th align="left"><?php echo __('Tag'); ?></th>
                        <th align="left"><?php echo __('Remove'); ?></th>
                    </tr>
                    <?php foreach($form->getObject()->getTags() as $tag): ?>
                    <tr>
                        <td><?php echo $tag; ?></td>
                        <td><input type="checkbox" name="exercise_remove_tags[]" value="<?php echo $tag; ?>" /></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <th valign="top"><?php echo __('Images'); ?></th>
            <td id="images">
                <?php
                    $p_id          = $form->getObject()->get('id');
                    $embeddedForms = $form->getEmbeddedForms();
                    $max_image     = $form->getMaxImages();

                    for($x=1; $x <= $max_image; $x++)
                    {
                        $img_form = $embeddedForms['image_'.$x];
                        $obj      = $img_form->getObject();
                        $is_new   = $obj->isNew();
                        $id       = $obj->getId();
                        $filename = $obj->getFilename();
                        $key      = 'image_'.$x;

                        echo '<div id="'.$key.'">';
                        echo '<h3>'.__('Image %1%',array('%1%'=>$x)).$embeddedForms[$key]->renderGlobalErrors().'</h3>';
                        echo '<table style="width:50%;">
                            <tr>
                                <th width="20%">'.$form[$key]['en']->renderLabel().' '.$form[$key]['en']['caption']->renderLabel().'</th>
                                <td>'.$form[$key]['en']['caption']->render().'</td>
                            </tr>
                            <tr>
                                <th width="20%">'.$form[$key]['da']->renderLabel().' '.$form[$key]['da']['caption']->renderLabel().'</th>
                                <td>'.$form[$key]['da']['caption']->render().'</td>
                            </tr>

                            <tr>
                                <th width="20%">'. $form[$key]['filename']->renderLabel().'</th>
                                <td>'. $form[$key]['filename']->render().((!$is_new)?'<br /> Current Image: '.image_tag('/uploads/exercises/'.$filename):'').($form[$key]['id']->render()).'</td>
                            </tr>';
                        echo '</table></div>';
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
