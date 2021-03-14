<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">
<div class="h-100" data-simplebar>


<!--- Sidemenu -->
<div id="sidebar-menu">

<ul id="side-menu">
	@canany(['AdmincpSuper','Admincp','Users','editor'], "App\Models\User")

		<li class="{{ Request::is('users/*') ? 'menuitem-active' : '' }}">
			<a href="#Profile" data-toggle="collapse">
			<i class="fas fa-folder-open"></i>
			<span class="badge badge-success badge-pill float-right">4</span>
			<span> User </span>
			</a>
			<div class="collapse" id="Profile">

				<ul class="nav-second-level">
					<li class="{{ Request::is('users/edit') ? 'menuitem-active' : '' }}">
				<a href="{{ url('users') }}/edit">Edit</a></li>
				@canany(['AdmincpSuper','Admincp','Notification'], "App\Models\User")
					<li class="{{ Request::is('users/notifications') ? 'menuitem-active' : '' }}">
				<a href="{{ url('users') }}/notifications">Notifications</a>
				</li>
			  @endcanany
				@canany(['AdmincpSuper','Admincp','Favorit'], "App\Models\User")
					<li class="{{ Request::is('users/favorit') ? 'menuitem-active' : '' }}">
				<a href="{{ url('users') }}/favorit">Favorit</a>
				</li>
			  @endcanany
				@canany(['AdmincpSuper','Admincp','Watch_later'], "App\Models\User")
					<li class="{{ Route::is('users/WatchLater') ? 'menuitem-active' : '' }}">
				<a href="{{ url('users') }}/WatchLater">Watch Later</a></li>

				@endcanany
				@canany(['AdmincpSuper','Admincp','Watch_Now'], "App\Models\User")
					<li class="{{ Route::is('users/watchContinue') ? 'menuitem-active' : '' }}">
				<a href="{{ url('users') }}/watchContinue">Watch Now</a></li>
        @endcanany
				</ul>

			</li>

			@endcanany
{{-- @if (Auth::guest())
	<li>
	<a href="{{ url('movies') }}/WatchLater">
	<i class="fas fa-video"></i>
	<span class="badge badge-success badge-pill float-right">4</span>
	<span> {{__("Movies")}} </span>
	</a>
	</li>
	<li>
	<a href="{{ url('tvshows') }}/WatchLater">
	<i class="fas fa-desktop"></i>
	<span class="badge badge-success badge-pill float-right">4</span>
	<span> {{__("TvShows")}}  </span>
	</a>
	</li>
	<li>
	<a href="{{ url('episodes') }}/WatchLater">
	<i class="fas fa-play"></i>
	<span class="badge badge-success badge-pill float-right">4</span>
	<span> {{__("Episodes")}} </span>
	</a>
	</li>
@endif --}}






	@canany(['AdmincpSuper','Admincp','editor_movies'], "App\Models\User")
		<li>
		<a href="#Movies" data-toggle="collapse">
		<i class="fas fa-video"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> Movies </span>
		</a>
		<div class="collapse" id="Movies">

			<ul class="nav-second-level">
			@can ('create', "App\Models\User")
			<li>
			<a href="{{ url('admincp/movies/Add') }}">Add movies</a>
			</li>
			@endcan

			<li>
			<a href="{{ url('admincp/movies') }}">List movies</a></li>

			</ul>
		</li>
		<!-- End Movies -->
		@else
			<li>
			<a href="{{ url('browse/movies') }}">
			<i class="fas fa-video"></i>
			{{-- <span class="badge badge-success badge-pill float-right">4</span> --}}
			<span> {{__("Movies")}} </span>
			</a>
			</li>

	@endcan
	@canany(['AdmincpSuper','Admincp','editor_tv'], "App\Models\User")
				<!-- start TvShows -->
		<li>
		<a href="#TvShows" data-toggle="collapse">
		<i class="fas fa-desktop"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> TvShows </span>
		</a>
		<div class="collapse" id="TvShows">

			<ul class="nav-second-level">
				@can ('Create',  "App\Models\User")
				<li>
				<a href="{{ url('admincp/tvshows/Add') }}">Add tvshows</a>
				</li>
				@endcan
			<li>
			<a href="{{ url('admincp/tvshows') }}">List tvshows</a></li>

			</ul>
		</li><!-- End TvShows -->
		<!-- start seasons -->
		<li>
		<a href="#Seasons" data-toggle="collapse">
		<i class="fas fa-folder-open"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> Seasons </span>
		</a>
		<div class="collapse" id="Seasons">

		<ul class="nav-second-level">
		<li>
		<a href="{{ url('admincp/seasons') }}">List seasons</a></li>
		</ul>
		</li><!-- End seasons -->

	@canany(['AdmincpSuper','Admincp','editor_ep'], "App\Models\User")
		<!-- start Episodes -->
		<li>
		<a href="#Episodes" data-toggle="collapse">
		<i class="fas fa-play"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> Episodes </span>
		</a>
		<div class="collapse" id="Episodes">

		<ul class="nav-second-level">
		<li>
		<a href="{{ url('admincp/episodes') }}">List Episodes</a>
		</li>
