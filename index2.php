<?php
    require 'vendor/autoload.php';
    
    $app = new \Slim\App([
        'settings' => [
            'displayErrorDetails' => true
        ]
    ]);

    $app->post('/', function($request, $response, $args){
        #print_r($request->getParams());
        
    });

    $app->get('/post/{categoria}/{slug}', function($request, $response, $args){
		print_r($args); 
        var_dump($request->getAttribute('categoria'));
        var_dump($request->getAttribute('slug'));
		//echo "<br />".$this->teste ;
	});

	$app->post('/contato', function($request, $response, $args){
		//print_r($request->getParams()); //Pega todos os parametros "GET", "POST", etc

		//print_r($request->getParsedBody()); //Pega somente os "POST" do Body
        //print_r($request->getQueryParams()); //Pega somente os "GET" do Body
		#die;

		
		return $response->withRedirect($this->router->pathFor('home')); //Redireciona a rota para "home"
	});

	$app->get('/', function($request, $response, $args){
        echo "<br> Estou na home";
        return $response->withStatus(404)->write('Not Found');
	})->setName('home');

	$app->get('/contato', function($request, $response, $args){
		$pathContato = $this->router->pathFor('contato');
		echo '<form action=""'.$pathContato.'" method="post">';
		echo '<input type="submit" name="teste" value="Enviar" />';
		echo '</form>';
	})->setName('contato');



$app->run();