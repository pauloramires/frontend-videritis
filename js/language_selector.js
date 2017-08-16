/**
 * Created by pauloramires on 29/09/2015.
 */


var InitializeTranslation = function() {
    var userLang = navigator.language || navigator.userLanguage;
    if (userLang == 'pt-BR') {
        new_src = 'images/flags/US_24.png';
        $(".selected_language").attr("alt", userLang);
        $(".selected_language").attr("src", new_src);
    }
    else if (userLang != 'pt-BR') {
        userLang = 'en-US';
        new_src = 'images/flags/BR_24.png';
        $(".selected_language").attr("alt", userLang);
        $(".selected_language").attr("src", new_src);
    }

    var options ={
        //lng: $(".selected_language").attr("alt"),
        lng: userLang,
        fallbackLng: false,
        getAsync: false
    };
    $.i18n.init( options, function(t) {
        $(document).i18n() } );
};
/**
 * Handler for mouse click on dropdown language menu
 */
$(window).load(function(){
    $(function(){
        $(".selected_language").on("click", function(event){


            var current_iso_code = event.target.attributes['alt'].nodeValue;
            if (current_iso_code == 'pt-BR') {
                current_iso_code = 'en-US';
                new_src = 'images/flags/BR_24.png'
            } else {
                current_iso_code = 'pt-BR';
                new_src = 'images/flags/US_24.png'

            }

            i18n.setLng(current_iso_code, function(err, t) { $(document).i18n(); });
            $(".selected_language").attr("alt",current_iso_code);
            $(".selected_language").attr("src",new_src);


        })
    })
});