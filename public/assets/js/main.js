async function loadNowPlaying() {

    try {

        const response = await fetch('api/radio.php');

        const data = await response.json();

        const station = data[0];

        console.log("Radio API Working");
        console.log(station);
        console.log(station.now_playing.song.title);


        let title = station.now_playing.song.title;

        title = title.replace(/^\d+\s*/, '');

        document.getElementById('song-title').innerText = title;

        document.getElementById('song-artist').innerText =
            station.now_playing.song.artist || "SingThyGlory";

        const count = station.listeners.current;

        document.getElementById("listeners").innerHTML =
            "👥 " + count + (count == 1 ? " Listener Online" : " Listeners Online");

        document.getElementById('album-art').src =
            station.now_playing.song.art;

       
         document.getElementById("listeners").innerText =
    "👥 " + station.listeners.current + " Listening";   

    document.getElementById("listeners").innerHTML =
    "👥 " + station.listeners.current + " Listening";

    } catch (error) {

        console.log(error);

    }

}

loadNowPlaying();

setInterval(loadNowPlaying,10000);

// ===============================
// CUSTOM PLAYER
// ===============================

const player = document.getElementById("radioPlayer");
const playButton = document.getElementById("playButton");
const volume = document.getElementById("volumeControl");
const album = document.getElementById("album-art");

player.volume = 0.8;

// Play / Pause

playButton.addEventListener("click", function () {

    if (player.paused) {

        player.play();

    } else {

        player.pause();

    }

});

// Update Button

player.onplay = function () {

    playButton.innerHTML = "❚❚";

    album.classList.add("playing");

    document.querySelector(".equalizer").classList.add("playing");

};

player.onpause = function () {

    playButton.innerHTML = "▶";

    album.classList.remove("playing");

    document.querySelector(".equalizer").classList.remove("playing");

};

// Volume

volume.addEventListener("input", function () {

    player.volume = this.value;

});

// ===============================
// YOUTUBE RSS FEED
// ===============================

// Bible Module
