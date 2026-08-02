<?php
/**
 * M-009 Support Ministry Modal
 * Part 1 of 2
 */
?>

<div
    class="modal fade"
    id="supportModal"
    tabindex="-1"
    aria-labelledby="supportModalTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg">

            <form id="supportRequestForm" novalidate>

                <div class="modal-header bg-warning-subtle">

                    <div>

                        <h4
                            class="modal-title mb-1"
                            id="supportModalTitle">

                            Support Ministry

                        </h4>

                        <small
                            class="text-muted"
                            id="supportModalSubtitle">

                            Please complete the form below.

                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <div class="modal-body">

                    <div
                        id="supportAlert"
                        class="alert d-none">
                    </div>

                    <input
                        type="hidden"
                        id="request_type"
                        name="request_type">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label
                                for="full_name"
                                class="form-label">

                                Full Name
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                class="form-control"
                                placeholder="Enter your full name"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label
                                for="email"
                                class="form-label">

                                Email Address
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label
                                for="phone"
                                class="form-label">

                                Phone Number

                            </label>

                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                class="form-control"
                                placeholder="+91 XXXXX XXXXX">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label
                                for="country"
                                class="form-label">

                                Country

                            </label>

                            <input
                                type="text"
                                id="country"
                                name="country"
                                class="form-control"
                                placeholder="Country">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label
                            id="subjectLabel"
                            for="subject"
                            class="form-label">

                            Subject

                        </label>

                        <input
                            type="text"
                            id="subject"
                            name="subject"
                            class="form-control"
                            placeholder="Enter subject">

                        <small
                            id="subjectHelp"
                            class="text-muted">

                            This field changes depending on the request type.

                        </small>

                    </div>

                    <div class="mb-3">

                        <label
                            id="ministryLabel"
                            for="ministry_area"
                            class="form-label">

                            Ministry Area / Skills

                        </label>

                        <input
                            type="text"
                            id="ministry_area"
                            name="ministry_area"
                            class="form-control"
                            placeholder="Enter ministry area">

                        <small
                            id="ministryHelp"
                            class="text-muted">

                            This field changes depending on the request type.

                        </small>

                    </div>

                    <div class="mb-3">

                        <label
                            id="messageLabel"
                            for="message"
                            class="form-label">

                            Message
                            <span class="text-danger">*</span>

                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            class="form-control"
                            placeholder="Write your message..."
                            required></textarea>

                        <small
                            id="messageHelp"
                            class="text-muted">

                            Please provide as much information as possible.

                        </small>

                    </div>
                     <div
                        id="dynamicFields"
                        class="row">
                        <!-- Dynamic fields can be inserted here later by JavaScript -->
                    </div>

                </div>

                <div class="modal-footer justify-content-between">

                    <div class="text-muted small">

                        <i class="fa-solid fa-shield-heart me-1"></i>

                        Your information will be used only to respond to your request.

                    </div>

                    <div>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                            <i class="fa-solid fa-xmark me-2"></i>

                            Close

                        </button>

                        <button
                            type="submit"
                            id="supportSubmitButton"
                            class="btn btn-warning">

                            <i class="fa-solid fa-paper-plane me-2"></i>

                            Submit Request

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script type="text/template" id="support-success-template">

<div class="text-center py-4">

    <div class="mb-3">

        <i class="fa-solid fa-circle-check text-success fa-4x"></i>

    </div>

    <h4 class="mb-3">

        Thank You!

    </h4>

    <p class="text-muted mb-0">

        Your request has been received successfully.

    </p>

    <p class="text-muted">

        Our ministry team will review your request and contact you as soon as possible.

    </p>

</div>

</script>
                   