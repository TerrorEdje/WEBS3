<?php
function checkAccessById()
{
	if (Auth::check())
	{
		$allowedRights = func_get_args();
		foreach ($allowedRights as $allowed)
		{
			if (Auth::user()->rights_id == $allowed)
			{
				return true;
			}
		}
	}
	return false;
}

function checkAccessReply($id)
{
	$reply = Reply::find($id);
	if (Auth::check())
	{
		if (Auth::user()->id == $reply->by)
		{
			return true;
		}
		if (checkAccess("Admin","Moderator"))
		{
			return true;
		}
	}
	return false;
}
?>