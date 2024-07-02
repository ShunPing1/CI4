function repeat_option_remove($parem){
    let option = {};
    $parem.each(function(){
        let value = $(this).val();
        if (option[value]) {
            $(this).remove();
        }else{
            option[value] = true;
        }
    })
}

function hidden_option(option_1,option_2,data_str){
    option_2.each(function(index){
        if (option_1.val() == $(this).data(data_str)) {
            $(this).removeClass('hidden');
        }else{
            $(this).addClass('hidden');
        }
    })
}