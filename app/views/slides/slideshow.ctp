
<!--- time = <?php echo @$time ?> -->

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
	cursor:none;
}

body{
	padding:0px;
	margin:0px;
	overflow:hidden;
	background:black url('http://infoskjerm.neuf.no/img/bannerindex-400.png') no-repeat center center;
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
		fx:"none",
/*"blindX,blindY,blindZ,cover,curtainX,curtainY,fade,"+
		   "fadeZoom,growX,growY,none,scrollUp,scrollDown,"+
		   "scrollLeft,scrollRight,scrollHorz,scrollVert,"+
		   "shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,wipe,zoom",*/
		timeout:20000,
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

updateSlides();
setInterval(updateSlides, 120000);

if($("img").length)
	setTimeout(function(){$("img").hide("fast")},5000);

setTimeout(function(){window.location = "http://infoskjerm.neuf.no/index.php/slides/slideshow";}, 10 * 60 * 1000);
</script>
