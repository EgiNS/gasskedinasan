$(document).ready(function(){
    $('#view_pembahasan').hide();
    $('#pembahasan').on('click', function() {
        $('#pembahasan').hide();
        $('#view_pembahasan').show();
    });
});