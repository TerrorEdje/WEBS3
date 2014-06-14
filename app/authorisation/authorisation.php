<?php
public function checkAccess()
{
	$rights = Right::all();
	$allowedRights = func_get_args();

	foreach ($allowedRights as $allowed)
	{
		foreach($rights as $right)
		{
			if ($right['name'] == $allowed)
			{
				return true;
			}
		}
	}

	return false;
}
?>