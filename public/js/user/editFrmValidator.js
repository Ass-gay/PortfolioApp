// Recuperation des champs de formulaire
const idInputUserEdit = document.getElementById("edit-user-id");
const nomInputUserEdit = document.getElementById("edit-user-nom");
const adresseInputUserEdit = document.getElementById("edit-user-adresse");
const telephoneInputUserEdit = document.getElementById("edit-user-telephone");
const emailInputUserEdit = document.getElementById("edit-user-email");
const photoInputUserEdit = document.getElementById("edit-user-photo");
const roleInputUserEdit = document.getElementById("edit-user-role");
const frmEditUser = document.getElementById("editUserForm");
const btnSubmitEdit = frmEditUser.querySelector("button[type='submit']");
const photoPreviewEdit = document.getElementById("photo-preview-edit");

// Desactive le boutton de soumission par defaut
btnSubmitEdit.disabled = true;

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

// Validation du champ nom a la saisie
nomInputUserEdit.addEventListener("input", () => {
        const nom = nomInputUserEdit.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 5, 50, nom);

        if (nomValidator) {
            showError(nomInputUserEdit, nomValidator.message);
        }
        else
        {
            showError(nomInputUserEdit, "");
        }
        checkFormValidity();
    }
);

// Validation du champ Adresse a la saisie
adresseInputUserEdit.addEventListener("input", () => {
        const adresse = adresseInputUserEdit.value.trim();
        const adresseValidator = Validator.adresseValidator("L'adresse", 3, 1000, adresse);

        if (adresseValidator) {
            showError(adresseInputUserEdit, adresseValidator.message);
        }
        else
        {
            showError(adresseInputUserEdit, "");
        }
        checkFormValidity();
    }
);

// Validation du champ telephone a la saisie
telephoneInputUserEdit.addEventListener("input", () => {
        const telephone = telephoneInputUserEdit.value.trim();
        const telephoneValidator = Validator.phoneValidator("Le numero telephone", 9, 17, telephone);

        if (telephoneValidator) {
            showError(telephoneInputUserEdit, telephoneValidator.message);
        }
        else
        {
            showError(telephoneInputUserEdit, "");
        }
        checkFormValidity();
    }
);

// Validation du champ email a la saisie
emailInputUserEdit.addEventListener("input", () => {
        const email = emailInputUserEdit.value.trim();
        const emailValidator = Validator.emailValidator("L'email", email);

        if (emailValidator) {
            showError(emailInputUserEdit, emailValidator.message);
        }
        else
        {
            showError(emailInputUserEdit, "");
        }
        checkFormValidity();
    }
);


// Validation du chaamp de photo a la selection
photoInputUserEdit.addEventListener("change", () => {
    const file = photoInputUserEdit.files[0];
    if (!file && !photoPreviewEdit.src) {
        showError(photoInputUserEdit, "La photo est obligatoire.");
    }
    else if (file && !file.type.startsWith("image/")) {
        showError(photoInputUserEdit, "Le ficher doit etre une image.");
    }
    else
    {
        showError(photoInputUserEdit, "");
    }
    checkFormValidity();
});

// Validation du chaamp de role a la selection
roleInputUserEdit.addEventListener("change", () => {
    if (roleInputUserEdit.value === "") {
        showError(roleInputUserEdit, "Veuillez selectionner un role.");
    }
    else
    {
        showError(roleInputUserEdit, "");
    }
    checkFormValidity();
});

// Active le bouton de valdation si les deux champs est valide
function checkFormValidity()
{
    const nom = nomInputUserEdit.value.trim();
    const adresse = adresseInputUserEdit.value.trim();
    const telephone = telephoneInputUserEdit.value.trim();
    const email = emailInputUserEdit.value.trim();
    const photo = photoInputUserEdit.files[0];
    const role = roleInputUserEdit.value.trim();

    


    const isNameValid = Validator.nameValidator("Le nom", 5, 50, nom);
    const isAdresseValid = Validator.adresseValidator("L'adresse", 3, 1000, adresse);
    const isTelephoneValid = Validator.phoneValidator("Le numero telephone", 9, 17, telephone);
    const isEmailValid = Validator.emailValidator("L'email", email);
    const isPhotoValid = photo && photo.type.startsWith("image/") || photoPreviewEdit.src !== "";
    const isRoleValid = type !== "";

    btnSubmitEdit.disabled = !(isNameValid && isAdresseValid && isTelephoneValid && isEmailValid && isPhotoValid && isRoleValid);
}
    const editbuttons = document.querySelectorAll(".btn-edit-user");

    editbuttons.forEach(button => {
        button.addEventListener("click", () => {

            // Recuperation des attribute data-...* de la balise clique
            const id = button.getAttribute("data-id");
            const nom = button.getAttribute("data-nom");
            const adresse = button.getAttribute("data-adresse");
            const telephone = button.getAttribute("data-telephone");
            const email = button.getAttribute("data-email");
            const role = button.getAttribute("data-role");
            const photo = button.getAttribute("data-photo");

            // Ramplir les champs du modal avec les donnees
            idInputUserEdit.value = id;
            nomInputUserEdit.value = nom;
            adresseInputUserEdit.value = adresse;
            telephoneInputUserEdit.value = telephone;
            emailInputUserEdit.value = email;
            roleInputUserEdit.value = role;

            // Mettre a jour l'apercu de la photo
            if (photo) {
                photoPreviewEdit.src = `../../images/user/${photo}`;
            }
            else
            {
                photoPreviewEdit.src = "";
            }

            
            const isNameValid = Validator.nameValidator("Le nom", 5, 50, nom) == null;
            const isAdresseValid = Validator.adresseValidator("L'adresse", 3, 1000, adresse) == null;
            const isTelephoneValid = Validator.phoneValidator("Le numero telephone", 9, 17, telephone) == null;
            const isEmailValid = Validator.emailValidator("L'email", email) == null;
            const isPhotoValid = photo != null;
            const isRoleValid = role !== "";
            btnSubmitEdit.disabled = !(isNameValid && isAdresseValid && isTelephoneValid && isEmailValid && isPhotoValid && isRoleValid);
        });
    });