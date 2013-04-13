$(document).ready(function() {
	// prevent "#" showing on address bar
	$('a[href="#"]').click(function(e){
		//$(this).css('border','1px red solid');
		e.preventDefault();
	})
	
	
	
	$('.tb-data').on('click', 'a[class="delete"]', function(){  
	    var id = $(this).data('id');
		//var table = $(this).data('table');
		//deleteData(table,id);
		deleteData(id);
	});
	
	$('.tb-data').on('click', 'a[class="edit"]', function(e){  
	    var id = $(this).data('id');
		e.preventDefault();

		getData(id);
	});
	
	
	
	$('.table-model').on('click', '#frm-btn-save', function(){
		saveData();
	});
	
	
	$('#frm-btn-cancel').on('click',function(){
		$('#frm-category').clearForm();
	});
	
	/*
	$('.tb-data > tbody > tr').each(function(){ 
	    var id = $(this).data('id');
		
		$(this).click(function(){
			
			//$(this).addClass('row_selected');
			console.log(id);	
		});
	});
	*/
	
	
	
	

	
	

	
	
});











/*
* 	Common App Functions
*/

function deleteData(id,table) {
//function deleteData(btn) {
	//console.log('deleteGradebkhdr');
	var	table = isset(table) ? table : $(".table-model").data('table');
	
	if(confirm('Are you sure you want to delete this item? '+ id)) {
		// build modal
		$.blockUI({ message: '<h2>Deleting <img src="../images/ajax-loader.gif"  /> </h2>',css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#fff', 
            '-webkit-border-radius': '5px', 
            '-moz-border-radius': '5px',  
			'border-radius': '5px',           
            color: '#bbb' 
        }  }); 
		
		//ajax to confirm delete 
		$.ajax({
        type: 'DELETE',
        contentType: 'application/json',
        url: '../www/api/'+ table +'/' + id,
        dataType: "json",
       // data: id,
        success: function(data, textStatus, jqXHR){
            //alert(textStatus + 'Gradebook header deleted successfully');
          	removeTableRow(data);
        	},
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + 'Failed on deleting '+ table +' data');
        	}
    	});
		
		$.unblockUI();
		
	} else {
		return false;
	} 			
}


function removeTableRow(data){
	$(".tb-data").find("#"+ data.id +"")
				.fadeOut("slow", function() {
					 $(this).remove(); 
					 TableNo();
				});
}

function TableNo(){
	$(".tb-data tbody tr td:first-of-type").each(function(){
		var no = $(this).parent().index() + 1;
		$(this).text(no);
	});
}



function addData() {
    //console.log('addGradebkhdr');
	var form = $(".table-model");
	var formData = form.formToJSON();	
    var	table = isset(table) ? table : form.data('table');

	//console.log(formData);
	//console.log(table);
    $.ajax({
        type: 'POST',
        contentType: 'application/json',
		url: '../www/api/'+ table ,
        dataType: "json",
        data: formData,
        success: function(data, textStatus, jqXHR){
            //alert(textStatus + 'Gradebook header created successfully');
          	addTableData(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + 'Failed on creating '+ table +' data');
        }
    });
	
	//form.find('tr:first-of-type td input:first-of-type').css('border','red 1px solid');
	var first_input = form.find('tr:first-of-type td input:first-of-type'); 
	var v = first_input.val();
	form.clearForm();
	first_input.val(v)
	  		   .focus();
	
	
}


function addTableData(data) {
    
	clear_alert();
	
	if(!data.error) {
		
		
		var fr = $(".tb-data tbody tr:first-of-type");
		var lr = $(".tb-data tbody tr:last-of-type");
	 	var no = parseInt($(".tb-data tbody tr:last-of-type td:first-of-type").text());
	    //var ctr = no + 1;
		var ctr = lr.index();
	  
	  	
	  
		var key, len = 0, row = '';
		for(key in data) {
			if(len == 0) {
				row += '<tr id="'+ data[key] +'" data-id="'+ data[key] +'"><td>'+ ctr +'</td>';
			} else {	
				row += '<td>'+ data[key] +'</td>';
			}
		  //console.log(data[key]);
		  //console.log(key);
		  len++;
		}
		
		
		row += '<td>';
		row += '<a class="edit" data-id="'+  data.id +'" data-table="category" href="#">Edit</a> ';
		row += '<a class="delete" data-id="'+ data.id +'" data-table="category" href="#">Delete</a>';
		row += '</td></tr>';
		//alert(len);
		
		/*    
		row += '<tr id="'+ data.id +'" ><td>'+ ctr +'</td>';
	    row += '<td>'+ data.code +'</td>';
	    row += '<td>'+ data.descriptor +'</td>';
		row += '<td>'+ data.type_name +'</td>';
	    row += '<td>';
		row += '<a class="edit" data-id="'+  data.id +'" data-table="category" href="#">Edit</a> ';
		row += '<a class="delete" data-id="'+ data.id +'" data-table="category" href="#">Delete</a>';
		row += '</td></tr>';			
		*/		
				
	   	fr.before(row);
		lr.remove();
		//lr.next().css('border','red 1px solid');
		fr.prev().find('td').each(function() {
			// color animation, optional. Do whatever you like here.
			//alert('fsafas');
			
			//fade 1
			/*
			$(this).animate({
			fontSize: "2em", backgroundColor: "#D5F9D5"
			}, 500 ).animate({
			fontSize: "1em"
			}, 500 );
			*/
			//fade 2
			$(this).effect("highlight", {}, 3000);
		
		});
			   
	 	//set_alert('success','Well done!', 'You successfully saved');
			
	} else {
		//console.log(data.error);	
		
		//set_alert('error','Oh snap!',data.error);	
	}
	
	TableNo();
		
}


