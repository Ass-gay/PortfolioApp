// Recuperation des champs de formulaire
const idInputEdit = document.getElementById("edit-id");
const titreInputEdit = document.getElementById("edit-titre");
const descriptionInputEdit = document.getElementById("edit-description");
const photoInputEdit = document.getElementById("edit-photo");
const typeInputEdit = document.getElementById("edit-type");
const frmEditRealisationEdit = document.getElementById("editServiceProjetForm");
const btnSubmitEdit = frmEditRealisationEdit.querySelector("button[type='submit']");
const photoPreview = document.getElementById("photo-preview");

// Desactive le boutton de soumission par defaut
// btnSubmitEdit.disabled = true;

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

// Validation du champ titre a la saisie
titreInputEdit.addEventListener("input", () => {
        const titre = titreInputEdit.value.trim();
        const titreValidator = Validator.nameValidator("Le titre", 5, 50, titre);

        if (titreValidator) {
            showError(titreInputEdit, titreValidator.message);
        }
        else
        {
            showError(titreInputEdit, "");
        }
        // checkFormValidity();
    }
);

// Validation du champ description a la saisie
descriptionInputEdit.addEventListener("input", () => {
        const description = descriptionInputEdit.value.trim();
        const descriptionValidator = Validator.nameValidator("La description", 15, 1000, description);

        if (descriptionValidator) {
            showError(descriptionInputEdit, descriptionValidator.message);
        }
        else
        {
            showError(descriptionInputEdit, "");
        }
        // checkFormValidity();
    }
);

// Validation du chaamp de photo a la selection
photoInputEdit.addEventListener("change", () => {
    const file = photoInputEdit.files[0];
    if (!file && !photoPreview.src) {
        showError(photoInputEdit, "La photo est obligatoire.");
    }
    else if (file && !file.type.startsWith("image/")) {
        showError(photoInputEdit, "Le ficher doit etre une image.");
    }
    else
    {
        showError(photoInputEdit, "");
    }
    // checkFormValidity();
});

// Validation du chaamp de type a la selection
typeInputEdit.addEventListener("change", () => {
    if (typeInputEdit.value === "") {
        showError(typeInputEdit, "Veuillez selectionner un type.");
    }
    else
    {
        showError(typeInputEdit, "");
    }
    // checkFormValidity();
});

// Active le bouton de valdation si les deux champs est valide
// function checkFormValidity()
// {
//     const titre = titreInputEdit.value.trim();
//     const description = descriptionInputEdit.value.trim();
//     const photo = photoInputEdit.files[0];
//     const type = typeInputEdit.value.trim();

//     const isTitreValid = Validator.nameValidator("Le titre", 5, 50, titre);
//     const isDescriptionValid = Validator.nameValidator("La description", 15, 1000, description);
//     const isPhotoValid = photo && photo.type.startsWith("image/") || photoPreview.src !== "";
//     const isTypeValid = type !== "";

//     btnSubmitEdit.disabled = !(isTitreValid && isDescriptionValid && isPhotoValid && isTypeValid);
// }


// Recuperation button edit
   
    const editbuttons = document.querySelectorAll(".btn-edit");

    editbuttons.forEach(button => {
        button.addEventListener("click", () => {

            // Recuperation des attribute data-...* de la balise clique
            const id = button.getAttribute("data-id");
            const titre = button.getAttribute("data-titre");
            const description = button.getAttribute("data-description");
            const type = button.getAttribute("data-type");
            const photo = button.getAttribute("data-photo");

            // Ramplir les champs du modal avec les donnees
            idInputEdit.value = id;
            titreInputEdit.value = titre;
            descriptionInputEdit.value = description;
            typeInputEdit.value = type;

            // Mettre a jour l'apercu de la photo
            if (photo) {
                photoPreview.src = `../../images/projetSercive/${photo}`;
            }
            else
            {
                photoPreview.src = "";
            }

            const isTitreValid = Validator.nameValidator("Le titre", 5, 50, titre) == null;
            const isDescriptionValid = Validator.nameValidator("La description", 15, 1000, description) == null;
            const isPhotoValid = photo != null;
            const isTypeValid = type !== "";

            btnSubmitEdit.disabled = !(isTitreValid && isDescriptionValid && isPhotoValid && isTypeValid);
        });
    });