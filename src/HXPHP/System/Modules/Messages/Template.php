<?php

namespace HXPHP\System\Modules\Messages;

class Template
{
	/**
	 * Conteúdo do template JSON
	 * @var array
	 */
	private $content;

	public function __construct($content)
	{
		$this->content = $content;
	}
	
	/**
	 * Retorna o conteúdo do template mediante o código informado com os parâmetros substituído 
	 * @param  string $code   Código do template
	 * @param  array  $fields Fields e seus parâmetros para substituição
	 * @return array
	 */
	public function getByCode($code, array $fields = array())
	{
		if (isset($this->content[$code])){
			$output = $this->content[$code];

			if ( ! empty($fields) ) {
				foreach ($fields as $field => $params) {
					if ( ! isset($output[$field]) || empty($params))
						continue;

					$output[$field] = vsprintf($output[$field], $params);
				}
			}

			return $output;
		}

		throw new \Exception("O codigo <'$code'> nao foi encontrado. Verifique o template.", 1);
	}
}