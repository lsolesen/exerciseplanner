<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_helper('Javascript') ?>

<form action="<?php echo url_for('programs/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getid() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
      <?php echo $form; ?>
        <tr>
            <th valign="top">Sets <?php echo link_to_remote('Add Rep Set',array('url'=>'programs/addSet?t=rep&p_id='.$form->getObject()->getId(),'update'=>'sets','position'=>'top')); ?>  <?php echo link_to_remote('Add Time Set',array('url'=>'programs/addSet?t=time&p_id='.$form->getObject()->getId(),'update'=>'sets','position'=>'top')); ?></th>
            <td id="sets">
                <?php foreach($form->getObject()->getSets() as $set): ?>
                    <div>
                        <?php
                            switch($set['otype'])
                            {
                                case 1: //Rep
                                    include_partial('setsForm',array('form'=> new RepSetForm($set),'label'=>'Rep Set'));
                                    break;
                                case 2: //Rep
                                    include_partial('setsForm',array('form'=> new TimeSetForm($set),'label'=>'Time Set'));
                                    break;
                            }
                        ?></div>
                <?php endforeach; ?>
            </td>
        </tr>
    </tbody>

    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Cancel'); ?></a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'programs/delete?id='.$form->getObject()->getid(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          &nbsp;<a href="<?php echo url_for('programs/index') ?>"><?php echo __('Return to list'); ?></a>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
