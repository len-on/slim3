<?php 
	namespace TrabalhoTDS\Controllers;

	abstract class Controller{
		protected $container;
		public function __construct(\Slim\Container $container){
			$this->container = $container;
		}

		public function __get($key){
			if ($this->container->{$key}){
				return $this->container->{$key};
			}
		}
	}

?>