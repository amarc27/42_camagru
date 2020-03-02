<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <style>
    .loader {
        position: fixed;
        z-index: 99;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader > img {
        width: 100px;
    }

    .loader.hidden {
        animation: fadeOut 1s;
        animation-fill-mode: forwards;
    }

    @keyframes fadeOut {
        100% {
            opacity: 0;
            visibility: hidden;
        }
    }

    .thumb {
        height: 100px;
        border: 1px solid black;
        margin: 10px;
    }
    </style>
    
    <div class="loader">
        <img src="loading.gif" alt="Loading..." />
    </div>
    <h2 id="title">Custom Loader - dcode</h2>
    <img src="image1.jpg" class="thumb" />
    <img src="image2.jpg" class="thumb" />
    <img src="image3.jpg" class="thumb" />

</body>
</html>