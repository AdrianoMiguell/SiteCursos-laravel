const next = document.getElementsByClassName("next");

if (next.length == 1 && typeof next != undefined) {
console.log("está indo next")

    var tag = document.createElement("script");
    tag.id = "iframe-demo";
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player("video_modulo", {
            events: {
                onReady: onPlayerReady,
                onStateChange: onPlayerStateChange,
            },
        });
    }

    function onPlayerReady(event) {
        document.getElementById("video_modulo").style.borderColor = "#FF6D00";
    }

    function changeStatesVideo(playerStatus) {
        if (playerStatus == 0) {
            // onEndedVideo()
            onFinishVideo(true);
        } else {
            onFinishVideo(false);
        }
    }

    function onPlayerStateChange(event) {
        changeStatesVideo(event.data);
    }

    function onFinishVideo(e) {
        if (e == true) {
            next[0].classList.remove("link_block");
            next[0].removeAttribute("disabled");
        } else {
            next[0].classList.add("link_block");
            next[0].setAttribute("disabled", "");
        }
    }

    onFinishVideo(false);
}
