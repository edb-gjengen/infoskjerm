<style type="text/css">
#slideshow iframe, img, #overlay
{
	position:absolute;
	left:0px;
	top:0px;
	border:0px;
	width:100%;
	height:100%;
	bottom:0px;
	overflow:hidden;
}

img
{
	z-index:8;
}

#overlay
{
	z-index:9;
}

body{
	padding:0px;
	margin:0px;
	overflow:hidden;
	background:url(<?php echo Router::url(IMAGE_URL . 'bannerindex-400.png') ?>) black;
}
</style>
<?php if(!$slides):
echo $html->image('noslides.png');
?>
<div id="slideshow">
	<iframe src="http://www.studentersamfundet.no"></iframe>
	<iframe src="http://studio.studentersamfundet.no"></iframe>
	<iframe src="http://studio.studentersamfundet.no"></iframe>
</div>
<?php else: ?>
<div id="slideshow">
	<iframe></iframe>
	<iframe></iframe>
</div>
<?php endif; ?>
<div id="overlay">
&nbsp;
</div>
<script type="text/javascript">
var slides = <?php echo json_encode($slides) ?>;
var count = 0;

$(function(){
	$("#slideshow iframe, img, #overlay").each(function(){
		$(this).height(window.innerHeight).width(window.innerWidth);
	});

	function getNext()
	{
		$.get("<?php echo Router::url('/slides/next') ?>", function(data)
				{
					$("#slideshow").cycle("next");
					$("#slideshow")[turn].src = data;
				});
	}
	//after:           null,  // transition callback (scope set to element that was shown):  function(currSlideElement, nextSlideElement, options, forwardFlag)
	
	$("#slideshow").cycle(
	
	{
		fx:"blindX,blindY,blindZ,cover,curtainX,curtainY,fade,"+
		   "fadeZoom,growX,growY,none,scrollUp,scrollDown,"+
		   "scrollLeft,scrollRight,scrollHorz,scrollVert,"+
		   "shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,wipe,zoom",
		timeout:6000,
		speed:2000,
		after:function(currSlideElement, nextSlideElement)
		{
			count++;
			if(slides && slides.length)
				currSlideElement.src = slides[count % slides.length]['Slide']['url'];
		}
	});
	
	$("#slideshow iframe").each(
		function(){
			$("#slideshow").cycle('next');
		});
});


function updateSlides()
{
	$.getJSON("<?php echo Router::url('/slides/slideshow') ?>",function(newslides)
			{
				slides = newslides;
			});
}

setInterval(updateSlides, 120000);
if($("img").length)
	setTimeout(function(){$("img").hide("fast")},5000);

</script>
