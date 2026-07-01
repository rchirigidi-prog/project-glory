/*==================================================
Project Glory v1.0
YouTube Module
==================================================*/

async function loadYoutubeVideos() {

    try {

        const response = await fetch("api/youtube.php");
        const videos = await response.json();

        const container = document.getElementById("youtubeVideos");

        if (!container) return;

        let html = "";

        videos.slice(0, 6).forEach(video => {

            const date = new Date(video.published);

            const title =
                video.title.length > 60
                    ? video.title.substring(0, 60) + "..."
                    : video.title;

            html += `

            <div class="youtube-card">

                <div class="video-thumb">

                    <img
                        loading="lazy"
                        src="${video.thumbnail}"
                        alt="${title}">

                    <div class="play-overlay">

                        <i class="fas fa-play"></i>

                    </div>

                </div>

                <div class="youtube-content">

                    <h5>${title}</h5>

                    <p>

                        <i class="far fa-calendar-alt me-2"></i>

                        ${date.toLocaleDateString("en-GB",{
                            day:"numeric",
                            month:"short",
                            year:"numeric"
                        })}

                    </p>

                    <a
                        href="${video.url}"
                        target="_blank"
                        class="btn btn-danger rounded-pill">

                        <i class="fab fa-youtube me-2"></i>

                        Watch Now

                    </a>

                </div>

            </div>

            `;

        });

        container.innerHTML = html;

        initializeYoutubeSlider();

    } catch(error) {

        console.error("YouTube RSS Error:", error);

    }

}

function initializeYoutubeSlider() {

    const next = document.getElementById("ytNext");
const prev = document.getElementById("ytPrev");

if (!slider) return;

if(next){

    next.onclick = () => {

        slider.scrollBy({

            left:380,

            behavior:"smooth"

        });

    };

}

    prev.onclick = () => {

        slider.scrollBy({

            left:-380,

            behavior:"smooth"

        });

    };

    setInterval(() => {

        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5) {

            slider.scrollTo({

                left:0,

                behavior:"smooth"

            });

        } else {

            slider.scrollBy({

                left:380,

                behavior:"smooth"

            });

        }

    },5000);

}

document.addEventListener("DOMContentLoaded", loadYoutubeVideos);