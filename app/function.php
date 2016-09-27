<?php
function theme($view_path)
{
	return env('APP_TM', 'default').".".$view_path;
}