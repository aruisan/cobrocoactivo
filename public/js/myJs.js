


///////////////////////subir foto avatar///////////////////
$('.thumbnail, .avatarThumbnail').hover(
    function(){
        //e.stopPropagation();
        $(this).find('.caption, .avatarCaption').slideDown(250); //.fadeIn(250)
    },
    function(){
        //e.stopPropagation();
        $(this).find('.caption, .avatarCaption').slideUp(250); //.fadeOut(205)
    }
 ); 

$('#avatarImagenDefault').on('click', function(e){
    e.stopPropagation();
    $('#avatarInput').click();
});

$('#avatarInput').on('change', function(){
    var url = $('#avatarForm').attr('action');
    var data = $('#avatarForm').serialize();
    $('#avatarForm').submit();	
});

////////////////////////////google traductor

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'es',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false
    }, 'google_translate_element');
}


/////////////////modal
$('#myModal').on('shown.bs.modal', function(){$('#myInput').focus(); });

//////
$(document).ready(function(){
    $('.dropdown-toggle').dropdown();
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
    });
  });