<h1>Exercisesets List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Otype</th>
      <th>S1</th>
      <th>I1</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($exercise_set_list as $exercise_set): ?>
    <tr>
      <td><a href="<?php echo url_for('exercisesets/edit?id='.$exercise_set['id']) ?>"><?php echo $exercise_set->getid() ?></a></td>
      <td><?php echo get_class($exercise_set); ?></td>
      <td><?php echo $exercise_set->gets1() ?></td>
      <td><?php echo $exercise_set->geti1() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('exercisesets/newRep') ?>"><?php echo __('New Rep Set')?></a>&nbsp;
  <a href="<?php echo url_for('exercisesets/newTime') ?>"><?php echo __('New Time Set')?></a>
