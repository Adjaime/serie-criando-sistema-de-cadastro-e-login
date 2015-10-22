<?php

namespace HXPHP\System\Services;

use HXPHP\System\Modules\Messages\Messages;

class PasswordRecovery
{

	/**
	 * Injeção do módulo de Mensagens
	 * @var object
	 */
	public $messages;

	/**
	 * Resultados do processo
	 * @var boolean
	 */
	public $status = false;

	/**
	 * Link de redefinição
	 * @var null
	 */
	private $link = null;

	/**
	 * Código alfanumérico de autenticação da requisição
	 * @var string
	 */
	public $token;

	/**
	 * Método construtor
	 */
	public function __construct()
	{
		$this->messages = new Messages('password-recovery');
		$this->messages->setBlock('alerts');
		
		return $this;
	}

	/**
	 * Gera o token
	 */
	private function generateToken()
	{
		$this->token = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
	}

	/**
	 * Define o link
	 * @param string $link Prefixo do link
	 */
	public function setLink($link)
	{
		$this->generateToken();
		$this->link = $link.$this->token;
	}

	/**
	 * Envia a mensagem de redefinição de senha
	 * @param  string $name  Nome do usuário
	 * @param  string $email E-mail do usuário
	 * @return array         Mensagem resultante do processo
	 */
	public function sendRecoveryLink($name, $email)
	{
		if (is_null($this->link))
			return $this->messages->getAlert('link-nao-definido');

		$message = $this->messages->getMessage('link-enviado', array(
			$name,
			$this->link,
			$this->link
		));

		if ($this->messages->sendEmail($email, $message)) {
			$this->status = true;
			return $this->messages->getAlert('link-enviado');
		}

		return $this->getMessage('email-nao-enviado');
	}
}