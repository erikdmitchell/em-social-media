jQuery(document).ready(function($) {

	$('#emsm-add-field').on('click', function(e) {  
		e.preventDefault();

		addNewRow();
	});

});

/**
 * addNewRow function.
 * 
 * @access public
 * @return void
 */
function addNewRow() {
	var $clone=jQuery('#emsm-social-media-table tr:last').clone();
	var oldSlug=$clone.attr('id').replace('emsm-', '');	

	clearFormElements($clone);
	clearOldSlug($clone, oldSlug);
	clearIcon($clone, oldSlug);
	
	jQuery('#emsm-social-media-table').append($clone);
}

/**
 * clearFormElements function.
 * 
 * @access public
 * @param mixed $div
 * @return void
 */
function clearFormElements($div) {
  $div.find(':input').each(function() {  
    switch(this.type) {
        case 'password':
        case 'text':
        case 'textarea':
        case 'file':
        case 'select-one':
        case 'select-multiple':
        case 'date':
        case 'number':
        case 'tel':
        case 'url':
        case 'hidden':
        case 'email':
            jQuery(this).val('');
            break;
        case 'checkbox':
        case 'radio':
            this.checked = false;
            break;
    }
  });
}

/**
 * clearOldSlug function.
 * 
 * @access public
 * @param mixed $div
 * @param mixed slug
 * @return void
 */
function clearOldSlug($div, slug) {
	$div.find(':input').each(function() {
		var newID=this.id.replace(slug, 'default');
		var newName=this.name.replace(slug, 'default');;

		jQuery(this).attr('id', newID);
		jQuery(this).attr('name', newName);
	});
}

/**
 * clearIcon function.
 * 
 * @access public
 * @param mixed $div
 * @param mixed slug
 * @return void
 */
function clearIcon($div, slug) {
	$div.find('span.icon-img').attr('class', 'default-icon icon-img');
	$div.find('.icon-img-fa').html('');
}

// select icon dialog //
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
	$('#emsm-social-media-table').on('click', 'a.emsm-select-icon', function(e) { 
console.log('click');		 
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