<script>
    (() => {
        if (typeof Swal === 'undefined') {
            return;
        }

        const toast = Swal.mixin({
            toast: true,
            position: 'bottom-start',
            showConfirmButton: false,
            timer: 3800,
            timerProgressBar: true,
            customClass: {
                popup: 'shadow',
            },
        });

        @if(session('success'))
            toast.fire({ icon: 'success', title: @json(session('success')) });
        @elseif(session('error'))
            toast.fire({ icon: 'error', title: @json(session('error')) });
        @elseif($errors->any())
            toast.fire({ icon: 'error', title: @json($errors->first() ?: 'Vérifiez les informations saisies.') });
        @elseif(session('status') === 'password-updated')
            toast.fire({ icon: 'success', title: 'Mot de passe mis à jour.' });
        @endif

        document.addEventListener('submit', (event) => {
            const form = event.target.closest('form[data-swal-confirm]');

            if (!form || form.dataset.swalConfirmed === 'true') {
                return;
            }

            event.preventDefault();
            Swal.fire({
                icon: form.dataset.swalIcon || 'question',
                title: form.dataset.swalTitle || 'Confirmer cette action',
                text: form.dataset.swalText || 'Voulez-vous continuer ?',
                showCancelButton: true,
                confirmButtonText: form.dataset.swalConfirmText || 'Confirmer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    form.dataset.swalConfirmed = 'true';
                    form.requestSubmit();
                }
            });
        });

        document.addEventListener('click', (event) => {
            const link = event.target.closest('a[data-swal-confirm]');

            if (!link || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                return;
            }

            event.preventDefault();
            Swal.fire({
                icon: link.dataset.swalIcon || 'question',
                title: link.dataset.swalTitle || 'Confirmer cette action',
                text: link.dataset.swalText || 'Voulez-vous continuer ?',
                showCancelButton: true,
                confirmButtonText: link.dataset.swalConfirmText || 'Continuer',
                cancelButtonText: 'Annuler',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.assign(link.href);
                }
            });
        });
    })();
</script>