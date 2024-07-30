@extends('layouts.app')

@section('content')
<link type="text/css" rel="stylesheet" href="https://cdn02.jotfor.ms/themes/CSS/5e6b428acc8c4e222d1beb91.css?v=3.3.55661&themeRevisionID=65660e4b326633110492e01a"/>  

<script src="https://cdn02.jotfor.ms/static/prototype.forms.js?v=3.3.55661" type="text/javascript"></script>
<script src="https://cdn03.jotfor.ms/static/jotform.forms.js?v=3.3.55661" type="text/javascript"></script>
<script src="https://cdn01.jotfor.ms/s/umd/8ff5ac23d97/for-appointment-field.js?v=3.3.55661" type="text/javascript"></script>
 <script src="https://cdn01.jotfor.ms/js/vendor/smoothscroll.min.js?v=3.3.55661" type="text/javascript"></script>
<script src="https://cdn02.jotfor.ms/js/errorNavigation.js?v=3.3.55661" type="text/javascript"></script>
<script type="text/javascript">	JotForm.newDefaultTheme = true;
	JotForm.extendsNewTheme = false;
	JotForm.singleProduct = false;
	JotForm.newPaymentUIForNewCreatedForms = false;
	JotForm.texts = {"confirmEmail":"E-mail does not match","pleaseWait":"Please wait...","validateEmail":"You need to validate this e-mail","confirmClearForm":"Are you sure you want to clear the form","lessThan":"Your score should be less than or equal to","incompleteFields":"There are incomplete required fields. Please complete them.","required":"This field is required.","requireOne":"At least one field required.","requireEveryRow":"Every row is required.","requireEveryCell":"Every cell is required.","email":"Enter a valid e-mail address","alphabetic":"This field can only contain letters","numeric":"This field can only contain numeric values","alphanumeric":"This field can only contain letters and numbers.","cyrillic":"This field can only contain cyrillic characters","url":"This field can only contain a valid URL","currency":"This field can only contain currency values.","fillMask":"Field value must fill mask.","uploadExtensions":"You can only upload following files:","noUploadExtensions":"File has no extension file type (e.g. .txt, .png, .jpeg)","uploadFilesize":"File size cannot be bigger than:","uploadFilesizemin":"File size cannot be smaller than:","gradingScoreError":"Score total should only be less than or equal to","inputCarretErrorA":"Input should not be less than the minimum value:","inputCarretErrorB":"Input should not be greater than the maximum value:","maxDigitsError":"The maximum digits allowed is","minCharactersError":"The number of characters should not be less than the minimum value:","maxCharactersError":"The number of characters should not be more than the maximum value:","freeEmailError":"Free email accounts are not allowed","minSelectionsError":"The minimum required number of selections is ","maxSelectionsError":"The maximum number of selections allowed is ","pastDatesDisallowed":"Date must not be in the past.","dateLimited":"This date is unavailable.","dateInvalid":"This date is not valid. The date format is {format}","dateInvalidSeparate":"This date is not valid. Enter a valid {element}.","ageVerificationError":"You must be older than {minAge} years old to submit this form.","multipleFileUploads_typeError":"{file} has invalid extension. Only {extensions} are allowed.","multipleFileUploads_sizeError":"{file} is too large, maximum file size is {sizeLimit}.","multipleFileUploads_minSizeError":"{file} is too small, minimum file size is {minSizeLimit}.","multipleFileUploads_emptyError":"{file} is empty, please select files again without it.","multipleFileUploads_uploadFailed":"File upload failed, please remove it and upload the file again.","multipleFileUploads_onLeave":"The files are being uploaded, if you leave now the upload will be cancelled.","multipleFileUploads_fileLimitError":"Only {fileLimit} file uploads allowed.","dragAndDropFilesHere_infoMessage":"Drag and drop files here","chooseAFile_infoMessage":"Choose a file","maxFileSize_infoMessage":"Max. file size","generalError":"There are errors on the form. Please fix them before continuing.","generalPageError":"There are errors on this page. Please fix them before continuing.","wordLimitError":"Too many words. The limit is","wordMinLimitError":"Too few words.  The minimum is","characterLimitError":"Too many Characters.  The limit is","characterMinLimitError":"Too few characters. The minimum is","ccInvalidNumber":"Credit Card Number is invalid.","ccInvalidCVC":"CVC number is invalid.","ccInvalidExpireDate":"Expire date is invalid.","ccInvalidExpireMonth":"Expiration month is invalid.","ccInvalidExpireYear":"Expiration year is invalid.","ccMissingDetails":"Please fill up the credit card details.","ccMissingProduct":"Please select at least one product.","ccMissingDonation":"Please enter numeric values for donation amount.","disallowDecimals":"Please enter a whole number.","restrictedDomain":"This domain is not allowed","ccDonationMinLimitError":"Minimum amount is {minAmount} {currency}","requiredLegend":"All fields marked with * are required and must be filled.","geoPermissionTitle":"Permission Denied","geoPermissionDesc":"Check your browser's privacy settings.","geoNotAvailableTitle":"Position Unavailable","geoNotAvailableDesc":"Location provider not available. Please enter the address manually.","geoTimeoutTitle":"Timeout","geoTimeoutDesc":"Please check your internet connection and try again.","selectedTime":"Selected Time","formerSelectedTime":"Former Time","cancelAppointment":"Cancel Appointment","cancelSelection":"Cancel Selection","noSlotsAvailable":"No slots available","slotUnavailable":"{time} on {date} has been selected is unavailable. Please select another slot.","multipleError":"There are {count} errors on this page. Please correct them before moving on.","oneError":"There is {count} error on this page. Please correct it before moving on.","doneMessage":"Well done! All errors are fixed.","invalidTime":"Enter a valid time","doneButton":"Done","reviewSubmitText":"Review and Submit","nextButtonText":"Next","prevButtonText":"Previous","seeErrorsButton":"See Errors","notEnoughStock":"Not enough stock for the current selection","notEnoughStock_remainedItems":"Not enough stock for the current selection ({count} items left)","soldOut":"Sold Out","justSoldOut":"Just Sold Out","selectionSoldOut":"Selection Sold Out","subProductItemsLeft":"({count} items left)","startButtonText":"START","submitButtonText":"Submit","submissionLimit":"Sorry! Only one entry is allowed. <br> Multiple submissions are disabled for this form.","reviewBackText":"Back to Form","seeAllText":"See All","progressMiddleText":"of","fieldError":"field has an error.","error":"Error"};
	JotForm.newPaymentUI = true;
	JotForm.originalLanguage = "en";
	JotForm.replaceTagTest = true;
	JotForm.clearFieldOnHide="disable";
	JotForm.submitError="jumpToFirstError";
	JotForm.encryptionProtocol = "JF-CSE-V1";
	window.addEventListener('DOMContentLoaded',function(){window.brandingFooter.init({"formID":242097293840562,"campaign":"powered_by_jotform_le","isCardForm":false,"isLegacyForm":true,"formLanguage":"en"})});
	JotForm.init(function(){
	/*INIT-START*/
      JotForm.autoNext(10);

    $('input_26').rating({stars:'5',
    inputClassName:'form-textbox',
    imagePath: 'https://cdn.jotfor.ms/images/stars_v2.png',
    cleanFirst:true, value:''});
$('input_26').setAttribute('role','radiogroup');
$('input_26').setAttribute('aria-labelledby','label_26');

    Array.from($('input_26').children).map(function(e, i){e.setAttribute('tabindex',0);
    if(i<5) {e.setAttribute('aria-label',(i+1)+' out of 5');}
    e.setAttribute('role','radio');
    e.setAttribute('aria-checked','false');
    e.setAttribute('aria-describedby', 'label_26');
    e.classList.add('form-star-rating-star', 'Stars');
    e.onkeypress = function(k){if(k.keyCode == 13 || k.keyCode == 32)e.click()}});
JotForm.handleSingleChoiceWithMultiTypeColumns();

    JotForm.calendarMonths = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    JotForm.appointmentCalendarMonths = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    JotForm.appointmentCalendarDays = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
    JotForm.calendarOther = "Today";
    window.initializeAppointment({"text":{"text":"Question","value":"Appointment"},"labelAlign":{"text":"Label Align","value":"Top","dropdown":[["Auto","Auto"],["Left","Left"],["Right","Right"],["Top","Top"]]},"required":{"text":"Required","value":"No","dropdown":[["No","No"],["Yes","Yes"]]},"description":{"text":"Hover Text","value":"","textarea":true},"slotDuration":{"text":"Slot Duration","value":"45","dropdown":[[15,"15 min"],[30,"30 min"],[45,"45 min"],[60,"60 min"],["custom","Custom min"]],"hint":"Select how long each slot will be."},"startDate":{"text":"Start Date","value":""},"endDate":{"text":"End Date","value":""},"intervals":{"text":"Intervals","value":[{"from":"09:00","to":"17:00","days":["Mon","Tue","Wed","Thu","Fri"]}],"hint":"The hours will be applied to the selected days and repeated."},"useBlockout":{"text":"Blockout Custom Dates","value":"No","dropdown":[["No","No"],["Yes","Yes"]],"hint":"Disable certain date(s) in the calendar."},"blockoutDates":{"text":"Blockout dates","value":[{"startDate":"","endDate":""}]},"useLunchBreak":{"text":"Lunch Time","value":"No","dropdown":[["No","No"],["Yes","Yes"]],"hint":"Enable lunchtime in the calendar."},"lunchBreak":{"text":"Lunchtime hours","value":[{"from":"12:00","to":"14:00"}]},"timezone":{"text":"Timezone","value":"America\u002FNew_York (GMT-04:00)"},"timeFormat":{"text":"Time Format","value":"AM\u002FPM","dropdown":[["24 Hour","24 Hour"],["AM\u002FPM","AM\u002FPM"]],"icon":"images\u002Fblank.gif","iconClassName":"toolbar-time_format_24"},"months":{"value":["January","February","March","April","May","June","July","August","September","October","November","December"],"hidden":true},"days":{"value":["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],"hidden":true},"startWeekOn":{"text":"Start Week On","value":"Sunday","dropdown":[["Monday","Monday"],["Sunday","Sunday"]],"toolbar":false},"rollingDays":{"text":"Rolling Days","value":"","toolbar":false},"prevMonthButtonText":{"text":"Previous month","value":""},"nextMonthButtonText":{"text":"Next month","value":""},"prevYearButtonText":{"text":"Previous year","value":""},"nextYearButtonText":{"text":"Next year","value":""},"prevDayButtonText":{"text":"Previous day","value":""},"nextDayButtonText":{"text":"Next day","value":""},"appointmentType":{"hidden":true,"value":"single"},"autoDetectTimezone":{"hidden":true,"value":"Yes"},"dateFormat":{"hidden":true,"value":"mm\u002Fdd\u002Fyyyy"},"maxAttendee":{"hidden":true,"value":"5"},"maxEvents":{"hidden":true,"value":""},"minScheduleNotice":{"hidden":true,"value":"3"},"name":{"hidden":true,"value":"appointment"},"order":{"hidden":true,"value":"18"},"qid":{"toolbar":false,"value":"input_33"},"reminderEmails":{"hidden":true,"value":{"schedule":[{"value":"2","unit":"hour"}]}},"type":{"hidden":true,"value":"control_appointment"},"useReminderEmails":{"hidden":true,"value":"No"},"id":{"toolbar":false,"value":"33"},"qname":{"toolbar":false,"value":"q33_appointment"},"cdnconfig":{"CDN":"https:\u002F\u002Fcdn.jotfor.ms\u002F"},"passive":false,"formProperties":{"highlightLine":"Enabled","coupons":false,"useStripeCoupons":false,"taxes":false,"comparePaymentForm":"","paymentListSettings":false,"newPaymentUIForNewCreatedForms":false,"formBackground":"#fff","newAppointment":false,"isAutoCompleteEnabled":true},"formID":242097293840562,"isPaymentForm":false,"isOpenedInPortal":false,"isCheckoutForm":false,"isOfflineForms":false,"SSL_URL":"https:\u002F\u002Fwww.jotform.com\u002F","themeVersion":"v2","isEnterprise":false,"environment":"PRODUCTION"});
        JotForm.alterTexts({"couponApply":"Apply","couponBlank":"Please enter a coupon.","couponChange":"","couponEnter":"Enter coupon","couponExpired":"Coupon is expired. Please try another one.","couponInvalid":"Coupon is invalid.","couponValid":"Coupon is valid.","productListAllText":"All","productListCategoriesText":"Categories:","productListClearSort":"Clear Sort","productListNameAZ":"Name: A to Z","productListNameZA":"Name: Z to A","productListPriceHighest":"Price: High to Low","productListPriceLowest":"Price: Low to High","productListSearchText":"Search","productListSortBy":"Sort By","shippingShipping":"Shipping","taxTax":"Tax","totalSubtotal":"Subtotal","totalTotal":"Total"}, true);
	/*INIT-END*/
	});

   setTimeout(function() {
JotForm.paymentExtrasOnTheFly([null,null,null,{"name":"howDid","qid":"3","text":"How did you hear about this website?","type":"control_radio"},{"name":"whatBrowser","qid":"4","text":"What browser do you use?","type":"control_radio"},null,null,null,null,null,{"name":"pageBreak17","qid":"10","text":"Page Break","type":"control_pagebreak"},{"name":"pageBreak17","qid":"11","text":"Page Break","type":"control_pagebreak"},{"name":"pageBreak","qid":"12","text":"Page Break","type":"control_pagebreak"},null,null,null,null,{"name":"websiteSurvey","qid":"17","text":"Website Survey","type":"control_head"},{"name":"submit","qid":"18","text":"Submit","type":"control_button"},null,null,{"name":"image","qid":"21","text":"Screenshot%202024-05-07%20at%2018.49.40.663a4e3324d3d5.02014397","type":"control_image"},null,null,{"name":"pageBreak24","qid":"24","text":"Page Break","type":"control_pagebreak"},null,{"description":"","name":"howDo","qid":"26","subLabel":"","text":"how do you like the services?","type":"control_rating"},{"name":"pageBreak27","qid":"27","text":"Page Break","type":"control_pagebreak"},{"description":"","name":"thisIs","qid":"28","text":"this is the scale rating","type":"control_scale"},{"description":"","name":"typeA","qid":"29","text":"Type a question","type":"control_checkbox"},{"description":"","name":"whatIs","qid":"30","text":"What is your gender","type":"control_radio"},null,null,{"description":"","name":"appointment","qid":"33","text":"Appointment","type":"control_appointment"},null,null,{"description":"","name":"howMany","qid":"36","subLabel":"","text":"how many do you want","type":"control_dropdown"},null,null,null,{"description":"","name":"typeA40","qid":"40","text":"Type a question","type":"control_matrix"},{"name":"pageBreak41","qid":"41","text":"Page Break","type":"control_pagebreak"},{"name":"divider","qid":"42","text":"Divider","type":"control_divider"}]);}, 20); 
</script>
</head>
<body>
<form class="jotform-form" onsubmit="return typeof testSubmitFunction !== 'undefined' && testSubmitFunction();" action="https://submit.jotform.com/submit/242097293840562" method="post" name="form_242097293840562" id="242097293840562" accept-charset="utf-8" autocomplete="on"><input type="hidden" name="formID" value="242097293840562" /><input type="hidden" id="JWTContainer" value="" /><input type="hidden" id="cardinalOrderNumber" value="" /><input type="hidden" id="jsExecutionTracker" name="jsExecutionTracker" value="build-date-1722297965832" /><input type="hidden" id="submitSource" name="submitSource" value="unknown" /><input type="hidden" id="buildDate" name="buildDate" value="1722297965832" />
  <div role="main" class="form-all">
    <ul class="form-section page-section">
      <li id="cid_17" class="form-input-wide" data-type="control_head">
        <div class="form-header-group  header-large">
          <div class="header-text httac htvam">
            <h1 id="header_17" class="form-header" data-component="header">Website Survey</h1>
            <div id="subHeader_17" class="form-subHeader">Please fill in the website information</div>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_image" id="id_21">
        <div id="cid_21" class="form-input-wide" data-layout="full">
          <div style="text-align:center" aria-hidden="true" role="none"><img alt="Image-21" loading="lazy" class="form-image" style="border:0" src="https://www.jotform.com/uploads/ugurg/form_files/Screenshot%202024-05-07%20at%2018.49.40.663a4e3324d3d5.02014397.png" height="344px" width="400px" data-component="image" role="none" aria-hidden="true" tabindex="-1" /></div>
        </div>
      </li>
      <li id="cid_10" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_10" type="button" class="form-pagebreak-back  button-hidden jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_10" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Start</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_10"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_radio" id="id_3"><label class="form-label form-label-top form-label-auto" id="label_3" aria-hidden="false"> How did you hear about this website? </label>
        <div id="cid_3" class="form-input-wide" data-layout="full">
          <div class="form-multiple-column" data-columncount="2" role="group" aria-labelledby="label_3" data-component="radio"><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_3" class="form-radio" id="input_3_0" name="q3_howDid" value="Social Media" /><label id="label_input_3_0" for="input_3_0">Social Media</label></span><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_3" class="form-radio" id="input_3_1" name="q3_howDid" value="Advertising" /><label id="label_input_3_1" for="input_3_1">Advertising</label></span><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_3" class="form-radio" id="input_3_2" name="q3_howDid" value="Search Engine" /><label id="label_input_3_2" for="input_3_2">Search Engine</label></span><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_3" class="form-radio" id="input_3_3" name="q3_howDid" value="Friend" /><label id="label_input_3_3" for="input_3_3">Friend</label></span><span class="form-radio-item formRadioOther"><input type="radio" class="form-radio-other form-radio" name="q3_howDid" id="other_3" value="other" tabindex="0" aria-label="Other" /><label id="label_other_3" style="text-indent:0" for="other_3">Other</label><span id="other_3_input" class="other-input-container" style="display:none"><input type="text" class="form-radio-other-input form-textbox" name="q3_howDid[other]" data-otherhint="Other" size="15" id="input_3" data-placeholder="Please type another option here" placeholder="Please type another option here" /></span></span></div>
        </div>
      </li>
      <li id="cid_24" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_24" type="button" class="form-pagebreak-back  jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_24" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Next</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_24"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_radio" id="id_30"><label class="form-label form-label-top form-label-auto" id="label_30" aria-hidden="false"> What is your gender </label>
        <div id="cid_30" class="form-input-wide" data-layout="full">
          <div class="form-single-column" role="group" aria-labelledby="label_30" data-component="radio"><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_30" class="form-radio" id="input_30_0" name="q30_whatIs" value="Male" /><label id="label_input_30_0" for="input_30_0">Male</label></span><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_30" class="form-radio" id="input_30_1" name="q30_whatIs" value="Female" /><label id="label_input_30_1" for="input_30_1">Female</label></span><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_30" class="form-radio" id="input_30_2" name="q30_whatIs" value="N/A" /><label id="label_input_30_2" for="input_30_2">N/A</label></span></div>
        </div>
      </li>
      <li class="form-line" data-type="control_dropdown" id="id_36"><label class="form-label form-label-top form-label-auto" id="label_36" for="input_36" aria-hidden="false"> how many do you want </label>
        <div id="cid_36" class="form-input-wide" data-layout="half"> <select class="form-dropdown" id="input_36" name="q36_howMany" style="width:310px" data-component="dropdown" aria-label="how many do you want">
            <option value="">Please Select</option>
            <option value="one">one</option>
            <option value="two">two</option>
            <option value="three">three</option>
          </select> </div>
      </li>
      <li id="cid_11" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_11" type="button" class="form-pagebreak-back  jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_11" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Next</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_11"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_checkbox" id="id_29"><label class="form-label form-label-top form-label-auto" id="label_29" aria-hidden="false"> Type a question </label>
        <div id="cid_29" class="form-input-wide" data-layout="full">
          <div class="form-single-column" role="group" aria-labelledby="label_29" data-component="checkbox"><span class="form-checkbox-item" style="clear:left"><span class="dragger-item"></span><input type="checkbox" aria-describedby="label_29" class="form-checkbox" id="input_29_0" name="q29_typeA[]" value="Type option 1" /><label id="label_input_29_0" for="input_29_0">Type option 1</label></span><span class="form-checkbox-item" style="clear:left"><span class="dragger-item"></span><input type="checkbox" aria-describedby="label_29" class="form-checkbox" id="input_29_1" name="q29_typeA[]" value="Type option 2" /><label id="label_input_29_1" for="input_29_1">Type option 2</label></span><span class="form-checkbox-item" style="clear:left"><span class="dragger-item"></span><input type="checkbox" aria-describedby="label_29" class="form-checkbox" id="input_29_2" name="q29_typeA[]" value="Type option 3" /><label id="label_input_29_2" for="input_29_2">Type option 3</label></span><span class="form-checkbox-item" style="clear:left"><span class="dragger-item"></span><input type="checkbox" aria-describedby="label_29" class="form-checkbox" id="input_29_3" name="q29_typeA[]" value="Type option 4" /><label id="label_input_29_3" for="input_29_3">Type option 4</label></span><span class="form-checkbox-item formCheckboxOther" style="clear:left"><input type="checkbox" class="form-checkbox-other form-checkbox" name="q29_typeA[other]" id="other_29" value="other" tabindex="0" aria-label="Other" /><label id="label_other_29" style="text-indent:0" for="other_29">Other</label><span id="other_29_input" class="other-input-container" style="display:none"><input type="text" class="form-checkbox-other-input form-textbox" name="q29_typeA[other]" data-otherhint="Other" size="15" id="input_29" data-placeholder="Please type another option here" placeholder="Please type another option here" /></span></span></div>
        </div>
      </li>
      <li class="form-line" data-type="control_rating" id="id_26"><label class="form-label form-label-top form-label-auto" id="label_26" for="input_26" aria-hidden="false"> how do you like the services? </label>
        <div id="cid_26" class="form-input-wide" data-layout="full">
          <div id="input_26" name="q26_howDo" data-component="rating" data-version="v2"><select name="q26_howDo" aria-label="how do you like the services?">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select></div>
        </div>
      </li>
      <li class="form-line" data-type="control_radio" id="id_4"><label class="form-label form-label-top form-label-auto" id="label_4" aria-hidden="false"> What browser do you use? </label>
        <div id="cid_4" class="form-input-wide" data-layout="full">
          <div class="form-multiple-column" data-columncount="2" role="group" aria-labelledby="label_4" data-component="radio"><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_0" name="q4_whatBrowser" value="Google Chrome" /><label id="label_input_4_0" for="input_4_0">Google Chrome</label></span><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_1" name="q4_whatBrowser" value="Firefox" /><label id="label_input_4_1" for="input_4_1">Firefox</label></span><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_2" name="q4_whatBrowser" value="IE" /><label id="label_input_4_2" for="input_4_2">IE</label></span><span class="form-radio-item"><span class="dragger-item"></span><input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_3" name="q4_whatBrowser" value="Safari" /><label id="label_input_4_3" for="input_4_3">Safari</label></span><span class="form-radio-item" style="clear:left"><span class="dragger-item"></span><input type="radio" aria-describedby="label_4" class="form-radio" id="input_4_4" name="q4_whatBrowser" value="Opera" /><label id="label_input_4_4" for="input_4_4">Opera</label></span></div>
        </div>
      </li>
      <li id="cid_27" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_27" type="button" class="form-pagebreak-back  jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_27" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Next</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_27"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_scale" id="id_28"><label class="form-label form-label-top form-label-auto" id="label_28" for="input_28" aria-hidden="false"> this is the scale rating </label>
        <div id="cid_28" class="form-input-wide" data-layout="full"> <span class="form-sub-label-container" style="vertical-align:top">
            <div role="radiogroup" aria-labelledby="label_28 sublabel_input_28_description" cellPadding="4" cellSpacing="0" class="form-scale-table" data-component="scale">
              <div class="rating-item-group">
                <div class="rating-item"><span class="rating-item-title for-from"><label for="input_28_worst" aria-hidden="true">Worst</label></span><input type="radio" aria-labelledby="label_input_28" class="form-radio" name="q28_thisIs" value="1" title="1" id="input_28_1" /><label for="input_28_1">1</label></div>
                <div class="rating-item"><input type="radio" aria-labelledby="label_input_28" class="form-radio" name="q28_thisIs" value="2" title="2" id="input_28_2" /><label for="input_28_2">2</label></div>
                <div class="rating-item"><input type="radio" aria-labelledby="label_input_28" class="form-radio" name="q28_thisIs" value="3" title="3" id="input_28_3" /><label for="input_28_3">3</label></div>
                <div class="rating-item"><input type="radio" aria-labelledby="label_input_28" class="form-radio" name="q28_thisIs" value="4" title="4" id="input_28_4" /><label for="input_28_4">4</label></div>
                <div class="rating-item"><span class="rating-item-title for-to"><label for="input_28_best" aria-hidden="true">Best</label></span><input type="radio" aria-labelledby="label_input_28" class="form-radio" name="q28_thisIs" value="5" title="5" id="input_28_5" /><label for="input_28_5">5</label></div>
              </div>
            </div><label class="form-sub-label" id="sublabel_input_28_description" style="border:0;clip:rect(0 0 0 0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px;white-space:nowrap">1 is Worst, 5 is Best</label>
          </span> </div>
      </li>
      <li id="cid_41" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_41" type="button" class="form-pagebreak-back  jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_41" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Next</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_41"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_divider" id="id_42">
        <div id="cid_42" class="form-input-wide" data-layout="full">
          <div class="divider" data-component="divider" style="border-bottom-width:1px;border-bottom-style:solid;border-color:rgb(243, 243, 254);height:1px;margin-left:0px;margin-right:0px;margin-top:5px;margin-bottom:5px"></div>
        </div>
      </li>
      <li class="form-line" data-type="control_matrix" id="id_40"><label class="form-label form-label-top form-label-auto" id="label_40" for="input_40" aria-hidden="false"> Type a question </label>
        <div id="cid_40" class="form-input-wide" data-layout="full">
          <table summary="" aria-labelledby="label_40" cellPadding="4" cellSpacing="0" class="form-matrix-table" data-component="matrix" data-dynamic="true">
            <tr class="form-matrix-tr form-matrix-header-tr">
              <th class="form-matrix-th" style="border:none"> </th>
              <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_0"><label id="label_40_col_0">Not Satisfied</label></th>
              <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_1"><label id="label_40_col_1">Somewhat Satisfied</label></th>
              <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_2"><label id="label_40_col_2">Satisfied</label></th>
              <th scope="col" class="form-matrix-headers form-matrix-column-headers form-matrix-column_3"><label id="label_40_col_3">Any thoughts?</label></th>
            </tr>
            <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_40 label_40_row_0">
              <th scope="row" class="form-matrix-headers form-matrix-row-headers"><label id="label_40_row_0">Service Quality</label></th>
              <td class="form-matrix-values"><input type="radio" id="input_40_0_0" class="form-radio" name="q40_typeA40[0][0]" value="Not Satisfied" aria-labelledby="label_40_col_0 label_40_row_0" aria-label="Cells Radio Button" /><label for="input_40_0_0" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_0_1" class="form-radio" name="q40_typeA40[0][1]" value="Somewhat Satisfied" aria-labelledby="label_40_col_1 label_40_row_0" aria-label="Cells Radio Button" /><label for="input_40_0_1" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_0_2" class="form-radio" name="q40_typeA40[0][2]" value="Satisfied" aria-labelledby="label_40_col_2 label_40_row_0" aria-label="Cells Radio Button" /><label for="input_40_0_2" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_0_3" class="form-radio" name="q40_typeA40[0][3]" value="Any thoughts?" aria-labelledby="label_40_col_3 label_40_row_0" aria-label="Cells Radio Button" /><label for="input_40_0_3" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
            </tr>
            <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_40 label_40_row_1">
              <th scope="row" class="form-matrix-headers form-matrix-row-headers"><label id="label_40_row_1">Cleanliness</label></th>
              <td class="form-matrix-values"><input type="radio" id="input_40_1_0" class="form-radio" name="q40_typeA40[1][0]" value="Not Satisfied" aria-labelledby="label_40_col_0 label_40_row_1" aria-label="Cells Radio Button" /><label for="input_40_1_0" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_1_1" class="form-radio" name="q40_typeA40[1][1]" value="Somewhat Satisfied" aria-labelledby="label_40_col_1 label_40_row_1" aria-label="Cells Radio Button" /><label for="input_40_1_1" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_1_2" class="form-radio" name="q40_typeA40[1][2]" value="Satisfied" aria-labelledby="label_40_col_2 label_40_row_1" aria-label="Cells Radio Button" /><label for="input_40_1_2" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_1_3" class="form-radio" name="q40_typeA40[1][3]" value="Any thoughts?" aria-labelledby="label_40_col_3 label_40_row_1" aria-label="Cells Radio Button" /><label for="input_40_1_3" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
            </tr>
            <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_40 label_40_row_2">
              <th scope="row" class="form-matrix-headers form-matrix-row-headers"><label id="label_40_row_2">Responsiveness</label></th>
              <td class="form-matrix-values"><input type="radio" id="input_40_2_0" class="form-radio" name="q40_typeA40[2][0]" value="Not Satisfied" aria-labelledby="label_40_col_0 label_40_row_2" aria-label="Cells Radio Button" /><label for="input_40_2_0" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_2_1" class="form-radio" name="q40_typeA40[2][1]" value="Somewhat Satisfied" aria-labelledby="label_40_col_1 label_40_row_2" aria-label="Cells Radio Button" /><label for="input_40_2_1" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_2_2" class="form-radio" name="q40_typeA40[2][2]" value="Satisfied" aria-labelledby="label_40_col_2 label_40_row_2" aria-label="Cells Radio Button" /><label for="input_40_2_2" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_2_3" class="form-radio" name="q40_typeA40[2][3]" value="Any thoughts?" aria-labelledby="label_40_col_3 label_40_row_2" aria-label="Cells Radio Button" /><label for="input_40_2_3" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
            </tr>
            <tr class="form-matrix-tr form-matrix-value-tr" aria-labelledby="label_40 label_40_row_3">
              <th scope="row" class="form-matrix-headers form-matrix-row-headers"><label id="label_40_row_3">Friendliness</label></th>
              <td class="form-matrix-values"><input type="radio" id="input_40_3_0" class="form-radio" name="q40_typeA40[3][0]" value="Not Satisfied" aria-labelledby="label_40_col_0 label_40_row_3" aria-label="Cells Radio Button" /><label for="input_40_3_0" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_3_1" class="form-radio" name="q40_typeA40[3][1]" value="Somewhat Satisfied" aria-labelledby="label_40_col_1 label_40_row_3" aria-label="Cells Radio Button" /><label for="input_40_3_1" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_3_2" class="form-radio" name="q40_typeA40[3][2]" value="Satisfied" aria-labelledby="label_40_col_2 label_40_row_3" aria-label="Cells Radio Button" /><label for="input_40_3_2" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              <td class="form-matrix-values"><input type="radio" id="input_40_3_3" class="form-radio" name="q40_typeA40[3][3]" value="Any thoughts?" aria-labelledby="label_40_col_3 label_40_row_3" aria-label="Cells Radio Button" /><label for="input_40_3_3" class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
            </tr>
          </table>
          <div><input type="hidden" name="q40_typeA40[colIds]" value="[&quot;0&quot;,&quot;1&quot;,&quot;2&quot;,&quot;3&quot;]" /><input type="hidden" name="q40_typeA40[rowIds]" value="[&quot;0&quot;,&quot;1&quot;,&quot;2&quot;,&quot;3&quot;]" /></div>
        </div>
      </li>
      <li id="cid_12" class="form-input-wide" data-type="control_pagebreak">
        <div class="form-pagebreak" data-component="pagebreak">
          <div class="form-pagebreak-back-container"><button id="form-pagebreak-back_12" type="button" class="form-pagebreak-back  jf-form-buttons" data-component="pagebreak-back">Back</button></div>
          <div class="form-pagebreak-next-container"><button id="form-pagebreak-next_12" type="button" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">Next</button></div>
          <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_12"></div>
        </div>
      </li>
    </ul>
    <ul class="form-section page-section" style="display:none;">
      <li class="form-line" data-type="control_appointment" id="id_33"><label class="form-label form-label-top" id="label_33" for="input_33" aria-hidden="false"> Appointment </label>
        <div id="cid_33" class="form-input-wide" data-layout="full">
          <div id="input_33" class="appointmentFieldWrapper jfQuestion-fields"><input type="hidden" class="appointmentFieldInput" name="q33_appointment[implementation]" value="new" id="input_33implementation" aria-hidden="true" /><input type="hidden" class="appointmentFieldInput " name="q33_appointment[date]" id="input_33_date" data-timeformat="AM/PM" aria-hidden="true" /><input type="hidden" class="appointmentFieldInput" name="q33_appointment[duration]" value="45" id="input_33_duration" aria-hidden="true" /><input type="hidden" class="appointmentFieldInput" name="q33_appointment[timezone]" value="America/New_York (GMT-04:00)" id="input_33_timezone" aria-hidden="true" />
            <div class="appointmentField"></div>
          </div>
        </div>
      </li>
      <li class="form-line" data-type="control_button" id="id_18">
        <div id="cid_18" class="form-input-wide" data-layout="full">
          <div data-align="auto" class="form-buttons-wrapper form-buttons-auto   jsTest-button-wrapperField"><button id="input_18" type="submit" class="form-submit-button submit-button jf-form-buttons jsTest-submitField" data-component="button" data-content="">Submit</button></div>
        </div>
      </li>
      <li style="display:none">Should be Empty: <input type="text" name="website" value="" type="hidden" /></li>
    </ul>
  </div>
  <script>
    JotForm.showJotFormPowered = "new_footer";
  </script>
  <script>
    JotForm.poweredByText = "Powered by Jotform";
  </script><input type="hidden" class="simple_spc" id="simple_spc" name="simple_spc" value="242097293840562" />
  <script type="text/javascript">
    var all_spc = document.querySelectorAll("form[id='242097293840562'] .si" + "mple" + "_spc");
    for (var i = 0; i < all_spc.length; i++)
    {
      all_spc[i].value = "242097293840562-242097293840562";
    }
  </script>
</form>

@endsection