<?php
require_once 'conexao.php';
include 'header.php';  // Incluir o cabeçalho

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">
        Usuário excluído com sucesso!
        </div>';
        // Redireciona para a página listar.php após 2 segundos
        header("refresh:2;url=listar.php");
        
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Erro ao excluir o usuário: ' . $conexao->error . '
              </div>';
    }
}

include 'footer.php'; // Incluir o rodapé
?>
