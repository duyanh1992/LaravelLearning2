@extends('admin.master')
@section('pageHeader', 'Product')
@section('function', 'List')
@section('content')
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
@if(Session::get('message'))
	<div class="alert alert-{!! Session::get('type') !!}">	
		{!! Session::get('message') !!}
	</div>
@endif
	<thead>
		<tr align="center">
			<th>ID</th>
			<th>Name</th>
			<th>Price</th>
			<th>Date</th>
			<th>Category</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php $index=1; ?>
		@foreach($listPrd as $item)
		<tr class="odd gradeX" align="center">
			<td>{!! $index !!}</td>
			<td>{!! $item->name !!}</td>
			<td>{!! number_format($item->price,0,',','.') !!} VNĐ</td>
			<td><?php echo Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();?></td>
			<td>
			<?php
				$cateName = DB::table('cates')
							->select('name')
							->where('id',$item->cate_id)
							->first();
				echo $cateName->name;			
			?>
			</td>
			<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{!! route('getDelPrd', $item->id) !!}" onclick="return delConfirm();"> Delete</a></td>
			<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! route('getEditPrd', $item->id) !!}">Edit</a></td>
		</tr>      
		<?php $index++; ?>		
		@endforeach		
	</tbody>
</table>
@endsection()  
