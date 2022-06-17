<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<iframe width="720" height="405" src="//www.youtube.com/embed/vdMHR9g6PX8?enablejsapi=1" frameborder="0" allowfullscreen id="video"></iframe>

<script>
// https://developers.google.com/youtube/iframe_api_reference

// global variable for the player
var player;

// this function gets called when API is ready to use
function onYouTubePlayerAPIReady() {
  // create the global player from the specific iframe (#video)
  player = new YT.Player('video', {
    events: {
      // call this function when player is ready to use
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
   
  // bind events
  var playButton = document.getElementById("play-button");
  playButton.addEventListener("click", function() {
    player.playVideo();
  });
  
  var pauseButton = document.getElementById("pause-button");
  pauseButton.addEventListener("click", function() {
    player.pauseVideo();
   document.getElementById("text").value = player.getCurrentTime();
    
  });
  
  var addButton = document.getElementById("icio-button");
  addButton.addEventListener("click", function() {
   document.getElementById("inicio").value = player.getCurrentTime();
    
  });

  $("#inicioBt").click(function() {
	$("#inicio").value = player.getCurrentTime();
  });

}

function tempoLink(link) {
    player.playVideo();
    player.seekTo(link,true);
}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

</script>

<div class="buttons">
  <!-- if we needed to change height/width we could use viewBox here -->
  <input value="PLAY" type="button" id="play-button">
  <input value="ADD" type="button" id="add-button">
  <input value="STOP" type="button" id="pause-button">
</div>

<input id="text" size="100"><br>
<input type="radio" id="time" name="time" value="Ataque"> Ataque<br>
<input type="radio" id="time" name="time" value="Defesa"> Defesa<br>
<input type="radio" id="time" name="time" value="Swat"> Swat <br>
<input id="jogada" size="100" placeholder="Digite a Jogada">
<textarea id="urls"> </textarea>

<br> <a href="#" onclick="tempoLink(0.282545)">Ataque: qwewqe - 0.282545</a><br />
<br> <a href="#" onclick="tempoLink(191.691389)">Defesa: Testando a paradinha - 191.691389</a><br />
<br> <a href="#" onclick="tempoLink(364.052554)">Swat: Allahu Akbar - 364.052554</a><br />
