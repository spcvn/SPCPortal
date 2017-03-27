$(document).ready(function() {
	$('.files-list .file-item').each(function(index, el) {
		var __name = $(this).attr('data-name');
		var __type = $(this).attr('data-type');
		var __exte = $(this).attr('data-exte');
		var __path = $(this).attr('data-path');
		var __file_ico = $(this).find('.file-icon');
		if (__type === "folder") {
			$(__file_ico).html('<span class="fa fa-folder orange"></span>');
		}
		else{
			switch(__exte){
				case 'jpg':
				case 'png':
				case 'gif':
					$(__file_ico).html('<img src="' + __path + '">');
					break;
				case 'psd':
					$(__file_ico).html('<span class="fa fa-image pink"></span>');
					break;
				case 'docx':
					$(__file_ico).html('<span class="fa fa-file-word-o blue"></span>');
					break;
				case 'pdf':
					$(__file_ico).html('<span class="fa fa-file-pdf-o brown"></span>');
					break;
				case 'zip':
					$(__file_ico).html('<span class="fa fa-file-archive-o red"></span>');
					break;
				default:
					$(__file_ico).html('<span class="fa fa-file-o green"></span>');
					break;
			}
		}
	});

	$('.mana-filter').find('input.ace').change(function(event) {
		if($('.filter-fol').prop('checked') == true){
			$('ul.files-list').find('li[data-type="folder"]').show();
		}
		else{
			$('ul.files-list').find('li[data-type="folder"]').hide();
		}

		if($('.filter-fil').prop('checked') == true){
			$('ul.files-list').find('li[data-type="file"]').show();
		}
		else{
			$('ul.files-list').find('li[data-type="file"]').hide();
		}
	});

	// Search
	$('input.files-search').keyup(function(event) {
		$('ul.files-list').find('li').hide();
		var key_search = $(this).val();
		$('ul.files-list').find('.file-info').each(function(index, el) {
			if($(this).html().match(key_search)){
				$(this).parent().show();
			}
		});
	});

});