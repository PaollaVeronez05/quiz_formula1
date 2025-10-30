<?php
// Redireciona se o jogo não foi iniciado
if (!isset($_SESSION['game']) || !isset($_SESSION['questions'])) {
    header('Location: index.php?route=start');
    exit;
}

// Processa a resposta
if (isset($_GET['answer'])) {
    $current_question = $_SESSION['game']['current_question'];
    $answer = (int)$_GET['answer'];

    // Verifica resposta
    if ($answer === $_SESSION['questions'][$current_question]['correct_answer']) {
        $_SESSION['game']['correct_answers']++;
    } else {
        $_SESSION['game']['incorrect_answers']++;
    }

    // Última pergunta?
    if ($current_question >= $_SESSION['game']['total_questions'] - 1) {
        header('Location: index.php?route=gameover');
        exit;
    }

    // Próxima pergunta
    $_SESSION['game']['current_question']++;
    header('Location: index.php?route=game');
    exit;
}

$current_question = $_SESSION['game']['current_question'];
$total_questions = $_SESSION['game']['total_questions'];
$correct_answers = $_SESSION['game']['correct_answers'];
$incorrect_answers = $_SESSION['game']['incorrect_answers'];

$question = $_SESSION['questions'][$current_question]['question'];
$answers = $_SESSION['questions'][$current_question]['answers'];
?>
<link rel="stylesheet" href="style.css">

<div class="container">
    <h1>🏎️ Quiz da Fórmula 1</h1>

    <h5>Questão <strong><?= $current_question + 1 ?> / <?= $total_questions ?></strong></h5>

    <div>
        <h4>
            Corretas: <strong><?= $correct_answers ?></strong>
            &nbsp;|&nbsp;
            Erradas: <strong><?= $incorrect_answers ?></strong>
        </h4>
    </div>

    <hr>
    <h4><strong><?= htmlspecialchars($question) ?></strong></h4>
    <hr>

    <div>
        <?php foreach ($answers as $i => $ans): ?>
            <h3 id="answer_<?= $i ?>" class="answer"><?= htmlspecialchars($ans) ?></h3>
        <?php endforeach; ?>
    </div>

    <div style="margin-top: 20px;">
        <a href="index.php?route=start">Desistir</a>
    </div>
</div>

<script>
document.querySelectorAll(".answer").forEach(element => {
    element.addEventListener('click', () => {
        let id = element.id.split('_')[1];
        window.location.href = `index.php?route=game&answer=${id}`;
    });
});
</script>