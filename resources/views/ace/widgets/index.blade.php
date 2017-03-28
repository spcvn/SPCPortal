@extends('ace.index')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="page-header">
				<h1>
					Widgets
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						Draggabble Widget Boxes with Persistent Position and State
					</small>
				</h1>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="invisible" id="main-widget-container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-1">
						<div class="widget-box" id="widget-box-1">
							<div class="widget-header">
								<h5 class="widget-title">Default Widget Box</h5>

								<div class="widget-toolbar">
									<div class="widget-menu">
										<a href="#" data-action="settings" data-toggle="dropdown">
											<i class="ace-icon fa fa-bars"></i>
										</a>

										<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
											<li>
												<a data-toggle="tab" href="#dropdown1">Option#1</a>
											</li>

											<li>
												<a data-toggle="tab" href="#dropdown2">Option#2</a>
											</li>
										</ul>
									</div>

									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>

									<a href="#" data-action="reload">
										<i class="ace-icon fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p class="alert alert-info">
										Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur.
									</p>
									<p class="alert alert-success">
										Raw denim you probably haven't heard of them jean shorts Austin.
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-2">
						<div class="widget-box widget-color-blue" id="widget-box-2">
							<div class="widget-header">
								<h5 class="widget-title bigger lighter">
									<i class="ace-icon fa fa-table"></i>
									Tables & Colors
								</h5>

								<div class="widget-toolbar widget-toolbar-light no-border">
									<select id="simple-colorpicker-1" class="hide">
										<option selected="" data-class="blue" value="#307ECC">#307ECC</option>
										<option data-class="blue2" value="#5090C1">#5090C1</option>
										<option data-class="blue3" value="#6379AA">#6379AA</option>
										<option data-class="green" value="#82AF6F">#82AF6F</option>
										<option data-class="green2" value="#2E8965">#2E8965</option>
										<option data-class="green3" value="#5FBC47">#5FBC47</option>
										<option data-class="red" value="#E2755F">#E2755F</option>
										<option data-class="red2" value="#E04141">#E04141</option>
										<option data-class="red3" value="#D15B47">#D15B47</option>
										<option data-class="orange" value="#FFC657">#FFC657</option>
										<option data-class="purple" value="#7E6EB0">#7E6EB0</option>
										<option data-class="pink" value="#CE6F9E">#CE6F9E</option>
										<option data-class="dark" value="#404040">#404040</option>
										<option data-class="grey" value="#848484">#848484</option>
										<option data-class="default" value="#EEE">#EEE</option>
									</select>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main no-padding">
									<table class="table table-striped table-bordered table-hover">
										<thead class="thin-border-bottom">
											<tr>
												<th>
													<i class="ace-icon fa fa-user"></i>
													User
												</th>

												<th>
													<i>@</i>
													Email
												</th>
												<th class="hidden-480">Status</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td class="">Alex</td>

												<td>
													<a href="#">alex@email.com</a>
												</td>

												<td class="hidden-480">
													<span class="label label-warning">Pending</span>
												</td>
											</tr>

											<tr>
												<td class="">Fred</td>

												<td>
													<a href="#">fred@email.com</a>
												</td>

												<td class="hidden-480">
													<span class="label label-success arrowed-in arrowed-in-right">Approved</span>
												</td>
											</tr>

											<tr>
												<td class="">Jack</td>

												<td>
													<a href="#">jack@email.com</a>
												</td>

												<td class="hidden-480">
													<span class="label label-warning">Pending</span>
												</td>
											</tr>

											<tr>
												<td class="">John</td>

												<td>
													<a href="#">john@email.com</a>
												</td>

												<td class="hidden-480">
													<span class="label label-inverse arrowed">Blocked</span>
												</td>
											</tr>

											<tr>
												<td class="">James</td>

												<td>
													<a href="#">james@email.com</a>
												</td>

												<td class="hidden-480">
													<span class="label label-info arrowed-in arrowed-in-right">Online</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div><!-- /.span -->
				</div><!-- /.row -->

				<div class="space-24"></div>

				<div class="row">
					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-3">
						<div class="widget-box widget-color-orange collapsed" id="widget-box-3">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title">
									<i class="ace-icon fa fa-sort"></i>
									Small Header & Collapsed
								</h6>

								<div class="widget-toolbar">
									<a href="#" data-action="settings">
										<i class="ace-icon fa fa-cog"></i>
									</a>

									<a href="#" data-action="reload">
										<i class="ace-icon fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-plus" data-icon-show="fa-plus" data-icon-hide="fa-minus"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p class="alert alert-info">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-4">
						<div class="widget-box" id="widget-box-4">
							<div class="widget-header widget-header-large">
								<h4 class="widget-title">Big Header</h4>

								<div class="widget-toolbar">
									<a href="#" data-action="settings">
										<i class="ace-icon fa fa-cog"></i>
									</a>

									<a href="#" data-action="reload">
										<i class="ace-icon fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p class="alert alert-info">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="space-24"></div>

				<div class="row">
					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-5">
						<div class="widget-box" id="widget-box-5">
							<div class="widget-header">
								<h5 class="widget-title smaller">With Label</h5>

								<div class="widget-toolbar">
									<span class="label label-success">
										16%
										<i class="ace-icon fa fa-arrow-up"></i>
									</span>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-6">
									<div class="alert alert-info"> Hello World! </div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-3 widget-container-col" id="widget-container-col-6">
						<div class="widget-box widget-color-dark light-border" id="widget-box-6">
							<div class="widget-header">
								<h5 class="widget-title smaller">With Badge</h5>

								<div class="widget-toolbar">
									<span class="badge badge-danger">Alert</span>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-6">
									<div class="alert alert-info"> Hello World! </div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-7">
						<div class="widget-box widget-color-dark" id="widget-box-7">
							<div class="widget-header widget-header-small">
								<h6 class="widget-title smaller">With Labels & Badges</h6>

								<div class="widget-toolbar no-border">
									<label>
										<input type="checkbox" class="ace ace-switch ace-switch-3" />
										<span class="lbl middle"></span>
									</label>
								</div>

								<div class="widget-toolbar">
									<span class="label label-warning">
										1.2%
										<i class="ace-icon fa fa-arrow-down"></i>
									</span>
									<span class="badge badge-info">info</span>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<div class="alert alert-info">
										Lorem ipsum dolor sit amet, consectetur adipiscing.
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="space"></div>

				<div class="row">
					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-8">
						<div class="widget-box widget-color-dark" id="widget-box-8">
							<div class="widget-header">
								<h5 class="widget-title bigger lighter">With Toolbox</h5>

								<div class="widget-toolbar">
									<label>
										<input type="checkbox" class="ace ace-checkbox-2" id="id-checkbox-vertical" />
										<span class="lbl middle padding-4"> Vertical</span>
									</label>
								</div>

								<div class="widget-toolbar">
									<div class="progress progress-mini progress-striped active pos-rel" style="width:60px;" data-percent="61%">
										<div class="progress-bar progress-bar-danger" style="width:61%"></div>
									</div>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-toolbox" id="widget-toolbox-1">
									<div class="btn-toolbar">
										<div class="btn-group">
											<button class="btn btn-sm btn-success btn-white btn-round">
												<i class="ace-icon fa fa-check bigger-110 green"></i>
												Approve
											</button>

											<button class="btn btn-sm btn-danger btn-white btn-round">
												<i class="ace-icon fa fa-times bigger-110 red2"></i>
												Reject
											</button>
										</div>

										<div data-toggle="buttons" class="btn-group">
											<label class="btn btn-sm btn-default btn-white btn-round">
												<i class="icon-only ace-icon fa fa-bold bigger-110"></i>

												<input type="checkbox" value="1" />
											</label>

											<label class="btn btn-sm btn-default btn-white btn-round">
												<i class="icon-only ace-icon fa fa-italic bigger-110"></i>

												<input type="checkbox" value="2" />
											</label>
										</div>

										<div data-toggle="buttons" class="btn-group">
											<label class="btn btn-sm btn-primary btn-white btn-round">
												<i class="icon-only ace-icon fa fa-align-left bigger-110"></i>

												<input type="radio" value="1" />
											</label>

											<label class="btn btn-sm btn-primary btn-white btn-round">
												<i class="icon-only ace-icon fa fa-align-center bigger-110"></i>

												<input type="radio" value="2" />
											</label>

											<label class="btn btn-sm btn-primary btn-white btn-round">
												<i class="icon-only ace-icon fa fa-align-right bigger-110"></i>

												<input type="radio" value="3" />
											</label>
										</div>
									</div>
								</div>

								<div class="widget-main padding-16">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur. Etiam justo nisl, gravida id egestas eu, eleifend vel metus. Pellentesque tellus ipsum, euismod in facilisis quis, aliquet quis sem.
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-9">
						<div class="widget-box widget-color-pink" id="widget-box-9">
							<div class="widget-header">
								<h5 class="widget-title">Bottom Toolbox (Footer)</h5>

								<div class="widget-toolbar">
									<a href="#" data-action="collapse">
										<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
									</a>
								</div>

								<div class="widget-toolbar no-border">
									<button class="btn btn-xs btn-light bigger">
										<i class="ace-icon fa fa-arrow-left"></i>
										Prev
									</button>

									<button class="btn btn-xs bigger btn-yellow dropdown-toggle" data-toggle="dropdown">
										Next
										<i class="ace-icon fa fa-chevron-down icon-on-right"></i>
									</button>

									<ul class="dropdown-menu dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
										<li>
											<a href="#">Action</a>
										</li>

										<li>
											<a href="#">Another action</a>
										</li>

										<li>
											<a href="#">Something else here</a>
										</li>

										<li class="divider"></li>

										<li>
											<a href="#">Separated link</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<p class="alert alert-info">
										Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur. Nulla fringilla eleifend consectetur.
									</p>
									<p class="alert alert-success">
										Raw denim you probably haven't heard of them jean shorts Austin.
									</p>
								</div>

								<div class="widget-toolbox padding-8 clearfix">
									<button class="btn btn-xs btn-danger pull-left">
										<i class="ace-icon fa fa-times"></i>
										<span class="bigger-110">I don't accept</span>
									</button>

									<button class="btn btn-xs btn-success pull-right">
										<span class="bigger-110">I accept</span>

										<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="space"></div>

				<div class="row">
					<div class="col-sm-6 widget-container-col" id="widget-container-col-10">
						<div class="widget-box" id="widget-box-10">
							<div class="widget-header widget-header-small">
								<h5 class="widget-title smaller">Tabbed</h5>

								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#home">Home</a>
										</li>

										<li>
											<a data-toggle="tab" href="#profile">Profile</a>
										</li>

										<li>
											<a data-toggle="tab" href="#info">Info</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-6">
									<div class="tab-content">
										<div id="home" class="tab-pane in active">
											<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
										</div>

										<div id="profile" class="tab-pane">
											<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
										</div>

										<div id="info" class="tab-pane">
											<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 widget-container-col" id="widget-container-col-11">
						<div class="widget-box widget-color-dark" id="widget-box-11">
							<div class="widget-header">
								<h6 class="widget-title">Scroll Content</h6>

								<div class="widget-toolbar">
									<a href="#" data-action="settings">
										<i class="ace-icon fa fa-cog"></i>
									</a>

									<a href="#" data-action="reload">
										<i class="ace-icon fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>

									<a href="#" data-action="fullscreen" class="orange2">
										<i class="ace-icon fa fa-expand"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-4 scrollable" data-size="125">
									<div class="content">
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-danger">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-success">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
										<div class="alert alert-info">
											Lorem ipsum dolor sit amet, consectetur adipiscing.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="space-24"></div>

				<div class="row">
					<div class="col-sm-6 widget-container-col" id="widget-container-col-12">
						<div class="widget-box transparent" id="widget-box-12">
							<div class="widget-header">
								<h4 class="widget-title lighter">Transparent Box</h4>

								<div class="widget-toolbar no-border">
									<a href="#" data-action="settings">
										<i class="ace-icon fa fa-cog"></i>
									</a>

									<a href="#" data-action="reload">
										<i class="ace-icon fa fa-refresh"></i>
									</a>

									<a href="#" data-action="collapse">
										<i class="ace-icon fa fa-chevron-up"></i>
									</a>

									<a href="#" data-action="close">
										<i class="ace-icon fa fa-times"></i>
									</a>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-6 no-padding-left no-padding-right">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-6 widget-container-col" id="widget-container-col-13">
						<div class="widget-box transparent" id="widget-box-13">
							<div class="widget-header">
								<h4 class="widget-title lighter">Tabs With Scroll</h4>

								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="myTab2">
										<li class="active">
											<a data-toggle="tab" href="#home2">Home</a>
										</li>

										<li>
											<a data-toggle="tab" href="#profile2">Profile</a>
										</li>

										<li>
											<a data-toggle="tab" href="#info2">Info</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-12 no-padding-left no-padding-right">
									<div class="tab-content padding-4">
										<div id="home2" class="tab-pane in active">
											<div class="scrollable-horizontal" data-size="800">
												<b>Horizontal Scroll</b>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
											</div>
										</div>

										<div id="profile2" class="tab-pane">
											<div class="scrollable" data-size="100" data-position="left">
												<b>Scroll on Left</b>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
											</div>
										</div>

										<div id="info2" class="tab-pane">
											<div class="scrollable" data-size="100">
												<b>Scroll # 3</b>
												Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque commodo massa sed ipsum porttitor facilisis. Nullam interdum massa vel nisl fringilla sed viverra erat tincidunt. Phasellus in ipsum velit. Maecenas id erat vel sem convallis blandit. Nunc aliquam enim ut arcu aliquet adipiscing. Fusce dignissim volutpat justo non consectetur.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr />
				<div class="text-center">
					<button type="reset" id="reset-widgets" class="btn btn-danger btn-white btn-bold btn-round">Reset Position/State</button>
				</div>
			</div><!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->

	{{ HTML::script('spcvn/ace/js/jquery-ui.custom.min.js') }}
	{{ HTML::script('spcvn/ace/js/jquery.ui.touch-punch.min.js') }}

	<!-- inline scripts related to this page -->
	<script type="text/javascript">
		jQuery(function($) {
			$('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
				var color_class = $(this).find('option:selected').data('class');
				var new_class = 'widget-box';
				if(color_class != 'default')  new_class += ' widget-color-'+color_class;
				$(this).closest('.widget-box').attr('class', new_class);
			});
			
			$('.scrollable').each(function () {
				var $this = $(this);
				$(this).ace_scroll({
					size: $this.attr('data-size') || 100,
				});
			});
			$('.scrollable-horizontal').each(function () {
				var $this = $(this);
				$(this).ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top',//show the scrollbars on top(default is bottom)
					size: $this.attr('data-size') || 500,
					mouseWheelLock: true
				  }
				).css({'padding-top': 12});
			});
			
			$(window).on('resize.scroll_reset', function() {
				$('.scrollable-horizontal').ace_scroll('reset');
			});
		
			$('#id-checkbox-vertical').prop('checked', false).on('click', function() {
				$('#widget-toolbox-1').toggleClass('toolbox-vertical')
				.find('.btn-group').toggleClass('btn-group-vertical')
				.filter(':first').toggleClass('hidden')
				.parent().toggleClass('btn-toolbar')
			});
		
			$('.widget-container-col').sortable({
		        connectWith: '.widget-container-col',
				items:'> .widget-box',
				handle: ace.vars['touch'] ? '.widget-title' : false,
				cancel: '.fullscreen',
				opacity:0.8,
				revert:true,
				forceHelperSize:true,
				placeholder: 'widget-placeholder',
				forcePlaceholderSize:true,
				tolerance:'pointer',
				start: function(event, ui) {
					ui.item.parent().css({'min-height':ui.item.height()})
				},
				update: function(event, ui) {
					ui.item.parent({'min-height':''})
					var widget_order = {}
					$('.widget-container-col').each(function() {
						var container_id = $(this).attr('id');
						widget_order[container_id] = []
						
						
						$(this).find('> .widget-box').each(function() {
							var widget_id = $(this).attr('id');
							widget_order[container_id].push(widget_id);
						});
					});
					ace.data.set('demo', 'widget-order', widget_order, null, true);
				}
		    });
			
			$(document).on('shown.ace.widget hidden.ace.widget closed.ace.widget', '.widget-box', function(event) {
				var widgets = ace.data.get('demo', 'widget-state', true);
				if(widgets == null) widgets = {}
		
				var id = $(this).attr('id');
				widgets[id] = event.type;
				ace.data.set('demo', 'widget-state', widgets, null, true);
			});
			
			(function() {
				var container_list = ace.data.get('demo', 'widget-order', true);
				if(container_list) {
					for(var container_id in container_list) if(container_list.hasOwnProperty(container_id)) {
		
						var widgets_inside_container = container_list[container_id];
						if(widgets_inside_container.length == 0) continue;
						
						for(var i = 0; i < widgets_inside_container.length; i++) {
							var widget = widgets_inside_container[i];
							$('#'+widget).appendTo('#'+container_id);
						}
		
					}
				}
				
				var widgets = ace.data.get('demo', 'widget-state', true);
				if(widgets != null) {
					for(var id in widgets) if(widgets.hasOwnProperty(id)) {
						var state = widgets[id];
						var widget = $('#'+id);
						if
						(
							(state == 'shown' && widget.hasClass('collapsed'))
							||
							(state == 'hidden' && !widget.hasClass('collapsed'))
						) 
						{
							widget.widget_box('toggleFast');
						}
						else if(state == 'closed') {
							widget.widget_box('closeFast');
						}
					}
				}
				
				$('#main-widget-container').removeClass('invisible');
				
				$('#reset-widgets').on('click', function() {
					ace.data.remove('demo', 'widget-state');
					ace.data.remove('demo', 'widget-order');
					document.location.reload();
				});
			})();
		});
	</script>
@stop