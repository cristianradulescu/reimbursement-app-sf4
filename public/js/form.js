'use strict';

jQuery(document).ready(() => {
    console.log('Ready to do stuff from main script!');

    syncTravelDates();
});

/**
 * Autofill leave/arrival times based on the travel period.
 */
function syncTravelDates()
{
    jQuery('#document_form_travel_dateStart').on('change', function() {
        jQuery('#document_form_travel_dateEnd').val(jQuery(this).val()).trigger('change');
        jQuery('#document_form_travel_departureLeaveTime').val(jQuery(this).val()+' 06:00');
        jQuery('#document_form_travel_destinationArrivalTime').val(jQuery(this).val()+' 09:00');
    });

    jQuery('#document_form_travel_dateEnd').on('change', function() {
        jQuery('#document_form_travel_destinationLeaveTime').val(jQuery(this).val()+' 18:00');
        jQuery('#document_form_travel_departureArrivalTime').val(jQuery(this).val()+' 21:00');
    });
}