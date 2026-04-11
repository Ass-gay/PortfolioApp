// Recuperation des champs de formulaire
const nomInput = document.getElementById("nom");
const emailInput = document.getElementById("email");
const sujetInput = document.getElementById("sujet");
const messageInput = document.getElementById("message");
const frmContact = document.getElementById("contactForm");
const btnSubmit = frmContact.querySelector("button[type='submit']");


let isNameValid = false;
let isEmailValid = false;
let isSujetValid = false;
let isMessageValid = false;

// Desactive le boutton de soumission par defaut
btnSubmit.disabled = true;

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

// Active le bouton de valdation si les deux champs est valide
function checkFormValidity()
{
    btnSubmit.disabled = !(isNameValid && isEmailValid && isSujetValid && isMessageValid);
}

// Validation du champ nom a la saisie
nomInput.addEventListener("input", () => {
        const nom = nomInput.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 50, nom);

        if (nomValidator) {
            showError(nomInput, nomValidator.message);
            isNameValid = false;
        }
        else
        {
            showError(nomInput, "");
            isNameValid = true;
        }
        checkFormValidity();
    }
);

// Validation du champ email a la saisie
emailInput.addEventListener("input", () => {
        const email = emailInput.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) {
            showError(emailInput, emailValidator.message);
            isEmailValid = false;
        }
        else
        {
            showError(emailInput, "");
            isEmailValid = true;
        }
        checkFormValidity();
    }
);

// Validation du champ sujet a la saisie
sujetInput.addEventListener("input", () => {
        const sujet = sujetInput.value.trim();
        const sujetValidator = Validator.nameValidator("Le sujet", 5, 50, sujet);

        if (sujetValidator) {
            showError(sujetInput, sujetValidator.message);
            isSujetValid = false;
        }
        else
        {
            showError(sujetInput, "");
            isSujetValid = true;
        }
        checkFormValidity();
    }
);

// Validation du champ message a la saisie
messageInput.addEventListener("input", () => {
        const message = messageInput.value.trim();
        const messageValidator = Validator.nameValidator("Le message", 5, 50, message);

        if (messageValidator) {
            showError(messageInput, messageValidator.message);
            isMessageValid = false;
        }
        else
        {
            showError(messageInput, "");
            isMessageValid = true;
        }
        checkFormValidity();
    }
);



// Desactive le boutton si les champs est vide
frmContact.addEventListener("reset", () => {
    isNameValid = false;
    isEmailValid = false;
    isSujetValid = false;
    isMessageValid = false;

    btnSubmit.disabled =true;
});