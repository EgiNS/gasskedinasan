$(function () {
    // Base URL dan data
    var base_url = $(".base_url").data("baseurl");
    var tryout = $("#tryout").data("tryout");
    var user_id = $("#user_id").data("userid");

    // Hanya berlaku pada halaman pengerjaan soal tryout
    if ($(".timer").length) {
        startSecureTimer();
    }

    // Fungsi utama timer dengan integrity checking
    function startSecureTimer() {
        // Data integrity dari server
        var serverEndTime = new Date($("#time").data("waktu")).getTime();
        var examStartTime = new Date($("#exam-start").data("start")).getTime();
        var examDuration = $("#exam-duration").data("duration") * 1000; // Convert to milliseconds

        // console.log('Server End Time:', new Date(serverEndTime));
        // console.log('Exam Start Time:', new Date(examStartTime));
        // console.log('Exam Duration:', examDuration / 60000 + ' minutes');

        // Validasi data integrity
        var calculatedEndTime = examStartTime + examDuration;
        var timeDifference = Math.abs(calculatedEndTime - serverEndTime);
        
        // console.log('Calculated End Time:', new Date(calculatedEndTime));
        // console.log('Time Difference:', timeDifference / 1000 + ' seconds');

        // Tolerance 30 detik untuk perbedaan waktu server-client
        if (timeDifference > 30000) {
            handleTimeManipulation("Data integrity failed - Time difference: " + (timeDifference / 1000) + " seconds");
            return;
        }

        // Gunakan calculated end time untuk konsistensi
        var countDownDate = calculatedEndTime;
        
        // Variables untuk integrity checking
        var lastTimeCheck = Date.now();
        var totalTimeDrift = 0;
        var maxAllowedDrift = 60000; // 60 detik maksimal drift
        var consecutiveBackwards = 0;
        var maxConsecutiveBackwards = 3;
        
        // Update timer display
        function updateTimerDisplay(hours, minutes, seconds, isWarning) {
            var timerElement = document.getElementsByClassName("timer")[0];
            timerElement.innerHTML = 
                hours.toString().padStart(2, '0') + ":" + 
                minutes.toString().padStart(2, '0') + ":" + 
                seconds.toString().padStart(2, '0');
            
            // Update styling berdasarkan waktu
            if (isWarning) {
                timerElement.className = "btn btn-lg btn-warning timer";
            } else {
                timerElement.className = "btn btn-lg btn-primary timer";
            }
        }

        function updateTimer() {
            var now = Date.now();
            var distance = countDownDate - now;

            // Deteksi waktu mundur (user set time backwards)
            if (now < lastTimeCheck) {
                consecutiveBackwards++;
                // console.warn('Time went backwards! Consecutive:', consecutiveBackwards);
                
                if (consecutiveBackwards >= maxConsecutiveBackwards) {
                    handleTimeManipulation("Time manipulation detected - multiple backwards jumps");
                    return;
                }
                
                // Adjust untuk small backwards jump (bisa karena system clock adjustment)
                lastTimeCheck = now;
                return;
            } else {
                consecutiveBackwards = 0; // Reset jika waktu normal
            }

            // Hitung time drift (jika timer berjalan terlalu lambat/cepat)
            var expectedTime = lastTimeCheck + 1000;
            var actualDrift = now - expectedTime;
            
            // Accumulate hanya excessive drift (lebih dari 100ms per detik)
            if (actualDrift > 100) {
                totalTimeDrift += (actualDrift - 100);
            }
            
            // console.log('Time drift - Current:', actualDrift + 'ms, Total:', totalTimeDrift + 'ms');

            // Jika total drift melebihi batas, curang terdeteksi
            if (totalTimeDrift > maxAllowedDrift) {
                handleTimeManipulation("Excessive time drift: " + totalTimeDrift + "ms");
                return;
            }

            lastTimeCheck = now;

            // Hitung waktu tersisa
            var hours = Math.floor(distance / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Tampilkan timer
            var isWarning = distance < 300000; // 5 menit lagi (warning)
            var isCritical = distance < 60000; // 1 menit lagi (critical)
            
            if (isCritical) {
                updateTimerDisplay(hours, minutes, seconds, true);
                document.getElementsByClassName("timer")[0].className = "btn btn-lg btn-danger timer";
            } else if (isWarning) {
                updateTimerDisplay(hours, minutes, seconds, true);
            } else {
                updateTimerDisplay(hours, minutes, seconds, false);
            }

            // Auto submit ketika waktu habis
            if (distance < 0) {
                clearInterval(timerInterval);
                handleTimeUp();
            }
        }

        function handleTimeManipulation(reason) {
            console.error('Time manipulation detected:', reason);
            clearInterval(timerInterval);
            
            var timerElement = document.getElementsByClassName("timer")[0];
            timerElement.innerHTML = "KECURANGAN TERDETEKSI";
            timerElement.className = "btn btn-lg btn-danger timer";
            
            // Log the attempt
            console.log('User attempted time manipulation:', {
                user_id: user_id,
                tryout: tryout,
                reason: reason,
                timestamp: new Date().toISOString()
            });
            
            // Submit dengan flag disqualification
            setTimeout(function() {
                $.ajax({
                    url: base_url + "exam/setselesai/" + tryout,
                    type: "post",
                    data: {
                        selesai: "sudah",
                        disqualify: "time_manipulation",
                        cheat_reason: reason,
                        user_id: user_id
                    },
                    success: function (response) {
                        console.log('Disqualified successfully');
                        window.location.replace(base_url + "tryout/mytryout");
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to submit disqualification:', error);
                        // Fallback - redirect anyway
                        window.location.replace(base_url + "tryout/mytryout");
                    }
                });
            }, 2000);
        }

        function handleTimeUp() {
            console.log('Time up - submitting exam');
            var timerElement = document.getElementsByClassName("timer")[0];
            timerElement.innerHTML = "Waktu Habis";
            timerElement.className = "btn btn-lg btn-secondary timer";
            
            $.ajax({
                url: base_url + "exam/setselesai/" + tryout,
                type: "post",
                data: { 
                    selesai: "sudah",
                    user_id: user_id
                },
                success: function (response) {
                    console.log('Exam submitted successfully');
                    window.location.replace(base_url + "tryout/mytryout");
                },
                error: function(xhr, status, error) {
                    console.error('Failed to submit exam:', error);
                    // Fallback - redirect anyway
                    window.location.replace(base_url + "tryout/mytryout");
                }
            });
        }

        // Start the timer
        var timerInterval = setInterval(updateTimer, 1000);
        
        // Initial update
        updateTimer();
        
        console.log('Secure timer started successfully');
    }

  $(".kerjakan").on("click", function (e) {
    e.preventDefault(); //Mematikan href
    const slug = $(this).data("slug");
    console.log("kerja")
    validasi(slug);
    // const user_token = $(this).data("token");
    // const slug = $(this).data("slug");
    // token();
    // function token() {
    //   Swal.fire({
    //     title: "Masukkan Token",
    //     html: `<input type="text" id="token" class="swal2-input" placeholder="Enter Token" autocomplete="off">`,
    //     confirmButtonText: "Enter",
    //     showCancelButton: true,
    //     focusConfirm: false,
    //     preConfirm: () => {
    //       const token = Swal.getPopup().querySelector("#token").value;
    //       // const password = Swal.getPopup().querySelector('#password').value
    //       if (!token) {
    //         Swal.showValidationMessage(`Silakan masukkan token`);
    //       } else if (token == user_token) {
    //         validasi(slug);
    //       } else {
    //         Swal.showValidationMessage(`Token salah`);
    //       }
    //       return { token: token };
    //     },
    //   });
    //   // .then((result) => {
    //   //   if(result.value.token == tryout_token) {
    //   //     validasi();
    //   //   } else {
    //   //     token();
    //   //     Swal.showValidationMessage(`Token salah`);
    //   //   }
    //   // })
    // }

    function validasi(slug) {
      Swal.fire({
        title: "Apakah Anda Yakin",
        html: "<b>untuk mengerjakan Tryout sekarang ?</b>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Kerjakan!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: base_url + "exam/setkerjakan/" + slug,
            type: "post",
            success: function () {
              document.location.href = base_url + "exam/question" + "?tryout=" + slug;
            },
          });
        }
      });
    }
  });

  $(".selesai").on("click", function (e) {
    const tryout = $(this).data("tryout");
    const kosong = $("#petaSoalPC .btn-danger").length;
    // if (document.getElementById("ragu-ragu").innerHTML != "Ragu-Ragu") {
    //   ragu_ragu = $("#petaSoalPC .btn-warning").length;
    // } else {
    //   ragu_ragu = $("#petaSoalPC .btn-warning").length - 1;
    // }
    const ragu_ragu = $('#petaSoalPC .btn-warning').length;

    if (kosong == 0 && ragu_ragu == 0) var pesan = "";
    else if (kosong == 0) var pesan = '<b style="color: red;">Masih ada ' + ragu_ragu + " soal ragu-ragu</b>";
    else if (ragu_ragu == 0) var pesan = '<b style="color: red;">Masih ada ' + kosong + " soal belum dijawab</b>";
    else var pesan = '<b style="color: red;">Masih ada ' + kosong + " soal belum dijawab dan " + ragu_ragu + " ragu-ragu</b>";
    // var pesan = "";

    e.preventDefault();
    Swal.fire({
      title: "Apakah Anda Yakin",
      html: "<b>untuk menyelesaikan Tryout sekarang ?</b><br>" + pesan,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Selesai!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: base_url + "exam/setselesai/" + tryout,
          type: "post",
          data: {
            selesai: "sudah",
          },
          success: function () {
            window.location.replace(base_url + "tryout/mytryout");
          },
        });
      }
    });
  });
});

// TOGGLE PETA SOAL PADA MOBILE VIEW
const hamburgerMenu = document.querySelector(".hamburger");
const menuIsActive = () => {
  hamburgerMenu.classList.toggle("active");
  if ($(".hamburger").hasClass("active")) {
    $(".petasoal").removeClass("petasoal-vis");
    $(".petasoal").removeAttr("style");
  } else {
    $(".petasoal").css("visibility", "hidden");
    $(".petasoal").css("clear", "both");
    $(".petasoal").css("float", "left");
    $(".petasoal").css("display", "none");
  }
};
if (hamburgerMenu) {
  hamburgerMenu.addEventListener("click", menuIsActive);
}
