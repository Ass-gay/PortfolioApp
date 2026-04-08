
// Selectionner les champs du formulaires
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const btnSubmit = document.getElementById("btnSubmit");

// Desactiver le bouton de soumission par defaut
btnSubmit.disabled = true;

// Permet d'affiche ou masquer les message d'eureur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}

// Validation de l'email a la saisie
emailInput.addEventListener("input", () => {
        const email = emailInput.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) {
            showError(emailInput, emailValidator.message);
            checkFormValidaty();
        }
        else
        {
            showError(emailInput, "");
            checkFormValidaty();
        }
    }
);

// Validation de password a la saisie
passwordInput.addEventListener("input", () => {
        const password = passwordInput.value.trim();
        const passwordValidator = Validator.passwordValidator("Le Mot de passe", password, 8);

        if (passwordValidator) {
            showError(passwordInput, passwordValidator.message);
            checkFormValidaty();
        }
        else
        {
            showError(passwordInput, "");
            checkFormValidaty();
        }
    }
);

// Active le bouton de connexion si les deux champs est valide
function checkFormValidaty()
{
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
    
    const emailValidator = Validator.emailValidator("L'email", email);
    const passwordValidator = Validator.passwordValidator("Le Mot de passe", password, 8);

    if (!emailValidator && !passwordValidator) {
        btnSubmit.disabled = false;
    }
    else
    {
        btnSubmit.disabled = true;
    }
}