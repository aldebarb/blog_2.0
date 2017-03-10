<?php

function removeMaliciousCode($data)
{
	$data = implode("", explode("\\", $data));
}