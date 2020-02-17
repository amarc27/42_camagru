'use strict';

const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const photo = document.getElementById('canvas_img');
const errorMsgElement = document.querySelector('span#errorMsg');

const constraints = {
  audio: false,
  video: {
    width: 640, height: 480
  }
};

// Access webcam
async function init() {
  try {
    const stream = await navigator.mediaDevices.getUserMedia(constraints);
    handleSuccess(stream);
  } catch (e) {
    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
  }
}

// Success
function handleSuccess(stream) {
  window.stream = stream;
  video.srcObject = stream;
}

// Load init
init();

document.getElementById('form').addEventListener("submit",function(){
  var context = canvas.getContext('2d');
  context.drawImage(video, 0, 0, 640, 480);
  var image = canvas.toDataURL('image/png'); // data:image/png...
  document.getElementById('base64').value = image;
});