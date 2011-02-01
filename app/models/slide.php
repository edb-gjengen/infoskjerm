<?php
class Slide extends AppModel {

	var $name = 'Slide';

	var $hasMany = 'DisplayTime';
	
	function getActiveSlides()
	{
		$enabledSlides = $this->find('list',
				array('conditions'=>
					array('Slide.enabled'=>1, 
						'(Slide.start IS NULL OR Slide.start <= now())',
						'(Slide.stop IS NULL OR Slide.stop >= now())')));
		
		$enabledSlides = array_keys($enabledSlides);
		
		return $this->DisplayTime->filterByDisplayTime($enabledSlides);
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
