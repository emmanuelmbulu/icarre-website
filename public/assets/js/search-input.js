var module_2712622=(function(){var c={"zh-hk":{name:{message:"網站搜尋輸入",description:null,placeholders:null}},es:{name:{message:"Entrada de búsqueda en el sitio",description:null,placeholders:null}},de:{name:{message:"Website-Sucheingabe",description:null,placeholders:null}},"fr-ca":{name:{message:"Entrée pour la recherche sur le site",description:"",placeholders:null}},el:{name:{message:"Είσοδος αναζήτησης ιστότοπου",description:null,placeholders:null}},ro:{name:{message:"Introducere căutare site",description:"",placeholders:null}},bn:{name:{message:"সাইট অনুসন্ধানের ইনপুট",description:"",placeholders:null}},vi:{name:{message:"Thông tin đầu vào để tìm kiếm trong site",description:"",placeholders:null}},pt:{name:{message:"Entrada de pesquisa do site",description:null,placeholders:null}},fr:{name:{message:"Champ de recherche de site",description:null,placeholders:null}},"zh-cn":{name:{message:"网站搜索输入",description:null,placeholders:null}},bg:{name:{message:"Въвеждане на търсене в сайт",description:"",placeholders:null}},"en-gb":{name:{message:"Site search input",description:"",placeholders:null}},it:{name:{message:"Input di ricerca del sito",description:null,placeholders:null}},en:{name:{message:"Site Search Input",description:null,placeholders:null}},ja:{name:{message:"サイト検索入力",description:null,placeholders:null}},sv:{name:{message:"Inmatning av sökning på webbplatsen",description:null,placeholders:null}},"he-il":{name:{message:"קלט חיפוש באתר",description:"",placeholders:null}},tr:{name:{message:"Site arama girişi",description:"",placeholders:null}},fi:{name:{message:"Sivun haun tulos",description:null,placeholders:null}},hu:{name:{message:"Bevitel a honlapon történő kereséshez",description:"",placeholders:null}},sl:{name:{message:"Vnos iskanja po spletnem mestu",description:"",placeholders:null}},"pt-pt":{name:{message:"Entrada de pesquisa do site",description:"",placeholders:null}},da:{name:{message:"Indtastning af webstedssøgning",description:null,placeholders:null}},ko:{name:{message:"사이트 검색 입력",description:null,placeholders:null}},nl:{name:{message:"Invoer doorzoeken site",description:null,placeholders:null}},ru:{name:{message:"Входная информация поиска по сайту",description:"",placeholders:null}},pl:{name:{message:"Wyszukiwanie na stronie",description:null,placeholders:null}},sk:{name:{message:"Zadaný text vyhľadávania webu",description:"",placeholders:null}},th:{name:{message:"การป้อนคำค้นหาในเว็บไซต์",description:"",placeholders:null}},cs:{name:{message:"Výraz hledaný na stránce",description:null,placeholders:null}},"ca-es":{name:{message:"Entrada de cerca al lloc",description:"",placeholders:null}},"ar-eg":{name:{message:"إدخال البحث في الموقع",description:"",placeholders:null}},"es-mx":{name:{message:"Entrada de búsqueda del sitio",description:null,placeholders:null}},uk:{name:{message:"Вхідна інформація пошуку по сайту",description:"",placeholders:null}},id:{name:{message:"Input Pencarian Situs",description:"",placeholders:null}},af:{name:{message:"Webwerfsoektogtoevoer",description:"",placeholders:null}},lt:{name:{message:"Svetainės paieškos įvestis",description:"",placeholders:null}},no:{name:{message:"Inndata sidesøk",description:null,placeholders:null}},hr:{name:{message:"Unos za pretraživanje web-mjesta",description:"",placeholders:null}}};i18n_getmessage=function(){return hs_i18n_getMessage(c,hsVars.language,arguments)};i18n_getlanguage=function(){return hsVars.language};var a=function(q){var i=3;var n={TAB:"Tab",ESC:"Esc",ESCAPE:"Escape",UP:"Up",ARROW_UP:"ArrowUp",DOWN:"Down",ARROW_DOWN:"ArrowDown"};var f="",e=q,r=q.querySelector(".hs-search-field__input"),d=q.querySelector(".hs-search-field__suggestions"),k=function(){var t=[];var u=q.querySelector("form");for(var s=0;s<u.querySelectorAll("input[type=hidden]").length;s++){var v=u.querySelectorAll("input[type=hidden]")[s];if(v.name!=="limit"){t.push(encodeURIComponent(v.name)+"="+encodeURIComponent(v.value))}}var w=t.join("&");return w};var m=function(t,v,s){var u;return function(){var z=this,y=arguments;var x=function(){u=null;if(!s){t.apply(z,y)}};var w=s&&!u;clearTimeout(u);u=setTimeout(x,v||200);if(w){t.apply(z,y)}}},o=function(){d.innerHTML="";r.focus();e.classList.remove("hs-search-field--open")},l=function(t){var s=[];s.push("<li id='results-for'>Results for \""+t.searchTerm+'"</li>');t.results.forEach(function(v,u){s.push("<li id='result"+u+"'><a href='"+v.url+"'>"+v.title+"</a></li>")});o();d.innerHTML=s.join("");e.classList.add("hs-search-field--open")},j=function(){var t=new XMLHttpRequest();var s="/_hcms/search?&term="+encodeURIComponent(f)+"&limit="+encodeURIComponent(i)+"&autocomplete=true&analytics=true&"+k();t.open("GET",s,true);t.onload=function(){if(t.status>=200&&t.status<400){var u=JSON.parse(t.responseText);if(u.total>0){l(u);g()}else{o()}}else{console.error("Server reached, error retrieving results.")}};t.onerror=function(){console.error("Could not reach the server.")};t.send()},g=function(){var z=[];z.push(r);var x=d.getElementsByTagName("A");for(var t=0;t<x.length;t++){z.push(x[t])}var w=z[0],s=z[z.length-1];var v=function(A){if(A.target==s&&!A.shiftKey){A.preventDefault();w.focus()}else{if(A.target==w&&A.shiftKey){A.preventDefault();s.focus()}}},u=function(A){A.preventDefault();if(A.target==s){w.focus()}else{z.forEach(function(B){if(B==A.target){z[z.indexOf(B)+1].focus()}})}},y=function(A){A.preventDefault();if(A.target==w){s.focus()}else{z.forEach(function(B){if(B==A.target){z[z.indexOf(B)-1].focus()}})}};e.addEventListener("keydown",function(A){switch(A.key){case n.TAB:v(A);break;case n.ESC:case n.ESCAPE:o();break;case n.UP:case n.ARROW_UP:y(A);break;case n.DOWN:case n.ARROW_DOWN:u(A);break}})},h=m(function(){f=r.value;if(f.length>2){j()}else{if(f.length==0){o()}}},250),p=(function(){r.addEventListener("input",function(s){if(f!=r.value){h()}})})()};if(document.attachEvent?document.readyState==="complete":document.readyState!=="loading"){var b=document.querySelectorAll(".hs-search-field");Array.prototype.forEach.call(b,function(e){var d=a(e)})}else{document.addEventListener("DOMContentLoaded",function(){var d=document.querySelectorAll(".hs-search-field");Array.prototype.forEach.call(d,function(f){var e=a(f)})})}})();