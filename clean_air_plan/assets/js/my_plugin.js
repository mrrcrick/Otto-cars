
jQuery(function($){
    // validate  discount given
    function valid(id,discount) {
        if ((discount == 0 || discount ===""))
        {
            return true;
        } else if ((discount <2000 ||discount >5000 || isNaN(discount) ))
        {
            $("."+id+" .error-msg" ).show();
            $("."+id+" .error-msg" ).text("** Invalid enter number from 2000 - 5000");
            return false;
        }
        return true
    }
    // calculate and display the discount
    function calculate(weeklyrent,agreelength,discount)
    {
        var totalweeks = (52 * agreelength)
        var newtotal = (totalweeks * weeklyrent) - discount;
        var newweekpayments = newtotal/totalweeks;
        return "£"+parseFloat(newweekpayments).toFixed(2);
    }
    // button listener for calulate button
    $('.rate_calculater button ').click(function(evt) {
        var id = $(evt.target).attr('class');
        var price = $("."+id+" .weekly_rental .info" ).text();
        var agreelength = $("."+id+" .agreementlength .info" ).text();
        var discount = $("."+id+" .rate_calculater input[type=text]").val();
        $("."+id+" .error-msg" ).hide();
        // if valid discount given given show discount
        if (valid(id,discount) && discount>0 && discount !=="") {
            $("."+id+" .weekly_rental .discount" ).css({'color':'red','text-decoration':'line-through'});
            $("."+id+" .weekly_rental .newprice" ).show();
            $("."+id+" .weekly_rental .newprice" ).html(calculate(price,agreelength,discount));
        } else {
            $("."+id+" .weekly_rental .discount" ).css({'color':'#303e48','text-decoration':'none'});
            $("."+id+" .weekly_rental .newprice" ).hide();
        }

    });
   });
