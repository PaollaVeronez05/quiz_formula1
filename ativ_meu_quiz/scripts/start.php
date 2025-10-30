<?php
// Processa o início do jogo
if (isset($_POST['start'])) {
    // Pega a quantidade de questões escolhida
    $numQuestions = isset($_POST['num_questions']) ? (int)$_POST['num_questions'] : 10;
    
    // Caminho absoluto para o arquivo de perguntas
    $questionsFile = dirname(__DIR__) . '/data/f1_questions.php';

    // Verifica se o arquivo existe
    if (!file_exists($questionsFile)) {
        die('❌ Erro: O arquivo de perguntas não foi encontrado em: ' . $questionsFile);
    }

    // Carrega o conteúdo do arquivo
    $allQuestions = require $questionsFile;

    // Verifica se retornou um array
    if (!is_array($allQuestions)) {
        die('❌ Erro: O arquivo f1_questions.php não retornou um array válido.');
    }

    // Limita o número de questões ao máximo disponível
    $numQuestions = min($numQuestions, count($allQuestions));

    // Embaralha e seleciona as questões
    shuffle($allQuestions);
    $questions = array_slice($allQuestions, 0, $numQuestions);

    // Inicializa sessão do jogo
    $_SESSION['game'] = [
        'current_question' => 0,
        'total_questions' => count($questions),
        'correct_answers' => 0,
        'incorrect_answers' => 0
    ];

    $_SESSION['questions'] = $questions;

    // Redireciona para a rota do jogo
    header('Location: index.php?route=game');
    exit;
}
?>

<div class="container" style="text-align:center; margin-top:50px;">
    <h1>🏁 Quiz da Fórmula 1</h1>
    <p>Teste seus conhecimentos sobre o mundo da F1!</p>

    <form method="post">
        <div style="margin: 20px 0;">
            <label for="num_questions">Quantas questões deseja responder?</label>
            <input 
                type="number" 
                name="num_questions" 
                id="num_questions" 
                min="1" 
                max="20" 
                value="10" 
                style="margin: 10px; padding: 8px; font-size: 16px; width: 80px; text-align: center;"
                required
            >
            <small style="display: block; color: #ffff; margin-top: 5px;">Escolha entre 1 e 20 questões</small>
        </div>
        
        <button type="submit" name="start" class="btn">Iniciar Jogo</button>
    </form>
</div>