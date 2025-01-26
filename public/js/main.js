$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
    });
    $('.show-message-div .alert-message').last().fadeOut(3000);
})
