$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");

  if ($("#repoptinymce").length) {
    const key = { 0: "text_soal", 1: "pembahasan", 2: "text_a", 3: "text_b", 4: "text_c", 5: "text_d", 6: "text_e" };
    const count = Object.keys(key).length;

    var textSoal;
    var pembahasanSoal;
    var textA;
    var textB;
    var textC;
    var textD;
    var textE;

    for (let i = 0; i < count; i++) {
      $.ajax({
        url: base_url + "admin/gettinymcevalue",
        type: "post",
        data: {
          name: key[i],
        },
        dataType: "json",
        success: (data) => {
          if (data.name == "text_soal") textSoal = data.value;
          else if (data.name == "pembahasan") pembahasanSoal = data.value;
          else if (data.name == "text_a") textA = data.value;
          else if (data.name == "text_b") textB = data.value;
          else if (data.name == "text_c") textC = data.value;
          else if (data.name == "text_d") textD = data.value;
          else if (data.name == "text_e") textE = data.value;
        },
        error: function (request, status, error) {
          Swal.fire({
            icon: "error",
            html: request.responseText ? request.responseText : "Oops, something went wrong. Please try again later.",
          });
        },
      });
    }

    tinymce.init({
      selector: "textarea.default-height",
      plugins: "autolink lists table lists",
      toolbar: "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
      toolbar_mode: "floating",
      tinycomments_mode: "embedded",
      tinycomments_author: "Author name",
      setup: (editor) => {
        editor.on("init", (e) => {
          tinymce.get(key[0]).setContent(textSoal);
          tinymce.get(key[1]).setContent(pembahasanSoal);
        });
      },
    });

    tinymce.init({
      selector: "textarea.custom-height",
      plugins: "autolink lists table lists",
      toolbar: "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
      toolbar_mode: "floating",
      tinycomments_mode: "embedded",
      tinycomments_author: "Author name",
      height: "240",
      setup: (editor) => {
        editor.on("init", (e) => {
          tinymce.get(key[2]).setContent(textA);
          tinymce.get(key[3]).setContent(textB);
          tinymce.get(key[4]).setContent(textC);
          tinymce.get(key[5]).setContent(textD);
          tinymce.get(key[6]).setContent(textE);
        });
      },
    });
  }

  if ($("#repoptinymcetryout").length) {
    $.ajax({
      url: base_url + "admin/gettinymcevalue",
      type: "post",
      data: {
        name: "ket_tryout",
      },
      dataType: "json",
      success: (data) => {
        tinymce.init({
          selector: "textarea",
          plugins: "autolink lists table lists",
          toolbar: "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
          toolbar_mode: "floating",
          tinycomments_mode: "embedded",
          tinycomments_author: "Author name",
          setup: (editor) => {
            editor.on("init", (e) => {
              tinymce.get("ket_tryout").setContent(data.value);
            });
          },
        });
      },
      error: function (request, status, error) {
        Swal.fire({
          icon: "error",
          html: request.responseText ? request.responseText : "Oops, something went wrong. Please try again later.",
        });
      },
    });
  }

  setTimeout(function () {
    $(".loading").remove();
  }, 2000);
});
