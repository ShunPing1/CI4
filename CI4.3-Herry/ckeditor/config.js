/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function( config )
{	
	config.font_defaultLabel = '微軟正黑體';
	config.font_names = 'Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif;新細明體;標楷體;微軟正黑體';
	config.fontSize_defaultLabel = '16px';
	config.fontSize_sizes ='16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;';
	
	//编辑器的z-index值 
	config.baseFloatZIndex = 10000;

	config.filebrowserUploadUrl ='ckeditor_upload/upload.php';
	config.uiColor = '#a0aec4';
	//config.allowedContent = ''; 需要用到的話，要寫在 ckeditor/plugins/simpleuploads/plugin.js 的 541 行中	
	// !!注意本案件有打開iframe
	
	config.toolbarGroups = [
		{ name: 'document',     groups: [ 'mode' ] },
		{ name: 'styles' },
		{ name: 'basicstyles',	groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',	groups: [ 'list','align' ] },
		{ name: 'insert' },
		{ name: 'colors' },
		{ name: 'font' },
		{ name: 'links' }
	];
	
	config.removeDialogTabs = 'image:advanced;image:Link;'; //圖片上傳 image:Upload;
	config.language = 'zh';	
	config.allowedContent = true;
};

