<?php

require_once('config.php');

$db_connection_handle = NULL;

function db_connect()
{
  global $DBUSER, $DBPASS, $DBNAME, $db_connection_handle;

  $db_connection_handle = 
    new PDO("mysql:host=localhost;dbname=$DBNAME", $DBUSER, $DBPASS);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db_connection_handle->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
  $db_connection_handle->
    setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
}

function db_create_user_table($drop = TRUE)
{
  global $db_connection_handle;

  if ($drop)
  {
    $sql = "DROP TABLE IF EXISTS users";
    $result = $db_connection_handle->exec($sql);
  }

  $sql = <<<ZZEOF
CREATE TABLE users (
  login VARCHAR(80) PRIMARY KEY,
  pass VARCHAR(40) NOT NULL,
  fname VARCHAR(40) NOT NULL,
  lname VARCHAR(40) NOT NULL,
  pnumber VARCHAR(40) NOT NULL,
  saddress VARCHAR(80) NOT NULL,
  city VARCHAR(40) NOT NULL 
)
ZZEOF;
  $result = $db_connection_handle->exec($sql);

  return $result;
}

function db_add_new_user($user, $pass, $fname, $lname, $pnumber, $saddress, $city, $do_hash = TRUE)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? sha1($pass) : $pass;

  $user_array = array(
  	':login' => $user, 
	':pass' => $adjusted_pass,
	':fname' => $fname,
	':lname' => $lname,
	':pnumber' => $pnumber,
	':saddress' => $saddress,
	':city' => $city
  );

  $sql = 'INSERT INTO users VALUES (:login, :pass, :fname, :lname, :pnumber, :saddress, :city)';
  $st = $db_connection_handle->prepare($sql);
  $result = $st->execute($user_array);
}

function db_add_new_users($array_of_user_data)
{
	foreach ($array_of_user_data as $user)
	{
		try
		{
			db_add_new_user(
				$user['login'],
				$user['password'],
				$user['fname'],
				$user['lname'],
				$user['pnumber'],
				$user['saddress'],
				$user['city']
			);
		}
		catch (PDOException $e)
		{
			echo 'PDO ERROR: '.$e->getMessage()."\n";
		}
	}
}

function db_check_user($user, $pass, $do_hash = TRUE)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? sha1($pass) : $pass;
  $user_array = array(':user' => $user);
  $sql = 'SELECT pass FROM users WHERE login=:user';

  try
  {
    $st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);

    $result = $st->fetchAll();
    if (count($result) == 1 && strcmp($result[0]['pass'], $adjusted_pass) == 0)
      return TRUE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}

function db_update_password($user, $pass, $do_hash = TRUE)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? sha1($pass) : $pass;
  $user_array = array(':user' => $user, ':pass' => $adjusted_pass);
  $sql = 'UPDATE users SET pass=:pass WHERE login=:user';

  try
  {
    $st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);
    return TRUE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}

function db_delete_user($user)
{
  global $db_connection_handle;

  $adjusted_pass = $do_hash == TRUE ? sha1($pass) : $pass;
  $user_array = array(':user' => $user);
  $sql = 'DELETE FROM users WHERE login=:user';

  try
  {
    $st = $db_connection_handle->prepare($sql);
    $st->execute($user_array);
    return TRUE;
  }
  catch (PDOException $e)
  {
    return FALSE;
  }
}

?>
