<section id="prayer" class="prayer-section">

    <div class="container">

        <div class="section-heading text-center">

            <h2>🙏 Prayer Request</h2>

            <p>
                Share your prayer needs with us. We would be honored to pray for you.
            </p>

        </div>

        <div class="prayer-card">

            <form id="prayerForm">

                <div class="mb-4">

                    <input
                        type="text"
                        id="name"
                        class="form-control"
                        placeholder="Your Name"
                        required>

                </div>

                <div class="mb-4">

                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        placeholder="Your Email">

                </div>

                <div class="mb-4">

                    <textarea
                        id="request"
                        class="form-control"
                        rows="6"
                        placeholder="Write your prayer request..."
                        required></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-warning btn-lg rounded-pill">

                    🙏 Submit Prayer Request

                </button>

            </form>

            <div
                id="prayerMessage"
                class="mt-4 text-center">
            </div>

        </div>

    </div>

</section>