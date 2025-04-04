<?php
require_once 'conexao.php';
include 'header.php'; // Incluir o cabeçalho

// Verifica se o ID foi enviado via POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Consulta o usuário pelo ID
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conexao->query($sql);
    
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        echo '<div class="alert alert-danger" role="alert">Usuário não encontrado!</div>';
        exit;
    }
}

// Atualiza os dados do usuário quando o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null; // Criptografa a senha se fornecida. 
                                                                    // Se a senha estiver vazia, não altera.
                                                                    // Lembrando que o MD5 não é recomendado para senhas, use password_hash() em produção.
    
    if ($senha) {
        $sql = "UPDATE usuarios SET nome='$nome', email='$email', senha='$senha' WHERE id=$id";
    } else {
        $sql = "UPDATE usuarios SET nome='$nome', email='$email' WHERE id=$id";
    }
    
    if (isset($_POST['salvar'])) {
        if ($conexao->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Usuário atualizado com sucesso!</div>';
            header("refresh:2;url=listar.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">Erro ao atualizar usuário: ' . $conexao->error . '</div>';
        }
    }
}
?>

<div class="container mt-5">
    <h2>Editar Usuário</h2>
    <form action="editar.php" method="post" class="formulario" onsubmit="return validarSenhas2()"> <!-- Adicionei o onsubmit para validar as senhas -->
        <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
        
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $usuario['nome']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $usuario['email']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" id="senha" name="senha" class="form-control">
        </div>

        <div class="mb-3">
            <label for="senha1" class="form-label">Repita a Senha:</label>
            <input type="password" id="senha1" name="senha1" class="form-control">
        </div>         
        
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="mostrarSenha" onclick="mostrarOuOcultarSenhas()">
            <label class="form-check-label" for="mostrarSenha">Mostrar senhas</label>
        </div>
        
        <button type="submit" name="salvar" class="btn btn-primary">Salvar Alterações</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>
