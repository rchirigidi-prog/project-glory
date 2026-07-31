document.addEventListener('DOMContentLoaded', () => {

    const modalElement = document.getElementById('supportModal');

    if (!modalElement) {
        return;
    }

    const modal = new bootstrap.Modal(modalElement);

    const form = document.getElementById('supportRequestForm');

    if (!form) {
        return;
    }

    const title = document.getElementById('supportModalTitle');
    const requestType = document.getElementById('request_type');
    const submitButton = document.getElementById('supportSubmitButton');

    const titles = {
        prayer: 'Prayer Request',
        financial: 'Financial Support',
        volunteer: 'Volunteer Ministry',
        sponsor: 'Sponsor a Project'
    };

    document.querySelectorAll('.support-btn').forEach(button => {

        button.addEventListener('click', function (event) {

            event.preventDefault();

            const type = this.dataset.type || 'prayer';

            requestType.value = type;

            if (title) {
                title.textContent = titles[type] || 'Support Request';
            }

            form.reset();
            requestType.value = type;

            modal.show();

        });

    });

    form.addEventListener('submit', async function (event) {

        event.preventDefault();

        submitButton.disabled = true;

        const originalText = submitButton.innerHTML;

        submitButton.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';

        try {

            const response = await fetch('/api/support-request.php', {

                method: 'POST',

                body: new FormData(form)

            });

            const result = await response.json();

            if (result.success) {

                alert('Thank you! Your request has been submitted successfully.');

                form.reset();

                modal.hide();

            } else {

                alert(result.message || 'Unable to submit your request.');

            }

        } catch (error) {

            console.error(error);

            alert('Network error. Please try again.');

        }

        submitButton.disabled = false;

        submitButton.innerHTML = originalText;

    });

});