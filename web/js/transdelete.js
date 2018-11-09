var btn_scorea = document.getElementById('scorea_button');
    var btn_scoreb = document.getElementById('scoreb_button');
    var select_teama = document.getElementById('select_a');
    var select_teamb = document.getElementById('select_b');
    select_teama.style.display="none";
    select_teamb.style.display="none";
    btn_scorea.setAttribute("disabled","disabled");
    btn_scorea.setAttribute("onclick","");
    btn_scoreb.setAttribute("disabled","disabled");
    btn_scoreb.setAttribute("onclick","");
    var gliph_del = document.getElementsByClassName('badge del');
    var gliph_redact = document.getElementsByClassName('badge redac');

    for(var i=0;i<gliph_redact.length;i++){
      gliph_del[i].setAttribute("style","display:none");
      gliph_redact[i].setAttribute("style","display:none");
    }