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
      <?php echo $form; ?>
        <tr>
            <th><?php echo __('Tags'); ?></th>
            <td></td>
        </tr>
        <tr>
            <th valign="top">Sets <?php if($is_owner): ?> <?php echo link_to_remote('Add Rep Set',array('url'=>'programs/addSet?t=rep','update'=>'sets','position'=>'top')); ?>  <?php echo link_to_remote('Add Time Set',array('url'=>'programs/addSet?t=time','update'=>'sets','position'=>'top')); ?> <?php endif; ?></th>
            <td id="sets">
                <?php foreach($obj->getSets() as $set): ?>
                    <div id="exercise_<?php echo $set['id']; ?>">
                        <?php
                            switch($set['otype'])
                            {
                                case 1: //Rep
                                    include_partial('setsForm',array('form'=> new RepSetForm($set),'label'=>'Rep Set','id'=>$set['id'],'is_owner'=>$is_owner));
                                    break;
                                case 2: //Rep
                                    include_partial('setsForm',array('form'=> new TimeSetForm($set),'label'=>'Time Set','id'=>$set['id'],'is_owner'=>$is_owner));
                                    break;
                            }
                        ?>
                    </div>
                <?php endforeach; ?>
            </td>
        </tr>
    </tbody>

    <tfoot>
      <tr>
        <td>
            &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Cancel'); ?></a>
            <?php if($is_owner): ?>
                <?php if (!$obj->isNew()): ?>
                    &nbsp;<?php echo link_to('Delete', 'programs/delete?id='.$obj->getid(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                <?php endif; ?>
                <input type="submit" value="Save" />
            <?php endif; ?>
        </td>
        <td>
            <?php if(!$is_owner && $can_edit ): ?>
            <a href="<?php echo url_for('programs/duplicate?id='.$obj['id']); ?>"><?php echo __('Duplicate'); ?></a>
            <?php endif;?>

            &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Return to list'); ?></a>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
