<?php

$twig -> addFunction(new Twig\TwigFunction('getUrl', function (string $name, array $params = []) {
    
    global $router;
    
    return $router -> generate($name, $params);

}));

