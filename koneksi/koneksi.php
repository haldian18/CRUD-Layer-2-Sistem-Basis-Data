<?php
function open_connection() {
	$hostname = "192.168.10.101";
	$username = "uapp";
	$password = "uapppass";
	$dbname = "wb17n007";
	$koneksi = mysqli_connect($hostname, $username, $password, $dbname);
	return $koneksi;
}