@else
		<li>
		<a href="{{ url('admincp/episodes') }}/WatchLater">
		<i class="fas fa-play"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> {{__("Episodes")}} </span>
		</a>
		</li>
@endcanany
		</ul>
		</li><!-- End Episodes -->
@else

	<li>
	<a href="{{ url('browse/tvshows') }}">
	<i class="fas fa-desktop"></i>
	{{-- <span class="badge badge-success badge-pill float-right">4</span> --}}
	<span> {{__("TvShows")}}  </span>
	</a>
	</li>
	<li>
	<a href="{{ url('browse/episodes') }}">
	<i class="fas fa-play"></i>
	{{-- <span class="badge badge-success badge-pill float-right">4</span> --}}
	<span> {{__("Episodes")}} </span>
	</a>
	</li>
	@endcan


	<!-- start APIDATA -->
	@canany(['AdmincpSuper','Admincp','api'], "App\Models\User")

		<li>
		<a href="#APIDATA" data-toggle="collapse">
		<i class="fas fa-database"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> APIDATA </span>
		</a>
		<div class="collapse" id="APIDATA">

			<ul class="nav-second-level">
				@canany(['AdmincpSuper','Admincp','editor_movies'], "App\Models\User")

			<li>
			<a href="{{ url('admincp/data/movies') }}">Movies</a>
			</li>
		    @endcan
		   	@canany(['AdmincpSuper','Admincp','editor_tv'], "App\Models\User")
			<li>
			<a href="{{ url('admincp/data/tvshows') }}">TvShows</a>
			</li>
		@endcan
		@canany(['AdmincpSuper','Admincp','editor_tv'], "App\Models\User")
			<li>
			<a href="{{ url('admincp/data/seasonss') }}">Seasons</a></li>
		@endcan
		@canany(['AdmincpSuper','Admincp','editor_tv'], "App\Models\User")
			<li>
			<a href="{{ url('admincp/data/episodes') }}">Episodes</a></li>

		@endcan
			</ul>
		</li>
				@endcan
		<!-- End APIDATA -->

			@canany(['AdmincpSuper','Admincp'], "App\Models\User")
				<li>
				<a href="#Categorys" data-toggle="collapse">
				<i class="fas fa-paste"></i>
				<span class="badge badge-success badge-pill float-right">4</span>
				<span> Categorys </span>
				</a>
				<div class="collapse" id="Categorys">

					<ul class="nav-second-level">
					<li>
					<a href="{{ url('admincp/Categorys/add') }}">Add Category</a>
					</li>
					<li>
					<a href="{{ url('admincp/Categorys') }}">List Categorys</a></li>

					</ul>
				</li>
		<!-- start Trached -->
		<li>
		<a href="#Trached" data-toggle="collapse">
		<i class="fa fa-trash"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> Trached </span>
		</a>
		<div class="collapse" id="Trached">

			<ul class="nav-second-level">
				<li>
				<a href="{{ url('admincp/Categorys/deletes') }}">Categorys</a>
				</li>
			<li>
			<a href="{{ url('admincp/movies/deletes') }}">Movies</a>
			</li>
			<li>
			<a href="{{ url('admincp/tvshows/deletes') }}">TvShows</a>
			</li>
			<li>
			<a href="{{ url('admincp/seasons/deletes') }}">Seasons</a></li>
			<li>
			<a href="{{ url('admincp/episodes/deletes') }}">Episodes</a></li>
			</ul>
		</li><!-- End Trached -->

		<!-- start APIDATA -->
		<li>
		<a href="#Options" data-toggle="collapse">
		<i class="fas fa-tools"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span> {{_("Options")}} </span>
		</a>
		<div class="collapse" id="Options">

			<ul class="nav-second-level">
				<li>
				<a href="{{ url('admincp/stats') }}">{{_("Statistics")}}</a>
				</li>
		  <li>
			<a href="{{ url('admincp/options/settings') }}">{{_("Settings")}}</a>
			</li>
			<li>
			<a href="{{ url('admincp/options/seo') }}">{{_("Seo")}}</a>
			</li>	<li>
			<a href="{{ url('admincp/options/api') }}">{{_("Key Api")}}</a>
			</li>
			<li>
			<a href="{{ url('admincp/options/roles') }}">{{_("Roles")}}</a>
			</li>
			</ul>
		</li><!-- End APIDATA -->
		<li>
		<a href="#Users" data-toggle="collapse">
		<i class="fas fa-user"></i>
		<span class="badge badge-success badge-pill float-right">4</span>
		<span>{{_("Users")}}</span>
		</a>
		<div class="collapse" id="Users">

			<ul class="nav-second-level">
			<li>
			<a href="{{ url('admincp/options/users/add') }}">{{_("Add User")}}</a>
			</li>
			<li>
			<a href="{{ url('admincp/options/users') }}">{{_("List Users")}}</a></li>

			</ul>
		</li>

@endcanany
</ul>
</div>
<!-- End Sidebar -->

<div class="clearfix"></div>


<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
</div>
