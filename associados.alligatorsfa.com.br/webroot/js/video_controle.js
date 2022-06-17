/**
 *  highlightRow and highlight are used to show a visual feedback. If the row has been successfully modified, it will be highlighted in green. Otherwise, in red
 */
function highlightRow(rowId, bgColor, after)
{
	var rowSelector = $("#" + rowId);
	rowSelector.css("background-color", bgColor);
	rowSelector.fadeTo("normal", 0.5, function() { 
		rowSelector.fadeTo("fast", 1, function() { 
			rowSelector.css("background-color", '');
		});
	});
}

function highlight(div_id, style) {
	highlightRow(div_id, style == "error" ? "#e5afaf" : style == "warning" ? "#ffcc00" : "#8dc70a");
}
        
/**
   updateCellValue calls the PHP script that will update the database. 
 */
function updateCellValue(editableGrid, rowIndex, columnIndex, oldValue, newValue, row, onResponse)
{      
	$.ajax({
		url: $("#editurl").val(),
		type: 'POST',
		dataType: "html",
	   		data: {
			id: editableGrid.getRowId(rowIndex), 
			newvalue: editableGrid.getColumnType(columnIndex) == "boolean" ? (newValue ? 1 : 0) : newValue, 
			colname: editableGrid.getColumnName(columnIndex),
			coltype: editableGrid.getColumnType(columnIndex)			
		},
		success: function (response) 
		{ 
			// reset old value if failed then highlight row
			var success = onResponse ? onResponse(response) : (response == '"ok"' || !isNaN(parseInt(response))); // by default, a sucessfull reponse can be "ok" or a database id 
			if (!success) editableGrid.setValueAt(rowIndex, columnIndex, oldValue);
		    highlight(row.id, success ? '"ok"' : "error"); 
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
   
}
   

function DatabaseGrid(url) 
{ 
	this.editableGrid = new EditableGrid("videosnap", {
		enableSort: true,
		editmode: 'fixed',
	    	// define the number of row visible by page
      		pageSize: 50,
      		// Once the table is displayed, we update the paginator state
        	tableRendered:  function() {  updatePaginator(this); },
   	    	tableLoaded: function() { datagrid.initializeGrid(this);  },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	        updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
       		}
 	});
	this.url = url;
	this.fetchGrid(url); 

	
}

function mudacor(row,valor) {
		if ( valor % 2 == 0 )  {
		       	$(row).removeClass('Jmensalidadegrid'); 
		       	$(row).addClass('mensalidadegrid'); 
		}
		else  {
		       	$(row).removeClass('mensalidadegrid'); 
		       	$(row).addClass('Jmensalidadegrid'); 
		}

}

DatabaseGrid.prototype.fetchGrid = function()  {
	// call a PHP script to get the data
	this.editableGrid.loadJSON(this.url);
};

DatabaseGrid.prototype.initializeGrid = function(grid) {
  var self = this;
         grid.setCellRenderer("action", new CellRenderer({ 
                    render: function(cell, id) {                 
                        cell.innerHTML+= "<img src='/img/delete.png' onclick=\"datagrid.deleteRow("+id+");\" alt='Excluir'/>";
                    }
         }));  
         grid.setCellRenderer("id", new CellRenderer({ 
                    render: function(cell, id) {                 
			i = grid.getColumnIndex('inicio');
			f = grid.getColumnIndex('fim');
			row=grid.getRow(cell.rowIndex);
			inicio = grid.getValueAt(cell.rowIndex,i);
			fim = grid.getValueAt(cell.rowIndex,f);
                        cell.innerHTML+= "<img src='/img/play.png' onclick=\"playTube("+id+",'"+inicio+"','"+fim+"');\" alt='Play'/>";
		       	$(row).removeClass('mensalidadegrid'); 
		       	$(row).addClass('Jmensalidadegrid'); 
                    }
         }));  
	 grid.renderGrid("tablecontent", "mensalidadegrid");
};    

DatabaseGrid.prototype.deleteRow = function(id) 
{
  var self = this;
  if ( confirm('Tem certeza que deseja excluir jogada' + id )  ) {
        $.ajax({
		url: $("#delurl").val(),
		type: 'POST',
		dataType: "html",
		data: {
			id: id 
		},
		success: function (response) 
		{ 
			if (response == '"ok"' )
		        self.editableGrid.removeRow(id);
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
  }
}; 


DatabaseGrid.prototype.addRow = function(id) 
{
	var self = this;
	$.ajax({
		url: $("form").attr("action"),
		type: $("form").attr("method"),
		dataType: "html",
		data: {
			video_id:  $("#video-id").val(),
			inicio:  $("#inicio").val(),
			fim:  $("#fim").val(),
			casa:  $("#casa").val(),
			visitante:  $("#visitante").val(),
			resultado:  $("#resultado").val(),
			descricao:  $("#descricao").val(),
		},
		success: function (response) 
		{ 
			if (response == '"ok"' ) {
				// hide form
				showAddForm();   
				$("#inicio").val('00:00');
				$("#fim").val('00:00');
				$("#casa").val('');
				$("#visitante").val('');
				$("#resultado").val('');
				$("#descricao").val('');
				self.fetchGrid();
		         }
		         else 
		           alert(response);
		},
		error: function(XMLHttpRequest, textStatus, exception) { alert("Ajax failure\n" + errortext); },
		async: true
	});
}; 




function updatePaginator(grid, divId)
{
    divId = divId || "paginator";
	var paginator = $("#" + divId).empty();
	var nbPages = grid.getPageCount();

	// get interval
	var interval = grid.getSlidingPageInterval(20);
	if (interval == null) return;
	
	// get pages in interval (with links except for the current page)
	var pages = grid.getPagesInInterval(interval, function(pageIndex, isCurrent) {
		if (isCurrent) return "<span id='currentpageindex'>" + (pageIndex + 1)  +"</span>";
		return $("<a>").css("cursor", "pointer").html(pageIndex + 1).click(function(event) { grid.setPageIndex(parseInt($(this).html()) - 1); });
	});
		
	// "first" link
	var link = $("<a class='nobg'>").html("<i class='fa fa-fast-backward'></i>");
	if (!grid.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.firstPage(); });
	paginator.append(link);

	// "prev" link
	link = $("<a class='nobg'>").html("<i class='fa fa-backward'></i>");
	if (!grid.canGoBack()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.prevPage(); });
	paginator.append(link);

	// pages
	for (p = 0; p < pages.length; p++) paginator.append(pages[p]).append(" ");
	
	// "next" link
	link = $("<a class='nobg'>").html("<i class='fa fa-forward'>");
	if (!grid.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.nextPage(); });
	paginator.append(link);

	// "last" link
	link = $("<a class='nobg'>").html("<i class='fa fa-fast-forward'>");
	if (!grid.canGoForward()) link.css({ opacity : 0.4, filter: "alpha(opacity=40)" });
	else link.css("cursor", "pointer").click(function(event) { grid.lastPage(); });
	paginator.append(link);
}; 


function showAddForm() {
  if ( $("#addform").is(':visible') ) 
      $("#addform").hide();
  else
      $("#addform").show();
}
var player,stopPlayTimer;

function onYouTubePlayerAPIReady() {
  player = new YT.Player('video', {
    events: {
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
   
  // bind events
  var playButton = document.getElementById("play-button");
  playButton.addEventListener("click", function() {
    if(player.getPlayerState() == 1) player.pauseVideo();
    else player.playVideo();
  });
  
  
  var inicioButton = document.getElementById("inicio-button");
  inicioButton.addEventListener("click", function() {
   document.getElementById("inicio").value = intToTime(player.getCurrentTime());
  });

  var fimButton = document.getElementById("fim-button");
  fimButton.addEventListener("click", function() {
   document.getElementById("fim").value = intToTime(player.getCurrentTime());
  });

}

function playTube(id,inicio,fim) {
    var i = timeToInt(inicio);
    var f = timeToInt(fim) +1;
    clearTimeout(stopPlayTimer);
    player.playVideo();
    player.seekTo(i,true);
    var timeToStop = (Math.floor(Number(f)) - Math.floor(Number(i))) * 1000;
    stopPlayTimer =  setTimeout(function() {player.pauseVideo()}, timeToStop); 
}

function timeToInt(str) {
    var p = str.split(':'),
        s = 0, m = 1;

    while (p.length > 0) {
	        s += m * parseInt(p.pop(), 10);
	            m *= 60;
	        }

    return s;    
}
function intToTime(raw) {
	var time = parseInt(raw,10);
	time = time < 0 ? 0 : time;

	var minutes = Math.floor(time / 60);
	var seconds = time % 60;

	minutes = minutes < 9 ? "0"+minutes : minutes;
	seconds = seconds < 9 ? "0"+seconds : seconds;
	return(minutes+":"+seconds);
}

// Inject YouTube API script
var tag = document.createElement('script');
tag.src = "//www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
