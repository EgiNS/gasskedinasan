$(document).ready(function () {
  var base_url = $(".base_url").data("baseurl");
  // console.log(base_url)

if ($("#repoptinymce").length) {
  const key = ["text_soal", "pembahasan", "text_a", "text_b", "text_c", "text_d", "text_e"];
  const values = {};

  // Ambil semua data repop dengan Promise agar tunggu semua selesai
  const requests = key.map(name => {
    return $.ajax({
      url: base_url + "admin/gettinymcevalue",
      type: "post",
      data: { name },
      dataType: "json"
    }).then(data => {
      values[data.name] = data.value;
    });
  });

  // Tunggu semua request selesai dulu
  Promise.all(requests).then(() => {
    // Inisialisasi TinyMCE setelah semua data siap
    tinymce.init({
      selector: "textarea.default-height",
      plugins: "autolink lists table lists",
      toolbar:
        "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
      toolbar_mode: "floating",
      tinycomments_mode: "embedded",
      tinycomments_author: "Author name",
      setup: (editor) => {
        editor.on("init", () => {
          const id = editor.id;
          if (values[id]) editor.setContent(values[id]);
        });
      },
    });

    tinymce.init({
      selector: "textarea.custom-height",
      plugins: "autolink lists table lists",
      toolbar:
        "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
      toolbar_mode: "floating",
      tinycomments_mode: "embedded",
      tinycomments_author: "Author name",
      height: 240,
      setup: (editor) => {
        editor.on("init", () => {
          const id = editor.id;
          if (values[id]) editor.setContent(values[id]);
        });
      },
    });
  }).catch(err => {
    Swal.fire({
      icon: "error",
      html: err.responseText ? err.responseText : "Oops, gagal memuat data TinyMCE.",
    });
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
