'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photo = document.getElementById('canvas_img');
const snap = document.getElementById('snap');
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    width: 640, height: 480
  }
};

// navigator.mediaDevices.getUserMedia({ audio:false, video: {width: 640, height: 480}   }).then(mediaStream => {
//   video.srcObject = mediaStream
//    video.onloadedmetadata = function(e) {
//    video.play();
//  };

// }).catch(err => {
//  document.querySelector('#overlay_msg').style.display="block"
//  document.querySelector('#picture_take').style.display="none"
//  document.querySelector('#picture_up').style.display="flex"
//  console.log("Erreur: " + err);
// }) 

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  }
  catch (e) {
    document.querySelector('#submit-take-picture').style.display="none"
    document.querySelector('#select-file').style.display="block"
    document.querySelector('#upload-file').style.display="block"
    document.querySelector('.overview').style.marginTop="100px"
    document.querySelector('#photo_frame').style.height="120px"
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

// snap.addEventListener("click", function() {
document.getElementById('form').addEventListener("submit",function(){
  var context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, 640, 480);
  var image = canvas.toDataURL('image/png'); // data:image/png...
  document.getElementById('base64').value = image;
});