<?php
class SlidesController extends AppController {

	var $name = 'Slides';
	var $scaffold;
	
	var $components = array('RequestHandler');
	
	function beforeFilter()
	{
		$this->Auth->allow("slideshow");
		$this->Auth->allow("next");
	}
	
	function index()
	{
		$enabled = $this->Slide->getEnabledSlides();
		$disabled = $this->Slide->getDisabledSlides();
		
		$this->set(compact('enabled','disabled'));
	}
	
	function enable($id)
	{
		$this->Slide->saveField('enabled', true);
		$this->Session->setFlash('Slide enabled');
		$this->redirect('index');
	}
	
	function disable($id)
	{
		$this->Slide->saveField('enabled', false);
		$this->Session->setFlash('Slide disabled');
		$this->redirect('index');
	}
	
	function timing($id)
	{
		if(!empty($this->data))
		{
			$intervals = array();
			
			$intervallength = 3 * 60 * 60;
			
			$times = $this->data['Time'];
			ksort($times);
			
			$intStart = false;
			foreach($times as $time=>$on)
			{
				if(!$on && $intStart !== false)
				{
					$intervals[] = array('start'=>$intStart, 'stop'=>$time,'slide_id'=>$id);
					$intStart = false;
				}
				else if($on && $intStart === false)
				{
					$intStart = $time;
				}
			}
			
			if($intStart !== false)
			{
				$intervals[] = array('start'=>$intStart, 'stop'=>$time + $intervallength,'slide_id'=>$id);
			}
			
			$ids = $this->Slide->DisplayTime->find('list', array('conditions'=>array('slide_id'=>$id)));
			if($ids)
			{
				$ids = array_keys($ids);
				foreach($intervals as &$interval)
				{
					$interval['id'] = array_pop($ids);
					if(!$ids)
						break;
				}
			}
			
			if($ids)
			{
				if(count($ids) == 1)
					$ids[] = '';
				$this->Slide->DisplayTime->deleteAll(array('DisplayTime.id'=>$ids));
			}
			
			$this->Slide->DisplayTime->saveAll($intervals);
			
			$this->Session->setFlash("Timing updated");
			$this->redirect('index');
		}
		else
		{
			$this->data['Slide']['id'] = $id;
			
			$display = $this->Slide->DisplayTime->find('all',array('conditions'=>array('slide_id'=>$id)));
			
			foreach($display as $d)
			{
				for($i = $d['DisplayTime']['start']; $i < $d['DisplayTime']['stop']; $i += $intervallength)
					$this->data['Time'][$i] = 1;
			}
		}
	}
	
	function delete($id)
	{
		if($this->Slide->delete($id))
		{
			$this->Session->setFlash('Slide slettet');
			$this->redirect('index');
		}
	}
	
	function setTime($time, $value)
	{
		die($this->Slide->saveField($time, $value));
	}
	
	function add()
	{
		if(isset($this->data))
		{
			
			if($this->data['Upload'])
			{
				$file = $this->data['Upload']['file'];
				
				$type = $file['type'];
				
				$first = array_shift(explode('/', $type));
				
				if(in_array($first, array('image','text','xml')))
				{
					App::import('Model','Resource');
					$Resource = new Resource();
					
					if($Resource->save($file))
					{
						move_uploaded_file($file['tmp_name'], $Resource->getPath());
						$this->data['Slide']['url'] = $Resource->getSlideshow();
						$this->data['Slide']['thumbnail'] = $Resource->getThumbnailUrl();
					}
				}
			}
			
			if(!$this->data['Slide']['start'])
				$this->data['Slide']['start'] = null;
			if(!$this->data['Slide']['stop'])
				$this->data['Slide']['stop'] = null;
			
			if($this->Slide->save($this->data))
			{
				$this->Session->setFlash('Slide opprettet');
				
				$this->Session->write("NewSlide", $this->Slide->id);
				
				$this->redirect('timing/' . $this->Slide->id);
			}
		}
	}
	
	function next()
	{
		$slides = $this->Slide->getActiveSlides();
		
		$slide = $slides[rand(0,count($slides) - 1)];
		
		$this->Slide->id = $slide;
		die($this->Slide->field('url'));
	}
	
	function slideshow()
	{
		$slides = $this->Slide->getActiveSlides();
		
		if(count($slides) == 1) $slides = array_pop($slides);
		$slides = $this->Slide->find('all', array('conditions'=>array('id'=>$slides)));
		
		if($this->RequestHandler->isAjax())
		{
			die(json_encode($slides));
		}
		
		$this->set(compact('slides'));
		
		$this->layout = 'slideshow';
	}
	
	function edit($id)
	{
		if(isset($this->data))
		{
		
			if(!$this->data['Slide']['start'])
				$this->data['Slide']['start'] = null;
			if(!$this->data['Slide']['stop'])
				$this->data['Slide']['stop'] = null;
				
			if($this->Slide->save($this->data))
			{
				$this->redirect('index');
			}
		}
		else
		{
			$this->data = $this->Slide->read();
		}
	}
}
?>
