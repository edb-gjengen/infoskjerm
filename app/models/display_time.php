<?php 


class DisplayTime extends AppModel
{
	var $name = 'DisplayTime';

	var $belongsTo = 'Slide';
	
	function getActiveSlideIds()
	{
		$tmp = $this->find('all', array('fields'=>array('slide_id'), 'conditions'=>array('DisplayTime.start <= '=>time(), 'DisplayTime.stop >= '=>time())));
		$ids = Set::extract('/DisplayTime/slide_id', $tmp);
		return $ids;
	}
}