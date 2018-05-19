var player = document.getElementById('audioPlayer');
var audio = document.createElement("AUDIO");
var buttonPlay = document.createElement("BUTTON");
var buttonPause = document.createElement("BUTTON");
var buttonPrevious = document.createElement("BUTTON");
var buttonNext = document.createElement("BUTTON");


buttonPlay.innerHTML = "PLAY";
buttonPlay.setAttribute("onclick", "f_buttonPlay();");

buttonPause.innerHTML = "PAUSE";
buttonPause.setAttribute("onclick", "f_buttonPause();")

buttonNext.innerHTML = "NEXT";
buttonNext.setAttribute("onclick", "f_buttonNext();");

buttonPrevious.innerHTML = "PREVIOUS";
buttonPrevious.setAttribute("onclick", "f_buttonPrevious();");

player.appendChild(audio);
player.appendChild(buttonPrevious);
player.appendChild(buttonPlay);
player.appendChild(buttonPause);
player.appendChild(buttonNext);

var allmusics = new Array("audio/Хотят ли русские войны.mp3", "audio/mark_bernes_-_ljubimij_gorod_(zvukoff.ru).mp3",
    "audio/Ай да как на горке.mp3","audio/АнимациЯ_Родина[www.MP3Fiber.com].mp3","audio/Бухенвальдский набат.mp3");

var currentSong = 0;

audio.setAttribute("src", allmusics[currentSong]);
dispSongTitle();

function f_buttonPlay() {
  audio.play();
}

function f_buttonPause() {
  audio.pause();
}

function f_buttonNext() {
    if(allmusics[++currentSong]){
        audio.setAttribute("src", allmusics[currentSong]);
        dispSongTitle();
    }else{
        --currentSong;
        alert("Fin de la playlist");
        dispSongTitle();
    }
}

function f_buttonPrevious() {
  if(allmusics[--currentSong]){
      audio.setAttribute("src", allmusics[--currentSong]);
      dispSongTitle();
  }else{
    alert("Fin de la playlist");
    ++currentSong;
    dispSongTitle();
  }
}

function dispSongTitle(){
  document.getElementById("songTitle").innerHTML = allmusics[currentSong];
}