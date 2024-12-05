<?php

include("../php/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Busca o arquivo para excluir
    $sql = "SELECT caminho_arquivo FROM arquivos_pdf WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arquivo = $row['caminho_arquivo'];

        // Exclui o arquivo
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }

        // Remove do banco
        $sql = "DELETE FROM arquivos_pdf WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "PDF excluído com sucesso.";
            header("Location: contratos.php");
            exit;
        } else {
            echo "Erro ao excluir do banco.";
        }
    } else {
        echo "Arquivo não encontrado.";
    }
}
?>