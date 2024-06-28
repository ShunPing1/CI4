<?php namespace App\Libraries\Ctr;
	class GsFile
	{
		function fixed_file_show($column_num, $data = null)
		{
			$content = '';
			
			for( $i=$column_num; $i <= $column_num; $i++  )
			{
				$file_name = 'f' . $i;
				
				$data_default_file = '';
				
				if(!is_null($data))
				{
					$img = $data[0]->$file_name;
					$data_default_file = ' data-default-file="' . $img . '" ';
				}
				
				$content .= <<<FileList
					<div class="col-sm-6 col-md-4 col-xs-6" style="margin-bottom: 15px;">
						<div style="width:100%;display: inline-block;" class="img_title">
							<h5 style="display: inline-block;">檔案</h5>
						</div>
							
						<div style="font-size: 14px;color: red;">*檔案上傳大小需小於20MB</div>
								
						<input type="file" name="$file_name" class="dropify" data-show-remove="false" ondragover="return false" id="$file_name" $data_default_file required/>
					</div>
FileList;
			}
			
			echo <<<FileRow
				<div class="row" id="img_list_wrap">
					$content
				</div>
				<script>
					$(document).ready(function () {
						var drEvent = $('.dropify').dropify({
							messages: {
								'default': '請直接拖入檔案或點擊，上傳檔案',
								'replace': '請直接拖入檔案或點擊，更換檔案',
								'remove':  '移除',
								'error':   '上傳錯誤'
							}
						});
					});
				</script>
				
				<div style="clear: both;height: 30px;"></div>
FileRow;
		}
	}
?>