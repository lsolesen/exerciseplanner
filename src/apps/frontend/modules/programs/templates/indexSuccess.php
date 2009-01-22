<h1>Programs List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Sf guard user</th>
      <th>Name</th>
      <th>Notes</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($program_list as $program): ?>
    <tr>
      <td><a href="<?php echo url_for('programs/edit?id='.$program['id']) ?>"><?php echo $program->getid() ?></a></td>
      <td><?php echo $program->getsf_guard_user_id() ?></td>
      <td><?php echo $program->getname() ?></td>
      <td><?php echo $program->getnotes() ?></td>
      <td><?php echo $program->getcreated_at() ?></td>
      <td><?php echo $program->getupdated_at() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('programs/new') ?>">New</a>
