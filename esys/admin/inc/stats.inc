<?php
function stats($where = 'here', $query = 'SELECT * from articles')
{
global $$where;

$results = mysql_query($query) or die(mysql_error());

//forward the number of gotten rows to where
$$where = mysql_num_rows($results);

}
?>