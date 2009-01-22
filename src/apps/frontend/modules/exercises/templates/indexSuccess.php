<h1>Exercises List</h1>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($exercise_list as $exercise): ?>
    <tr>
      <td><a href="<?php echo url_for('exercises/edit?id='.$exercise['id']) ?>"><?php echo $exercise->getname() ?></a></td>
      <td><?php echo $exercise->getcreated_at() ?></td>
      <td><?php echo $exercise->getupdated_at() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('exercises/new') ?>">New</a>
