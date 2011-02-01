<?php 
echo $form->create(null, array('type'=>'file'));
echo $form->input('title');

?>
<fieldset>
<legend>Content</legend>
<h3>Enter url</h3><?php 
echo $form->input('url');
?><h3>or upload file</h3><?php 
echo $form->file('Upload.file');
?>
<p>Filene kjøres direkte i browseren, og den støtter vanlige bildeformater, html, tekstfiler og SVG :)</p>
</fieldset>
<fieldset>
<legend>Start/stop</legend>
<?php

echo '<p>La feltet stå tomt for å ikke ha noe spesielt start/stopp tidspunkt</p>';


echo '<div id="simplebox">';
echo $form->label('simple','Use simple timing:');
echo $form->checkbox('simple');
echo '</div>';

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
echo $form->end('Create');

?>