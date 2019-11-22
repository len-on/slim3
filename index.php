<?php 
	
	require 'vendor/autoload.php';

	$app = new \Slim\App([
		'settings' => [
			'displayErrorDetails' => true
		]
	]);

	$container = $app->getContainer();

	$container['view'] = function($container){
		$folder = __DIR__;
	 	$view = new \Slim\Views\Twig($folder.'\app\public\views', [
			'cache' => false
		]);

	$view->addExtension(new \Slim\Views\TwigExtension(
			$container->router,
			$container->request->getUri()
		));

		return $view;
	};

	$container['db'] = function($container){
		return new PDO('mysql:host=localhost;dbname=TrabalhoSlim', 'root', '');
	};

	$container['HomeController'] = function($container) use ($app){
		return new TrabalhoTDS\Controllers\HomeController($container);
	};

	$container['ClientesController'] = function($container) use ($app){
		return new TrabalhoTDS\Controllers\ClientesController($container);
	};

	$app->post('/', 'ClientesController:cadastrarCliente');
	$app->get('/', 'HomeController:index')->setName('home');

	$app->get('/clientes', 'ClientesController:listaClientes')->setName('clientes');








/*	$app->get('/post/{categoria}/{slug}', function($request, $response, $args){
		#print_r($args); 
		print_r($request->getAttribute('categoria'));
		echo "<br />".$this->teste ;
	});

	$app->post('/contato', function($request, $response, $args){
		print_r($request->getParams()); //Pega todos os parametros "GET", "POST", etc

		#print_r($request->getParsedBody()); //Pega somente os "POST" do Body
		
		#print_r($request->getQueryParams()); //Pega somente os "GET" do Body

		#die;

		return $response->withStatus(200)->write('Success!');
		return $response->withRedirect($this->router->pathFor('home')); //Redireciona a rota para "home"
	});

	$app->get('/', function($request, $response, $args){
		echo "estou na home";
	})->setName('home');

	$app->get('/contato', function($request, $response, $args){
		$pathContato = $this->router->pathFor('contato');
		echo '<form action=""'.$pathContato.'" method="post">';
		echo '<input type="submit" name="teste" value="Enviar" />';
		echo '</form>';
	})->setName('contato');*/

	$app->run();
?>