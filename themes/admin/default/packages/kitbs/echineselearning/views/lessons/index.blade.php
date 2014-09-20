@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('kitbs/echineselearning::lessons/general.title') }} ::
@parent
@stop

{{-- Queue Assets --}}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}
{{ Asset::queue('data-grid', 'cartalyst/js/data-grid.js', 'underscore') }}
{{ Asset::queue('moment', 'moment/js/moment.js') }}

{{ Asset::queue('kitbs-echineselearning', 'kitbs/echineselearning::css/style.css', 'bootstrap') }}
{{ Asset::queue('kitbs-echineselearning', 'kitbs/echineselearning::js/script.js', 'jquery') }}

{{-- Partial Assets --}}
@section('assets')
@parent
@stop

{{-- Inline Styles --}}
@section('styles')
@parent
@stop

{{-- Inline Scripts --}}
@section('scripts')
@parent
<script>
$(function()
{
	var dg = $.datagrid('lesson', '.data-grid', '.data-grid_pagination', '.data-grid_applied', {
		loader: '.loading',
		throttle: 25,
		scroll: '.data-grid',
		callback: function()
		{
			$('#checkAll').prop('checked', false);

			$('#actions').prop('disabled', true);
		}
	});

	$(document).on('click', '#checkAll', function()
	{
		$('input:checkbox').not(this).prop('checked', this.checked);

		var status = $('input[name="entries[]"]:checked').length > 0;

		$('#actions').prop('disabled', ! status);
	});

	$(document).on('click', 'input[name="entries[]"]', function()
	{
		var status = $('input[name="entries[]"]:checked').length > 0;

		$('#actions').prop('disabled', ! status);
	});

	$(document).on('click', '[data-action]', function(e)
	{
		e.preventDefault();

		var action = $(this).data('action');

		var entries = $.map($('input[name="entries[]"]:checked'), function(e, i)
		{
			return +e.value;
		});

		$.ajax({
			type: 'POST',
			url: '{{ URL::toAdmin('echineselearning/lessons') }}',
			data: {
				action : action,
				entries: entries
			},
			success: function(response)
			{
				dg.refresh();
			}
		});
	});
});
</script>
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">

	<h1>{{{ trans('kitbs/echineselearning::lessons/general.title') }}}</h1>

</div>

<div class="row">

	<div class="col-lg-7">

		{{-- Data Grid : Applied Filters --}}
		<div class="data-grid_applied" data-grid="lesson"></div>

	</div>

	<div class="col-lg-5 text-right">

		<form method="post" action="" accept-charset="utf-8" data-search data-grid="lesson" class="form-inline" role="form">

			<div class="form-group">

				<div class="loading"></div>

			</div>

			<div class="btn-group text-left">

				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					{{{ trans('general.filters') }}} <span class="caret"></span>
				</button>

				<ul class="dropdown-menu multi-level" role="menu" data-grid="lesson">
					<li><a href="#">{{{ trans('general.show_all') }}}</a></li>
					<li role="presentation" class="divider"></li>
					<li class="dropdown-submenu">
						<a tabindex="-1" href="#">Status</a>
						<ul class="dropdown-menu">
							<li><a href="#" data-reset data-filter="enabled:1" data-label="enabled::{{{ trans('kitbs/echineselearning::lessons/table.all_enabled') }}}">{{{ trans('kitbs/echineselearning::lessons/table.show_enabled') }}}</a></li>
							<li><a href="#" data-reset data-filter="enabled:0" data-label="enabled::{{{ trans('kitbs/echineselearning::lessons/table.all_disabled') }}}">{{{ trans('kitbs/echineselearning::lessons/table.show_disabled') }}}</a></li>
						</ul>
					</li>
					{{--<li class="dropdown-submenu">
						<a tabindex="-1" href="#">Date</a>
						<ul class="dropdown-menu">
							<!-- <li><a href="#" data-filter="is_past:1" data-label="is_past::{{{ trans('kitbs/echineselearning::lessons/table.all_past') }}}">{{{ trans('kitbs/echineselearning::lessons/table.show_past') }}}</a></li> -->
							<!-- <li><a href="#" data-filter="is_past:0" data-label="is_past::{{{ trans('kitbs/echineselearning::lessons/table.all_future') }}}">{{{ trans('kitbs/echineselearning::lessons/table.show_future') }}}</a></li> -->
						</ul>
					</li>--}}
					<li class="dropdown-submenu">
						<a tabindex="-1" href="#">Teacher</a>
						<ul class="dropdown-menu">
							@foreach ($teachers as $teacher)
							<li><a href="#" data-reset data-filter="teacher:{{{ $teacher }}}" data-label="teacher::{{{ $teacher }}}">{{ $teacher ?: '(empty)' }}</a></li>
							@endforeach
						</ul>
					</li>
				</ul>

			</div>

			<div class="form-group has-feedback">

				<input name="filter" type="text" placeholder="{{{ trans('general.search') }}}" class="form-control">

				<span class="glyphicon fa fa-search form-control-feedback"></span>

			</div>

			<a class="btn btn-primary" href="{{ URL::toAdmin('echineselearning/lessons/create') }}"><i class="fa fa-plus"></i> {{{ trans('button.create') }}}</a>

		</form>

	</div>

</div>

<br />

<table data-source="{{ URL::toAdmin('echineselearning/lessons/grid') }}" data-grid="lesson" class="data-grid table table-striped table-bordered table-hover">
<colgroup>
	<col style="width:30px;">
	<col class="col-md-2">
	<col class="col-md-2">
	<col class="col-md-2">
	<col class="col-md-2">
	<col class="col-md-1">
	<col class="col-md-3">
</colgroup>
	<thead>
		<tr>
			<th><input type="checkbox" name="checkAll" id="checkAll"></th>
			<th class="sortable" data-sort="lesson_at" colspan="3">{{{ trans('kitbs/echineselearning::lessons/table.lesson_at') }}}</th>
			<th class="sortable" data-sort="teacher">{{{ trans('kitbs/echineselearning::lessons/table.teacher') }}}</th>
			<th class="sortable" data-sort="enabled">{{{ trans('kitbs/echineselearning::lessons/table.enabled') }}}</th>
			<th class="sortable" data-sort="updated_at">{{{ trans('kitbs/echineselearning::lessons/table.updated_at') }}}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

{{-- Data Grid : Pagination --}}
<div class="data-grid_pagination" data-grid="lesson"></div>

@include('kitbs/echineselearning::grids/lesson/results')
@include('kitbs/echineselearning::grids/lesson/filters')
@include('kitbs/echineselearning::grids/lesson/pagination')
@include('kitbs/echineselearning::grids/lesson/no_results')
@include('kitbs/echineselearning::grids/lesson/no_filters')

@stop
