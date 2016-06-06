$(document).ready(function(){ 
        var $total = 0;
        $('td.price').each(function(){
            $total += parseInt($(this).text());
        });
        
        $('td#total').text($total + " рублей");    
});