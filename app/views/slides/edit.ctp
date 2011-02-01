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

echo '<p>La feltet stå tomt for å ikke ha noe spesielt start/stopp tidspunkt</p>';


echo '<div id="simplebox">';
echo $form->label('simple','Use simple timing:');
echo $form->checkbox('simple');
echo '</div>';

echo $form->hidden('DisplayTime.0.id');
echo $form->hidden('DisplayTime.0.slide_id');
echo $form->input('DisplayTime.0.start', array('class'=>'date'));
echo $form->input('DisplayTime.0.stop', array('class'=>'date'));

?>
</fieldset>
<script type="text/javascript">
	$(function(){
		$(".date").datepicker({dateFormat:"yy-mm-dd 00:00:00",
					onSelect:function(){
						if(!$("#SlideSimple").attr('checked')){
							$("#SlideSimple").attr('checked', true);
							//$("#simplebox").effect('bounce',250);
						}
					}});
	});
</script>
<?php 
echo $form->end('Save');
