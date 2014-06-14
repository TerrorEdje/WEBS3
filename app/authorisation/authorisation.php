<?php
function checkAccess()
{
	if (Auth::check())
	{
		$rights = Right::all();
		$allowedRights = func_get_args();
		foreach ($allowedRights as $allowed)
		{
			foreach($rights as $right)
			{
				if ($right->name == $allowed)
				{
					if (Auth::user()->rights_id == $right->id)
					{
						return true;
					}
				}
			}
		}
	}
	return false;
}

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>