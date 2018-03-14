// add rows of risk responses dynamically
	// initialize counter
	var counter = 0;
	// add new row function	
	function new_row()
	{
		var parent_element = "response-table-body";

		counter++;
		
		// create a new row
		var new_row = document.createElement('tr');

		// set id for the new row
		new_row.id = "response-row-" + counter; 

		// add innerhtml elements from existing first row
		new_row.innerHTML = document.getElementById("response-row").innerHTML;

		// create new table cell to hold link that will remove one of the added rows
		var new_cell = document.createElement('td');

		// assign ID to new table cell
		new_cell.id = "remove-row-" + counter;

		// add content to new cell
		// var row_counter  = "response-row-" + counter
		new_cell.innerHTML = "<i onclick='delete_row(&quot;"+new_row.id+"&quot;)' class='fa fa-times' aria-hidden='true'></i>";

		// new_cell.innerHTML = "<a href='' onclick=''><i class='fa fa-times' aria-hidden='true'></i></a>";

		// append new cell to new row
		new_row.appendChild(new_cell);

		// append new row to parent element
		document.getElementById(parent_element).appendChild(new_row);

		// initialize select2.js
		// $('.select-users').select2();
		// $('.response-title').select2();
	}


	// delete row
	function delete_row(elementId)
	{
		// Removes an element from the document
	    var element = document.getElementById(elementId);
	    //element.parentNode.removeChild(element);
	    element.remove();
	}


$(document).ready(function() {

    $('.response-title').select2();
    
    $('.action-owner').select2();


    // multiple select
    $('.select-users').select2();
    
});