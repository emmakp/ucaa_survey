<!DOCTYPE html>
<html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="HandheldFriendly" content="true">
    <title>Thank You</title>
    <link rel="shortcut icon" href="{{ asset('img/airestech.jpg') }}">
    <script type="text/javascript" src="https://cdn.jotfor.ms/js/prototype.js"></script>

    <link type="text/css" rel="stylesheet" href="https://cdn.jotfor.ms/css/thankyou.css?v=0.13">
    <style type="text/css">
      body {
        background:  rgb(243, 243, 254);
        font-family: Inter, sans-serif;
        font-size: 16px;
        color: #2C3345;
      }
      .form-all {
        background:  #fff;
        max-width: 600px;
      }
      .thankyou-sub-text {
        color: #2C3345;
      }
      #footer {
        max-width: 600px;
      }

      .thankYouDownloadPDFWrapper {
        border-top: 1px solid  rgb(243, 243, 254);
      }
      .ty-buttons.thankYouEditSubmission, .ty-buttons.thankYouDownloadPDF {
        color: #2C3345;
        background-color: #fff;
        border-color: #2C3345;
      }
      .ty-buttons.thankYouFillAgain {
        color: #2C3345;
        background-color: #fff;
        border-color: #2C3345;
      }
      @media print {
       .form-all {
        width: 600px;
       }
      }
    </style>
    <style type="text/css" id="form-styles">
/* Injected CSS Code */
#cid_21 img.form-image,
#id_21 img.form-image{
    margin-top : -52px;
}

.form-label.form-label-auto {

      display: block;
      float: none;
      text-align: left;
      width: 100%;

      }
/* Injected CSS Code */
.form-all { padding:0 10px;
  padding-bottom: 30px;
}
.wrapper {
  display: flex;
  min-height: 370px;
  margin:0 auto;
  justify-content:center;
  flex-direction: column;
}

div  img {
  margin: 24px 0 0;
}
      [class*="col-"] {
  text-align:center;
  display:flex;
  flex-direction: column;
}
  .col-1 img{
  width:100%;
  max-width:153px;
}
.col-1 {
  justify-content: center;
  align-items: center;
}
.col-2 {
display: flex;
flex-direction: column;
align-items:center;
justify-content:center;
padding: 16px;
}
       @media screen and (max-width: 480px) {
  .thankyou {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .form-all {
    display: flex;
   flex-direction: column;
    justify-content: center;
}
}div.wrapper .col-1 {
 background-size: ;
}

    </style>
  </head>
  <body id="stage" class="thankyou">
    <div class="form-all">
      <div class="thankyou-wrapper"><p class="thank-you-icon" style="text-align:center;"><img src="https://cdn.jotfor.ms/img/Thankyou-iconV2.png?v=0.1" alt="thank you check icon" width="153" height="156"></p><div style="text-align:center;"><h1 class="thankyou-main-text ty-text" style="text-align:center;">Thank You!</h1><p class="thankyou-sub-text ty-text" style="text-align:center;">Your submission has been received.</p></div></div>

    </div>
    <div id="footer" class="form-footer" style="display: block !important;">
      <div class="thankyou-footer-wrapper ">
  <div class="thankyou-text thankyou-leftside">
    <a class="locale" href="https://www.najod.co" target="_blank">
      Powered By Najod
    </a>
  </div>
  <div class="thankyou-text thankyou-rightside">
    <a class="locale" href="#!">
      Connect to Wifi
    </a>
  </div>
</div>
    </div>

  <script type="text/javascript">
    function inIframe () {
      try {
          return window.self !== window.top;
      } catch (e) {
          return true;
      }
    }
    function sendHeightPageToParent() {
        var formAllContent = document.querySelector('.form-all');
        var compStyles = window.getComputedStyle(formAllContent);
        var stageMarginTop = formAllContent ? parseInt(compStyles.getPropertyValue('marginTop')) || parseInt(compStyles.getPropertyValue('margin')) || 0 : 0;
        var isMobile = window.matchMedia("(pointer:coarse)").matches || window.matchMedia("only screen and (max-width: 480px)").matches;
        var isIframe = inIframe();
        var contentHeight = formAllContent.offsetHeight + document.querySelector('.form-footer').offsetHeight;
        var height = (isIframe && isMobile) ? contentHeight : document.body.offsetHeight + (stageMarginTop * 2);
        window.scrollTo(0,0);
        window.parent.postMessage('setHeight:' + height + ':242097293840562', '*');
    }
    if (window.parent !== window) {
      window.parent.postMessage({ action: 'submission-completed' }, '*');
      sendHeightPageToParent();
      window.addEventListener('load', sendHeightPageToParent);
    }

    window.newThankYouPage = true;
    window.document.title = 'Thank You';
    // window.publishURL = 'https://submit.jotform.com/242097293840562';
    var favicon = document.querySelector('link[rel="shortcut icon"]');
    window.isDarkMode = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
    if(favicon && window.isDarkMode) {
      favicon.href = favicon.href.replaceAll('favicon-2021-light.ico', 'favicon-2021-dark.ico');
    }
  </script>
  <script src="https://cdn.jotfor.ms/js/includes/thankYouPageScripts.js"></script>


</body></html>
