<a id="stop" href="#">Stop</a>


<br>
<br>
<br>

<iframe id="popup-youtube-player" width="640" height="360" src="https://www.youtube.com/embed/vdMHR9g6PX8?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen="true" allowscriptaccess="always"></iframe>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
$('#stop').on('click', function() {
	$('#popup-youtube-player')[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');    
});

</script>

