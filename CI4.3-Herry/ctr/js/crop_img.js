// JavaScript Document
var cropper;
								
function crop_img(name, img_width, img_height)
{
	var img = $("#"+ name).siblings(".dropify-preview").children(".dropify-render").children("img").attr("src");

	$("#image").attr("src", img);
	$("#img_colum").val(name);
	$("#img_width").val(img_width);
	$("#img_height").val(img_height);

	var image = document.getElementById('image');
	cropper = new Cropper(image, {
	  aspectRatio: img_width / img_height,
	  crop(event) {
	  }
	});
	
	$("#popupbox").bPopup({
		closeClass: 'popup_cancel',
		zIndex: 9999997,
		onClose: function() { cropper.destroy(); }
	});
}

function do_crop_img()
{
	var img_colum = $("#img_colum").val();
	var input_name = img_colum.split("_file");
	var width = $("#img_width").val();
	var height = $("#img_height").val();

	var img_src = $("#image").attr("src");

	if(img_src.match("uploads/") != null)
	{
		img_src = img_src.split('uploads/');
		img_src = img_src[1].split(".");
	}
	else
	{
		img_src = img_src.split(";base64");
		img_src = img_src[0].split("data:");
		img_src = img_src[1].split("/");
	}

	var result = cropper.getCroppedCanvas({ width: width,height: height});
									
	if(img_src[1] == 'jpg' || img_src[1] == 'jpeg') result = cropper.getCroppedCanvas({ width: width,height: height,fillColor: '#fff'});

	cropper.destroy();

	$.ajax({
	  type: 'POST',
	  url: 'ctr/image_crop/do_crop_img',
	  data: { img: result.toDataURL('image/'+img_src[1]), img_type: img_src[1] },
	  success: function (rep) {
			if(rep == 'false')
			{
				Swal.fire({
					icon: 'error',
					title: '裁切失敗!!',
					timer: 0,
					onClose: () => {

					}
				});
				$("#popupbox").bPopup().close();
			}
			else
			{
				$("#"+ img_colum).siblings(".dropify-preview").children(".dropify-render").children("img").attr("src", rep);
				$("#"+ input_name[0]).val(rep);
				Swal.fire({
					icon: 'success',
					title: '裁切成功!!',
					timer: 0,
					onClose: () => {

					}
				});
				$("#popupbox").bPopup().close();
			}
	   },
	  dataType: 'html'
	});
}

function change_img(element)
{
	var num = $(element).attr("id").split("_file")[0];
	
	$(".crop_text_"+ num).html("");
	$("#"+ num).val("false");
	$(".crop_button_"+ num).fadeIn();
}
