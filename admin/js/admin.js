jQuery(document).ready(function($) {


/*
	$('#default_field').parent().parent().hide();

	$('#add-field').click(function(e) {
		e.preventDefault();

		if ($('#add-field-name').val()=='') {
			return false;
		}

		var $tr=$('#default_field').parent().parent();
		var $clone=$tr.clone();
		$tr.after($clone);
		$clone.show();
		setupClone($clone,$('#add-field-name').val());

		$('#add-field-name').val('');
	});

	function setupClone($tr,name) {
		var id=name.replace(/\W+/g, " ");
		var $td=$tr.find('td');
		var url=$td.find('input#default_field');
		id=id.toLowerCase();

		$tr.find('th').text(name); // set name

		$td.html($td.html().replace(/default_field/g,id));

		$td.find('#github-name').val(name); // set name

	}
*/

});

(function ($) {
	var slug='';
	
	// initalise the dialog
	$('#emsm-icons-overlay').dialog({
		title: 'Select a Social Media Icon',
		dialogClass: 'wp-dialog',
		autoOpen: false,
		draggable: false,
		width: 'auto',
		modal: true,
		resizable: false,
		closeOnEscape: true,
		position: {
		  my: "center",
		  at: "center",
		  of: window
		},
		open: function () {
		  // close dialog by clicking the overlay behind it
		  $('.ui-widget-overlay').bind('click', function(){
		    $('#emsm-icons-overlay').dialog('close');
		  })
		},
		create: function () {
		  // style fix for WordPress admin
		  $('.ui-dialog-titlebar-close').addClass('ui-button');
		},
	});
	
	// bind a button or a link to open the dialog
	$('a.emsm-select-icon').on('click', function(e) {  
		e.preventDefault();

		slug=$(this).data('inputId');
	
		$('#emsm-icons-overlay').dialog('open');
	});

	// an icon is selected //
	$('.fa-icons-list li a').on('click', function(e) {
		e.preventDefault();
		
		var icon=$(this).data('icon');
	
		// set hidden input //
		$('#' + slug + '-icon').val(icon);
	
		// show new icon //
		$('.' + slug + '-icon .icon-img-fa').html('<i class="fa ' + icon + '"></i>');
		
		// close dialog //
		$('#emsm-icons-overlay').dialog('close');
	});
  
})(jQuery);