<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        include("../php/conexao.php");

        $id = $_POST['id'];
        $div_nome = $_POST['div_nome'];

        // Atualiza os dados
        if (!empty($_FILES['arquivo']['name']) && $_FILES['arquivo']['type'] === 'application/pdf') {
            $caminho_pasta = "uploads/";
            $nome_arquivo = basename($_FILES['arquivo']['name']);
            $caminho_arquivo = $caminho_pasta . time() . "_" . $nome_arquivo;

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) {
                $sql = "UPDATE arquivos_pdf SET caminho_arquivo = ?, div_nome = ? WHERE id = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssi", $caminho_arquivo, $div_nome, $id);
            }
        } else {
            $sql = "UPDATE arquivos_pdf SET div_nome = ? WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("si", $div_nome, $id);
        }

        if ($stmt->execute()) {
            echo "PDF atualizado com sucesso.";
            header("Location: contratos.php");
            exit;
        } else {
            echo "Erro ao atualizar.";
        }
    }