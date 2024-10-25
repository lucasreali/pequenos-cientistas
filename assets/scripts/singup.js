// Validação de informações
function validateForm() {
    const name = document.forms["form"]["name"].value.trim();
    const email = document.forms["form"]["email"].value.trim();
    const password = document.forms["form"]["password"].value.trim();

    // Verificar se o nome tem pelo menos 3 caracteres
    if (name.length < 3) {
        alert("O nome deve ter pelo menos 3 caracteres.");
        return false;
    }

    // Verificar se o e-mail é válido
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Por favor, insira um e-mail válido.");
        return false;
    }

    // Verificar se a senha tem pelo menos 6 caracteres
    if (password.length < 6) {
        alert("A senha deve ter pelo menos 6 caracteres.");
        return false;
    }
    
    const validarCPF = (cpf) => {
        const regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/;
        return regex.test(cpf);
    }

    // Se todas as validações passarem, permitir o envio do formulário
    return true;
}