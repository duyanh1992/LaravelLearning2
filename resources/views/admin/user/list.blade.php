@extends('admin.master')
@section('pageHeader', 'User')
@section('function', 'List')
@section('content')
@if(Session::get('message'))
	<div id="test" class="alert alert-{!! Session::get('type') !!}">
		{!! Session::get('message') !!}
	</div>
@endif
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Username</th>
			<th>Level</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index = 1 ?>
		@foreach($allUser as $user)
		<tr class="odd gradeX" align="center">
			<td>{{ $index }}</td>
			<td>{!! $user->username !!}</td>
			<td>
				@if(($user->level) == 1)
				{!! "Admin" !!}
				@else
				{!! "Member" !!}
				@endif
			</td>
			<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! route('getDelUser', $user->id) !!}" onclick="return delConfirm();"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('getEditUser', $user->id) !!}">Edit</a></td>
		</tr>
		<?php $index++ ?>
		@endforeach()
	</tbody>
</table>
@endsection()  