function saveData() {
	var id = $(".table-model #id").val();
	//console.log(id);	
	if(id == ''){
		addData();
	} else {
		updateData(id);
	}	
}


function getData(id) {
	
	var form = $(".table-model");	
    var	table = form.data('table');
	
    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: '../www/api/'+ table +'/'+ id,
        dataType: "json",
        //data: id,
        success: function(data, textStatus, jqXHR){
            //alert(textStatus + 'Gradebook header fech successfully');  
			renderDetails(data)
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + 'Failed on creating '+ table +' header');
        }
    });
}

function renderDetails(data) {
	
	var key;
	for(key in data) {
		//console.log(data[key]);
		//console.log(key);
		var elementType = $('#'+key).prop('tagName');
		//console.log(elementType);	
		if(elementType == 'SELECT') {
			
			$('#'+ key +' > option').each(function() {
				//console.log($(this).val());
				if($(this).val() == data[key]){
					//console.log(data[key]);
					$(this).attr('selected','selected');
				}
			});
		} else {
			$('#'+key).val(data[key]);
		}	
	}
	
}

function updateData(id) {
  	
	var form = $(".table-model");
	var formData = form.formToJSON();	
    var	table = form.data('table');
	
    $.ajax({
        type: 'PUT',
        contentType: 'application/json',
        url: '../www/api/'+ table +'/' + id,
        dataType: "json",
        data: formData,
        success: function(data, textStatus, jqXHR){
          //alert(textStatus + 'Gradebook header successfully edited');
          updateTableData(data);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert(textStatus + 'Failed on creating Gradebook header');
        }
    });
}

function updateTableData(data) {
	var existing_tr =  $(".tb-data tbody tr#"+ data.id);
		//existing_tr.css('border','red 1px solid');
		
		var key, len = 0;
		for(key in data) {
			if(len == 0) {
					
			} else {	
				//console.log($(existing_tr +' td').index());
				
				existing_tr.find('td')
                    .filter(function(index){
						//console.log(len);
						return index == len
				    })
					.text(data[key]);
					
				
			}
			len++;
			
			
		}	
		
		existing_tr.find('td')
				   .effect("highlight", {}, 3000);
		
		/*
		existing_tr.find('td:not(:last-of-type)').each(function(){
						var key, len = 0;
						for(key in data) {
							if(len == 0) {
								
							} else {	
								$(this).text(data[key]);
							}
							 len++;
						}	
					})				  
				   .parent()
				   .find('td')
				   .effect("highlight", {}, 3000);
				   */
}









/* 
*	Alerts!
*	type = success, error or info
*	header = header for the alert
* 	text = the content
*/
function set_alert(type, header, text) {
	
	type = isset(type) ? type : 'info';
	header = isset(header) ? header : 'Heads up!';
	text = isset(text) ? text : 'This alert needs your attention, but it\'s not super important.';
	
	var alert_row = '<div class="alert alert-'+ type +'">';
		alert_row += '<button class="close" data-dismiss="alert" type="button">×</button>';
		alert_row += '<strong>'+ header +' </strong>' + text;
		alert_row += '</div>';
	
	$('#frm-alert').html(alert_row);
}

function clear_alert() {
	$('#frm-alert').html('');
}







/*
* 	jQuery Helper Functions
*/


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


$.fn.formToJSON = function(){
	return JSON.stringify(this.serializeObject());
}


$.fn.clearForm = function() {
  // iterate each matching form
  return this.each(function() {
    // iterate the elements within the form
    $(':input', this).each(function() {
      var type = this.type, tag = this.tagName.toLowerCase();
      if (type == 'text' || type == 'password' || tag == 'textarea')
        this.value = '';
      else if (type == 'checkbox' || type == 'radio')
        this.checked = false;
      else if (tag == 'select')
        this.selectedIndex = 0;
	  else
       this.value = "";
    });
  });
};





/*
* 	JavaScript Helper Functions
*/

function isset() {

  var a = arguments,
    l = a.length,
    i = 0,
    undef;

  if (l === 0) {
    throw new Error('Empty isset');
  }

  while (i !== l) {
    if (a[i] === undef || a[i] === null) {
      return false;
    }
    i++;
  }
  return true;
}