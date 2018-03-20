<?php
//function.php
/**
 *generate_key
 *
 *generates a random key
 *
 *@return (string) random string of 64 characters 
 *
 */
function generate_key()
{
	$length = 32;
	$characters = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z')); 
	shuffle($characters);
	return hash_hmac('sha256', substr(implode('', $characters), 0, $length), time());
}
?>

