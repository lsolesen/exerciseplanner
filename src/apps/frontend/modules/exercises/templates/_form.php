<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('exercises/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getid() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['en']->renderLabel() ?></th>
        <td>
          <?php echo $form['en']->renderError() ?>
          <?php echo $form['en'] ?>
        </td>
      </tr>

     <tr>
        <th><?php echo $form['da']->renderLabel() ?></th>
        <td>
          <?php echo $form['da']->renderError() ?>
          <?php echo $form['da'] ?>
        </td>
      </tr>

      <tr>
        <th><?php echo $form['exercises_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['exercises_list']->renderError() ?>
          <?php echo $form['exercises_list'] ?>
        </td>
      </tr>

      <tr>
        <th><?php echo $form['muscles_list']->renderLabel() ?></th>
        <td>
          <?php echo $form['muscles_list']->renderError() ?>
          <?php echo $form['muscles_list'] ?>
        </td>
      </tr>

      <tr>
        <th>Created</th>
        <td><?php echo $form->getObject()->getcreated_at(); ?></td>
      </tr>
      <tr>
        <th>Modified</th>
        <td><?php echo $form->getObject()->getupdated_at(); ?></td>
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
