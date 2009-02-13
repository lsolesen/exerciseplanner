<h1><?php echo __('Exercise Sets List'); ?></h1>

<table>

  <tbody>
    <?php $last_otype = -1; ?>
    <?php foreach ($exercise_set_list as $exercise_set): ?>

    <?php
        if($last_otype != $exercise_set['otype'])
        {
            $last_otype = $exercise_set['otype'];
            echo '<tr>';
                foreach($labels[$last_otype] as $field => $label)
                    echo '<th>'.$label.'</th>';

            echo '</tr>';
        }
    ?>
    <tr>
      <td><a href="<?php echo url_for('exercisesets/edit?id='.$exercise_set['id']) ?>"><?php echo $exercise_set->getid() ?></a></td>
      <td><?php echo $exercise_set->gets1() ?></td>
      <td><?php echo $exercise_set->geti1() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>

</table>
<br />
  <a href="<?php echo url_for('exercisesets/newRep') ?>"><?php echo __('New Rep Set')?></a>&nbsp;
  <a href="<?php echo url_for('exercisesets/newTime') ?>"><?php echo __('New Time Set')?></a>
