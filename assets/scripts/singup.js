// Validação de informações
function validateForm() {
    const name = document.forms["form"]["name"].value.trim();
    const email = document.forms["form"]["email"].value.trim();
    const password = document.forms["form"]["password"].value.trim();

    const validarCPF = (cpf) => {
        const regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/;
        return regex.test(cpf);
      };
    
      if (name.length < 3) {


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


    return true;
}





function validateDate() {
    const input = document.getElementById('dateborn');
    const errorMessage = document.getElementById('error-message');
    const today = new Date();
    const birthDate = new Date(input.value);

    // Verifica se a data é válida
    if (isNaN(birthDate.getTime())) {
        errorMessage.textContent = "Por favor, insira uma data válida.";
        errorMessage.style.display = "block";
        return false;
    }
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    const dayDifference = today.getDate() - birthDate.getDate();

    // Ajusta a idade caso o mês/dia atual ainda não tenha passado no ano
    if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
        age--;
    }

    // Verifica se a idade é válida (entre 18 e 120 anos)
    if (age < 3 || age > 120) {
        errorMessage.style.display = "block";
    } else {
        errorMessage.style.display = "none";
        alert("Data de nascimento válida!");
    }

    
    const validarCPF = (cpf) => {
        const regex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$|^\d{11}$/;
        return regex.test(cpf);
    }

    // Se todas as validações passarem, permitir o envio do formulário
    return true;

}