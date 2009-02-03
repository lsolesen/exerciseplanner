<h1><?php echo __('Programs List'); ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('User'); ?></th>
      <th><?php echo __('Created at'); ?></th>
      <th><?php echo __('Updated at');?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($program_list as $program): ?>
    <tr>
      <td><a href="<?php echo url_for('programs/edit?id='.$program['id']) ?>"><?php echo $program->getName() ?></a></td>
      <td><?php echo $program->getUser()->getUsername() ?></td>

      <td><?php echo $program->getcreated_at() ?></td>
      <td><?php echo $program->getupdated_at() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('programs/new') ?>"><?php echo __('New'); ?></a>
