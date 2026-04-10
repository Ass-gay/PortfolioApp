    const btnDeleteElementsUser = document.querySelectorAll(".btn-delete-user");
    
        btnDeleteElementsUser.forEach((btnDeleteUser) => {
            btnDeleteUser.addEventListener("click", function (event) {
            event.preventDefault();

            const userId = this.getAttribute('data-id-user');
            const userName = this.getAttribute('data-name-user');

            Swal.fire({
                title: `Veuillez-vous bien supprimer l'utilisateur  ${userName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la suppression',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `userMainController?id=${userId}&action=delete`;
                }
            })
        })
    });