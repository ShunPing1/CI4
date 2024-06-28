<?php namespace App\Libraries\Ctr;
	class Img
	{
		function fixed_img_show($img_width, $img_height, $imgNum, $imgTitle, $data = null)
		{
			$content = '';
			
			$file_name = 'f' . $imgNum .'_file';
			$name = 'f' . $imgNum;

			$crop_display = '';
			$crop_message = '<div class="crop_text_f'. $imgNum .'" style="font-size: 14px;padding:10px;"></div>';
			$data_default_file = '';
			$type_name = '';
			$img = 'false';

			//是否必須放圖片
			$required_img = '';
			if($imgNum == 1)
			{
				$required_img = 'required';
			}

			if(!is_null($data))
			{
				$type_name = '<input type="hidden" name="f' . $imgNum .'_type" value="false"/>';
				$img = $data[0]->$name;
				$data_default_file = ' data-default-file="' . $img . '" ';
				//是否有圖片
				if($img == "")
				{
					$crop_display = 'display: none;';
				}

				//是否符合比例
				$img_colum = 'f' . $imgNum . '_resize';
				if($data[0]->$img_colum == 'false')
				{
					$crop_message = '<div class="crop_text_f'. $imgNum .'" style="font-size: 14px;color: red;">▲圖片不符合比例!</div>';
				}
			}

			$content .= <<<ImgList
				<div class="col-sm-6 col-md-4 col-xs-6" style="margin-bottom: 15px;">
					<div style="width:100%;display: inline-block;" class="img_title">
						<h5 style="display: inline-block;">$imgTitle - 寬{$img_width}x高{$img_height}px</h5>
						<button type="button" style="float: right;cursor: pointer;$crop_display" class="crop_button_f$imgNum btn-success" onClick="crop_img('$file_name', {$img_width}, {$img_height})">裁切</button>
					</div>

					<div style="font-size: 14px;color: red;">*為維護網站品質,每張圖片建議上傳小於500KB,最高單次上傳總額共20MB,單次上傳超過20MB請分次上傳</div>

					$crop_message

					<input type="file" name="$file_name" class="dropify" data-show-remove="false" ondragover="return false" id="$file_name" onChange="change_img(this);" $data_default_file $required_img/>
					<input type="hidden" name="$name" id="$name"  value="$img"/>
					$type_name
				</div>
ImgList;
			
			echo $content;
		}
		
		function img_init()
		{
			echo <<<ImgRow
				<script>
					$(document).ready(function () {
						var drEvent = $('.dropify').dropify({
							messages: {
								'default': '請直接拖入圖片或點擊，上傳圖片',
								'replace': '請直接拖入圖片或點擊，更換圖片',
								'remove':  '移除',
								'error':   '上傳錯誤'
							}
						});

						drEvent.on('dropify.afterClear', function(event, element){
							//alert(element.element.name);
							var name = element.element.name.split("_file");
							$("#"+name[0]).val("false");

							$(".crop_button_"+ name[0]).fadeOut();
						});
					});
				</script>
				
				<div id="popupbox">
					<div class="popup_cancel">
						<i class="fa fa-close"></i>
					</div>
					<div class="popupbox_title">編輯圖片</div>
					<div class="img-container">
						<img id="image" src="">
					</div>
					<div id="popupbox_button_wrap">
						<input type="hidden" value="" id="img_colum">
						<input type="hidden" value="" id="img_width">
						<input type="hidden" value="" id="img_height">
						<button type="button" class="btn btn-primary" onclick="do_crop_img();">裁切</button>
					</div>
				</div>
ImgRow;
		}
		
		function free_img_show($img_width, $img_height, $max_num = 'none', $data = null)
		{
			echo <<<ImgRow
				<div class="form-group">
					<div style="font-size:18px;">
						新增產品圖片(寬{$img_width}x高{$img_height}px)：
					</div>
					<input type="number" id="activity_img_input_amount" value="1" style="font-size:18px;width: 120px;float: left;margin-right: 25px;" class="form-control" />
					<input type="button" value="增加"  class="btn btn-primary" onclick="append_number_input({$img_width}, {$img_height})" />
				</div>

				<style>
					.activity_img_wrap {
						display: flex;
						flex-wrap: wrap;
					}

					.activity_img_item {
						width: 33.33%;
						padding: 0 15px;
						margin-bottom: 45px;
					}

					@media (max-width: 991px) {
						.activity_img_item {
							width: 50%;
						}
					}

					.img_title {
						height: 25px;
					}

					.activity_img_bottom {
						display: flex;
						align-items: center;
						justify-content: space-between;
						background: #f8f9fa;
						padding: 10px 15px;
						border-radius: 5px;
						border: 1px solid #d0d1d1;
					}

					.activity_img_item_new .activity_img_bottom {
						justify-content: flex-end;
					}

					.activity_img_bottom label {
						font-size: 18px;
						margin-bottom: 0;
						display: flex;
						align-items: center;
						cursor: pointer;
					}

					.batch_delete_checkbox {
						width: 20px;
						height: 20px;
						margin-right: 10px;
						cursor: pointer;
					}

					.activity_img_seq {
						width: 80px;
						padding-left: 15px;
						margin-left: 10px;
					}
				</style>

				<div class="activity_img_wrap">
ImgRow;
			if(!is_null($data) & $data != '')
			{
				$json = json_decode($data);
				$img_num = 0;
				usort($json, array($this, 'imgSequence'));
				
				foreach($json as $value)
				{
					$img_id = $value->img_id;
					$img = $value->img;
					$data_default_file = ' data-default-file="' . $img . '" ';
					$img_sequence = $value->img_sequence;

					// 圖片是否符合比例
					if($value->img_resize == 'false') $crop_message = '<div class="crop_text_img'. $img_num .'" style="font-size: 14px;color: red;">▲圖片不符合比例!</div>';
					else $crop_message = '<div class="crop_text_img'. $img_num .'" style="font-size: 14px;"></div>';

					echo <<<EchoData
					<div class="activity_img_item" id="activity_$img_num">
						<div style="width:100%;display: inline-block;" class="img_title">
							<button type="button" style="float: right;cursor: pointer;" class="crop_button_img$img_num btn-success" onClick="crop_img('img{$img_num}_file', {$img_width}, {$img_height})">裁切</button>
							<button type="button" style="float: left;cursor: pointer;" class="btn-danger" onClick="delete_activity($img_num)">刪除</button>
						</div>
						<input type="file" name="img_file[]" id="img{$img_num}_file" $data_default_file class="dropify" ondragover="return false" data-show-remove="false" onChange="change_img(this)"/>
						<input type="hidden" name="img[]" id="img{$img_num}" value="$img"/>
						<input type="hidden" name="img_type[]" id="img{$img_num}_type" value="false"/>
						$crop_message
						<div class="activity_img_bottom">
							<label class="ml-auto">
								排序
								<input type="number" class="activity_img_seq" name="img_sequence[]" value="$img_sequence">
							</label>
						</div>
					</div>
EchoData;
					$img_num++;
				}
			}
					
			echo <<<ImgRow
				</div>
				
				<script>
					// 新增產品照片
					var original_input_amount = parseInt( $('.activity_img_wrap .activity_img_item').length );

					function append_number_input(img_width, img_height)
					{
						var append_amount = parseInt( $('#activity_img_input_amount').val() );
						var input_html;
						var all_count = original_input_amount + append_amount ;

						for(var i=original_input_amount;i < all_count;i++ )
						{
							var this_item_number = i;

							input_html = '<div class="activity_img_item activity_img_item_new" id="activity_' + this_item_number + '">';
							input_html += '<div style="width:100%;display: inline-block;" class="img_title">';
							input_html += '<button type="button" style="float: right;display: none;cursor: pointer;" class="crop_button_img' + this_item_number + ' btn-success" onClick="crop_img(\'img' + this_item_number + '_file\', '+ img_width +', '+ img_height +')">裁切</button>';
							input_html += '<button type="button" style="float: left;cursor: pointer;" class="btn-danger" onClick="delete_activity(' + this_item_number + ')">刪除</button>';
							input_html += '</div>';
							input_html += '<div class="crop_text_img'+ this_item_number +'"></div>';
							input_html += '<input type="file" name="img_file[]" id="img' + this_item_number + '_file" class="dropify" ondragover="return false" data-show-remove="false" onChange="change_img(this)" required/>';
							input_html += '<input type="hidden" name="img[]" id="img' + this_item_number + '" value="false"/>';
							input_html += '<div class="activity_img_bottom">';
							input_html += '<label class="ml-auto">';
							input_html += '排序';
							input_html += '<input type="number" class="activity_img_seq" name="img_sequence[]" value="0">';
							input_html += '</label>';
							input_html += '</div>';
							input_html += '</div>';

							$('.activity_img_wrap').append( input_html );

							original_input_amount++;
						}

						var drEvent = $('.dropify').dropify({
							messages: {
								'default': '請直接拖入圖片或點擊，上傳圖片',
								'replace': '請直接拖入圖片或點擊，更換圖片',
								'remove':  '移除',
								'error':   '上傳錯誤'
							}
						});
					}

					function delete_activity( num )
					{
						Swal.fire({
							icon: 'question',
							title: '刪除後更新才會是真正刪除，是否確定刪除此圖片?',
							timer: 0,
							showCancelButton: true,
							confirmButtonText: '確定',
							cancelButtonText: '取消',
							onClose: () => {

							},
						}).then(function(result) {
							if(result.value)
							{
								$('.activity_img_wrap #activity_' + num ).remove();
							}
						});
					}
				</script>
ImgRow;
		}

		//圖片數量1 只有電腦版圖片, 2有手機版圖片
		function head_img_show($img_width, $img_height, $imgNum, $data = null)
		{
			$content = '';
			
			for( $i=1; $i <= $imgNum; $i++  )
			{
				$file_name = 'f' . $i .'_file';
				$name = 'f' . $i;
				
				$crop_display = '';
				$crop_message = '<div class="crop_text_f'. $i .'" style="font-size: 14px;padding:10px;"></div>';
				$data_default_file = '';
				$type_name = '';
				$img = 'false';

				//是否必須放圖片
				$required_img = '';
				if($i == 1)
				{
					$required_img = 'required';
				}
				
				$img_title = ($i == 1) ? '上方圖片電腦版' : '上方圖片手機版';

				if(!is_null($data))
				{
					$type_name = '<input type="hidden" name="f' . $i .'_type" value="false"/>';
					$img = $data[0]->$name;
					$data_default_file = ' data-default-file="' . $img . '" ';
					//是否有圖片
					if($img == "")
					{
						$crop_display = 'display: none;';
					}

					//是否符合比例
					$img_colum = 'f' . $i . '_resize';
					if($data[0]->$img_colum == 'false')
					{
						$crop_message = '<div class="crop_text_f'. $i .'" style="font-size: 14px;color: red;">▲圖片不符合比例!</div>';
					}
				}
				
				$content .= <<<ImgList
					<div class="col-sm-6 col-md-4 col-xs-6" style="margin-bottom: 15px;">
						<div style="width:100%;display: inline-block;" class="img_title">
							<h5 style="display: inline-block;">$img_title - 寬{$img_width[$i]}x高{$img_height[$i]}px</h5>
							<button type="button" style="float: right;cursor: pointer;$crop_display" class="crop_button_f$i btn-success" onClick="crop_img('$file_name', {$img_width[$i]}, {$img_height[$i]})">裁切</button>
						</div>
						
						<div style="font-size: 14px;color: red;">*為維護網站品質,每張圖片建議上傳小於500KB,最高單次上傳總額共20MB,單次上傳超過20MB請分次上傳</div>
						
						$crop_message
											
						<input type="file" name="$file_name" class="dropify" data-show-remove="false" ondragover="return false" id="$file_name" onChange="change_img(this);" $data_default_file $required_img/>
						<input type="hidden" name="$name" id="$name"  value="$img"/>
						$type_name
					</div>
ImgList;
			}
			
			echo <<<ImgRow
				<div class="row" id="img_list_wrap">
					$content
				</div>
				<script>
					$(document).ready(function () {
						var drEvent = $('.dropify').dropify({
							messages: {
								'default': '請直接拖入圖片或點擊，上傳圖片',
								'replace': '請直接拖入圖片或點擊，更換圖片',
								'remove':  '移除',
								'error':   '上傳錯誤'
							}
						});

						drEvent.on('dropify.afterClear', function(event, element){
							//alert(element.element.name);
							var name = element.element.name.split("_file");
							$("#"+name[0]).val("false");

							$(".crop_button_"+ name[0]).fadeOut();
						});
					});
				</script>
				
				<div id="popupbox">
					<div class="popup_cancel">
						<i class="fa fa-close"></i>
					</div>
					<div class="popupbox_title">編輯圖片</div>
					<div class="img-container">
						<img id="image" src="">
					</div>
					<div id="popupbox_button_wrap">
						<input type="hidden" value="" id="img_colum">
						<input type="hidden" value="" id="img_width">
						<input type="hidden" value="" id="img_height">
						<button type="button" class="btn btn-primary" onclick="do_crop_img();">裁切</button>
					</div>
				</div>
				
				<div style="clear: both;height: 30px;"></div>
ImgRow;
		}
		
		private function imgSequence($a, $b)
		{
			if($a->img_sequence > $b->img_sequence)
				return 1;
			else
				return -1;

			if($a->img_sequence == $b->img_sequence) return 0;
		} 
	}
?>