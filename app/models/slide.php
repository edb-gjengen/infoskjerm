<?php
class Slide extends AppModel {

	var $name = 'Slide';

	var $hasMany = 'DisplayTime';
	public $time = null;
	
	function getActiveSlides($time = false)
	{
		if(!is_numeric($time))
			$time = time();
		
		$this->DisplayTime->getTimedSlides($time);
		
		$this->time = $time = strftime("%F %T", $time);
		
		$enabledSlides = $this->find('list',
				array('conditions'=>
					array('Slide.enabled'=>1, 
						"(Slide.start IS NULL OR Slide.start <= '$time')",
						"(Slide.stop IS NULL OR Slide.stop >= '$time')")));
		
		$enabledSlides = array_keys($enabledSlides);
		
		return $this->DisplayTime->filterByDisplayTime($enabledSlides, $time);
	}
	
	function getEnabledSlides()
	{
		return $this->find('all', array('conditions'=>array('Slide.enabled'=>1)));
	}
	
	function getDisabledSlides()
	{
		return $this->find('all', array('conditions'=>array('Slide.enabled'=>0),'order'=>array('id'=>'DESC')));
	}
}
?>
