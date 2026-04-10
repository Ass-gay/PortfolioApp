// Recuperation des champs de formulaire
const currentPassword = document.getElementById("current_password");
const newPassword = document.getElementById("new_password");
const confirmPassword = document.getElementById("confirm_password");

// Permet d'affiche ou masquer les message d'eureur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
        baliseP.style.color = "brown";
        baliseP.style.fontWeight = "bold";
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}


// Validation du mot de pass actuel
currentPassword.addEventListener("input", () => {
        const passwordValue = currentPassword.value.trim();
        const currentPasswordValidator = Validator.passwordValidator("Le mot de passe actuel",  passwordValue, 8);

        if (currentPasswordValidator) {
            showError(currentPassword, currentPasswordValidator.message);
        }
        else
        {
            showError(currentPassword, "");
        }
    }
);

// Validation du  nouveau mot de pass
newPassword.addEventListener("input", () => {
        const newPasswordValue = newPassword.value.trim();
        const newPasswordValidator = Validator.passwordValidator("Le nouveau mot de passe",  newPasswordValue, 8);

        if (newPasswordValidator) {
            showError(newPassword, newPasswordValidator.message);
        }
        else
        {
            showError(newPassword, "");
        }
    }
);

// Validation du  confirmation le nouveau mot de pass
confirmPassword.addEventListener("input", () => {
        const confirmPasswordValue = confirmPassword.value.trim();
        const confirmPasswordValidator = Validator.passwordValidator("Le mot de passe de confirmation",  confirmPasswordValue, 8);

        if (confirmPasswordValidator) {
            showError(confirmPassword, confirmPasswordValidator.message);
        }
        else if (confirmPasswordValue != newPassword.value.trim()) {
            showError(confirmPassword, "Les deux mot de passe ne sont pas conforms");
        }
        else
        {
            showError(confirmPassword, "");
        }
    }
);