<?php 

class Resource extends AppModel
{
	var $name = 'Resource';
	
	function getPath()
	{
		return TMP . 'slides/res_' . $this->id;
	}
	
	function getUrl()
	{
		return Router::url('/resources/get/' . $this->id);
	}
	
	function getThumbnail()
	{
		return TMP . 'thumbnails/res_' . $this->id . '.png';
	}
	
	function getThumbnailUrl()
	{
		return Router::url('/resources/thumbnail/' . $this->id);
	}
	
	function getSlideshow()
	{
		return Router::url('/resources/slideshow/' . $this->id);
	}
}
