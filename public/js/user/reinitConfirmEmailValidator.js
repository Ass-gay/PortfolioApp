// Recuperation des champs de formulaire
const reinitConfirmInput = document.getElementById("reinit-confirm-email");
const reinitConfirmEmail = document.getElementById("reinitConfirmMailForm");
const btnSubmitReinit = reinitConfirmEmail.querySelector("button[type='submit']");


let isEmailReinitValid = false;

// Desactive le boutton de soumission par defaut
btnSubmitReinit.disabled = true;

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
    btnSubmitReinit.disabled = !(isEmailReinitValid);
}


// Validation du champ email a la saisie
reinitConfirmInput.addEventListener("input", () => {
        const email = reinitConfirmInput.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) {
            showError(reinitConfirmInput, emailValidator.message);
            isEmailReinitValid = false;
        }
        else
        {
            showError(reinitConfirmInput, "");
            isEmailReinitValid = true;
        }
        checkFormValidity();
    }
);