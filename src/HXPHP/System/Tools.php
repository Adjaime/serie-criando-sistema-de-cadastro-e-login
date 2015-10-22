<?php

namespace HXPHP\System;

class Tools
{
	/**
	 * Exibe os dados
	 * @param  mist $data Variável que será "debugada"
	 */
	static function dd($data, $dump = false)
	{
		echo '<pre>';

		if ($dump)
			var_dump($data);
		else
			print_r($data);
		
		echo '</pre>';
	}

	/**
	 * Criptografa a senha do usuário no padrão HXPHP
	 * @param  string $password Senha do usuário
	 * @param  string $salt     Código alfanumérico
	 * @return array            Array com o SALT e a SENHA
	 */
	static function hashHX($password, $salt = null)
	{
		
		if (is_null($salt))
			$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));

		$password = hash('sha512', $password.$salt);
		
		return array(
			'salt' => $salt,
			'password' => $password
		);
	}

	/**
	 * Processo de tratamento para o mecanismo MVC
	 * @param string $input     String que será convertida
	 * @return string           String convertida
	 */
	static function filteredName($input)
	{
		$find    = array(
			'-',
			'_'
		);
		$replace = array(
			' ',
			' '
		);
		return str_replace(' ', '', ucwords(str_replace($find, $replace, $input)));
	}
}