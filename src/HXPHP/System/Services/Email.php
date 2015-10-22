<?php

namespace HXPHP\System\Services;

class Email
{
	
	/**
	 * Envia e-mail
	 * @param  string $email    E-mail para qual será enviada a mensagem
	 * @param  string $assunto  Assunto da mensagem
	 * @param  string $mensagem Mensagem
	 * @param  array  $config   Array com Remetente e E-mail do remetente
	 * @return array            Array com o status de envio e mensagem
	 */
	public function send($email, $assunto, $mensagem, array $config = array())
	{
		
		$destinatario=strtolower($email);
		$assunto=addslashes(trim($assunto));
		$mensagem=nl2br($mensagem);
		
		$remetente       =	$config["remetente"];
		$email_remetente =	$config["email"];

		$cabecalho = "MIME-Version: 1.0\n";
		$cabecalho .= 	"Content-Type: text/html; charset=UTF-8\n";
		$cabecalho .= 	"From: \"{$remetente}\" <{$email_remetente}>\n";

		return @mail ($destinatario, $assunto, $mensagem, $cabecalho);
	}
}