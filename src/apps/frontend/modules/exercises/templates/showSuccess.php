<?php
    $can_edit = $exercise->canBeEdited($sf_user);
    $is_owner = $exercise->isOwner($sf_user);
?>
<h1>Exercise - <?php echo $exercise['name']; ?></h1>
<table>
    <tbody>
        <tr>
            <th><label for="exercise_en_name">Name</label></th>
            <td><?php echo $exercise['name']; ?></td>
        </tr>
        <tr>
            <th><label for="exercise_en_description">Description</label></th>
            <td><?php echo $exercise['description']; ?></td>
        </tr>
        <tr>
            <th><label for="exercise_is_shareable">Is shareable</label></th>
            <td><?php echo ($exercise['is_shareable']) ? __('Yes'):__('No'); ?></td>
        </tr>

        <tr>
            <th><label for="exercise_owner">Owner</label></th>
            <td><?php echo $exercise['Owner']; ?></td>
        </tr>

        <tr>
            <th><label for="exercise_owner">Creator</label></th>
            <td><?php echo $exercise['Creator']; ?></td>
        </tr>

        <tr>
            <th><label for="exercise_exercises_list">Related Exercises</label></th>
            <td><?php if(count($exercise['Exercises']) == 0): ?>
                    <?php echo __('None'); ?>
                <?php else: ?>
                    <?php foreach($exercise['Exercises'] as $rexercise): ?>
                        <?php echo $rexercise['name']; ?><br />
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="exercise_muscles_list">Related Muscles</label></th>
            <td><?php if(count($exercise['Muscles']) == 0): ?>
                    <?php echo __('None'); ?>
                <?php else: ?>
                    <?php foreach($exercise['Muscles'] as $muscle): ?>
                        <?php echo $muscle['name']; ?><br />
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td />
            <td>
                <?php if(count($exercise['Images']) == 0): ?>
                    <?php echo __('No Images'); ?>
                <?php else: ?>
                    <?php foreach($exercise['Images'] as $image): ?>
                        <div>
                        <?php echo image_tag('/uploads/exercises/'.$image['filename']); ?><br /><?php echo $image['caption']; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th><label for="exercise_en_video">Video</label></th>
            <td><?php echo $exercise['video']; ?></td>
        </tr>
    </tbody>
</table>
<?php if(!$is_owner && $can_edit ): ?>
    <a href="<?php echo url_for('exercises/duplicate?id='.$exercise_id); ?>"><?php echo __('Duplicate'); ?></a>
<?php endif; ?>

<?php if($is_owner): ?>
    <a href="<?php echo url_for('exercises/edit?id='.$exercise_id); ?>"><?php echo __('Edit'); ?></a>
<?php endif; ?>
