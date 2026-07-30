<nav class="navbar navbar-expand-lg navbar-dark fixed-top custom-navbar">

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand d-flex align-items-center" href="index.php">

            <img
                src="assets/images/logo/logo.png"
                alt="SingThyGlory Logo"
                loading="eager">

        </a>

        <!-- Mobile Toggle -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainMenu"
            aria-controls="mainMenu"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navigation -->
        <div
            class="collapse navbar-collapse"
            id="mainMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#player">
                        Radio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#mission">
                        Mission
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#support">
                        Support
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#features">
                        Features
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#youtube">
                        Videos
                    </a>
                </li>

                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">

                    <a
                        href="#player"
                        class="btn btn-warning btn-live px-4">

                        🔴 Listen Live

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const navbar = document.querySelector('.custom-navbar');

    if (!navbar) {
        return;
    }

    function updateNavbar() {
        if (window.scrollY > 40) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    updateNavbar();

    window.addEventListener('scroll', updateNavbar);

});
</script>