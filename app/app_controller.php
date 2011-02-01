<?php
class AppController extends Controller
{
	var $components = array('Auth','Session');
	
	var $helpers = array('Html','Javascript','Session','Form');
	function beforeFilter()
	{
		$this->Auth->loginRedirect = '/slides/index';
		$this->Auth->loginUrl = '/users/login';
	}
}