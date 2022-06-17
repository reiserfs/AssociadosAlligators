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
	this.editableGrid = new EditableGrid("mensalidades", {
		enableSort: true,
	    	// define the number of row visible by page
      		pageSize: 50,
      		// Once the table is displayed, we update the paginator state
        	tableRendered:  function() {  updatePaginator(this); },
   	    	tableLoaded: function() { datagrid.initializeGrid(this);  },
		modelChanged: function(rowIndex, columnIndex, oldValue, newValue, row) {
   	    		updateCellValue(this, rowIndex, columnIndex, oldValue, newValue, row);
			if (this.getColumnName(columnIndex) == 'valor_pago') mudacor(row,newValue);
       		}
 	});
	this.url = url;
	this.fetchGrid(url); 

	
}

function mudacor(row,valor) {
		if ( valor > 0 )  {
		       	$(row).removeClass('Nmensalidadegrid'); 
		       	$(row).addClass('mensalidadegrid'); 
		}
		else  {
		       	$(row).removeClass('mensalidadegrid'); 
		       	$(row).addClass('Nmensalidadegrid'); 
		}

}

DatabaseGrid.prototype.fetchGrid = function()  {
	// call a PHP script to get the data
	this.editableGrid.loadJSON(this.url);
};

DatabaseGrid.prototype.initializeGrid = function(grid) {

  var self = this;

// render for the action column
         grid.setCellRenderer("action", new CellRenderer({ 
                    render: function(cell, id) {                 
                       // cell.innerHTML+= "<i onclick=\"datagrid.deleteRow("+id+");\" class='fa fa-trash-o red' ></i>";
                        cell.innerHTML+= "<img src='/img/delete.png' onclick=\"datagrid.deleteRow("+id+");\" alt='Excluir'/>";
			c = grid.getColumnIndex('valor_pago');
			row=grid.getRow(cell.rowIndex);
			valor = grid.getValueAt(cell.rowIndex,c);
			mudacor(row,valor);
                    }
         }));  
	 grid.renderGrid("tablecontent", "mensalidadegrid");
};    

DatabaseGrid.prototype.deleteRow = function(id) 
{
  var self = this;
  if ( confirm('Tem certeza que deseja excluir mensalidade ' + id )  ) {
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
			vencimento:  $("#vencimento").val(),
			associado_id:  $("#associado-id").val(),
			valor_base:  $("#valor-base").val(),
			desconto:  $("#desconto").val(),
			acressimo:  $("#acressimo").val(),
			valor_pago:  $("#valor-pago").val(),
			plano_id:  $("#plano-id").val(),
			observacoes:  $("#observacoes").val(),
		},
		success: function (response) 
		{ 
			if (response == '"ok"' ) {
				// hide form
				showAddForm();   
				$("#vencimento").val('');
				$("#valor-base").val('');
				$("#desconto").val('');
				$("#acressimo").val('');
				$("#valor-pago").val('');
				$("#observacoes").val('');
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
