                        <div class="select select_PC">
                            <?php foreach($category as $c_item){ ?>
                                <div class="type_block type_PC_block">
                                    <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                                    <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                                    <div class='public_selects_block'>
                                        <?php
                                            foreach($subcategory as $s_item){
                                                if ($c_item['categoryID'] == $s_item['categoryID']) {
                                                    echo "<a href='#'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- 手機板選單 -->
                        <div class="select select_phone">
                            <p class="option option_all">
                                總選單<i class="fa-solid fa-angle-right"></i>
                            </p>
                            <!-- 選單內容 -->
                            <div class="phone_option_block">
                                <?php foreach($category as $c_item){ ?>
                                    <div class="type_block type_PC_block">
                                        <input type='hidden' name='<?php echo $c_item['categoryID'];?>'>
                                        <div class='option major_option shorts_type'><?php echo $c_item['categoryName'];?><i class='fa-solid fa-angle-right'></i></div>
                                        <div class='public_selects_block'>
                                            <?php
                                                foreach($subcategory as $s_item){
                                                    if ($c_item['categoryID'] == $s_item['categoryID']) {
                                                        echo "<a href='#'><p class='option option_item'>".$s_item['subcategoryName']."</p></a>";
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <script>
                            // 手風琴選單
                            $('.public_selects_block').hide();
                            $('.major_option').click(function () {
                                $(this).next('.public_selects_block').slideToggle('slow');
                                $('.major_option').not($(this)).next('.public_selects_block').slideUp('slow');
                                $('.major_option').not($(this)).find('i').removeClass('fa-chevron-down').addClass('fa-angle-right');
                                changeIcon($(this));
                            });

                            // 選單選取
                            $('.option_item').click(function () {
                                $('.option_item').removeClass('option_active');
                                $(this).addClass('option_active');
                            });

                            // 手機板總選單
                            $('.phone_option_block').hide();
                            $('.option_all').click(function () {
                                $('.phone_option_block').slideToggle('slow');
                                changeIcon($(this));
                            });

                            // 更換選單icon
                            function changeIcon(menu){
                                if (menu.find('i').hasClass('fa-chevron-down')) {
                                    menu.find('i').removeClass('fa-chevron-down').addClass('fa-angle-right');
                                } else {
                                    menu.find('i').removeClass('fa-angle-right').addClass('fa-chevron-down');
                                };
                            }
                        </script>