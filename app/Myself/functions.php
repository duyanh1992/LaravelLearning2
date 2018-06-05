<?php
function parentCate($arr, $parent_id=0, $add='', $select=0){
	foreach($arr as $item){
		if($item['parent_id'] == $parent_id){
			$id = $item['id'];

			if($select == $id){
				echo "<option value='".$id."' selected='selected'>".$add.$item['name']."</option><br />";
			}
			else{
				echo "<option value='".$id."'>".$add.$item['name']."</option><br />";
			}
			parentCate($arr, $id, $add.'--- ',$select);
		}
	}
}

function ramdomString(){
	
}
?>
