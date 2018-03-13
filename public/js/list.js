'use strict';

jQuery(document).ready(() => {
    jQuery('#generateReportButton').on('click', () => {
        jQuery.get(
            '/document/report',
            jQuery('input[id^="documentId-"]').serialize()
        )
        .done(
            (data) => {
                jQuery('#reportModalBody').html(data);
                jQuery('#reportModal').modal();
            }
        );
    })
});
