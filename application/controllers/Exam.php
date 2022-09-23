<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Exam extends CI_Controller
{
    protected $loginUser, $tipeSoal;
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Menu_model', 'menu');
        $this->load->model('Tryout_model', 'tryout');
        $this->load->model('User_tryout_model', 'user_tryout');
        $this->load->model('Soal_model', 'soal');
        $this->load->model('Ragu_ragu_model', 'ragu_ragu');
        $this->load->model('Jawaban_model', 'jawaban');

        $this->loginUser = $this->user->getLoginUser();
        $this->tipeSoal = $this->soal->getAllTipeSoal();
    }

    public function question($token = null)
    {
        submenu_access(13);

        $this->load->model('Company_settings_model', 'company_settings');

        $slug = $this->input->get('tryout');
        $soal_pertama = $this->soal->get('one', ['id' => 1], $slug);
        if ($token == null)
            redirect("exam/question/" . $soal_pertama['token'] . "?tryout=" . $slug);

        $tryout = $this->tryout->get('one', ['slug' => $slug]);

        $email = $this->session->userdata('email');
        $company_settings = $this->company_settings->get('one', ['id' => 1]);

        $data = [
            'title' => 'Pengerjaan Tryout ' . $tryout['name'] . ' - ' . $company_settings['name'],
            'soal' => $this->soal->get('one', ['token' => $token], $slug),
            'user' => $this->loginUser,
            'soal_lengkap' => $this->soal->getAll($slug, array('token')),
            'jawaban' => $this->jawaban->get('one', ['email' => $email], $slug),
            'ragu_ragu' => $this->ragu_ragu->get('one', ['email' => $email], $slug),
            'user_tryout' => $this->user_tryout->get('one', ['email' => $email], $slug),
            'tryout' => $tryout
        ];

        if ($tryout['tipe_tryout'] == 'SKD')
            $data['tipe_soal'] = $this->tipeSoal;

        if (isset($data['jawaban']['waktu_selesai'])) {
            $this->session->set_flashdata('error', 'Anda sudah menyelesaikan Try Out ini');
            redirect('tryout/mytryout');
        } else if (!isset($data['user_tryout']))
            redirect('auth/blocked');

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('exam/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function setinput($slug)
    {
        $this->load->model('Paradata_model', 'paradata');

        $email = $this->session->userdata('email');
        $nomor = $this->input->post('nomor');
        $pilihan = $this->input->post('pilihan');
        $user_id = $this->input->post('user_id');

        $keterangan = $this->input->post('ket');

        $data = [
            'ragu_ragu' => [
                'user_id' => $user_id,
                'email' => $email,
                'nomor' => $nomor,
                'riwayat' => $keterangan,
                'created_at' => time()
            ],
            'jawaban' => [
                'user_id' => $user_id,
                'email' => $email,
                'nomor' => $nomor,
                'riwayat' => $pilihan,
                'created_at' => time()
            ]
        ];

        if ($keterangan == 'R' || $keterangan == 'Y') {
            $this->db->insert('user_paradata_' . $slug, $data['ragu_ragu']);
            $this->paradata->insert($data['ragu_ragu'], $slug);

            $this->ragu_ragu->update(
                [
                    '`' . $nomor . '`' => $keterangan
                ],
                [
                    'email' => $email
                ],
                $slug
            );
        } else if ($keterangan == 'K') {
            $this->paradata->insert($data['ragu_ragu'], $slug);

            $this->jawaban->update(
                [
                    '`' . $nomor . '`' => $pilihan
                ],
                [
                    'email' => $email
                ],
                $slug
            );
        } else {
            $this->paradata->insert($data['jawaban'], $slug);

            $this->jawaban->update(
                [
                    '`' . $nomor . '`' => $pilihan
                ],
                [
                    'email' => $email
                ],
                $slug
            );
        }
    }

    public function setkerjakan($slug)
    {
        $email = $this->session->userdata('email');

        $data = [
            'email' => $this->session->userdata('email'),
            'waktu_mulai' => time()
        ];

        $this->jawaban->insert($data, $slug);

        $this->ragu_ragu->insert(['email' => $email], $slug);

        $this->user_tryout->update(['status' => 1], ['email' => $email], $slug);
    }

    public function setselesai($slug)
    {
        $this->load->model('Kunci_tkp_model', 'kunci_tkp');

        $email = $this->session->userdata('email');
        $tryout = $this->tryout->get('one', ['slug' => $slug]);
        $kunci = $this->jawaban->get('one', ['email' => 'kunci_jawaban_' . $slug . '@gmail.com'], $slug);
        $jawaban = $this->jawaban->get('one', ['email' => $email], $slug);
        $jumlah_soal = $tryout['jumlah_soal'];

        if ($tryout['tipe_tryout'] == 'SKD') {
            //===========PERHITUNGAN NILAI===========
            $nilai_twk = 0;
            $nilai_tiu = 0;
            $nilai_tkp = 0;

            //UNTUK PENILAIAN TKP
            $A = $this->kunci_tkp->get('one', ['pilihan' => 'A'], $slug);
            $B = $this->kunci_tkp->get('one', ['pilihan' => 'B'], $slug);
            $C = $this->kunci_tkp->get('one', ['pilihan' => 'C'], $slug);
            $D = $this->kunci_tkp->get('one', ['pilihan' => 'D'], $slug);
            $E = $this->kunci_tkp->get('one', ['pilihan' => 'E'], $slug);

            //PERHITUNGAN NILAI TWK
            for ($i = 1; $i <= 30; $i++) {
                if ($jawaban[$i] == $kunci[$i]) {
                    $nilai_twk += 5;
                }
            }

            //PERHITUNGAN NILAI TIU
            for ($i = 31; $i <= 65; $i++) {
                if ($jawaban[$i] == $kunci[$i]) {
                    $nilai_tiu += 5;
                }
            }

            // PERHITUNGAN NILAI TKP
            for ($i = 66; $i <= 110; $i++) {
                if ($jawaban[$i] == 'A')
                    $nilai_tkp += $A[$i];
                else if ($jawaban[$i] == 'B')
                    $nilai_tkp += $B[$i];
                else if ($jawaban[$i] == 'C')
                    $nilai_tkp += $C[$i];
                else if ($jawaban[$i] == 'D')
                    $nilai_tkp += $D[$i];
                else if ($jawaban[$i] == 'E')
                    $nilai_tkp += $E[$i];
            }

            // for ($i = 66; $i <= 110; $i++) {
            //     // echo '`' . $i . '`' . ' INT NOT NULL, ';
            //     echo "'" . $i . "' " . "=> rand(1,5),";
            //     echo '<br>';
            // }
            // die;

            $update = [
                'twk' => $nilai_twk,
                'tiu' => $nilai_tiu,
                'tkp' => $nilai_tkp,
                'total' => $nilai_twk + $nilai_tiu + $nilai_tkp
            ];

            $this->user_tryout->update($update, ['email' => $email], $slug);

            // END PERHITUNGAN NILAI


            $time = time();

            $this->jawaban->update(
                [
                    '`waktu_selesai`' => $time
                ],
                [
                    'email' => $email
                ],
                $slug
            );

            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah menyelesaikan ujian!</div>');
        } else if ($tryout['tipe_tryout'] == 'nonSKD') { //PERHITUNGAN NILAI TWK
            $this->load->model('Bobot_nilai_model', 'bobot_nilai');
            $this->load->model('Bobot_nilai_tiap_soal_model', 'bobot_nilai_tiap_soal');

            $bobot_nilai = $this->bobot_nilai->get('many', ['tryout' => $slug]);
            $nilai = 0;

            if ($bobot_nilai[0]['status'] == 1 && $bobot_nilai[1]['status'] == 1) {
                $bobot_benar = $bobot_nilai[0]['bobot'];
                $bobot_salah = $bobot_nilai[1]['bobot'];

                for ($i = 1; $i <= $jumlah_soal; $i++) {
                    if ($jawaban[$i] == $kunci[$i])
                        $nilai += $bobot_benar;
                    else if ($jawaban[$i] != null && $jawaban[$i] != $kunci[$i])
                        $nilai += $bobot_salah;
                }
            } else if ($bobot_nilai[0]['status'] == 0 && $bobot_nilai[1]['status'] == 0) {
                $A = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'A'], $slug);
                $B = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'B'], $slug);
                $C = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'C'], $slug);
                $D = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'D'], $slug);
                $E = $this->bobot_nilai_tiap_soal->get('one', ['pilihan' => 'E'], $slug);

                for ($i = 1; $i <= $jumlah_soal; $i++) {
                    if ($jawaban[$i] == 'A')
                        $nilai += $A[$i];
                    else if ($jawaban[$i] == 'B')
                        $nilai += $B[$i];
                    else if ($jawaban[$i] == 'C')
                        $nilai += $C[$i];
                    else if ($jawaban[$i] == 'D')
                        $nilai += $D[$i];
                    else if ($jawaban[$i] == 'E')
                        $nilai += $E[$i];
                }
            }

            $update = [
                'nilai' => $nilai
            ];

            $this->user_tryout->update($update, ['email' => $email], $slug);

            // END PERHITUNGAN NILAI


            $time = time();

            $this->jawaban->update(
                [
                    '`waktu_selesai`' => $time
                ],
                [
                    'email' => $email
                ],
                $slug
            );
        }
        $this->ragu_ragu->delete(['email' => $email], $slug);
        $this->user_tryout->update(['status' => 2], ['email' => $email], $slug);
        $this->session->set_flashdata('success', 'Menyelesaikan Try Out');
    }
}