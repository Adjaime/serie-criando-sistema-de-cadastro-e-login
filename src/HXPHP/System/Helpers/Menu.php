<?php

namespace HXPHP\System\Helpers;

use HXPHP\System\Storage as Storage;

class Menu
{

	/**
	 * Menus e submenus
	 * @var array
	 */
	private $menu = array();

	/**
	 * Conteúdo HTML do menu renderizado
	 * @var string
	 */
	private $html;

	/**
	 * Define o ARRAY com menus e o CONTROLLER
	 * @param string $role Nível do usuário
	 * @param string $controller Controller
	 */
	public function __construct($role, $controller)
	{
		$this->setMenu($role)
			 ->setController($controller);
		
	}

	/**
	 * Define o CONTROLLER
	 * @param string $controller Controller
	 */
	private function setController($controller)
	{
		$this->controller = $controller;
		return $this;
	}
	
	/**
	 * Define o Array com menus e submenus
	 * @param  string $role Role do usuário
	 */
	private function setMenu($role)
	{	
		switch ($role) {
			case 'administrator':
				$this->menu = array(
					'Home/home' => 'home',
					'Projetos/briefcase' => 'projetos/listar/',
					'Clientes/users' => array(
						'Listar todos' => 'clientes/show',
						'Tipos de clientes' => 'clientes/tipos'
					),
					'Usuários/users' => 'usuarios/listar/'
				);
				break;

			case 'user':
				$this->menu = array(
					'Home/home' => 'home',
					'Projetos/briefcase' => 'projetos/listar/'
				);
				break;
		}

		return $this;
	}

	/**
	 * Modela o menu em HTML
	 * @param  string $controller Controller
	 */
	private function setHTML($controller)
	{
		if (is_null($controller))
			throw new \Exception("Informe o controller para gerar o menu.", 1);
			
		$controller = strtolower(str_replace('Controller', '', $controller));

		$this->html .= '<ul>';

		foreach ($this->menu as $key => $value) {
			$explode = explode('/', $key);

			$title = $explode[0];
			$icon =  isset($explode[1]) ? $explode[1] : '';

			/**
			 * Menu com submenus
			 */
			if (is_array($value)) {
				$values = array_values($value);
				$check = explode('/', $values[0]);

				$this->html .= '
				    <li class="dropdown '.(($check[0] == $controller) ? 'active' : '').'">
				      <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-'.$icon.'"></i> <span>'.$title.'</span> <i class="arrow fa fa-angle-down pull-right"></i></a>
				      <ul class="dropdown-menu">
				';

				foreach($value as $titulo => $link){
					$this->html .= '
						<li><a href="'.BASE.$link.'">'.$titulo.'</a></li>';
				}

				$this->html .= '
					  </ul>
					</li>';
			}
			/**
			 * Apenas Menu
			 */
			else {
				$this->html .= '<li '.((strpos($value, $controller) !== false) ? 'class="active"' : '').'>
									<a href="'.BASE.$value.'">
										<i class="fa fa-'.$icon.'"></i> <span>'.$title.'</span>
									</a>
								</li>';
			}
		}

		$this->html .= '</ul>';

		return $this;
	}

	/**
	 * Exibe o HTML com o menu renderizado
	 * @return string
	 */
	public function getMenu()
	{
		$this->setHTML($this->controller);
		return $this->html;
	}

	/**
	 * Exibe o HTML com o menu renderizado
	 * @return string
	 */
	public function __toString()
	{
		return $this->getMenu();
	}
}