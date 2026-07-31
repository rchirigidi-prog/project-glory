<?php
/**
 * Support Ministry Modal
 * M-009 – Support Ministry Module
 */
?>

<div
    class="modal fade"
    id="supportModal"
    tabindex="-1"
    aria-labelledby="supportModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <form
                id="supportRequestForm"
                autocomplete="off">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="supportModalLabel">

                        Support Ministry

                    </h5>

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

                                Full Name <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="full_name"
                                name="full_name"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label
                                for="email"
                                class="form-label">

                                Email Address <span class="text-danger">*</span>

                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label
                                for="phone"
                                class="form-label">

                                Phone

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label
                                for="country"
                                class="form-label">

                                Country

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="country"
                                name="country">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label
                            for="subject"
                            class="form-label">

                            Subject

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="subject"
                            name="subject">

                    </div>

                    <div class="mb-3">

                        <label
                            for="ministry_area"
                            class="form-label">

                            Ministry Area / Skills

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="ministry_area"
                            name="ministry_area">

                    </div>

                    <div class="mb-3">

                        <label
                            for="message"
                            class="form-label">

                            Message <span class="text-danger">*</span>

                        </label>

                        <textarea
                            class="form-control"
                            id="message"
                            name="message"
                            rows="5"
                            required></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Close

                    </button>

                    <button
                        type="submit"
                        id="submitSupportRequest"
                        class="btn btn-warning">

                        Submit Request

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>