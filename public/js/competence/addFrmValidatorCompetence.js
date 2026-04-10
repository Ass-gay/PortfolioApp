// Recuperation des champs de formulaire
const nomInput = document.getElementById("nom-competence");
const descriptionInput = document.getElementById("description-competence");
const niveauInput = document.getElementById("niveau-competence");
const frmAddCompetence = document.getElementById("addCompetenceForm");
const btnSubmitCompetence = frmAddCompetence.querySelector("button[type='submit']");

let isNameValid = false;
let isDescriptionValid = false;
let isNiveauValid = false;

// Desactive le boutton de soumission par defaut
btnSubmitCompetence.disabled = true;

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
    btnSubmitCompetence.disabled = !(isNameValid && isDescriptionValid && isNiveauValid);
}

// Validation du champ nom a la saisie
nomInput.addEventListener("input", () => {
        const nom = nomInput.value.trim();
        const nomValidator = Validator.nameValidator("Le nom", 2, 50, nom);

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

// Validation du champ description a la saisie
descriptionInput.addEventListener("input", () => {
        const description = descriptionInput.value.trim();
        const descriptionValidator = Validator.nameValidator("La description", 5, 1000, description);

        if (descriptionValidator) {
            showError(descriptionInput, descriptionValidator.message);
            isDescriptionValid = false;
        }
        else
        {
            showError(descriptionInput, "");
            isDescriptionValid = true;
        }
        checkFormValidity();
    }
);

// Validation du champ niveau à la saisie
niveauInput.addEventListener("input", () => {
    const niveau = niveauInput.value.trim();
    const niveauValidator = Validator.phoneValidator("Le niveau", 0, 100, niveau);

    if (niveauValidator) {
        showError(niveauInput, niveauValidator.message);
        isNiveauValid = false;
    }
    else
    {
        showError(niveauInput, "");
        isNiveauValid = true;
    }

    checkFormValidity();
});



// Desactive le boutton si les champs est vide
frmAddCompetence.addEventListener("reset", () => {
    isNameValid = false;
    isDescriptionValid = false;
    isNiveauValid = false;

    btnSubmitCompetence.disabled =true;
});