<?php
require_once 'conexao.php';
include 'header.php';  // Incluir o template de cabeçalho reaproveitando o código header.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); //Na primeira versão utilizei o MD5 para criptografar a senha, mas é recomendável usar password_hash() para maior segurança.
    // Se a senha for fácil dá para descriptografar, então é melhor usar password_hash() e password_verify() para verificar a senha.
    // Site para descriptogragrafar MD5: https://www.md5online.org/ e https://iotools.cloud/pt/tool/md5-decrypt/
    
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    if ($conexao->query($sql) === TRUE) {
        // Mensagem de sucesso com Bootstrap
        echo '<div class="alert alert-success" role="alert">
                Usuário criado com sucesso!
              </div>';
        // Redireciona para a página listar.php após 2 segundos
        header("refresh:2;url=listar.php");
    } else {
        // Mensagem de erro com Bootstrap
        echo '<div class="alert alert-danger" role="alert">
                Erro ao criar usuário: ' . $conexao->error . '
              </div>';
    }
}
?>

<!-- Formulário para criar usuário -->
<div class="container mt-5">
    <h2>Criar Usuário</h2>
        <form action="criar.php" method="post" class="formulario" onsubmit="return validarSenhas()"> <!-- Adicionei o onsubmit para validar as senhas -->
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" id="senha" name="senha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="senha1" class="form-label">Repita a Senha:</label>
                <input type="password" id="senha1" name="senha1" class="form-control" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="mostrarSenha" onclick="mostrarOuOcultarSenhas()">
                <label class="form-check-label" for="mostrarSenha">Mostrar senhas</label>
            </div>
            
            
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>    

<?php include 'footer.php'; // Incluir o rodapé ?>
