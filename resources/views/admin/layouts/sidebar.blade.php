<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="{{url('/admin')}}" class="brand-link">
		<img src="{{asset('/assets/images/logo.png')}}" alt="{{config('app.name', 'EREBS')}}-Logo" class="brand-image img-circle " style="opacity:1">
    <span class="brand-text"><b>SUMMIT-IAS</b></span>
	</a>

	<div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

				<li class="nav-item has-treeview">
          <a href="{{url('/admin')}}" class="nav-link @if(isset($Header) && $Header == 'Dashboard') active @endif">
            <i class="nav-icon fa fa-home"></i>
            <p><b>Dashboard</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/users')}}" class="nav-link @if(isset($Header) && $Header == 'Users') active @endif">
            <i class="nav-icon fa fa-user-graduate"></i>
            <p><b>Users</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/getintouch')}}" class="nav-link @if(isset($Header) && $Header == 'Get in Touch') active @endif">
            <i class="nav-icon fa fa-headset"></i>
            <p><b>Get in Touch</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/contactus')}}" class="nav-link @if(isset($Header) && $Header == 'Contact Us') active @endif">
            <i class="nav-icon fa fa-envelope-open"></i>
            <p><b>Contact Us</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/category')}}" class="nav-link @if(isset($Header) && $Header == 'Category') active @endif">
            <i class="nav-icon fa fa-th-large"></i>
            <p><b>Course Category</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/courses')}}" class="nav-link @if(isset($Header) && $Header == 'Courses') active @endif">
            <i class="nav-icon fa fa-copy"></i>
            <p><b>Courses</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/subjects')}}" class="nav-link @if(isset($Header) && $Header == 'Subjects') active @endif">
            <i class="nav-icon fa fa-file-alt"></i>
            <p><b>Subjects</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/topics')}}" class="nav-link @if(isset($Header) && $Header == 'Topics') active @endif">
            <i class="nav-icon fa fa-certificate"></i>
            <p><b>Topics</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/articles')}}" class="nav-link @if(isset($Header) && $Header == 'Articles') active @endif">
            <i class="nav-icon fa fa-file-signature"></i>
            <p><b>Articles</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/toppers')}}" class="nav-link @if(isset($Header) && $Header == 'Toppers') active @endif">
            <i class="nav-icon fa fa-trophy"></i>
            <p><b>Toppers</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/reviews')}}" class="nav-link @if(isset($Header) && $Header == 'Reviews') active @endif">
            <i class="nav-icon fa fa-star"></i>
            <p><b>Testimonials</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/downloads')}}" class="nav-link @if(isset($Header) && $Header == 'Downloads') active @endif">
            <i class="nav-icon fa fa-file-download"></i>
            <p><b>Downloads</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/affairs')}}" class="nav-link @if(isset($Header) && $Header == 'Current Affairs') active @endif">
            <i class="nav-icon fa fa-newspaper"></i>
            <p><b>Current Affairs</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview  @if(isset($Header) && $Header == 'Gallery') menu-open @endif">
          <a href="#" class="nav-link @if(isset($Header) && $Header == 'Gallery') active @endif ">
            <i class="nav-icon fas fa-images"></i>
            <p><b>Gallery</b> <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/admin/gallery/category')}}" class="nav-link @if(isset($subHeader) && $subHeader == 'Gallery Category') active nav-sub-link @endif  ">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery Category</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/gallery')}}" class="nav-link @if(isset($subHeader) && $subHeader == 'Gallery') active nav-sub-link @endif  ">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="{{url('/admin/notifications')}}" class="nav-link @if(isset($Header) && $Header == 'Notifications') active @endif">
            <i class="nav-icon fa fa-bell"></i>
            <p><b>Notifications</b></p>
          </a>
        </li>

        <li class="nav-item has-treeview  @if(isset($Header) && $Header == 'Settings') menu-open @endif">
          <a href="#" class="nav-link @if(isset($Header) && $Header == 'Settings') active @endif ">
            <i class="nav-icon fas fa-cog"></i>
            <p><b>Settings</b> <i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/admin/settings/general')}}" class="nav-link @if(isset($subHeader) && $subHeader == 'General Settings') active nav-sub-link @endif  ">
                <i class="far fa-circle nav-icon"></i>
                <p>General Settings</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('/admin/settings/seo')}}" class="nav-link @if(isset($subHeader) && $subHeader == 'SEO Content') active nav-sub-link @endif  ">
                <i class="far fa-circle nav-icon"></i>
                <p>SEO Content</p>
              </a>
            </li>
          </ul>
        </li>

			</ul>
		</nav>
	</div>
</aside>
