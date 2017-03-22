@extends('ace.index')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					Gallery
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						responsive photo gallery using colorbox
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div>
				<ul class="ace-thumbnails clearfix">
					<li>
						<a href="{{ url('spcvn/ace/images/gallery/image-1.jpg') }}" title="Photo Title" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/thumb-1.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
						</a>

						<div class="tags">
							<span class="label-holder">
								<span class="label label-info">breakfast</span>
							</span>

							<span class="label-holder">
								<span class="label label-danger">fruits</span>
							</span>

							<span class="label-holder">
								<span class="label label-success">toast</span>
							</span>

							<span class="label-holder">
								<span class="label label-warning arrowed-in">diet</span>
							</span>
						</div>

						<div class="tools">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-2.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-2.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
							<div class="text">
								<div class="inner">Sample Caption on Hover</div>
							</div>
						</a>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-3.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-3.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
							<div class="text">
								<div class="inner">Sample Caption on Hover</div>
							</div>
						</a>

						<div class="tools tools-bottom">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-4.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-4.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
							<div class="tags">
								<span class="label-holder">
									<span class="label label-info arrowed">fountain</span>
								</span>

								<span class="label-holder">
									<span class="label label-danger">recreation</span>
								</span>
							</div>
						</a>

						<div class="tools tools-top">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>

					<li>
						<div>
							{{ HTML::image('spcvn/ace/images/gallery/image-5.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
							<div class="text">
								<div class="inner">
									<span>Some Title!</span>

									<br />
									<a href="spcvn/ace/images/gallery/image-5.jpg" data-rel="colorbox">
										<i class="ace-icon fa fa-search-plus"></i>
									</a>

									<a href="#">
										<i class="ace-icon fa fa-user"></i>
									</a>

									<a href="#">
										<i class="ace-icon fa fa-share"></i>
									</a>
								</div>
							</div>
						</div>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-6.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-6.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
						</a>

						<div class="tools tools-right">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-1.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-1.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
						</a>

						<div class="tools">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>

					<li>
						<a href="{{ URL::to('spcvn/ace/images/gallery/image-2.jpg') }}" data-rel="colorbox">
							{{ HTML::image('spcvn/ace/images/gallery/image-2.jpg', '150x150', array('width' => '150', 'height' => '150')) }}
						</a>

						<div class="tools tools-top in">
							<a href="#">
								<i class="ace-icon fa fa-link"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-paperclip"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-pencil"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-times red"></i>
							</a>
						</div>
					</li>
				</ul>
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->

	{{ HTML::script('spcvn/ace/js/jquery.colorbox.min.js') }}

	<script type="text/javascript">
		jQuery(function($) {
			var $overflow = '';
			var colorbox_params = {
				rel: 'colorbox',
				reposition:true,
				scalePhotos:true,
				scrolling:false,
				previous:'<i class="ace-icon fa fa-arrow-left"></i>',
				next:'<i class="ace-icon fa fa-arrow-right"></i>',
				close:'&times;',
				current:'{current} of {total}',
				maxWidth:'100%',
				maxHeight:'100%',
				onOpen:function(){
					$overflow = document.body.style.overflow;
					document.body.style.overflow = 'hidden';
				},
				onClosed:function(){
					document.body.style.overflow = $overflow;
				},
				onComplete:function(){
					$.colorbox.resize();
				}
			};

			$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
			$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");
			$(document).one('ajaxloadstart.page', function(e) {
				$('#colorbox, #cboxOverlay').remove();
			});
		})
	</script>
@stop