<h3><?php echo $label ?></h3>
<table>
    <?php echo $form; ?>
    <?php if($is_owner): ?>
    <tr>
        <td colspan="2" align="right"><?php echo ( ($form->getObject()->getId() == $id ? link_to_remote('Delete',array('url'=>'programs/removeSet?id='.$id.'&program_id='.$form->getObject()->get('program_id'),'confirm'=>__('This action is not reversable. Are you sure?'),'update'=>'data','after'=>"$('exercise_".$id."').remove();")) : link_to_function('Delete',"$('exercise_".$id."').remove();"))); ?></td>
    </tr>
    <?php endif;?>
</table>