$('#addClass').click(function(){
    var text = $('#sub').val() + " " +  $('#cn').val() + '<button>x</button>';
    if(text.length){
        $('<li />', {html: text}).appendTo('ul.justList')
    }
});

$('ul').on('click','button' , function(el){
    $(this).parent().remove()
});