<h1><?php echo __('Exercises List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('Is Shareable'); ?></th>
      <th><?php echo __('Creator'); ?></th>
      <th><?php echo __('Owner'); ?></th>
      <th><?php echo __('Created at'); ?></th>
      <th><?php echo __('Updated at'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($exercise_list as $exercise): ?>
    <tr>
      <td><a href="<?php echo url_for('exercises/show?id='.$exercise['id']) ?>"><?php echo $exercise['name']; ?></a></td>
      <td><?php echo ($exercise['is_shareable'])?__('Yes'):__('No'); ?></td>
      <td><?php echo $exercise['Creator']; ?>
      <td><?php echo $exercise['Owner']; ?>
      <td><?php echo $exercise['created_at']; ?></td>
      <td><?php echo $exercise['updated_at']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('exercises/new') ?>">New</a>
