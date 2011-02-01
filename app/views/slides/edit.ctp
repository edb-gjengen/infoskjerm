<div><?php 
echo $html->link('Delete this slide', '/slides/delete/' . $this->data['Slide']['id'], array('style'=>'color:red;','onclick'=>'return confirm("Er du sikker på at du vil slette denne?");'));
?></div>
<fieldset>
<legend>Details</legend>
<?php 

echo $html->image( $this->data['Slide']['thumbnail']?$this->data['Slide']['thumbnail']:'nothumb.png');

echo $form->create();

echo $form->input('title');

echo $form->input('url');

?>
</fieldset>
<fieldset>
<legend>Start/stop</legend>
<?php
echo '<p>Skal sliden bare være synlig i et bestemt tidsintervall?</p>';

echo $form->input('start', array('class'=>'date'));
echo $form->input('stop', array('class'=>'date'));

?>
</fieldset>
<script type="text/javascript">
	$(function(){
		$(".date").datepicker({dateFormat:"yy-mm-dd 00:00:00"});
	});
</script>
<?php 
echo $form->end('Create');

?>
</fieldset>
<script type="text/javascript">
	$(function(){
		$(".date").datepicker({dateFormat:"yy-mm-dd 00:00:00"});
	});
</script>
<?php 
echo $form->end('Save');
