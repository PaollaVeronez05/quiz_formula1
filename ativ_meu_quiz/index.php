<?php
session_start();

// Define a rota (padrão: start)
$route = isset($_GET['route']) ? $_GET['route'] : 'start';

// Define o caminho base das rotas
$scriptsPath = __DIR__ . '/scripts/';


// Mapeia as rotas disponíveis
$routes = [
    'start' => $scriptsPath . 'start.php',
    'game' => $scriptsPath . 'game.php',
    'gameover' => $scriptsPath . 'gameover.php'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz da Fórmula 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Verifica se a rota é válida
if (array_key_exists($route, $routes)) {
    require $routes[$route];
} else {
    // Exibe uma página 404 amigável
    echo "<h1>Erro 404</h1><p>Página não encontrada.</p>";
}


require_once __DIR__ . "/scripts/footer.php";
?>
</body>
</html>