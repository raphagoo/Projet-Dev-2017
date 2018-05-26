var player = document.getElementById('audioPlayer');
var audio = document.createElement("AUDIO");
var buttonPlay = document.createElement("BUTTON");
var buttonPause = document.createElement("BUTTON");
var buttonPrevious = document.createElement("BUTTON");
var buttonNext = document.createElement("BUTTON");

audio.setAttribute("controls", "controls");

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
//player.appendChild(buttonPlay);
//player.appendChild(buttonPause);
player.appendChild(buttonNext);

var allmusics = new Array();

var currentSong = 0;

function setCurrentSong() {
    audio.setAttribute("src", allmusics[currentSong]);
    dispSongTitle();
    f_buttonPlay();
}

function f_buttonPlay() {
  audio.play();
}

function f_buttonPause() {
  audio.pause();
}

function f_buttonNext() {
    if(allmusics[++currentSong]){
        audio.setAttribute("src", allmusics[currentSong]);
        f_buttonPlay();
        dispSongTitle();
    }else{
        // --currentSong;
        // alert("Fin de la playlist");
        currentSong = 0;
        f_buttonPlay();
        dispSongTitle();
    }
}

function f_buttonPrevious() {
  if(allmusics[--currentSong]){
      audio.setAttribute("src", allmusics[currentSong]);
      f_buttonPlay();
      dispSongTitle();
  }else{
    //alert("Fin de la playlist");
    ++currentSong;
      currentSong = 0;
      audio.setAttribute("src", allmusics[currentSong]);
      f_buttonPlay();
    dispSongTitle();
  }
}

function dispSongTitle(){
  document.getElementById("songTitle").innerHTML = allmusics[currentSong];
}

function onclickPlayMusic(albumArray, musicIndex){
   allmusics  = albumArray;
   currentSong = musicIndex;
    setCurrentSong();
}

function onclickPlayAlbum(albumArray){
    allmusics  = albumArray;
    currentSong = 0;
    setCurrentSong();
}

alert(allmusics);

onclickPlayAlbum(["Assets/Music/Хотят ли русские войны.mp3", "Assets/Music/mark_bernes_-_ljubimij_gorod_(zvukoff.ru).mp3",
    "Assets/Music/Ай да как на горке.mp3","Assets/Music/АнимациЯ_Родина[www.MP3Fiber.com].mp3","Assets/Music/Бухенвальдский набат.mp3"]);

//onclickPlayMusic(['afa','yuy','opoo'], 1);

