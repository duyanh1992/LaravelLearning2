<div class="container">
	<div id="categorymenu">
		<nav class="subnav">
			<ul class="nav-pills categorymenu">
				<li><a class="active"  href="{!! url('/') !!}">Home</a></li>
				<?php
				// Get parent cate:
				$parentCate = DB::table('cates')->where('parent_id', 0)->get();
				?>
				@foreach($parentCate as $item1)
				<li><a href="{!! route('getAllPrdByCate', $item1->id) !!}">{!! $item1->name !!}</a>
					<div>
						<?php
							// Get child cate:
							$childCate = DB::table('cates')->where('parent_id', $item1->id)->get();
						?>
						<ul>
						@foreach($childCate as $item2)
							<li><a href="{!! route('getPrdCate', $item2->id) !!}">{!! $item2->name !!}</a> </li>						
						@endforeach	
						</ul>
					</div>
				</li>	
				@endforeach	
			</ul>
		</nav>
	</div>
</div>