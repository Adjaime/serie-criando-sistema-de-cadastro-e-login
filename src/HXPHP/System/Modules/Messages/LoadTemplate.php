<?php

namespace HXPHP\System\Modules\Messages;

class LoadTemplate
{
	/**
	 * JSON do template
	 * @var json
	 */
	private $json;

	/**
	 * Caminho do template
	 * @var string
	 */
	public $file = null;

	/**
	 * Método responsável pela leitura do arquivo JSON
	 * @param string $template Nome do template
	 */
	public function __construct($template)
	{
		/**
		 * Caminho completo do template
		 * @var string
		 */
		$template = dirname(__FILE__) . DS . 'templates' . DS . $template . '.json';

		if ( ! file_exists($template))
			throw new \Exception("O template nao foi localizado: <'$template'>", 1);

		$this->file  = $template;
		$this->json  = file_get_contents($template);
	}

	/**
	 * Retorna o conteúdo do template
	 * @return json
	 */
	public function getJson()
	{
		return empty($this->json) ? false : $this->json;
	}

	/**
	 * Retorna o caminho do template
	 * @return string
	 */
	public function getTemplatePath()
	{
		return $this->file;
	}
}