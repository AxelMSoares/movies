<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Movies</title>
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="upperHeader">
            <div class="headerWrapper">
                <div><a href="<?= $router->generate('home') ?>" class="logo"><h1>Great Movies</h1></a></div>
                <div class="search">
                    <form action="#" method="get">
                        <input type="text" class="searchBar" name="search" id="search">
                        <button class="searchLogo"><img   src="../public/images/searchLogo.svg" alt="search logo"></button>
                    </form>
                </div>
                <div class="connection">
                    <img src="../public/images/userLogo.svg" alt="User Logo">
                    <div class="connectionLinks">
                        <a href="">Connexion</a>
                        <a href="">Créer un Compte</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottomHeader">
            <div class="headerWrapper"></div>
        </div>
    </header>
    
