@extends('ace.index')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					Timeline
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						based on widget boxes with 2 different styles
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="align-right">
				<span class="green middle bolder">Choose timeline: &nbsp;</span>

				<div class="btn-toolbar inline middle no-margin">
					<div data-toggle="buttons" class="btn-group no-margin">
						<label class="btn btn-sm btn-yellow active">
							<span class="bigger-110">1</span>

							<input type="radio" value="1" />
						</label>

						<label class="btn btn-sm btn-yellow">
							<span class="bigger-110">2</span>

							<input type="radio" value="2" />
						</label>
					</div>
				</div>
			</div>

			<div id="timeline-1">
				<div class="row">
					<div class="col-xs-12 col-sm-12 {{-- col-sm-offset-1 --}}">
						<div class="timeline-container">
							<div class="timeline-label">
								<span class="topic-status st-private">
									Private
									<ul class="member-private">
										<li>
											{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}Sang Huynh
										</li>
										<li>
											{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}Son Nguyen
										</li>
										<li>
											{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}Hien Nguyen
										</li>
									</ul>
								</span>
								<span class="topic-title">
									The day you went away - You are not alone
								</span>
							</div>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
										<span class="label label-info label-sm">16:22</span>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">
												<a href="#" class="blue">Susan</a>
												<span class="grey">reviewed a product</span>
											</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												16:22
											</span>

											<div class="rating inline widget-toolbar">
												<i data-alt="1" class="star-on-png" title="bad"></i>
												<i data-alt="2" class="star-on-png" title="poor"></i>
												<i data-alt="3" class="star-half-png" title="regular"></i>
												<i data-alt="4" class="star-off-png" title="good"></i>
												<i data-alt="5" class="star-off-png" title="gorgeous"></i>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="red">high life</span>

												accusamus terry richardson ad squid &hellip;
												<div class="space-6"></div>

												<div class="timeline-items timeline-cus">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<span class="fa fa-fw fa-check correct-answer"></span>
															{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Anim pariatur cliche reprehenderit, enim eiusmod accusamus terry richardson ad squid.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-off-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-on-png" title="regular"></i>
																	<i data-alt="4" class="star-half-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-half-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="widget-toolbox clearfix">
													<div class="pull-left">
														<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
														<a href="javascript:void(0)" class="bigger-110 timeline-readmore">Show answers</a>
													</div>

													<div class="pull-right action-buttons">
														<a href="#">
															<i class="ace-icon fa fa-check green bigger-130"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-pencil blue bigger-125"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-times red bigger-125"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
										<span class="label label-info label-sm">16:22</span>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">
												<a href="#" class="blue">Susan</a>
												<span class="grey">reviewed a product</span>
											</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												16:22
											</span>

											<div class="rating inline widget-toolbar">
												<i data-alt="1" class="star-on-png" title="bad"></i>
												<i data-alt="2" class="star-on-png" title="poor"></i>
												<i data-alt="3" class="star-half-png" title="regular"></i>
												<i data-alt="4" class="star-off-png" title="good"></i>
												<i data-alt="5" class="star-off-png" title="gorgeous"></i>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="red">high life</span>

												accusamus terry richardson ad squid &hellip;
												<div class="space-6"></div>

												<div class="timeline-items timeline-cus">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<span class="fa fa-fw fa-check correct-answer"></span>
															{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Anim pariatur cliche reprehenderit, enim eiusmod accusamus terry richardson ad squid.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-off-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-on-png" title="regular"></i>
																	<i data-alt="4" class="star-half-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-half-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="widget-toolbox clearfix">
													<div class="pull-left">
														<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
														<a href="javascript:void(0)" class="bigger-110 timeline-readmore">Show answers</a>
													</div>

													<div class="pull-right action-buttons">
														<a href="#">
															<i class="ace-icon fa fa-check green bigger-130"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-pencil blue bigger-125"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-times red bigger-125"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->

						<div class="timeline-container">
							<div class="timeline-label">
								<span class="topic-status">
									Public
								</span>
								<span class="topic-title">
									The day you went away - You are not alone
								</span>
							</div>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
										<span class="label label-info label-sm">16:22</span>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">
												<a href="#" class="blue">Susan</a>
												<span class="grey">reviewed a product</span>
											</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												16:22
											</span>

											<div class="rating inline widget-toolbar">
												<i data-alt="1" class="star-on-png" title="bad"></i>
												<i data-alt="2" class="star-on-png" title="poor"></i>
												<i data-alt="3" class="star-half-png" title="regular"></i>
												<i data-alt="4" class="star-off-png" title="good"></i>
												<i data-alt="5" class="star-off-png" title="gorgeous"></i>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="red">high life</span>

												accusamus terry richardson ad squid &hellip;
												<div class="space-6"></div>

												<div class="timeline-items timeline-cus">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<span class="fa fa-fw fa-check correct-answer"></span>
															{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Anim pariatur cliche reprehenderit, enim eiusmod accusamus terry richardson ad squid.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-off-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-on-png" title="regular"></i>
																	<i data-alt="4" class="star-half-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-half-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="widget-toolbox clearfix">
													<div class="pull-left">
														<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
														<a href="javascript:void(0)" class="bigger-110 timeline-readmore">Show answers</a>
													</div>

													<div class="pull-right action-buttons">
														<a href="#">
															<i class="ace-icon fa fa-check green bigger-130"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-pencil blue bigger-125"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-times red bigger-125"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
										<span class="label label-info label-sm">16:22</span>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">
												<a href="#" class="blue">Susan</a>
												<span class="grey">reviewed a product</span>
											</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												16:22
											</span>

											<div class="rating inline widget-toolbar">
												<i data-alt="1" class="star-on-png" title="bad"></i>
												<i data-alt="2" class="star-on-png" title="poor"></i>
												<i data-alt="3" class="star-half-png" title="regular"></i>
												<i data-alt="4" class="star-off-png" title="good"></i>
												<i data-alt="5" class="star-off-png" title="gorgeous"></i>
											</div>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="red">high life</span>

												accusamus terry richardson ad squid &hellip;
												<div class="space-6"></div>

												<div class="timeline-items timeline-cus">
													<div class="timeline-item clearfix">
														<div class="timeline-info">
															<span class="fa fa-fw fa-check correct-answer"></span>
															{{ HTML::image('spcvn/ace/images/avatars/avatar1.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Anim pariatur cliche reprehenderit, enim eiusmod accusamus terry richardson ad squid.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-off-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-on-png" title="regular"></i>
																	<i data-alt="4" class="star-half-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>

													<hr>

													<div class="timeline-item clearfix">
														<div class="timeline-info">
															{{ HTML::image('spcvn/ace/images/avatars/avatar2.png', "Susan't Avatar") }}
															<span class="label label-sm">16:22</span>
														</div>

														<div class="widget-box transparent">
															<div class="widget-body">
																<div class="widget-main">
																	Designed a new logo for our website. Would appreciate feedback.
																</div>
																<div class="rating inline rating-answers">
																	<i data-alt="1" class="star-on-png" title="bad"></i>
																	<i data-alt="2" class="star-on-png" title="poor"></i>
																	<i data-alt="3" class="star-half-png" title="regular"></i>
																	<i data-alt="4" class="star-off-png" title="good"></i>
																	<i data-alt="5" class="star-off-png" title="gorgeous"></i>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="widget-toolbox clearfix">
													<div class="pull-left">
														<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
														<a href="javascript:void(0)" class="bigger-110 timeline-readmore">Show answers</a>
													</div>

													<div class="pull-right action-buttons">
														<a href="#">
															<i class="ace-icon fa fa-check green bigger-130"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-pencil blue bigger-125"></i>
														</a>

														<a href="#">
															<i class="ace-icon fa fa-times red bigger-125"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->

						<div class="timeline-container">
							<div class="timeline-label">
								<span class="label label-success arrowed-in-right label-lg">
									<b>Yesterday</b>
								</span>
							</div>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<i class="timeline-indicator ace-icon fa fa-beer btn btn-inverse no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">Haloween party</h5>

											<span class="widget-toolbar">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												1 hour ago
											</span>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												<div class="clearfix">
													<div class="pull-left">
														Lots of fun at Haloween party.
														<br />
														Take a look at some pics:
													</div>

													<div class="pull-right">
														<i class="ace-icon fa fa-chevron-left blue bigger-110"></i>

														{{ HTML::image('spcvn/ace/images/gallery/thumb-4.jpg', 'image 1', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-3.jpg', 'image 2', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-2.jpg', 'image 3', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-1.jpg', 'image 4', array('width' => '36')) }}
														
														<i class="ace-icon fa fa-chevron-right blue bigger-110"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<i class="timeline-indicator ace-icon fa fa-trophy btn btn-pink no-hover green"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">Lorum Ipsum</h5>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="green bolder">high life</span>
												accusamus terry richardson ad squid &hellip;
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main"> Going to cafe for lunch </div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<i class="timeline-indicator ace-icon fa fa-bug btn btn-danger no-hover"></i>
									</div>

									<div class="widget-box widget-color-red2">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">Critical security patch released</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												9:15
											</span>

											<span class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="ace-icon fa fa-refresh"></i>
												</a>

												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</span>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Please download the new patch for maximum security.
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->

						<div class="timeline-container">
							<div class="timeline-label">
								<span class="label label-grey arrowed-in-right label-lg">
									<b>May 17</b>
								</span>
							</div>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<i class="timeline-indicator ace-icon fa fa-leaf btn btn-primary no-hover green"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-header widget-header-small">
											<h5 class="widget-title smaller">Lorum Ipsum</h5>

											<span class="widget-toolbar no-border">
												<i class="ace-icon fa fa-clock-o bigger-110"></i>
												10:22
											</span>

											<span class="widget-toolbar">
												<a href="#" data-action="reload">
													<i class="ace-icon fa fa-refresh"></i>
												</a>

												<a href="#" data-action="collapse">
													<i class="ace-icon fa fa-chevron-up"></i>
												</a>
											</span>
										</div>

										<div class="widget-body">
											<div class="widget-main">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="blue bolder">high life</span>
												accusamus terry richardson ad squid &hellip;
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->
					</div>
				</div>
			</div>

			<div id="timeline-2" class="hide">
				<div class="row">
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
						<div class="timeline-container timeline-style2">
							<span class="timeline-label">
								<b>Today</b>
							</span>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">11:15 pm</span>

										<i class="timeline-indicator btn btn-info no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<span class="bigger-110">
													<a href="#" class="purple bolder">Susan</a>
													reviewed a product
												</span>

												<br />
												<i class="ace-icon fa fa-hand-o-right grey bigger-125"></i>
												<a href="#">Click to read &hellip;</a>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">12:30 pm</span>

										<i class="timeline-indicator btn btn-info no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												Going to
												<span class="green bolder">veg cafe</span>
												for lunch
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">11:15 pm</span>

										<i class="timeline-indicator btn btn-info no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												Designed a new logo for our website. Would appreciate feedback.
												<a href="#">
													Click to see
													<i class="ace-icon fa fa-search-plus blue bigger-110"></i>
												</a>

												<div class="space-2"></div>

												<div class="action-buttons">
													<a href="#">
														<i class="ace-icon fa fa-heart red bigger-125"></i>
													</a>

													<a href="#">
														<i class="ace-icon fa fa-facebook blue bigger-125"></i>
													</a>

													<a href="#">
														<i class="ace-icon fa fa-reply light-green bigger-130"></i>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-info no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding"> Took the final exam. Phew! </div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->

						<div class="timeline-container timeline-style2">
							<span class="timeline-label">
								<b>Yesterday</b>
							</span>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-success no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<div class="clearfix">
													<div class="pull-left">
														<span class="orange2 bolder">Haloween party</span>

														Lots of fun at Haloween party.
														<br />
														Take a look at some pics:
													</div>

													<div class="pull-right">
														<i class="ace-icon fa fa-chevron-left blue bigger-110"></i>

														{{ HTML::image('spcvn/ace/images/gallery/thumb-4.jpg', 'image 1', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-3.jpg', 'image 2', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-2.jpg', 'image 3', array('width' => '36')) }}
														{{ HTML::image('spcvn/ace/images/gallery/thumb-1.jpg', 'image 4', array('width' => '36')) }}
														
														<i class="ace-icon fa fa-chevron-right blue bigger-110"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-success no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="pink2 bolder">high life</span>
												accusamus terry richardson ad squid &hellip;
											</div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-success no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding"> Going to cafe for lunch </div>
										</div>
									</div>
								</div>

								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-success no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<span class="red bolder">Critical security patch released</span>

												<br />
												Please download the new patch for maximum security.
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->

						<div class="timeline-container timeline-style2">
							<span class="timeline-label">
								<b>May 17</b>
							</span>

							<div class="timeline-items">
								<div class="timeline-item clearfix">
									<div class="timeline-info">
										<span class="timeline-date">9:00 am</span>

										<i class="timeline-indicator btn btn-grey no-hover"></i>
									</div>

									<div class="widget-box transparent">
										<div class="widget-body">
											<div class="widget-main no-padding">
												<span class="bolder blue">Lorum Ipsum</span>
												Anim pariatur cliche reprehenderit, enim eiusmod
												<span class="purple bolder">high life</span>
												accusamus terry richardson ad squid &hellip;
											</div>
										</div>
									</div>
								</div>
							</div><!-- /.timeline-items -->
						</div><!-- /.timeline-container -->
					</div>
				</div>
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->

	<script type="text/javascript">
		jQuery(function($) {
			$('[data-toggle="buttons"] .btn').on('click', function(e){
				var target = $(this).find('input[type=radio]');
				var which = parseInt(target.val());
				$('[id*="timeline-"]').addClass('hide');
				$('#timeline-'+which).removeClass('hide');
			});
		});

		$('a.timeline-readmore').click(function(event) {
			$(this).closest('.widget-toolbox').prev('.timeline-cus').slideDown('slow');
			$(this).html('See all answers');
			$(this).prev().css('transform', 'rotate(-90deg)').addClass('less');
		});
		$('a.timeline-readmore').prev().click(function(event) {
			if ($(this).hasClass('less')) {
				$(this).closest('.widget-toolbox').prev('.timeline-cus').slideUp('slow');
				$(this).next().html('Show answers');
				$(this).css('transform', 'rotate(0deg)').removeClass('less');
			}
		});

		$(window).click(function() {
			$('.st-private').children('ul').slideUp('300');
			$('.st-private').removeClass('less');
		});

		$('.st-private').click(function(event) {
			if($(this).hasClass('less')){
				$(this).children('ul').slideUp('300');
				$(this).removeClass('less');
			}
			else{
				$(this).children('ul').slideDown('300');
				$(this).addClass('less');
			}
			event.stopPropagation();
		});
	</script>
@stop