<?php
require_once 'conexao.php';
include 'header.php';  // Incluir o cabeçalho template header.php 

$sql = "SELECT id, nome, email, data_criacao FROM usuarios";
$result = $conexao->query($sql);
?>


<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Data de Criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['data_criacao']}</td>
                        <td class='text-center'>
                            <!-- Formulário de Editar -->
                            <form action='editar.php' method='POST' class='d-inline'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' class='btn btn-warning btn-sm'>
                                    <i class='fas fa-edit'></i> <!-- Ícone de editar -->
                                </button>
                            </form>

                            <!-- Link de Excluir -->
                            <a href='excluir.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\")'>
                                <i class='fas fa-trash-alt'></i> <!-- Ícone de excluir -->
                            </a>
                        </td>
                        </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center'>Nenhum usuário encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>
</div>

<?php include 'footer.php'; //utilização do template de rodapé ?> 