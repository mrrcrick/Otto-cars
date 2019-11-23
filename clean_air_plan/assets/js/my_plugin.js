
console.log("AAAAAAAAAAAA");

jQuery(function($){




        $('.rate_calculater button ').click(function(evt){

                var id = $(evt.target).attr('class');
                var price = $("."+id+" .weekly_rental" ).html();
                alert(price);

});
});
