<h1><?php echo __('Exercises List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('Created at'); ?></th>
      <th><?php echo __('Updated at'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($exercise_list as $exercise): ?>
    <tr>
      <td><a href="<?php echo url_for('exercises/edit?id='.$exercise['id']) ?>"><?php echo $exercise['Translation'][$sf_user->getCulture()]['name']; ?> - <?php echo $exercise['id']; ?></a></td>
      <td><?php echo $exercise['created_at']; ?></td>
      <td><?php echo $exercise['updated_at']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('exercises/new') ?>">New</a>
