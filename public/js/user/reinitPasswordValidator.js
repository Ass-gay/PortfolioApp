// Recuperation des champs de formulaire
const newPasswordReinit = document.getElementById("new-password-reinit");
const confirmPasswordReinit = document.getElementById("confirm-password-reinit");

const frmReinitPassword = document.getElementById("reiniPasswordForm");
const btnSubmitReinitPassword = frmReinitPassword.querySelector("button[type='submit']");

var isNewPasswordReinitValid = false;
var isConfirmPasswordReinitValid = false;

// Desactive le boutton de soumission par defaut
btnSubmitReinitPassword.disabled = true;

// Permet d'affiche ou masquer les message d'eureur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
        // baliseP.style.color = "brown";
        baliseP.style.fontWeight = "bold";
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}

// Active le bouton de valdation si les deux champs est valide
function checkFormValidity()
{
    btnSubmitReinitPassword.disabled = !(isNewPasswordReinitValid && isConfirmPasswordReinitValid);
}

// Validation du  nouveau mot de pass
newPasswordReinit.addEventListener("input", () => {
        const newPasswordReinitValue = newPasswordReinit.value.trim();
        const newPasswordReinitValidator = Validator.passwordValidator("Le nouveau mot de passe",  newPasswordReinitValue, 8);

        if (newPasswordReinitValidator) {
            showError(newPasswordReinit, newPasswordReinitValidator.message);
            isNewPasswordReinitValid = false; // ❌ invalide
        }
        else
        {
            showError(newPasswordReinit, "");
            isNewPasswordReinitValid = true; // ✅ valide
        }
        checkFormValidity();
    }
);

// Validation du  confirmation le nouveau mot de pass
confirmPasswordReinit.addEventListener("input", () => {
        const confirmPasswordReinitValue = confirmPasswordReinit.value.trim();
        const confirmPasswordReinitValidator = Validator.passwordValidator("Le mot de passe de confirmation",  confirmPasswordReinitValue, 8);

        if (confirmPasswordReinitValidator) {
            showError(confirmPasswordReinit, confirmPasswordReinitValidator.message);
            isConfirmPasswordReinitValid = false;
        }
        else if (confirmPasswordReinitValue != newPasswordReinit.value.trim()) {
            showError(confirmPasswordReinit, "Les deux mot de passe ne sont pas conforms");
            isConfirmPasswordReinitValid = false;
        }
        else
        {
            showError(confirmPasswordReinit, "");
            isConfirmPasswordReinitValid = true;
        }
        checkFormValidity();
    }
);