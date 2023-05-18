$(document).ready(function(){
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
	  $('.step').change(function() {
    var next_step = $(this).next('.step');
    var all_next_steps = $(this).nextAll('.step');
    // If the element *has* a value
    if ($(this).val()) {
        // Should also perform validation here
        next_step.attr('disabled', false);
    }
    // If the element doesn't have a value
    else {
        // Clear the value of all next steps and disable
        all_next_steps.val('');
        all_next_steps.attr('disabled', true);
    }
    $('.step').keydown(function(event) {
        // If they pressed tab AND the input has a (valid) value
        if ($(this).val() && event.keyCode == 9) {
            $(this).next('.step').attr('disabled', false);
        }
    });
});
	
	  });