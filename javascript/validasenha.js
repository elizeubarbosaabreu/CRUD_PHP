// Função para validar senhas do formulário de cadastro
// Tamanho mínimo de 8 caracteres
// Verifica se as senhas coincidem
function validarSenhas() {
    const senha = document.getElementById("senha").value;
    const senha1 = document.getElementById("senha1").value;

    if (senha.length < 8) {
        alert("A senha deve ter no mínimo 8 caracteres.");
        return false;
    }

    if (senha !== senha1) {
        alert("As senhas não coincidem.");
        return false;
    }

    return true;
}

// Função para verificar senha do formulário editar
// Somente verifica tamnho de senha se campo for preenchido
// Caso contrário, retorna true
function validarSenhas() {
    const senha = document.getElementById("senha").value;
    const senha1 = document.getElementById("senha1").value;
    if (senha !== ""){

        if (senha.length < 8) {
            alert("A senha deve ter no mínimo 8 caracteres.");
            return false;
        }
    
        if (senha !== senha1) {
            alert("As senhas não coincidem.");
            return false;
        }
    

    }
    
    return true;
}

// Função para mostrar ou ocultar as senhas
function mostrarOuOcultarSenhas() {
    const campos = [document.getElementById("senha"), document.getElementById("senha1")];

    campos.forEach(campo => {
        campo.type = (campo.type === "password") ? "text" : "password";
    });
}