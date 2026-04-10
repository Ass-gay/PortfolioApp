 const btnRestaurerElements = document.querySelectorAll(".btn-restaurer-user");
    
        btnRestaurerElements.forEach((btnRestaurer) => {
            btnRestaurer.addEventListener("click", function (event) {
            event.preventDefault();

            const userId = this.getAttribute('data-id-user');
            const userName = this.getAttribute('data-name-user');

            Swal.fire({
                title: `Veuillez-vous bien Restaurer l'utilisateur  ${userName}`,
                text: "Cette action est irreversibile !",
                icon: "warning",
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                cancelButtontext: 'Annuler la restauration',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Oui, restaurer',
            }).then((reponse) => {
                if (reponse.isConfirmed) {
                    window.location.href = `userMainController?id=${userId}&action=restaurer`;
                }
            })
        })
        });