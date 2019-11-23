
console.log("AAAAAAAAAAAA");

jQuery(function($){
    function valid(id,discount) {
        if (discount <2000 ||discount >5000 || isNaN(discount))
        {
            $("."+id+" .error-msg" ).show();
            $("."+id+" .error-msg" ).text("** Invalid enter number from 2000 - 5000");
            return false;
        }
        return true
    }

    function calculate(weeklyrent,agreelength,discount)
    {

        var totalweeks = (52 * agreelength)
        var newtotal = (totalweeks * weeklyrent) - discount;
        var newweekpayments = newtotal/totalweeks;
        return "£"+parseFloat(newweekpayments).toFixed(2);
    }

    $('.rate_calculater button ').click(function(evt) {
        var id = $(evt.target).attr('class');
        var price = $("."+id+" .weekly_rental .info" ).text();
        var agreelength = $("."+id+" .agreementlength .info" ).text();
        var discount = $("."+id+" .rate_calculater input[type=text]").val();
        $("."+id+" .error-msg" ).hide();
        if (valid(id,discount) && discount>0) {
            $("."+id+" .weekly_rental .discount" ).css({'color':'red','text-decoration':'line-through'});
            $("."+id+" .weekly_rental .newprice" ).show();
            $("."+id+" .weekly_rental .newprice" ).html(calculate(price,agreelength,discount));
        } else {
            $("."+id+" .weekly_rental .discount" ).css({'color':'#303e48','text-decoration':'none'});
            $("."+id+" .weekly_rental .newprice" ).hide();
        }
        //color:red;text-decoration:line-through;
        //calculate(price,agreelength,discount);

    });
   });
