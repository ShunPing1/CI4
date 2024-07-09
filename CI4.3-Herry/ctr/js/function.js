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

function create_option(categoryId,input,data01,data02,select){
    let sub_option_arr = [];
    input.each(function(index){
        let sub_categoryId = $(this).data(data01);
        if (categoryId == sub_categoryId) {
            sub_option_arr.push('<option value='+$(this).data(data02)+'>'+$(this).val()+'</option>');
        };
    });
    let sub_option_str = sub_option_arr.join('');
    select.html(sub_option_str);
}

function saveNum(str){
    let match = str.match(/\d+/);
    return match[0];
}