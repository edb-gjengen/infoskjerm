<style>
#left
{
	float:left;
	width:50%;
}

#right
{
	float:left;
	width:50%;
}
</style>
<div>
<?php echo $html->link('Add new slide', '/slides/add') ?> 
<?php echo $html->link('Logout', '/users/logout', array('style'=>'float:right;')) ?>
</div>
<div id="left">
<h2>Active slides</h2>
<ul>
<?php foreach($enabled as $slide): ?>
	<li id="Slide<?php echo $slide['Slide']['id'] ?>">
		<h3><?php echo $slide['Slide']['title']; ?></h3>
		<p>
			<?php echo $html->link('Edit', '/slides/edit/' . $slide['Slide']['id']) ?>
			<?php echo $html->link('Set timing', '/slides/timing/' . $slide['Slide']['id']) ?>
			<?php echo $html->link('Disable', '/slides/disable/' . $slide['Slide']['id']) ?>
		</p>
		<img src="<?php echo $slide['Slide']['thumbnail']?$slide['Slide']['thumbnail']:Router::url('/img/nothumb.png')?>" />
	</li>
<?php endforeach; ?>
</ul>
</div>
<div id="right">
<h2>Disabled slides</h2>
<ul>
<?php foreach($disabled as $slide): ?>
	<li id="Slide<?php echo $slide['Slide']['id'] ?>">
		<h3><?php echo $slide['Slide']['title']; ?></h3>
		<p>
			<?php echo $html->link('Edit', '/slides/edit/' . $slide['Slide']['id']) ?>
			<?php echo $html->link('Set timing', '/slides/timing/' . $slide['Slide']['id']) ?>
			<?php echo $html->link('Enable', '/slides/enable/' . $slide['Slide']['id']) ?>
		</p>
		<img src="<?php echo $slide['Slide']['thumbnail']?$slide['Slide']['thumbnail']:Router::url('/img/nothumb.png')?>" />
	</li>
<?php endforeach; ?>
</ul>
</div>

<script type="text/javascript">
<?php if($newslide = $this->Session->read('NewSlide')):
$this->Session->delete('NewSlide');?>
$(function(){
	$("#Slide<?php echo $newslide ?>").effect("bounce",250);
});
<?php endif; ?>
</script>
