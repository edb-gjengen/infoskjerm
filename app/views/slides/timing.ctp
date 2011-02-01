<?php
echo $form->create();
echo $form->hidden('id');

echo $form->submit('Save');
echo '<div>';
echo $html->link('Check/uncheck all','#',array('id'=>'toggleall')) . ' ';
echo $html->link('Revert current changes','/slides/timing/' . $this->data['Slide']['id'],array('id'=>'revert'));
echo '</div>';
$tittel = array('9'=>'Uke 32','16'=>'Uke 33','23'=>'Uke 34','30'=>'Uke 35');

?>
<div style="width:40%;float:left;margin:10px;clear:none;">
<h2>Ukesoversikt</h2>
	<table>
		<tr>
			<th>Tid</th>
			<th class="day"><?php echo implode('</th><th class="day">',array('Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag','Søndag')) ?></th>
		</tr>
<?php for($j = 0; $j < 24; $j+= 3): ?>
		<tr>
			<th class="time"><?php echo "$j:00- " . ($j + 3) . ":00" ?></th>
<?php for($k = 0; $k < 7; $k++): $tid = ($weekstart + $k * 24 * 60 * 60 + $j * 60 * 60); ?>
			<td<?php if(@$this->data['Time'][$tid]) echo ' class="selected org"' ?>><?php echo $form->checkbox('Time.' . $tid) ?></td>
<?php endfor; ?>
		</tr>
<?php endfor; ?>
	</table>
</div>


<div style="clear:both;">
	<?php echo $form->submit("Save"); 
	echo $form->end();?>
</div>

<style>
	.selected
	{
		background-color:yellow !important;
	}
	
	th
	{
		 width:1px;
		 font-size:smaller;
		 border:0px;
	}
</style>
<script type="text/javascript">
var mousedown = false;
var isToggled = false;
$(function() {
		$("td").live('mousedown',
					function(event){
						if(event.which == 1)
						{
							mousedown = true;
							$(this).toggleClass("selected");
							isToggeled = $(this).hasClass("selected");
							$("input", this).attr('checked' ,isToggeled);
							return false;
						}
				}).live('mouseenter',
					function(event){
						if(mousedown)
						{
							if(isToggeled)
								$(this).addClass("selected");
							else
								$(this).removeClass("selected");
							$("input", this).attr('checked' ,isToggeled);
						}
					});
		$("th").live("click", function()
				{
					$(this).toggleClass("selected");
					var isToggeled = $(this).hasClass("selected");
					
					if($(this).hasClass("time"))
					{
						var tds = $(this).parent().children("td");
						if(isToggeled)
							tds.addClass("selected");
						else
							tds.removeClass("selected");
						tds.children("input").attr('checked', isToggeled);
					}
					else if($(this).hasClass("day"))
					{
						var index = $(this).parent().children().index(this) - 1;

						var tds = $("table").has(this).find("tr").find("td:eq(" + index + ")");
						
						if(isToggeled)
							tds.addClass("selected");
						else
							tds.removeClass("selected");
						
						tds.children("input").attr('checked', isToggeled);
					}
					else
					{
						var tds = $("table").has(this).find("td");
						
						if(isToggeled)
							tds.addClass("selected");
						else
							tds.removeClass("selected");
						
						tds.children("input").attr('checked', isToggeled);
					}
					return false;
				});
		$(document).mouseup(function(){mousedown=false;});
		
	$("td input:checkbox").hide();
	
	$("#toggleall").click(function(){
		var isToggeled = $("td input:checked").length == 0;

		var tds = $("td");
		
		if(isToggeled)
			tds.addClass("selected");
		else
			tds.removeClass("selected");
		
		tds.children("input").attr('checked', isToggeled);
		
		return false;
	});
	
	$("#revert").click(function(){
		$("td input").attr('checked',false);
		$("td").removeClass("selected");

		$("td.org").addClass("selected");
		$("td.selected input").attr('checked',true);

		return false;
	});
});

</script>
