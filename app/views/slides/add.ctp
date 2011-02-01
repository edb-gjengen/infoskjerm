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

echo '<p>Skal sliden bare være synlig i et bestemt tidsintervall?</p>';

echo $form->input('start', array('type'=>'text','class'=>'date'));
echo $form->input('stop', array('type'=>'text','class'=>'date'));

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
