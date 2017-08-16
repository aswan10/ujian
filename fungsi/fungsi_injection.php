<?php
class Bajak {
function antiinjection($data){
	$filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
	return $filter_sql;
}
}
$injection = new Bajak;
?>