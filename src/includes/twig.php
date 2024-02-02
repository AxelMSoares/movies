<?php


$twig -> addFunction(new Twig\TwigFunction('getUrl', function (string $name, array $params = []) {
    
    global $router;
    
    return $router -> generate($name, $params);

}));

$twig -> addFunction (new Twig\TwigFunction('search', function (string $name, string $search) {
    
    $pos = strpos(strtolower($name), strtolower($search));
	return ($pos === false) ? false : true;

}));