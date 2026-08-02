document.addEventListener('DOMContentLoaded', () => {

    const modalElement = document.getElementById('supportModal');

    if (!modalElement) {
        return;
    }

    const modal = new bootstrap.Modal(modalElement);

    const form = document.getElementById('supportRequestForm');

    const modalTitle = document.getElementById('supportModalTitle');
    const modalSubtitle = document.getElementById('supportModalSubtitle');

    const requestType = document.getElementById('request_type');

    const submitButton = document.getElementById('supportSubmitButton');

    const alertBox = document.getElementById('supportAlert');

    const subjectLabel = document.getElementById('subjectLabel');
    const subjectInput = document.getElementById('subject');

    const ministryLabel = document.getElementById('ministryLabel');
    const ministryInput = document.getElementById('ministry_area');

    const messageLabel = document.getElementById('messageLabel');
    const messageInput = document.getElementById('message');

    const subjectHelp = document.getElementById('subjectHelp');
    const ministryHelp = document.getElementById('ministryHelp');
    const messageHelp = document.getElementById('messageHelp');

    const config = {

        prayer: {

            title: '🙏 Prayer Request',

            subtitle: 'Share your prayer request with our ministry team.',

            subjectLabel: 'Prayer Topic',

            subjectPlaceholder: 'Example: Healing, Family, Job',

            subjectHelp: 'Briefly describe your prayer topic.',

            ministryLabel: 'Prayer Category',

            ministryPlaceholder: 'Health, Family, Ministry, Personal...',

            ministryHelp: 'Optional category.',

            messageLabel: 'Prayer Request',

            messagePlaceholder: 'Please share your prayer request in detail...',

            messageHelp: 'Everything shared will remain confidential.'

        },

        financial: {

            title: '❤️ Financial Support',

            subtitle: 'Thank you for your willingness to support this ministry.',

            subjectLabel: 'Donation Purpose',

            subjectPlaceholder: 'Example: Radio Ministry',

            subjectHelp: 'Tell us where you would like your support to be used.',

            ministryLabel: 'Preferred Donation Amount',

            ministryPlaceholder: 'Example: ₹1000 (Optional)',

            ministryHelp: 'Leave blank if you are unsure.',

            messageLabel: 'Message',

            messagePlaceholder: 'Tell us how you would like to support...',

            messageHelp: 'We will contact you with the available giving options.'

        },

        volunteer: {

            title: '🤝 Volunteer Ministry',

            subtitle: 'Use your gifts to serve the Kingdom of God.',

            subjectLabel: 'Area of Interest',

            subjectPlaceholder: 'Media, Music, Bible, Website...',

            subjectHelp: 'Where would you like to serve?',

            ministryLabel: 'Skills & Experience',

            ministryPlaceholder: 'Photography, Editing, Singing...',

            ministryHelp: 'Tell us about your experience.',

            messageLabel: 'About You',

            messagePlaceholder: 'Please introduce yourself...',

            messageHelp: 'Our team will contact you soon.'

        },

        sponsor: {

            title: '🌱 Sponsor a Project',

            subtitle: "Partner with us to expand God's Kingdom.",

            subjectLabel: 'Project Name',

            subjectPlaceholder: 'Bible Distribution, Radio Expansion...',

            subjectHelp: 'Which project interests you?',

            ministryLabel: 'Sponsorship Type',

            ministryPlaceholder: 'Individual / Church / Organization',

            ministryHelp: 'Tell us who will be sponsoring.',

            messageLabel: 'Message',

            messagePlaceholder: 'Share your sponsorship interest...',

            messageHelp: 'We will respond as soon as possible.'

        }

    };

    function applyConfiguration(type) {

        const item = config[type] || config.prayer;

        modalTitle.textContent = item.title;

        modalSubtitle.textContent = item.subtitle;

        subjectLabel.textContent = item.subjectLabel;
        subjectInput.placeholder = item.subjectPlaceholder;
        subjectHelp.textContent = item.subjectHelp;

        ministryLabel.textContent = item.ministryLabel;
        ministryInput.placeholder = item.ministryPlaceholder;
        ministryHelp.textContent = item.ministryHelp;

        messageLabel.textContent = item.messageLabel;
        messageInput.placeholder = item.messagePlaceholder;
        messageHelp.textContent = item.messageHelp;

    }

    document.querySelectorAll('.support-btn').forEach(button => {

        button.addEventListener('click', function (e) {

            e.preventDefault();

            const type = this.dataset.type || 'prayer';

            form.reset();

            requestType.value = type;

            applyConfiguration(type);

            alertBox.classList.add('d-none');

            alertBox.classList.remove(
                'alert-success',
                'alert-danger'
            );

            alertBox.innerHTML = '';

            modal.show();

        });

    });
    form.addEventListener('submit', async function (e) {

        e.preventDefault();

        submitButton.disabled = true;

        submitButton.innerHTML =
            '<span class="spinner-border spinner-border-sm me-2"></span>Submitting...';

        alertBox.classList.add('d-none');
        alertBox.classList.remove('alert-success', 'alert-danger');
        alertBox.innerHTML = '';

        try {

            const response = await fetch('/api/support-request.php', {

                method: 'POST',

                body: new FormData(form)

            });

            const result = await response.json();

            alertBox.classList.remove('d-none');

            if (result.success) {

                alertBox.classList.remove('alert-danger');
                alertBox.classList.add('alert-success');

                const type = requestType.value;

                let successMessage = '';

                switch (type) {

                    case 'prayer':
                        successMessage =
                            '🙏 Thank you. Your prayer request has been received. Our prayer team will stand with you in prayer.';
                        break;

                    case 'financial':
                        successMessage =
                            '❤️ Thank you for your willingness to support this ministry. We will contact you with the available giving options.';
                        break;

                    case 'volunteer':
                        successMessage =
                            '🤝 Thank you for offering to serve. Our ministry team will contact you soon.';
                        break;

                    case 'sponsor':
                        successMessage =
                            '🌱 Thank you for your interest in sponsoring this ministry. We will contact you shortly.';
                        break;

                    default:
                        successMessage =
                            result.message || 'Your request has been submitted successfully.';
                        break;

                }

                alertBox.innerHTML = successMessage;

                setTimeout(() => {

                    modal.hide();

                    form.reset();

                    requestType.value = '';

                }, 1800);

            } else {

                alertBox.classList.remove('alert-success');
                alertBox.classList.add('alert-danger');

                alertBox.innerHTML =
                    result.message || 'Unable to submit your request. Please try again.';

            }

        } catch (error) {

            console.error(error);

            alertBox.classList.remove('d-none');
            alertBox.classList.remove('alert-success');
            alertBox.classList.add('alert-danger');

            alertBox.innerHTML =
                'A network error occurred. Please check your connection and try again.';

        } finally {

            submitButton.disabled = false;

            submitButton.innerHTML =
                '<i class="fa-solid fa-paper-plane me-2"></i>Submit Request';

        }

    });

});