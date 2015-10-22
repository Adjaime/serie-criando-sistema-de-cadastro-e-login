<?php

namespace HXPHP\System\Storage;

class Session implements StorageInterface
{
	/**
	 * Prefixo das sessões
	 */
	const PREFIX = 'hxphp_storage_session';

	/**
	 * Método que cria uma sessão
	 * @param string $name  Nome da sessão
	 * @param string $value Conteúdo da sessão
	 */
	public function set($name, $value)
	{
		$_SESSION[self::PREFIX][$name] = $value;

		return $this;
	}

	/**
	 * Método que seleciona uma sessão
	 * @param  string $name Nome da sessão
	 * @return string       Conteúdo da sessão
	 */
	public function get($name)
	{
		if ($this->exists($name)) {
			return $_SESSION[self::PREFIX][$name];
		}

		return null;
	}

	/**
	 * Verifica a existência da sessão
	 * @param  string  $name Nome da sessão
	 * @return boolean       Status do processo
	 */
	public function exists($name)
	{
		return isset($_SESSION[self::PREFIX][$name]);
	}

	/**
	 * Exclui uma sessão
	 * @param  string $name Nome da sessão
	 */
	public function clear($name)
	{
		if ($this->exists($name)) {
			unset($_SESSION[self::PREFIX][$name]);
		}
	}
}