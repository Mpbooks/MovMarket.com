<?php
// avaliacoes.php

// Função para calcular a média e a quantidade de avaliações de um produto
function calcularMediaAvaliacoes($produto_id, $pdo) {
    // Consulta para calcular a média e contar as avaliações
    $sql = "SELECT AVG(rating) AS media, COUNT(*) AS quantidade FROM avaliacoes WHERE produto_id = :produto_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result; // Retorna a média e a quantidade de avaliações
}
?>
