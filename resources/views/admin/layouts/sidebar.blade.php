<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar menupos-fixed menu-light ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				<ul class="nav pcoded-inner-navbar ">					
					<li class="nav-item">
					    <a href="{{URL::to('admin/dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layout"></i></span><span class="pcoded-mtext">Events Management</span></a>
					    <ul class="pcoded-submenu">
					        <li><a href="{{URL::to('admin/event/list')}}">Event List</a></li>
					        <li><a href="{{URL::to('admin/event/sevices/list')}}">Event Sevices</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
					    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-list"></i></span><span class="pcoded-mtext">Packages</span></a>
					    <ul class="pcoded-submenu">
							<li><a href="{{URL::to('admin/packages/features')}}">Features List</a></li>
					        <li><a href="{{URL::to('admin/packages/list')}}">Packages List</a></li>
					        <li><a href="{{URL::to('admin/packages/add')}}">Add New Package</a></li>
					    </ul>
					</li>
					<li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="fa fa-image"></i></span><span class="pcoded-mtext">Portfolio's</span></a>
						<ul class="pcoded-submenu">
							<li><a href="{{URL::to('admin/portfolios/photo-albums')}}">Photo Album's</a></li>
							<li><a href="{{URL::to('admin/portfolios/video-albums')}}">Video Album's</a></li>
						</ul>
					</li>					
					<!-- <li class="nav-item">
					    <a href="{{URL::to('admin/portfolios')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-image"></i></span><span class="pcoded-mtext">Portfolio's</span></a>
					</li> -->
					<li class="nav-item">
					    <a href="{{URL::to('admin/teams')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Team</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{URL::to('admin/event/eventenquiry/list')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Event Enquiry List</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{URL::to('admin/testimonials')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-quote-left"></i></span><span class="pcoded-mtext">Testimonials</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{URL::to('admin/general-setting')}}" class="nav-link "><span class="pcoded-micon"><i class="fa fa-cog"></i></span><span class="pcoded-mtext">General Setting</span></a>
					</li>
					<li class="nav-item">
					    <a href="{{URL::to('admin/logout')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-log-out"></i></span><span class="pcoded-mtext">Logout</span></a>
					</li>			
				</ul>	
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->