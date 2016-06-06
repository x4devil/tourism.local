$(document).ready(function(){ 
        $("input:checkbox").removeAttr("checked");
	var $value = $('#currentPrice').attr("currentPrice");
        
        $('#price').text('Общая цена: ' + $value + " рублей.");
        
        var $checkBoxValue = 0;
        
	function calculation(){
            $('input:checkbox:checked').each(function(){
                var $a = $(this).attr('price');
                if(typeof $a !== typeof undefined && $a !== false){
                    $checkBoxValue += parseInt($(this).attr("price"));
                }
            });
            var $b = parseInt($checkBoxValue * $('select').val())+parseInt($value);
            
            $('#price').text("Общая цена: " + $b + " рублей.");
            
            $checkBoxValue = 0;
        }
        
        $('input:checkbox').click(function(){
            var $a = $(this).attr('price');
            if(typeof $a !== typeof undefined && $a !== false){
                calculation(); 
            }
        });
        $('select').change(function(){
            calculation();
        });
});