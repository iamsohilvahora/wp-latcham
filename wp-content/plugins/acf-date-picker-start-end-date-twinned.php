<?php
/*
Plugin Name: ACF Date Picker - set end date to after start date
Author: Suresh Bhatol
Version: 0.1
*/


// These variables will need to be changed for your site.
$start_tour_field_id = 'field_5fc0e9eff9922';
$end_tour_field_id = 'field_5fc0ea05f9923';


$tour_field_ids = array( $start_tour_field_id, $end_tour_field_id );


// Add the JavaScript block only if one of the two date picker
// fields is being displayed.
function dcwd_setup_datepicker_init( $field ) {
	global $tour_field_ids;

	if ( in_array( $field[ 'key' ], $tour_field_ids ) ) {
		add_action('acf/input/admin_footer', 'dcwd_init_datepicker' );
	}
}
// Only run for date picker fields.
add_action( 'acf/render_field/type=date_picker', 'dcwd_setup_datepicker_init' );


// JavaScript code to initialise and change UX of date picker fields.
function dcwd_init_datepicker() {
	global $start_tour_field_id, $end_tour_field_id;
?>
<script>
start_tour_field_id = '<?php echo $start_tour_field_id; ?>';
end_tour_field_id = '<?php echo $end_tour_field_id; ?>';
tour_field_ids = [ start_tour_field_id, end_tour_field_id ];

// This filter allows the date picker settings to be customized for each date picker field.
// Called before the date picker instance is created.
// See: https://api.jqueryui.com/datepicker/
acf.add_filter('date_picker_args', function( args, $field ){
	if ( tour_field_ids.indexOf( $field.attr('data-key') ) >= 0 ) {
		args.minDate = -2;  // Minimum selectable date is two days ago.
		args.yearRange = '-0:+10';  // Limit to this year to +10 years.
	}	

	return args;
});
</script>
<script>
jQuery.noConflict();
jQuery(document).ready( function($){
	$("#acf-<?php echo $start_tour_field_id; ?>").next().datepicker().on("change", function( e ) {
		start_date = $(this).val();
		end_date_picker = $("#acf-<?php echo $end_tour_field_id; ?>").next();
		end_date = end_date_picker.val();

		// This block copied from Event Manager (events-manager/includes/js/events-manager.js)
		// If start date changed to be after end date then set the end date to start date.
		if( start_date > end_date && end_date != '' ) {
			end_date_picker.datepicker( "setDate" , start_date );
			end_date_picker.trigger('change');
		}
		// Send minimum selectable end date to the start date.
		end_date_picker.datepicker( "option", 'minDate', start_date );
  });
});
</script>
<?php
}