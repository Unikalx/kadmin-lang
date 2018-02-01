CKEDITOR.editorConfig = function( config ) {
	config.filebrowserBrowseUrl = '/admin/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = '/admin/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = '/admin/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = '/admin/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = '/admin/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = '/admin/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';		
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'paragraph', groups: [ 'align', 'indent', 'list', 'blocks', 'bidi', 'paragraph' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.removeButtons = 'Scayt,Anchor,SpecialChar,Maximize,RemoveFormat,Styles';
	config.allowedContent = true;
	config.height = '20em';
};