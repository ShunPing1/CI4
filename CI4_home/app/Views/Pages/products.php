<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>產品頁籤</title>
    <script src="JS/jquery3.js"></script>
    <style>
        .hidden{
            display: none;
        }
    </style>
</head>
<body>
    <select name="" id="category_select">
        <?php
            foreach($products as $item){
                echo "<option value='{$item['categoryID']}'>".$item['categoryName']."</option>";
            }
        ?>
    </select>
    <?php
        foreach($products as $item){
            echo "<input type='hidden' class='subcategory' data-subcategory='{$item['subcategoryID']}' data-category='{$item['categoryID']}' value='{$item['subcategoryName']}'>";
        }
    ?>
    <select name="" id="subcategory_select">
        <?php
            foreach($products as $item){
                if ($item) {
                    # code...
                }
                echo "<option value='{$item['categoryID']}'>".$item['categoryName']."</option>";
            }
        ?>
    </select>
    <div class="test">test</div>
    <script>
        let repeat = {};
        $('#category_select option').each(function(index){
            let value = $(this).val();
            if (repeat[value]) {
                $(this).remove();
            }else{
                repeat[value] = true;
            }
        })

        $('#subcategory_select option').each(function(){
            let categoryId = $('#category_select').val();
            let current_categoryId = $(this).data('category');
            if (categoryId != current_categoryId) {
                $(this).addClass('hidden');
            }else{
                $(this).removeClass('hidden');
            }
        })

        $('#category_select').change(function(){
            let categoryId = $(this).val();
            let sub_option_arr = [];
            $('.subcategory').each(function(index){
                let sub_categoryId = $(this).data('category');
                if (categoryId == sub_categoryId) {
                    sub_option_arr.push('<option value='+$(this).data('subcategory')+'>'+$(this).val()+'</option>');
                };
            });
            let sub_option_str = sub_option_arr.join('');
            console.log(sub_option_str);
            $('#subcategory_select').html(sub_option_str);
        })
    </script>
</body>
</html>