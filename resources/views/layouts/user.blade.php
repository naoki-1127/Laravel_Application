<!doctype html>
<html lang="ja">

<head>
	@if (Auth::check())
	<meta name="user_id" content="{{ Auth::user()->id }}" />
	@endif
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="generator" content="Jekyll v4.0.1">
	<title>山本のサイト</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
	<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="https://unpkg.com/feather-icons"></script>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}

		a {
			color: white;
		}

		.login-user:hover {
			color: white;
		}

		#sidebarMenu {
			min-height: 100vh;
		}

		.save-report {
			color: white;
		}
	</style>
</head>

<body>
	<div id="app">
		<nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap shadow">
			<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">YAMAMOTO HP</a>
			<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
				data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
			<!--         <ul class="navbar-nav px-3">
            <li class="nav-item dropdown"> -->
			<a id="navbarDropdown" class="nav-link dropdown-toggle login-user" href="#" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
				
				{{ Session::get('name') }} <span class="caret"></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
					{{ __('ログアウト') }}
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>
			<!--             </li>
        </ul> -->
		</nav>

		<div class="container-fluid">
			<div class="row">
				<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-info sidebar collapse" min-height>
					<div class="sidebar-sticky pt-3">
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link active" href=<?php $url=env('APP_URL')?>./home>
									<span data-feather="home"></span>
									Dashboard <span class="sr-only">(current)</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./todo>
									<span data-feather="list"></span>
									TodoList
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./photo>
									<span data-feather="image"></span>
									Photo
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./dictionary>
									<span data-feather="book"></span>
									Dictionary
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./storageapi>
									<span data-feather="hard-drive"></span>
									Storage
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./study>
									<span data-feather="pen-tool"></span>
									Study
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href=<?php $url=env('APP_URL')?>./news>
									<span data-feather="tablet"></span>
									News
								</a>
							</li>
						</ul>

						<h6
							class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 save-report">
							<span>Saved reports</span>
							<a class="d-flex align-items-center save-report" href="#" aria-label="Add a new report">
								<span data-feather="plus-circle"></span>
							</a>
						</h6>
						<ul class="nav flex-column mb-2">
							<li class="nav-item">
								<a class="nav-link" href="#">
									<span data-feather="file-text"></span>
									Current month
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									<span data-feather="file-text"></span>
									Last quarter
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									<span data-feather="file-text"></span>
									Social engagement
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									<span data-feather="file-text"></span>
									Year-end sale
								</a>
							</li>
						</ul>
					</div>
				</nav>

				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

					<main class="py-4">
						@yield('content')
					</main>
					<!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
				</main>

			</div>
		</div>
	</div>
	<script>
		feather.replace()
	</script>
</body>

</html>