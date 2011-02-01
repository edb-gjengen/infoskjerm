<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $scaffold;
	
	function login()
	{
		
		
	}
	
	function logout()
	{
		$this->redirect($this->Auth->logout());
	}
}
?>