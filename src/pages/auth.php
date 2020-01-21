<?php
function auth($login, $passwd)
{
	$content = file_get_contents('../db/users');
	$accounts = unserialize($content);
	if ($accounts)
	{
		foreach ($accounts as $key => $value)
		{
			if ($value['login'] === $login && $value['passwd'] === hash('whirlpool', $passwd))
				return true;
		}
	}
	return false;
}
?>
