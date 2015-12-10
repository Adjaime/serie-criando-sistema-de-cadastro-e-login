<?php

namespace HXPHP\System\Configs;

class RegisterModules
{
	public $modules = array();
	
	public function __construct()
	{
		$this->modules = array(
			'database',
			'mail',
			'auth'
		);
		
		return $this;
	}
}