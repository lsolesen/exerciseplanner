<h1><?php echo __('Programs List'); ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo __('Name'); ?></th>
      <th><?php echo __('Number of Exercises'); ?></th>
      <th><?php echo __('Owner'); ?></th>
      <th><?php echo __('Creator'); ?></th>
      <th><?php echo __('Created at'); ?></th>
      <th><?php echo __('Updated at');?></th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($program_list as $program): ?>
    <tr>
<!--      <td><a href="<?php echo ($program->CanBeEdited($sf_user)) ? url_for('programs/edit?id='.$program['id']):'programs/show?id='.$program['id']; ?>"><?php echo $program->getName(); ?></a></td>-->
      <td><a href="<?php echo url_for('programs/show?id='.$program['id']); ?>"><?php echo $program->getName(); ?></a></td>
      <td><?php echo $program['num_exercises'];; ?></td>
      <td><?php echo (isset($program['Owner'])) ? $program['Owner']['username']: __('N/A'); ?></td>
      <td><?php echo (isset($program['Creator'])) ? $program['Creator']['username']: __('N/A'); ?></td>
      <td><?php echo $program->getcreated_at() ?></td>
      <td><?php echo $program->getupdated_at() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($sf_user->isAuthenticated()): ?>
<p><a href="<?php echo url_for('programs/new') ?>"><?php echo __('New'); ?></a></p>
<?php endif; ?>
