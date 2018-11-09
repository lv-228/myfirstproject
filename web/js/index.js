    function sendAjaxForm(result_form, ajax_form, url) {
      $.ajax({
          url:     url, //url страницы (action_ajax_form.php)
          type:     "POST", //метод отправки
          dataType: "html", //формат данных
          data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
          success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            document.getElementById(result_form).innerHTML = result;
            $('#wtfdude').click();
        },
        error: function(response) { // Данные не отправлены
          document.getElementById(result_form).innerHTML = "Ошибка. Данные не отправленны.";
        }
    });
    }

    function updateScore(side,form) {
        $.ajax({
        url: 'translation/updatescore'+side,
        type: "POST",
        dataType: "html",
        data: $("#"+form).serialize(),
        success: function(response) {
          result = $.parseJSON(response);
          document.getElementById('score'+side+'_button').innerHTML = result;
      },
      error: function(response) {
        document.getElementById('result_form').innerHTML = "Ошибка. Данные не отправленны.";
      }
      });
      }

      // function updateTeam() {
      //   $.ajax({
      //     url: 'translation/updateteama',
      //     type: "POST",
      //     dataType: "html",
      //     data: $("#team_chose").serialize(),
      //     success: function(response) {
      //       result = $.parseJSON(response);
      //       document.getElementById('modal_a_div').innerHTML = result;
      //     }
      //   });
      // }

        function keyDown (e){
          if(e.keyCode == 17) ctrl = true;
          else if (e.keyCode == 13 && ctrl){
            document.getElementById("my_id").click();
            setTimeout('document.getElementById("text_area_my_id").value = ""', 300);
          }
        }
        function keyUp (e) {
          if(e.keyCode == 17) ctrl = false;
        }

        function validateFormA() {
          if($("#score_teama").val() == '' || $("#score_teama").val()<0){
            alert("Поле счет не может быть пустым или отрицательным!");
          }
          else {
            updateScore("a","scoreform1");
          }
        }

          function validateFormB() {
            if($("#score_teamb").val() == '' || $("#score_teamb").val()<0){
            alert("Поле счет не может быть пустым или отрицательным!");
          }
          else {
            updateScore("b","scoreform2");
          }
          }

          $('#score_teama').keydown(function(){
            if (event.keyCode == 13){
              if($("#score_teama").val() == '' || $("#score_teama").val()<0){
                  alert("Поле счет не может быть пустым или отрицательным!");
                  return false;
                }
                else document.getElementById("scoreform1").submit();
              }  
          });

          $('#score_teamb').keydown(function(){
            if (event.keyCode == 13){
              if($("#score_teamb").val() == '' || $("#score_teamb").val()<0){
                  alert("Поле счет не может быть пустым или отрицательным!");
                  return false;
                }
                else document.getElementById("scoreform2").submit();
              }  
          });

          var press_shift;

          $(document).keydown(function(){
            if(event.keyCode == 16){
              press_shift = true;
            }
          });

          $(document).keyup(function(){
            if(event.keyCode == 16){
              press_shift = false;
            }
          });

          $(document).keydown(function(){
            if(event.keyCode == 13 && !press_shift){
              document.getElementById("my_id").click();
            setTimeout('document.getElementById("text_area_my_id").value = ""', 300);
            }
          });

          function clear_textarea() {
            setTimeout('document.getElementById("text_area_my_id").value = ""', 300);
          }

          $(document).ready(function () {
            var textscroll = document.getElementById("text_scroll");
            textscroll.scrollTop = textscroll.scrollHeight;
          });

          // $(document).ready(function () {
          //   document.getElementById('teama_post').setAttribute('action','');
          // });