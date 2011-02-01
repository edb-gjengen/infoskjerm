<?php 

class ResourcesController extends AppController
{
	var $name = "Resources";
	
	function beforeFilter(){
		$this->Auth->allow("*");
	}
	function get($id)
	{
		if(!is_numeric($id))
		{
			$this->Resource->data = array_shift($this->Resource->findByName($id));
			if(!$this->Resource->data )
				die;
			$this->Resource->id = $this->Resource->data['id'];
		}
		
		$type = $this->Resource->field('type');
		$path = $this->Resource->getPath();
		
		header('Content-type:' . $type);
		$content = @file_get_contents($path);
		die($content);
	}
	
	function slideshow($id)
	{
		if(!is_numeric($id))
		{
			$this->Resource->data = array_shift($this->Resource->findByName($id));
			if(!$this->Resource->data )
				die;
			$this->Resource->id = $this->Resource->data['id'];
		}
		
		$type = $this->Resource->field('type');
		if(substr($type, 0, 5) == 'image')
		{
			header('Content-type: text/html');
			?>
			<html>
			<body>
			<img src="<?php echo $this->Resource->getUrl(); ?>" style="position:absolute;left:0px;width:100%;top:0px;height:100%;"/>
			</body>
			</html>
			<?php
			die;
		}
		else
		{
			$this->get($id);	
		}
	}
	
	function thumbnail($id)
	{
		if(!file_exists($this->Resource->getThumbnail()))
		{
			system('convert -thumbnail 300x200 ' . $this->Resource->getPath() . ' ' . $this->Resource->getThumbnail());
		}
		
		header('Content-type: image/png');
		$content = @file_get_contents($this->Resource->getThumbnail());
		die($content);
	}
}