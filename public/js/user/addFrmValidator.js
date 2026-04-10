// Recuperation des champs de formulaire
const nomInputUser = document.getElementById("add-user-nom");
const adresseInputUser = document.getElementById("add-user-adresse");
const telephoneInputUser = document.getElementById("add-user-telephone");
const emailInputUser = document.getElementById("add-user-email");
const photoInputUser = document.getElementById("add-user-photo");
const roleInputUser = document.getElementById("add-user-role");
const frmAddUser = document.getElementById("addUserForm");
const btnSubmit = frmAddUser.querySelector("button[type='submit']");


let isNameValid = false;
let isAdresseValid = false;
let isTelephoneValid = false;
let isEmailValid = false;
let isPhotoValid = false;
let isRoleValid = false;

// Desactive le boutton de soumission par defaut
// btnSubmit.disabled = true;

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
// function checkFormValidity()
// {
//     btnSubmit.disabled = !(isNameValid && isAdresseValid && isTelephoneValid && isEmailValid && isPhotoValid && isRoleValid);
// }

// Validation du champ nom a la saisie
nomInputUser.addEventListener("input", () => {
        const nom = nomInputUser.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 50, nom);

        if (nomValidator) {
            showError(nomInputUser, nomValidator.message);
            isNameValid = false;
        }
        else
        {
            showError(nomInputUser, "");
            isNameValid = true;
        }
        // checkFormValidity();
    }
);

// Validation du champ adresse a la saisie
adresseInputUser.addEventListener("input", () => {
        const adresse = adresseInputUser.value.trim();
        const adresseValidator = Validator.adresseValidator("L'adresse", 3, 100, adresse);

        if (adresseValidator) {
            showError(adresseInputUser, adresseValidator.message);
            isAdresseValid = false;
        }
        else
        {
            showError(adresseInputUser, "");
            isAdresseValid = true;
        }
        // checkFormValidity();
    }
);

// Validation du champ telephone a la saisie
telephoneInputUser.addEventListener("input", () => {
        const telephone = telephoneInputUser.value.trim();
        const telephoneValidator = Validator.phoneValidator("Le numero telephone", 9, 17, telephone);

        if (telephoneValidator) {
            showError(telephoneInputUser, telephoneValidator.message);
            isTelephoneValid = false;
        }
        else
        {
            showError(telephoneInputUser, "");
            isTelephoneValid = true;
        }
        // checkFormValidity();
    }
);

// Validation du champ email a la saisie
emailInputUser.addEventListener("input", () => {
        const email = emailInputUser.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) {
            showError(emailInputUser, emailValidator.message);
            isEmailValid = false;
        }
        else
        {
            showError(emailInputUser, "");
            isEmailValid = true;
        }
        // checkFormValidity();
    }
);


// Validation du chaamp de photo a la selection
photoInputUser.addEventListener("change", () => {
    const file = photoInputUser.files[0];
    if (!file) {
        showError(photoInputUser, "La photo est obligatoire.");
        isPhotoValid = false;
    }
    else if (!file.type.startsWith("image/")) {
        showError(photoInputUser, "Le ficher doit etre une image.");
        isPhotoValid = false;
    }
    else
    {
        showError(photoInputUser, "");
        isPhotoValid = true;
    }
    // checkFormValidity();
});

// Validation du chaamp de role a la selection
roleInputUser.addEventListener("change", () => {
    if (roleInputUser.value === "") {
        showError(roleInputUser, "Veuillez selectionner un role.");
        isRoleValid = false;
    }
    else
    {
        showError(typeInput, "");
        isRoleValid = true;
    }
    // checkFormValidity();
});



// Desactive le boutton si les champs est vide
frmAddUser.addEventListener("reset", () => {
    isNameValid = false;
    isAdresseValid = false;
    isTelephoneValid = false;
    isEmailValid = false;
    isPhotoValid = false;
    isRoleValid = false;

    btnSubmit.disabled =true;
});