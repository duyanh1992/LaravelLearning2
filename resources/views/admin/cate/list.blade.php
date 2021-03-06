@extends('admin.master')
@section('pageHeader', 'Cate')
@section('function', 'List')
@section('content')

<div class="col-md-12">
	<!-- Show alert message  -->
	@include('admin.blocks.message')
	<!-- End show alert message -->
</div>
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Category Parent</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index=1; ?>
		@foreach($getListCate as $item)
		<tr class="odd gradeX" align="center">
			<td>{!! $index !!}</td>
			<td>{!! $item->name !!}</td>
			<td>
				<!-- etting showed cate parent name -->
			<?php
				$cateParentName = DB::table('cates')->select('name')
								  ->where('id', $item->parent_id)
								  ->first();
				if(!isset($cateParentName->name)){
					echo 'none';
				}
				else{
					echo $cateParentName->name;
				}
			?>
			 <!-- End setting showed cate parent name -->
			</td>
			<td class="center"><i class="fa fa-trash-o fa-fw"></i><a onclick="return delConfirm();"; href="{!! route('getDelCate', $item['id']) !!}"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('getEditCate', $item['id']) !!}">Edit</a></td>
		</tr>
		<?php $index++;?>
		@endforeach
	</tbody>
</table>
@endsection()
