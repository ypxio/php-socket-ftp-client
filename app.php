<?php

error_reporting(0);

include("def.php");

echo 'ftp host server : ';

$ftp_server = fgets(STDIN);
$ftp_server = rtrim($ftp_server, "\r\n");

$conn_id = ftp_connect($ftp_server);

echo "Connected to $ftp_server\n";

echo "Username for $ftp_server: ";
$ftp_user_name = fgets(STDIN);
$ftp_user_name = rtrim($ftp_user_name, "\r\n");

$ftp_user_pass = get_password("Password required for $ftp_user_name");
$ftp_user_pass = rtrim($ftp_user_pass, "\r\n");

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

if($login_result)
{
	echo "User $ftp_user_name logged in successfully\n";
}

$current_dir = '/';

while(1)
{
	echo "ftp://$ftp_server > ";
	$syntax = fgets(STDIN);
	$syntax = rtrim($syntax, "\r\n");

	$syntax = explode(" ", $syntax);
	$command = $syntax[0];
	$value = $syntax[1];

	switch($command)
	{
		case 'upload':
		include("upload.php");
		break;

		case 'download':
		include("download.php");
		break;

		case 'list':
			switch($value)
			{
				case "remote":
				include("list_remote.php");
				break;

				case "local":
				include("list_local.php");
				break;
			}
		break;

		case 'cd':
			if($value[0] == '/') $current_dir = $value; else $current_dir = rtrim($current_dir,'/'). '/' .$value;
			ftp_chdir($conn_id,$current_dir);		
			break;

		case 'pwd':
			echo $current_dir;
			break;
	}

	echo "\n";
}

echo "\n";
