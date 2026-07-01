document
.getElementById("prayerForm")
.addEventListener("submit", async function(e){

    e.preventDefault();

    const formData = new FormData();

    formData.append(
        "name",
        document.getElementById("name").value
    );

    formData.append(
        "email",
        document.getElementById("email").value
    );

    formData.append(
        "request",
        document.getElementById("request").value
    );

    const response = await fetch(
        "api/prayer.php",
        {
            method:"POST",
            body:formData
        }
    );

    const result = await response.json();

    if(result.success){

        document.getElementById(
            "prayerMessage"
        ).innerHTML =

        "<div class='alert alert-success'>🙏 Thank you! Your prayer request has been received.</div>";

        document
        .getElementById("prayerForm")
        .reset();

    }

});