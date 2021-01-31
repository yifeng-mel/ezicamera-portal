<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EziCamera</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>

        html {
            height: 100%;
            overflow: hidden;
            font-family: 'Nunito', sans-serif;
        }

        body { 
            margin:0;
            padding:0;
            height: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
            font-family: 'Nunito', sans-serif;
        }

        p {
            font-size: 140%;
            line-height: 150%;
            color: black;
        }
        
        .header {
            text-align: center;
        }

        .title {
            width: 50%;
            padding: 5%;
            border-radius: 10px;
            margin-right: 20%;
            background-color: white;
        }

        .slide {
            position: relative;
            min-height: 100vh;
            width: 100vw;
            box-sizing: border-box;
            transform-style: inherit;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        .slide:before {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .slide .title {
            margin-left: auto;
            margin-right: 10wh;
        }

        #slide1 {
            background-color: #798995;
            color: white;
        }

        #slide2 {
            background-color: #71B6C6;
        }

        #slide3 {
            background-color: #DDBDB9;
        }

        #slide4 {
            background-color: #C26351;
        }

        #slide5 {
            background-color: #BB3D3C;
        }

        .subsection {
            padding: 0 25px;
        }
    </style>
</head>
<body>
    <div id="slide1" class="slide header">
        <h1>Welcome to EziCamera</h1>
        <div id="sections">
            <span class="subsection">Encryption</span>
            <span class="subsection">Authentication</span>
            <span class="subsection">Live Streaming</span>
            <span class="subsection">Video Recording</span>
            <span class="subsection">Easy Setup</span>
        </div>
    </div>

    <div id="slide2" class="slide">
        <div class="title">
            <h1>Encryption</h1>
            <p>
                Internet is a complex place, you don't know who is spying on your data. 
                <br>
                EziCamera secures your connection by encrypting your data with HTTPS, Datagram Transport Layer Security (DTLS) and Secure Real-time Transport Protocol (SRTP).
            </p>
            <h1>Authentication</h1>
            <p>
                It is mandatory to setup your own login credentials, so only you have access to your EziCamera.
            </p>
        </div>
    </div>

    <div id="slide3" class="slide">
        <div class="title">
            <h1>Live Streaming</h1>
            <p>
                You will be provided a unique URL secured by HTTPS.
                <br>
                With this url, you can view your EziCamera live streaming at any time.
            </p>
            <h1>Video Recording</h1>
            <p>
                EziCamera is capable of storing 7 days of video recording. 
                <br>
                With the secured URL, you can download these videos easily.
            </p>
        </div>
    </div>
    
    <div id="slide4" class="slide">
        <div class="title">
            <h1>Easy Setup</h1>
            <p>
                It's super easy to setup EziCamera.
                <br>
                Buy EziCamera, connect EziCamera to your home Wi-Fi and setup your own credentials. Done! 
            </p>
        </div>
    </div>

    <div id="slide5" class="slide">
        <div class="title">
            <h1>Contact Us</h1>
            <p>
                Contact us by sending email to <strong>support@ezicamera.com</strong> , our support team will get back to you within 24 hours. 
            </p>
        </div>
    </div>    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    let box = document.querySelector('body')
    let targetElm = document.querySelector('#slide1');
    scrollToElm( box, targetElm , 1 );   
});

var currentPage = 1;

/////////////

function scrollToElm(container, elm, duration){
  var pos = getRelativePos(elm);
  scrollTo( container, pos.top , duration);  // duration in seconds
}

function getRelativePos(elm){
  var pPos = elm.parentNode.getBoundingClientRect(), // parent pos
      cPos = elm.getBoundingClientRect(), // target pos
      pos = {};

  pos.top    = cPos.top    - pPos.top + elm.parentNode.scrollTop,
  pos.right  = cPos.right  - pPos.right,
  pos.bottom = cPos.bottom - pPos.bottom,
  pos.left   = cPos.left   - pPos.left;

  return pos;
}
    
function scrollTo(element, to, duration, onDone) {
    var start = element.scrollTop,
        change = to - start,
        startTime = performance.now(),
        val, now, elapsed, t;

    function animateScroll(){
        now = performance.now();
        elapsed = (now - startTime)/1000;
        t = (elapsed/duration);

        element.scrollTop = start + change * easeInOutQuad(t);

        if( t < 1 )
            window.requestAnimationFrame(animateScroll);
        else
            onDone && onDone();
    };

    animateScroll();
}

function easeInOutQuad(t){ return t<.5 ? 2*t*t : -1+(4-2*t)*t };

window.addEventListener('wheel', throttle(callback, 1000));

function throttle(fn, wait) {
  var time = Date.now();
  return function(event) {
    event.preventDefault()
    if ((time + wait - Date.now()) < 0) {
      fn(event);
      time = Date.now();
    }
  }
}

function callback(event) {
    if (event.deltaY < 0)
    {
        console.log('scrolling up')
        currentPage = currentPage - 1;
    }
    else if (event.deltaY > 0)
    {
        console.log('scrolling down');
        currentPage = currentPage + 1;
    }

    let box = document.querySelector('body')
    if (currentPage < 1) { currentPage = 1; return }
    if (currentPage > 5) { currentPage = 5; return }
    
    if (currentPage == 1) {
        targetElm = document.querySelector('#slide1');
    } else if(currentPage == 2) {
        targetElm = document.querySelector('#slide2');
    } else if(currentPage == 3) {
        targetElm = document.querySelector('#slide3');
    } else if(currentPage == 4) {
        targetElm = document.querySelector('#slide4');
    } else if(currentPage == 5) {
        targetElm = document.querySelector('#slide5');
    }

    scrollToElm( box, targetElm , 1 );   
}

</script>
</html>