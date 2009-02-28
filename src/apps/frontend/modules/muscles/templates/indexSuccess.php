<h1><?php echo __('Muscles List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('Insertion'); ?></th>
      <th><?php echo __('Origin'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($muscle_list as $muscle): ?>
    <tr>
      <td><a href="<?php echo url_for('muscles/edit?id='.$muscle['id']) ?>"><?php echo $muscle->getname() ?></a></td>
      <td><?php echo $muscle->getinsertion() ?></td>
      <td><?php echo $muscle->getorigin() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($sf_user->isAuthenticated()): ?>
  <p><a href="<?php echo url_for('muscles/new') ?>"><?php echo ('New'); ?>></a></p>
<?php endif; ?>