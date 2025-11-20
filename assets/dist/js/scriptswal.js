$(document).ready(function () {
  var base_url = $('.base_url').data('baseurl');
  const flashdataSuccess = $('#success').data('flashdata');
  const flashdataError = $('#error').data('flashdata');
  
  if (flashdataSuccess) {
    Swal.fire({
      icon: 'success',
      title: 'Anda Berhasil',
      html: '<b>'+flashdataSuccess+'!</b>'
    });
  }

  if (flashdataError) {
    Swal.fire({
      icon: 'error',
      title: 'Something Wrong',
      html: '<b>'+flashdataError+'!</b>'
    });
  }

  $('.btn-delete').on('click', function (e) {
    e.preventDefault(); //Mematikan href
    const url = $(this).data('url');
    const message = $(this).data('message');
    const key = $(this).data('key');
    const caption = $(this).data('caption');
    const dataPost = $(this).data('post');
    Swal.fire({
      title: 'Apakah Anda Yakin',
      html: '<b>untuk menghapus <span style="color: red;">' + message + '</span> ?<br/>' + caption + '</b>',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        // document.location.href = base_url + url + key;
        $.ajax({
          url: base_url + url + key,
          type: 'post',
          data: {
              dataPost: dataPost
          },
          success: function() {
            if(url != 'admin/hapustryout/' && url != 'admin/paket-to/delete/')
              window.location.reload();
            else if(url == 'admin/hapustryout/')
              window.location.href = base_url + 'admin/tryout';
            else if(url == 'admin/paket-to/delete/')
              window.location.href = base_url + 'admin/paket-to';
          }
        });
      }
    });
  });


  $('#btn-cancel-transaction').on('click', function (e) {
    e.preventDefault(); //Mematikan href
    const order_id = $(this).data('id');
    const message = $(this).data('message');
    const key = $(this).data('key');
    const caption = $(this).data('caption');
    const dataPost = $(this).data('post');
    Swal.fire({
      title: 'Apakah Anda Yakin',
      html: '<b>untuk membatalkan transaksi berikut dengan order id <span style="color: red;">' + order_id + '</span> ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Batalkan!'
    }).then((result) => {
      if (result.isConfirmed) {
        // document.location.href = base_url + url + key;
        $.ajax({
          url: base_url + 'tryout/canceltransaction',
          type: 'post',
          data: {
              order_id: order_id
          },
          success: function() {
            window.location.reload();
          },
          error: function(request, status, error) {
            Swal.fire({
              icon: 'error',
              html: (request.responseText ? request.responseText : 'Oops, something went wrong. Please try again later.')
            });
          }
        });
      }
    });
  });
});