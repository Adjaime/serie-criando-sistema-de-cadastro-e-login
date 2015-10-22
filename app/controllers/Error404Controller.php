<?php 

class Error404Controller extends \HXPHP\System\Controller
{
	public function indexAction()
	{
		$this->view->setAssets('css', $this->configs->baseURI . 'public/css/error.css');
	}
}