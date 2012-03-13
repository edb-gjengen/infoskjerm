<?php 


class DisplayTime extends AppModel
{
	var $name = 'DisplayTime';

	var $belongsTo = 'Slide';
	
	
	function getTimedSlides($time)
	{
		$timestr = strftime("%F %T", $time);
		
		$monday = (strftime('%u', $time) == 1?7*24*3600:0)  + 
								strtotime('last week monday midnight', $time);
		
		$timeofweek = $time - $monday;
		
		$tmp = $this->find('all', array('recursive'=>1, 'conditions'=>array('Slide.enabled'=>1, 
						"(Slide.start IS NULL OR Slide.start <= '$timestr')",
						"(Slide.stop IS NULL OR Slide.stop >= '$timestr')", '
						DisplayTime.start <= '=>$timeofweek, 
						'DisplayTime.stop >= ' => $timeofweek) ) );
		
		return Set::extract('/DisplayTime/slide_id', $tmp);
	}
	
	function filterByDisplayTime($ids)
	{
		$timeofweek = time() - strtotime('this week midnight');
		
		$tmp = $this->find('all', array('fields'=>array('slide_id'), 'conditions'=>array('DisplayTime.slide_id'=>$ids,'DisplayTime.start <= '=>$timeofweek, 'DisplayTime.stop >= '=>$timeofweek)));
		
		$ids = Set::extract('/DisplayTime/slide_id', $tmp);
		return $ids;
	}
}
