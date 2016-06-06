$(document).ready(function(){ 
        $('select').each(function(){
            $(this).find('option:first').attr("selected", "selected");
        });
        
        $('select').change(function(){
            $b = $(this).parent().siblings('#priceForOne').attr('price') * $(this).val();
            $(this).parent().siblings('.price').text('Общая цена: ' + $b + " рублей.");
        });
});