$(document).ready(function() {
	function setIcon(){
		var root_url = window.location.protocol + "//" + window.location.host + "/";
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
						$(__file_ico).html('<img src="' + root_url + __path.split('public/')[1] + '" height="35">');
						break;
					case 'psd':
						$(__file_ico).html('<span class="fa fa-image pink"></span>');
						break;
					case 'docx':
						$(__file_ico).html('<span class="fa fa-file-word-o blue"></span>');
						break;
					case 'pptx':
						$(__file_ico).html('<span class="fa fa-file-powerpoint-o purple"></span>');
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
	}
	setIcon();

	// Filter
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

	// Sort
	$('select.files-sort').change(function(event) {
		var sort_type = $(this).val();
		var last_sort = $('ul.files-list').find('li').sort(function (a, b) {
			return $(a).attr(sort_type).toUpperCase().localeCompare($(b).attr(sort_type).toUpperCase());
		})
		$.each(last_sort, function(index, item) {
			$('ul.files-list').append(item);
		});
	});

	// Get fileslist
	function getFilesList(direct){
		var __li;
		$.ajax({
			url: '/acelayout/fileslist',
			type: 'POST',
			dataType: 'json',
			async: false,
        	cache: false,
			data: {
				direct: direct
			},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success: function(data){
				$('ul.files-list').children('li').remove();
				jQuery.each(data, function(index, item) {
					__li = '<li class="file-item" data-name="' + item['name'] + '" data-type="' + item['type'] + '" data-exte="' + item['exte'] + '" data-path="' + item['path'] + '" data-size="' + item['size'] + '" data-time="' + item['time'] + '" data-pare="' + item['pare'] + '">\
							<div class="file-icon"></div>\
							<div class="file-info">' + item['name'] + '</div>\
							</li>';
				    $('ul.files-list').append(__li);
				});
				setIcon();
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}

	// Open directory
	$('ul.files-list').on('click', 'li[data-type="folder"]', function(event) {
		var direct = $(this).attr('data-path');
		getFilesList(direct);
		$('.data-undo').addClass('active');
	});

	// Undo process
	$('span.data-undo').click(function(event) {
		var myURL = $('ul.files-list').find('li').first().attr('data-pare');
		var myDir = myURL.substring( 0, myURL.lastIndexOf( "/" ) + 1);
		console.log(myDir);
		console.log(myDir);
		
		if ($(this).hasClass('active')) {
			getFilesList(myDir);
			if(myDir == $('.root-path').html()){
				$('.data-undo').removeClass('active');
			}
		}
	});

	console.log($('.root-path').html());

});