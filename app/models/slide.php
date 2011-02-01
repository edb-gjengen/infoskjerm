<?php
class Slide extends AppModel {

	var $name = 'Slide';

	var $hasMany = 'DisplayTime';

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