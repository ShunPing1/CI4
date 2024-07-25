<div class="banner_page_block">
    <div class="banner_page">
        <div class="img_block">
            <div class="img">
                <?php if (!TRUE) {
                    echo "<img src=".base_url('Ctr/img/main-visual@2x-tw.png')." alt='' class='banner_img'>";
                }else{
                    echo '尚未上傳圖片';
                };?>
            </div>
        </div>
        <form action="<?= base_url('Ctr/Banner/InsertBanner')?>" method='post'>
            <input type="file" class='upload_img' name='img'>
            <br>
            <br>
            <button type='submit'>送出</button>
        </form>
        <script>
            $('.upload_img').change(function(){
                console.log($(this).val());
            })
        </script>
    </div>
</div>

