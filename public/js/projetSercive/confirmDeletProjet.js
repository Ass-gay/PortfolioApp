    const btnDeleteElementsServiceProjet = document.querySelectorAll(".btn-delete-serviceProjet");
    
        btnDeleteElementsServiceProjet.forEach((btnDeleteServiceProjet) => {
            btnDeleteServiceProjet.addEventListener("click", function (event) {
            event.preventDefault();

            const serviceProjetId = this.getAttribute('data-id-serviceProjet');
            const serviceProjetName = this.getAttribute('data-name-serviceProjet');

            Swal.fire({
                title: `Veuillez-vous bien supprimer l'utilisateur  ${serviceProjetName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la suppression',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `projetServiceMainController?id=${serviceProjetId}&action=delete`;
                }
            })
        })
    });