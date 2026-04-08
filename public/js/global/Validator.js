class Validator {

    //Permet de valider un mot de passe password
    static passwordValidator(controlName, value, lengthWord)
    {
        return !value.length
        ? {error: true, message: `${controlName} est obligatoire.`}
        : value.length < lengthWord
        ? {error: true, message: `${controlName} diot contenir au moins ${lengthWord} caracteres.`}
        : ((value != "") && (value.startsWith(" ") || value.endsWith(" ")))
        ? {error: true, message: `${controlName} les espaces du debut et de fin ne sont pas autorises.`}
        : null;
    }

    //Permet de valider un adresse email
    static emailValidator(controlName, value)
    {
        let pattern = '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$';
        return !value.length
        ? {error: true, message: `${controlName} est obligatoire.`}
        : !value.match(new RegExp(pattern))
        ? {error: true, message: `${controlName} doit respecter le fotmat example@gmail.com.`}
        : null;
    }

    //Permet de valider un numero de telephone
    static phoneValidator(controlName, minLength, maxLength, value)
    {
        let pattern = '^[0-9+]+(\.?[0-9]+)?$';
        return !value.length
        ? {error: true, message: `${controlName} est obligatoire.`}
        : !value.match(new RegExp(pattern))
        ? {error: true, message: `${controlName} ne doit contenir que des chiffres.`}
        : value.length < minLength
        ? {error: true, message: `${controlName} doit contenir au moins ${minLength} chiffres.`}
        : value.length > maxLength
        ? {error: true, message: `${controlName} doit contenir au plus ${maxLength} chiffres.`}
        : null;

    }

    //Permet de valider un nom compose de chaine de caractere
    static nameValidator(controlName, minLength, maxLength, value)
    {
        let pattern = /^[A-Za-zÀ-ÿ '-]+$/;
        
        if (!value) {
            return {error: true, message: `${controlName} est obligatoire.`}
        }

        if (!value.match(new RegExp(pattern))) {
            return {error: true, message: `${controlName} ne doit contenir que des lettres.`}
        }

        if (value.length < minLength) {
            return {error: true, message: `${controlName} doit contenir au moins ${minLength} lettres.`}
        }

        if (value.length > maxLength) {
            return {error: true, message: `${controlName} doit contenir au plus ${maxLength} lettres.`}
        }

        if ((value != "") && (value.startsWith(" ") || value.endsWith(" "))) {
            return {error: true, message: `${controlName} les espaces du debut et de fin ne sont pas autorises.`}
        }

        return null;
    }

    //Permet de valider une adresse
    static adresseValidator(controlName, minLength, maxLength, value)
    {
        const isContainsNumber = /^(?=.*[0-9]).*$/;
        const isContainsUpperCase = /^(?=.*[A-Z]).*$/;
        const isContainsLowerCase = /^(?=.*[a-z]).*$/;
        const isContainsSymbolCase = /^(?=.*[-,;.]).*$/;
        
        if (!value) {
            return {error: true, message: `${controlName} est obligatoire.`}
        }

        if (isContainsSymbolCase.test(value)
            && isContainsNumber.test(value)
            && isContainsUpperCase.test(value)
            && isContainsLowerCase.test(value)) {
            return {error: true, message: `${controlName} ne doit contenir que des caracteres specieux.`}
        }

        if (isContainsNumber.test(value)
            && isContainsSymbolCase.test(value)
            && isContainsUpperCase.test(value)
            && isContainsLowerCase.test(value)) {
            return {error: true, message: `${controlName} ne doit contenir que des chiffres.`}
        }

        if (value.length < minLength) {
            return {error: true, message: `${controlName} doit contenir au moins ${minLength} lettres.`}
        }

        if (value.length > maxLength) {
            return {error: true, message: `${controlName} doit contenir au plus ${maxLength} lettres.`}
        }

        if ((value != "") && (value.startsWith(" ") || value.endsWith(" "))) {
            return {error: true, message: `${controlName} les espaces du debut et de fin ne sont pas autorises.`}
        }
        
        return null;
    }
}