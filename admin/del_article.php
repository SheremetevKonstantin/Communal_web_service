<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/conn.php');
if( $_SESSION['auth'] != true && $_SESSION['rang'] != 1 ) {
	
    header("Location: /index.php");
    exit;
}
$id= $_GET['id'];

$query = 'DELETE FROM blog WHERE id="'.$id.'"';
mysqli_query($conn,$query);
mysqli_close($conn);
header("Location: /admin/edit_blog.php");