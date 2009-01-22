<h1>Muscles List</h1>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Insertio</th>
      <th>Origio</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($muscle_list as $muscle): ?>
    <tr>
      <td><a href="<?php echo url_for('muscles/edit?id='.$muscle['id']) ?>"><?php echo $muscle->getname() ?></a></td>
      <td><?php echo $muscle->getinsertio() ?></td>
      <td><?php echo $muscle->getorigio() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('muscles/new') ?>">New</a>
