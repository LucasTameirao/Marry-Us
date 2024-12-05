<?php

include("../php/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $div_nome = $_POST['div_nome'] ?? null;

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['type'] === 'application/pdf') {
        $caminho_pasta = "uploads/";
        if (!is_dir($caminho_pasta)) {
            mkdir($caminho_pasta, 0777, true);
        }

        $nome_arquivo = basename($_FILES['arquivo']['name']);
        $caminho_arquivo = $caminho_pasta . time() . "_" . $nome_arquivo;

        // Move o arquivo para a pasta
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {

            // Insere no banco
            $sql = "INSERT INTO arquivos_pdf (nome, caminho_arquivo, div_nome) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("sss", $nome, $caminho_arquivo, $div_nome);

            if ($stmt->execute()) {
                echo "PDF enviado com sucesso!";
                header("Location: contratos.php");
                exit;
            } else {
                echo "Erro ao salvar no banco: " . $stmt->error;
            }
        } else {
            echo "Erro ao mover o arquivo.";
        }
    } else {
        echo "Envie um arquivo válido em formato PDF.";
    }
}
?>