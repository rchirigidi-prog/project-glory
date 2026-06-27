async function loadVerse() {

    try {

        const response = await fetch("api/bible.php");

        const verse = await response.json();

        document.getElementById("verseText").innerHTML =
            verse.text;

        document.getElementById("verseReference").innerHTML =
            verse.reference;

    } catch(error) {

        console.error("Bible API Error:", error);

    }

}

loadVerse();

document.getElementById("copyVerse").onclick = function() {

    navigator.clipboard.writeText(

        document.getElementById("verseText").innerText +

        " - " +

        document.getElementById("verseReference").innerText

    );

    alert("Bible verse copied!");

};

document.getElementById("shareVerse").onclick = function() {

    if (navigator.share) {

        navigator.share({

            title:"Today's Bible Verse",

            text:
            document.getElementById("verseText").innerText +

            " - " +

            document.getElementById("verseReference").innerText

        });

    }

};