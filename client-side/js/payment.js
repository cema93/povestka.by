(function() {
  var toMain = false;

  function loadConfig() {
       AJAXRequest('/doika/client-' + window.parent.doika.campaignId, setConfigHTML)
  }

  function loadDataConfig() {
     AJAXRequest('/doika/client-' + window.parent.doika.campaignId, setConfigData)
  }

  function setConfigData(data) {
      dataConfig = data;
  }

  function setConfigHTML(data) {
    document.getElementsByClassName("module-donate__title")[0].innerText = data.innerText.campaignTitle;
    document.getElementsByClassName("module-donate__description")[0].innerHTML = data.innerText.campaignDescription;
    document.getElementsByClassName("payment__description")[0].innerText = data.innerText.paymentDescriptionTitle;
    document.getElementsByClassName("result__description")[0].insertAdjacentHTML( 'beforeend', data.innerText.resultsText);

    document.getElementById('module-donate').style.backgroundColor = data.backgroundColor;

    document.getElementsByClassName("module-donate__title")[0].style.color = data.titleTextColor;
    document.getElementsByClassName("module-donate__title")[0].style.fontSize = data.titleFontSize;

    document.getElementsByClassName("module-donate__description")[0].style.color = data.descriptionTextColor;
    document.getElementsByClassName("module-donate__description")[0].style.fontSize = data.descriptionFontSize;


    updateIframeHeight();

    window.parent.doika.title = data.innerText.campaignTitle;
    window.parent.doika.result = data.innerText.resultsText;
    window.parent.postMessage(['dockHeader', true], '*')
  }

  function getBePaidJS(data) {

    var options = {
      type: 'inline',
      id: 'donate-bePaid__form',
      url: data.checkout.redirect_url,
      style: window.paymentStyle,
      size: { width: "100%", height: "100%" }
    };

    var pf = new BeGateway(options);
    pf.buildForm();
  }

  function AJAXRequest(url, callback) {
        var request = new XMLHttpRequest();
        request.open('GET', url, true);

        request.onreadystatechange = function() {
          if (request.readyState === 4) {
            if (request.status >= 200 && request.status < 300) {
              var data = JSON.parse(request.responseText);
              return callback(data);
            }
          }
        };
        request.send();
  }

  function back() {
    if(toMain) {
      var parse = document.createElement('a');
      parse.href = document.referrer;
      var url = parse.protocol + '//' + parse.hostname + parse.pathname+ '#module-donate-wrapper';
      
	  window.top.location.href = url;

    } else
     window.parent.postMessage(['doikaMain', true], '*')
  }

  function init() {

    switch (window.parent.doika.status) {
      case 'success':
        var bePaidForm = document.querySelector(".donate-bePaid__form");
        var wrapper = document.querySelector(".module-donate__message");
        bePaidForm.style.display = "none";
        wrapper.style.display = "flex";
        var title = document.querySelector(".module-donate__message_title");
        title.innerHTML = "<span style='color:#21ae00'>Спасибо, передача дара успешно завершена</span>";
        title.style.background = "none";
        title.style.backgroundSize = "contain";
        var button = document.querySelector(".module-donate__message_button");
        var backbutton = document.querySelector(".module-donate__back-button");
        backbutton = backbutton.style.display = "none";
        toMain = true;
        document.querySelector(".module-donate__message_button").addEventListener("click", back);
        button.innerHTML = "Подарить ещё!";
        afterPayScroll();
      break;
      case 'decline':
      case 'fail':
        var bePaidForm = document.querySelector(".donate-bePaid__form");
        var wrapper = document.querySelector(".module-donate__message");
        bePaidForm.style.display = "none";
        wrapper.style.display = "flex";
        var title = document.querySelector(".module-donate__message_title");
        title.innerHTML = "Очень жаль, но транзакция была отклонена. <br><span style='color:#000;float:left;text-align:left;';>Попробуйте сделать \"произвольный платеж\" через интернет банкинг.<br>Данные для перевода:<br>ИП Гавриленко Семён Алексеевич, УНП: 193052606 <br>р/с: BY29ABLT30130239893350010001 в ЗАО «АБСОЛЮТБАНК» БИК: ABLTBY22<br>Назначение: перевод средств согласно договора дарения.</span>";
        title.style.background = "none";
        title.style.backgroundSize = "contain";
        var button = document.querySelector(".module-donate__message_button");
        button.innerHTML = "Попробовать еще раз";
        var backbutton = document.querySelector(".module-donate__back-button");
        toMain = true;
        document.querySelector(".module-donate__message_button").addEventListener("click", back);
        backbutton = backbutton.style.display = "none";
        afterPayScroll();
      break;
      default:
        var backUrl = '&url=' + encodeURIComponent(document.referrer); 
        var url = '/doika/donate-' + window.parent.doika.campaignId + '?donate=' + window.parent.doikaSum + backUrl;
        AJAXRequest(url, getBePaidJS);
   }

    document.querySelector(".payment__description").addEventListener("click", PopUpShow);
    document.querySelector(".module-donate__back-button").addEventListener("click", back);

    loadDataConfig();
    loadConfig();
    document.querySelector("#donate-bePaid__form").addEventListener("load", updateIframeHeight);

  }

  window.addEventListener("load", init);

  function PopUpShow() {
    window.parent.postMessage(['openPopUp', true], '*')
  }

  function updateIframeHeight() {
    window.parent.postMessage(['updateIframeHeight', true], '*')
  }

  function afterPayScroll() {
    // возвращает cookie если есть или undefined
    function getCookie( name ) {
      var matches = document.cookie.match( new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent( matches[1] ) : null;
    }

    if( getCookie( 'pageYOffset' ) ) {
      window.parent.scrollTo( 0, getCookie ( 'pageYOffset' ) );
    }
  }
}());
