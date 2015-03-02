@extends('layouts.base')

@section('body')

	{{-- OFFCANVAS --}}
	<div class="off-canvas-wrap" data-offcanvas>
		<div class="inner-wrap">

			{{-- HEADER --}}
			<nav class="tab-bar">
				<section class="left-small"><a class="left-off-canvas-toggle menu-icon" title="{{ _('Menu') }}"><span>&nbsp;</span></a></section>
				<section class="middle tab-bar-section">{!! link_to_route('home', $appName) !!} <i>{{ $title }}</i></section>
			</nav>

			{{-- LEFT --}}
			<aside class="left-off-canvas-menu">
				@if ($currentUser)
					@include('side.sections', ['sections' => $sections])
					@include('side.me', ['user' => $currentUser])
				@else
					@include('side.login')
				@endif

				@include('side.languages', ['languages' => $languagesButCurrent])
			</aside>

			{{-- MAIN CONTAINER --}}
			<div id="main" class="row">
				<br/>
				{{-- FLASH MESSAGES --}}
				@foreach (['error' => 'alert', 'success' => 'success', 'info' => '', 'secondary' => 'secondary'] as $flashMessage => $boxClass)
					@if (Session::has($flashMessage))
					<div class="alert-box {{ $boxClass }}" data-alert>
						{{ Session::get($flashMessage) }}
						<a class="close">&times;</a>
					</div>
					@endif
				@endforeach

				{{-- CONTENT --}}
				@yield('content')
			</div>

			{{-- Close offcanvas after click the main content --}}
			<a class="exit-off-canvas"></a>
		</div><!--.inner-wrap-->
	</div><!--.off-canvas-wrap-->
	{{-- END OFFCANVAS --}}
@stop


@section('js')
@parent
<script>
$(document).ready(function() {

	// Make canvas content as tall as possible
	var $main = $('#main'), height = Math.max($doc.height(), $(window).height());
	if($main.height() < height)
		$main.height(height);

});
</script>
@stop
