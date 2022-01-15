/*
* Embed iframe into page and add top banner on page load
*/

(function() {

  var root = document.getElementsByTagName('html')[0];

  var windowTranslated = false; // is window moved down by js
  var transformedElements = []; // efixed elements, transformed by banner
  var donateModuleLoaded  = false;

  window.addEventListener("load", init);

  // Dock donate module banner to top of the page and slide down fixed elements(like top menus)

  function dockBannerToTop() {
      if(!window.doika.bannerDocked && window.doika.banner_visibility) {
      document.body.classList.add("donateHeader__margin");

      window.doika.bannerDocked = true;

      var elems = document.body.getElementsByTagName("*");

      for (var i = 0; i < elems.length; i++) {
          var elementComputedStyle = window.getComputedStyle(elems[i], null);
          var elementPosition = elementComputedStyle.getPropertyValue('position');
          var elementTopPosition = elementComputedStyle.getPropertyValue('top');

          if ((elementPosition == 'fixed') && (parseInt(elementTopPosition) <= 59) && (elementTopPosition)) {
              elems[i].classList.add("donateHeader__transform");
              transformedElements.push(elems[i]);
          }
      }

      var donateHeader = document.createElement('div');

      donateHeader.className = 'donateHeader';

      var title = window.doika.title;     
      var goal = window.doika.result;
      var button = "Помочь!";

      donateHeader.innerHTML = '<p class="donateHeader__title">' + title + '</p>' +
        '<p class="donateHeader__goal">' + goal + ' руб.</p>' +
        '<p class="donateHeader__button">' + button + '</p>';

      root.appendChild(donateHeader);
      document.getElementsByClassName("donateHeader__button")[0].style.backgroundColor = window.doika.color_banner_help_background;
	  document.getElementsByClassName("donateHeader__button")[0].style.color = window.doika.color_banner_help_text;
	  
      donateHeader.style.backgroundColor = window.doika.color_banner_background;
	  donateHeader.style.color = window.doika.color_banner_help_text;
	 
      var moduleDOMElement = document.querySelector("#module-donate-wrapper");
      var banner = document.querySelector(".donateHeader");
      checkDonateModuleVisibility(moduleDOMElement, banner);

    }
  }

  function scrollToDonateWindow(moduleDOMElement) {
    moduleDOMElement.scrollIntoView({
      behavior: 'smooth'
    });
  }

  // check if module div inside viewport
  function checkDonateModuleVisibility(moduleDOMElement, banner) {
	  if(window.doika.banner_visibility) {
		  var rect = moduleDOMElement.getBoundingClientRect();
		  var delta = 0;
		  if(window.doika.bannerDocked) {
			var delta = 60;
		  }

		  if( (rect.bottom - delta) > 0 &&
			  rect.right > 0 &&
			  rect.left < (window.innerWidth || document.documentElement.clientWidth) &&
			  (rect.top + delta) < (window.innerHeight || document.documentElement.clientHeight)
		  ){

			banner.style.display = "none";
			document.body.classList.remove("donateHeader__margin");
			window.doika.bannerDocked = false;

			for (var i in transformedElements) {
			   transformedElements[i].classList.remove("donateHeader__transform");
			}
		  }
		  else {
			banner.style.display = "flex";

			for (var i in transformedElements) {
			   transformedElements[i].classList.add("donateHeader__transform");
			}

			document.body.classList.add("donateHeader__margin");
			window.doika.bannerDocked = true;
		  }
	  }
  }

  function PopUpShow(popup) {
    popup.style.display = "block";
    document.body.style.overflow = "hidden";
  }

  function PopUpHide(popup) {
    popup.style.display = "none";
    document.body.style.overflow = "auto";
  }

  function init() {

    if(sessionStorage.getItem('doikaPosition')) {
      window.scrollTop = sessionStorage.getItem('doikaPosition');
    }

    loadDonateModule();
    addPopUpToDOM();

    var moduleDOMElement = document.querySelector("#module-donate");
    var popup = document.querySelector("#doikaPopup");

    document.querySelector(".b-popup-close").addEventListener("click", function () {
      PopUpHide(popup);
    });
    popup.addEventListener("click", function () {
      PopUpHide(popup);
    });

    document.querySelector(".b-popup-content").addEventListener("click", function(e){
      e.stopPropagation();
    });




   window.addEventListener("beforeunload", function(e) {
     var top  = window.pageYOffset || document.documentElement.scrollTop;
     sessionStorage.setItem('doikaPosition', top);
     return null;
   });

   if (typeof window.addEventListener != 'undefined') {
       window.addEventListener('message', function(e) {
         if((e.data[1] == true) && (e.data[0] == 'openPopUp')) {
            PopUpShow(popup);
         }
       }, false);
   }

  }

  function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
  };

  function loadDonateModule() {

    var wrapper = document.getElementById("module-donate-wrapper");
    window.doika = {};
    window.doika.campaignId = wrapper.getAttribute("data-id");

    switch (getUrlParameter("message")) {
      case '1':
       window.doika.status = "success";
       wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-payment.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
      break;
      case '2':
        window.doika.status = "decline";
        wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-payment.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
      break;
      case '3':
        window.doika.status = "fail";
        wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-payment.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
      break;
      default:
        wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-main.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
   }

    var donateModule = document.getElementById('module-donate');

    if (typeof window.addEventListener != 'undefined') {
        window.addEventListener('message', function(e) {

          switch (e.data[0]) {
            case 'updateIframeHeight':
                var donateModule = document.getElementById('module-donate');
                donateModule.style.height = donateModule.contentWindow.document.body.scrollHeight + 'px';
                wrapper.style.height = donateModule.contentWindow.document.body.scrollHeight + 'px';
              break;
            case 'doikaSubmit':
                wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-payment.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
                window.doikaSum = e.data[1];
              break;
            case 'doikaMain':
                wrapper.innerHTML = '<iframe id="module-donate" src="/client-side/module-donate-main.html" frameborder="0" scrolling=no height="0" width="100%"></iframe>';
                window.doikaSum = 0;
              break;
            case 'dockHeader':
              if(!document.querySelector(".donateHeader") && window.doika.banner_visibility) {
                dockBannerToTop();
                 var moduleDOMElement = document.querySelector("#module-donate-wrapper");
                 var banner = document.querySelector(".donateHeader");
                 document.querySelector(".donateHeader__button").addEventListener("click", function () {
					 window.location.href = 'https://povestka.by/donate/#module-donate-wrapper';
//                   scrollToDonateWindow(moduleDOMElement);
                 });

                 window.addEventListener("scroll", function () {
                   checkDonateModuleVisibility(moduleDOMElement , banner);
                 });

                 window.addEventListener("resize", function () {
                   checkDonateModuleVisibility(moduleDOMElement, banner);
                 });
               }
            break;
          }

        }, false);
    }



    window.addEventListener("resize", function(e) {
      var donateModule = document.getElementById('module-donate');
      donateModule.style.height = donateModule.contentWindow.document.body.scrollHeight + 'px';
      wrapper.style.height = donateModule.contentWindow.document.body.scrollHeight + 'px';
    });

    loadjscssfile('/client-side/assets/css/banner.css','css');
    loadjscssfile('/client-side/assets/css/targetDonatePage.css','css');
    loadjscssfile('https://js.bepaid.by/begateway-1-latest.min.js','js');

    donateModuleLoaded  = true;
  }

  function addPopUpToDOM() {
      var div = document.createElement('div');
      div.className = "b-popup";
      div.id = "doikaPopup";
      div.innerHTML = '<div class="b-popup-content">' +
         '<div class="b-popup-close"></div>' +
         '<h3>На этой странице передача дара производится Банковской Картой в сответствии с <a href="https://povestka.by/help/public-offer-agreement/" target="_blank">договором публичной аферты</a>.</h3>' +
         '<p>По нажатию кнопки "Подарить!" для Вас будет выведена специальная платежная форма процессинговой системы <a href="https://bepaid.by/"><span style="color:#F7941E">be</span><span style="color:#65707B">Paid</span></a>. ' +
          'Для оплаты Вам потребуется ввести данные своей карты и подтвердить платеж кнопкой "Оплатить N руб.", Где N - определенная Вами сумма. ' +
          'Мы принимаем платежи со следующих банковских карт: MasterCard, Maestro, Visa, Visa Electron, БелКарт.</p>' +
         '<p>Платежи с банковских карт осуществляются через систему электронных платежей <a href="https://bepaid.by/"><span style="color:#F7941E">be</span><span style="color:#65707B">Paid</span></a>. Платежная форма системы соответствует всем требованиям безопасности передачи данных (PCI DSS Level 1). Мы не записываем и не храним данные Вашей банковской карты.</p>' +
         '<p>Если на Вашей карте запрещены платежи в интернете, вы можете сделать перевод через интернет банкинг. Для этого зайдите в систему интернет банк и воспользуйтест функцией "произвольный платеж".<br>Данные для перевода: <br>ИП Гавриленко Семён Алексеевич <br>УНП: 193052606 <br>р/с: BY29ABLT30130239893350010001 <br>в ЗАО «АБСОЛЮТБАНК» <br>БИК: ABLTBY22<br> Назначение: перевод средств согласно договору дарения</p>' +
      '</div>';
      document.body.appendChild(div);
  }

  //insert scripts into DOM
  function loadjscssfile(filename, filetype) {
    if (filetype == "js") {

      var fileref = document.createElement('script')
      fileref.setAttribute("type", "text/javascript")
      fileref.setAttribute("src", filename)

    } else if (filetype == "css") {
      var fileref = document.createElement("link")
      fileref.setAttribute("rel", "stylesheet")
      fileref.setAttribute("type", "text/css")
      fileref.setAttribute("href", filename)
    }
    if (typeof fileref != "undefined")
      document.body.appendChild(fileref)
  }

}());
