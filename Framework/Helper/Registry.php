<?php

namespace Framework\Helper;

use Framework\Base;

class Registry extends Base
{
	private static $instance;

	final function __construct()
	{
	}

	final static function instance()
	{
		if ( !isset( self::$instance ) ) {
			self::$instance = new static();
		}

		return self::$instance;
	}

}