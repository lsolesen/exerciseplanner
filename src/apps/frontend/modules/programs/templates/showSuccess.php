<?php
    $can_edit = $program->canBeEdited($sf_user);
    $is_owner = $program->isOwner($sf_user);
?>
<h1><?php echo __('Program'); ?> - <?php echo $program['name']; ?></h1>
<table>
    <tbody>
        <tr>
            <th><label for="program_en_name">Name</label></th>
            <td><?php echo $program['name']; ?></td>
        </tr>

        <tr>
            <th><label for="program_is_shareable">Is shareable</label></th>
            <td></td>
        </tr>

        <tr>
            <th><label for="program_en_notes">Notes</label></th>
            <td><?php echo $program['notes']; ?></td>
        </tr>

        <tr>
            <th>Tags</th>
            <td><?php foreach($program->getTags(array('lang'=>$sf_user->getCulture())) as $tag) { echo $tag.'<br />'; } ?></td>
        </tr>

        <tr>
            <th valign="top">Sets</th>
            <td id="sets">
                <?php if(count($program['Sets']) == 0): ?>
                    <?php echo __('No Exercise Sets'); ?>
                <?php else: ?>
                    <?php foreach($program['Sets'] as $set): ?>
                    <div id="exercise_<?php echo $set['id']; ?>">
                        <?php if($set['otype'] == 1): ?>
                            <h3>Rep Set</h3>
                            <table>
                                <tr>
                                    <th><label for="exercise_set_exercise_id">Exercise</label></th>
                                    <td>
                                        <?php echo $set['Exercise']['name']; ?><br />
                                        <p><?php echo $set['Exercise']['description']; ?></p>
                                        <?php echo $set['Exercise']['video']; ?>
                                        <?php foreach($set['Exercise']['Images'] as $image): ?>
                                            <div><?php echo image_tag('/uploads/exercises/'.$image['filename'],array('width'=>$image['width'],'height'=>$image['height'])); ?><br /><?php echo $image['caption']; ?></div>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="exercise_set_s1">Weight</label></th>
                                    <td><?php echo $set['s1']; ?></td>
                                </tr>
                                <tr>
                                    <th><label for="exercise_set_s2">Number of Reps</label></th>
                                    <td><?php echo $set['s2']; ?></td>
                                </tr>
                            </table>
                        <?php else: ?>
                            <h3>Time Set</h3>
                            <table>
                                <tr>
                                    <th><label for="exercise_set_exercise_id">Exercise</label></th>
                                    <td>
                                        <?php echo $set['Exercise']['name']; ?><br />
                                        <p><?php echo $set['Exercise']['description']; ?></p>
                                        <?php echo $set['Exercise']['video']; ?>
                                        <?php foreach($set['Exercise']['Images'] as $image): ?>
                                            <div><?php echo image_tag('/uploads/exercises/'.$image['filename'],array('width'=>$image['width'],'height'=>$image['height'])); ?><br /><?php echo $image['caption']; ?></div>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th><label for="exercise_set_s1">Time</label></th>
                                    <td><?php echo $set['s2']; ?></td>
                                </tr>
                                <tr>
                                    <th><label for="exercise_set_s2">Misc</label></th>
                                    <td><?php echo $set['s1']; ?></td>
                                </tr>
                            </table>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>

<?php if(!$is_owner && $can_edit ): ?>
    <a href="<?php echo url_for('programs/duplicate?id='.$program['id']); ?>"><?php echo __('Duplicate'); ?></a>
<?php endif; ?>

<?php if($is_owner): ?>
    <a href="<?php echo url_for('programs/edit?id='.$program['id']); ?>"><?php echo __('Edit'); ?></a>
<?php endif; ?>