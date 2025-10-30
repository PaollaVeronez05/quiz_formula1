<?php
// Se o jogo não estiver completo, volta ao início
if (!isset($_SESSION['game'])) {
    header('Location: index.php?route=start');
    exit;
}

$correct = $_SESSION['game']['correct_answers'];
$incorrect = $_SESSION['game']['incorrect_answers'];
$total = $_SESSION['game']['total_questions'];

// Limpa sessão
session_destroy();
?>
<link rel="stylesheet" href="style.css">

<div class="container" style="text-align:center; margin-top:50px;">
    <h1>🏁 Fim do Jogo!</h1>
    <h2>Você acertou <strong><?= $correct ?></strong> de <strong><?= $total ?></strong> perguntas!</h2>

    <p>Corretas: <?= $correct ?> | Erradas: <?= $incorrect ?></p>

    <a href="index.php?route=start">🔁 Jogar Novamente</a>
</div>