/******************************************************
*
*   GATORS JS 
*  Scripts utilizados nas páginas do sistema de 
*  associados Brasilia Alligators
*    
*          Thiago (Desenho) Melo
*******************************************************/
// ASSOCIADOS CORES DO CHAR
function hexToRgb(hex,c) {
    hex = hex.replace(/[^0-9A-F]/gi, '');
    var bigint = parseInt(hex, 16);
    switch(c) {
	case 0:
	    return (bigint >> 16) & 255;
	    break;
	case 1:
	    return (bigint >> 8) & 255;
	    break;
	case 2:
	    return bigint & 255;
	    break;
  }
}  

function drawImage(imageObj) {
	var canvas = document.getElementById('fa_body');
	var context = canvas.getContext('2d');
	var x = 0;
	var y = 0;

	context.drawImage(imageObj, x, y);

	var imageData = context.getImageData(x, y, imageObj.width, imageObj.height);
	var data = imageData.data;

	for(var i = 0; i < data.length; i += 4) {
		if(data[i] == 255 && data[i + 1] == 0 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Camisa']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Camisa']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Camisa']['cor']?>',2);
		}
		if(data[i] == 0 && data[i + 1] == 255 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Capacete']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Capacete']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Capacete']['cor']?>',2);
		}
		if(data[i] == 0 && data[i + 1] == 0 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Luva']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Luva']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Luva']['cor']?>',2);
		}
		if(data[i] == 0 && data[i + 1] == 255 && data[i +2] == 255){
			data[i] = hexToRgb('<?=$equipado['Calca']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Calca']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Calca']['cor']?>',2);
		}
		if(data[i] == 255 && data[i + 1] == 0 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Meiao']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Meiao']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Meiao']['cor']?>',2);
		}
		if(data[i] == 255 && data[i + 1] == 255 && data[i +2] == 0){
			data[i] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',0);
			data[i + 1] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',1);
			data[i + 2] = hexToRgb('<?=$equipado['Chuteira']['cor']?>',2);
		}
	}

	// overwrite original image
	context.putImageData(imageData, x, y);
	var my_gradient=context.createLinearGradient(0,100,0,200);
	my_gradient.addColorStop(0,"green");
	my_gradient.addColorStop(1,"yellow");
	context.font = "bold 70pt Calibri";
	context.fillStyle = my_gradient;
	context.strokeStyle= "#000000";
	context.fillText("<?php echo ($associado->numero)? $associado->numero : '00'?>", 106, 200);
	context.strokeText("<?php echo ($associado->numero)? $associado->numero : '00'?>", 106, 200);
}

// CRIA IMAGEM
var imageObj = new Image();
imageObj.onload = function() {
drawImage(this);
};
imageObj.src = '/img/fullpad_body.png';
//FIM CRIA IMAGEM

//ASSOCIADOS TOOLTIP
$(document).ready(function() {
// Tooltip only Text
	$('.imgicon').hover(function(){
		// Hover over code
		var title = $(this).attr('title');
		$(this).data('tipText', title).removeAttr('title');
		$('<p class="tooltip"></p>')
		.text(title)
		.appendTo('body')
		.fadeIn('slow');
	}, function() {
			// Hover out code
			$(this).attr('title', $(this).data('tipText'));
			$('.tooltip').remove();
		}).mousemove(function(e) {
			var mousex = e.pageX + 20; //Get X coordinates
			var mousey = e.pageY + 10; //Get Y coordinates
			$('.tooltip')
			.css({ top: mousey, left: mousex })
		});
});
