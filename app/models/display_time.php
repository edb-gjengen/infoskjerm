<?php 


class DisplayTime extends AppModel
{
	var $name = 'DisplayTime';

	var $belongsTo = 'Slide';
	
	function filterByDisplayTime($ids)
	{
		$timeofweek = time() - strtotime('this week midnight');
		
		$tmp = $this->find('all', array('fields'=>array('slide_id'), 'conditions'=>array('DisplayTime.slide_id'=>$ids,'DisplayTime.start <= '=>$timeofweek, 'DisplayTime.stop >= '=>$timeofweek)));
		$ids = Set::extract('/DisplayTime/slide_id', $tmp);
		return $ids;
	}
}
