    <div class="pc-container">
        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

        <?php $tab = $this->input->get('tab');
    if (empty($tab)) $tab = 'company'; ?>

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title ?></h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <?= breadcumb($breadcrumb_item); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body p-3">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <!-- COMPANY -->
                            <a class="nav-item nav-link <?= ($tab == 'company' ? 'active' : ''); ?>" id="nav-company-tab"
                                data-bs-toggle="tab" href="#nav-company" role="tab" aria-controls="nav-company"
                                aria-selected="<?= ($tab == 'company' ? 'true' : 'false'); ?>" data-tab="company">Company</a>

                            <!-- TOKEN -->
                            <a class="nav-item nav-link <?= ($tab == 'token' ? 'active' : ''); ?>" id="nav-token-tab" data-bs-toggle="tab"
                                href="#nav-token" role="tab" aria-controls="nav-token"
                                aria-selected="<?= ($tab == 'token' ? 'true' : 'false'); ?>" data-tab="token">Token</a>

                            <!-- EMAIL -->
                            <a class="nav-item nav-link <?= ($tab == 'email' ? 'active' : ''); ?>" id="nav-email-tab" data-bs-toggle="tab"
                                href="#nav-email" role="tab" aria-controls="nav-email"
                                aria-selected="<?= ($tab == 'email' ? 'true' : 'false'); ?>" data-tab="email">Email</a>

                            <!-- MIDTRANS -->
                            <a class="nav-item nav-link <?= ($tab == 'midtrans' ? 'active' : ''); ?>" id="nav-midtrans-tab"
                                data-bs-toggle="tab" href="#nav-midtrans" role="tab" aria-controls="nav-midtrans"
                                aria-selected="<?= ($tab == 'midtrans' ? 'true' : 'false'); ?>" data-tab="midtrans">Midtrans</a>

                            <!-- KODE -->
                            <a class="nav-item nav-link <?= ($tab == 'kode' ? 'active' : ''); ?>" id="nav-kode-tab" data-bs-toggle="tab"
                                href="#nav-kode" role="tab" aria-controls="nav-kode"
                                aria-selected="<?= ($tab == 'kode' ? 'true' : 'false'); ?>" data-tab="kode">Kode</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <!-- COMPANY -->
                        <div class="tab-pane fade <?= ($tab == 'company' ? 'show active' : ''); ?>" id="nav-company" role="tabpanel"
                            aria-labelledby="nav-company-tab">
                            <div class="row my-3 mx-1">
                                <div class="col-lg-12">
                                    <?= form_open_multipart('admin/settings?tab=company'); ?>

                                    <!-- COMPANY NAME -->
                                    <div class="form-group row mb-2">
                                        <label for="name" class="col-sm-3 col-form-label">Company name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="<?= $company['name']; ?>">
                                            <?= form_error_message('name'); ?>
                                        </div>
                                    </div>

                                    <!-- COMPANY EMAIL -->
                                    <div class="form-group row mb-2">
                                        <label for="no_wa" class="col-sm-3 col-form-label">Company email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="<?= $company['email']; ?>" autocomplete="off">
                                            <?= form_error_message('email'); ?>
                                        </div>
                                    </div>

                                    <!-- COMPANY ADDRESS -->
                                    <div class="form-group row mb-2">
                                        <label for="no_wa" class="col-sm-3 col-form-label">Company address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="<?= $company['address']; ?>" autocomplete="off">
                                            <?= form_error_message('address'); ?>
                                        </div>
                                    </div>

                                    <!-- LOGO -->
                                    <div class="form-group row mb-2">
                                        <div class="col-sm-3">Logo</div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/img/logo/') . $company['logo'] ?>"
                                                        class="img-thumbnail">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <!-- <label class="custom-file-label" for="logo">Choose file</label> -->
                                                        <input type="file" class="custom-file-input form-control" id="logo" name="logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ICON FOR BROWSER -->
                                    <div class="form-group row">
                                        <div class="col-sm-3">Icon for Browser</div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <img src="<?= base_url('assets/img/logo/') . $company['icon_for_browser'] ?>"
                                                        class="img-thumbnail">
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input form-control" id="icon_for_browser"
                                                            name="icon_for_browser">
                                                        <!-- <label class="custom-file-label" for="icon_for_browser">Choose file</label> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TAB -->
                                    <input type="hidden" name="tab" value="company">

                                    <!-- SAVE -->
                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-9">
                                            <button type="submit" class="btn btn-primary" name="company-save" value="save">Save</button>
                                        </div>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- TOKEN -->
                        <div class="tab-pane fade <?= ($tab == 'token' ? 'show active' : ''); ?>" id="nav-token" role="tabpanel"
                            aria-labelledby="nav-token-tab">
                            <div class="row my-3 mx-1">
                                <div class="col-lg-12">
                                    <form action="<?= base_url('admin/settings?tab=token'); ?>" method="post">

                                        <!-- ACCOUNT ACTIVATION -->
                                        <div class="form-group row">
                                            <label for="account_activation" class="col-form-label">Account Activation</label>
                                            <select class="custom-select form-select" name="account_activation" id="account_activation">
                                                <option value="1"
                                                    <?= (set_value('account_activation') == 1) ? 'selected' : ($token['account_activation'] == 1 ? 'selected' : ''); ?>>
                                                    Enable</option>
                                                <option value="0"
                                                    <?= (set_value('account_activation') == 0) ? 'selected' : ($token['account_activation'] == 0 ? 'selected' : ''); ?>>
                                                    Disable</option>
                                            </select>
                                        </div>

                                        <!-- TIME LIMIT FOR ACTIVATION -->
                                        <div class="form-group row">
                                            <label for="time_limit_for_activation" class="col-form-label">Time limit for Account
                                                Activation</label>
                                            <select class="custom-select form-select" name="time_limit_for_activation"
                                                id="time_limit_for_activation">
                                                <?php if (set_value('time_limit_for_activation') == 1) : ?>
                                                <option value="1" selected>Enable</option>
                                                <option value="0">Disable</option>
                                                <?php elseif (set_value('time_limit_for_activation') == 0) : ?>
                                                <option value="1">Enable</option>
                                                <option value="0" selected>Disable</option>
                                                <?php elseif ($token['time_limit_activation'] != 0) : ?>
                                                <option value="1" selected>Enable</option>
                                                <option value="0">Disable</option>
                                                <?php else : ?>
                                                <option value="1">Enable</option>
                                                <option value="0" selected>Disable</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- TIME LIMIT ACTIVATION -->
                                        <div class="form-group row time_limit_activation">
                                            <label for="time_limit_activation" class="col-form-label">Time limit (in hours)</label>
                                            <input type="number" class="form-control " id="time_limit_activation"
                                                name="time_limit_activation" autocomplete="off"
                                                value="<?= (set_value('time_limit_activation') ? set_value('time_limit_activation') : ($token['time_limit_activation'] != 0 ? $token['time_limit_activation'] : '')); ?>">
                                            <?= form_error_message('time_limit_activation'); ?>
                                        </div>

                                        <!-- TIME LIMIT FOR RESET PASSWORD -->
                                        <div class="form-group row">
                                            <label for="time_limit_for_reset_password" class="col-form-label">Time limit for Reset
                                                Password</label>
                                            <select class="custom-select form-select" name="time_limit_for_reset_password"
                                                id="time_limit_for_reset_password">
                                                <?php if (set_value('time_limit_for_reset_password') == 1) : ?>
                                                <option value="1" selected>Enable</option>
                                                <option value="0">Disable</option>
                                                <?php elseif (set_value('time_limit_for_reset_password') == 0) : ?>
                                                <option value="1">Enable</option>
                                                <option value="0" selected>Disable</option>
                                                <?php elseif ($token['time_limit_reset_password'] != 0) : ?>
                                                <option value="1" selected>Enable</option>
                                                <option value="0">Disable</option>
                                                <?php else : ?>
                                                <option value="1">Enable</option>
                                                <option value="0" selected>Disable</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- TIME LIMIT RESET PASSWORD -->
                                        <div class="form-group row time_limit_reset_password">
                                            <label for="time_limit_reset_password" class="col-form-label">Time limit (in hours)</label>
                                            <input type="number" class="form-control" id="time_limit_reset_password"
                                                name="time_limit_reset_password" autocomplete="off"
                                                value="<?= (set_value('time_limit_reset_password') ? set_value('time_limit_reset_password') : ($token['time_limit_reset_password'] != 0 ? $token['time_limit_reset_password'] : '')); ?>">
                                            <?= form_error_message('time_limit_reset_password'); ?>
                                        </div>
                                        <hr />

                                        <!-- TAB -->
                                        <input type="hidden" name="tab" value="token">

                                        <!-- SAVE -->
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary" name="token-save" value="save">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="tab-pane fade <?= ($tab == 'email' ? 'show active' : ''); ?>" id="nav-email" role="tabpanel"
                            aria-labelledby="nav-email-tab">
                            <div class="row my-3 mx-1">
                                <div class="col-lg-12">
                                    <form action="<?= base_url('admin/settings?tab=email'); ?>" method="POST">

                                        <!-- EMAIL SENDER ADDRESS -->
                                        <div class="form-group row">
                                            <label for="email_sender_address" class="col-form-label">Email sender address*</label>
                                            <input type="text" class="form-control" id="email_sender_address"
                                                name="email_sender_address" autocomplete="off"
                                                value="<?= (set_value('email_sender_address') ? set_value('email_sender_address') : $email['email_sender_address']); ?>">
                                            <?= form_error_message('email_sender_address'); ?>
                                        </div>

                                        <!-- EMAIL SENDER NAME -->
                                        <div class="form-group row">
                                            <label for="email_sender_name" class="col-form-label">Email sender name*</label>
                                            <input type="text" class="form-control" id="email_sender_name" name="email_sender_name"
                                                autocomplete="off"
                                                value="<?= (set_value('email_sender_name') ? set_value('email_sender_name') : $email['email_sender_name']); ?>">
                                            <?= form_error_message('email_sender_name'); ?>
                                        </div>

                                        <!-- MAIL TRANSPORT TYPE -->
                                        <div class="form-group row">
                                            <label for="mail_transport_type" class="col-form-label">Mail transport type*</label>
                                            <select class="custom-select form-select" name="mail_transport_type" id="mail_transport_type">
                                                <?php if (set_value('mail_transport_type') == 'php') : ?>
                                                <option value="php" selected>PHP</option>
                                                <option value="smtp">SMTP</option>
                                                <?php elseif (set_value('mail_transport_type') == 'smtp') : ?>
                                                <option value="php">PHP</option>
                                                <option value="smtp" selected>SMTP</option>
                                                <?php elseif ($email['mail_transport_type'] == 'php') : ?>
                                                <option value="php" selected>PHP</option>
                                                <option value="smtp">SMTP</option>
                                                <?php else : ?>
                                                <option value="php">PHP</option>
                                                <option value="smtp" selected>SMTP</option>
                                                <?php endif; ?>
                                            </select>

                                            <!-- WARNING FOR PHP EMAIL SENDER -->
                                            <div class="alert alert-warning alert-dismissible fade show col-sm-12 mt-2 php-email-sender-warning"
                                                role="alert">
                                                Warning! PHP Email Sender just working on live server.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <?= form_error_message('mail_transport_type'); ?>
                                        </div>

                                        <!-- SMTP OPTIONS -->
                                        <div class="smtp-options">
                                            <h4 class="mt-4">SMTP Options</h4>

                                            <!-- HOSTNAME -->
                                            <div class="form-group row mb-2">
                                                <label for="hostname" class="col-sm-3 col-form-label">Hostname*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="hostname" name="hostname"
                                                        autocomplete="off"
                                                        value="<?= (set_value('hostname') ? set_value('hostname') : $email['hostname']); ?>">
                                                    <?= form_error_message('hostname'); ?>
                                                </div>
                                            </div>

                                            <!-- USERNAME -->
                                            <div class="form-group row mb-2">
                                                <label for="username" class="col-sm-3 col-form-label">Username*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username" name="username"
                                                        autocomplete="off"
                                                        value="<?= (set_value('username') ? set_value('username') : $email['username']); ?>">
                                                    <?= form_error_message('username'); ?>
                                                </div>
                                            </div>

                                            <!-- PASSWORD -->
                                            <div class="form-group row mb-2">
                                                <label for="password" class="col-sm-3 col-form-label">Password*</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password"
                                                        autocomplete="off"
                                                        value="<?= (set_value('password') ? set_value('password') : $email['password']); ?>">
                                                    <?= form_error_message('password'); ?>
                                                </div>
                                            </div>

                                            <!-- PORT NUMBER -->
                                            <div class="form-group row mb-2">
                                                <label for="port_number" class="col-sm-3 col-form-label">Port number*</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="port_number" name="port_number"
                                                        autocomplete="off"
                                                        value="<?= (set_value('port_number') ? set_value('port_number') : $email['port_number']); ?>">
                                                    <?= form_error_message('port_number'); ?>
                                                </div>
                                            </div>

                                            <!-- ENCRYPTION -->
                                            <div class="form-group row">
                                                <label for="encryption" class="col-sm-3 col-form-label">Encryption</label>
                                                <div class="col-sm-9">
                                                    <select class="custom-select form-select" name="encryption" id="encryption">
                                                        <option value="none"
                                                            <?= (set_value('encryption') == 'none') ? 'selected' : ($email['encryption'] == 'none' ? 'selected' : ''); ?>>
                                                            None</option>
                                                        <option value="ssl"
                                                            <?= (set_value('encryption') == 'ssl') ? 'selected' : ($email['encryption'] == 'ssl' ? 'selected' : ''); ?>>
                                                            SSL</option>
                                                        <option value="tls"
                                                            <?= (set_value('encryption') == 'tls') ? 'selected' : ($email['encryption'] == 'tls' ? 'selected' : ''); ?>>
                                                            TLS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />

                                        <!-- TAB -->
                                        <input type="hidden" name="tab" value="email">

                                        <!-- SAVE -->
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-primary" name="email-save"
                                                    value="save">Save</button>
                                                <button type="submit" class="btn btn-primary" name="email-save-and-test"
                                                    value="save-and-test">Save &
                                                    Test</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- MIDTRANS -->
                        <div class="tab-pane fade <?= ($tab == 'midtrans' ? 'show active' : ''); ?>" id="nav-midtrans" role="tabpanel"
                            aria-labelledby="nav-midtrans-tab">
                            <div class="row my-3 mx-1">
                                <div class="col-lg-12">
                                    <form action="<?= base_url('admin/settings?tab=midtrans'); ?>" method="POST">
                                        <div class="form-group row">

                                            <!-- ENVIRONMENT -->
                                            <label for="environment" class="col-form-label">Environment*</label>
                                            <select class="custom-select form-select" name="environment" id="environment">
                                                <?php if (set_value('environment') == 'sandbox') : ?>
                                                <option value="sandbox" selected>Sandbox</option>
                                                <option value="production">Production</option>
                                                <?php elseif (set_value('environment') == 'production') : ?>
                                                <option value="sandbox">Sandbox</option>
                                                <option value="production" selected>Production</option>
                                                <?php elseif ($midtrans['environment'] == 'sandbox') : ?>
                                                <option value="sandbox" selected>Sandbox</option>
                                                <option value="production">Production</option>
                                                <?php else : ?>
                                                <option value="sandbox">Sandbox</option>
                                                <option value="production" selected>Production</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                        <!-- CLIENT KEY -->
                                        <div class="form-group row">
                                            <label for="client_key" class="col-form-label">Client Key*</label>
                                            <input type="text" class="form-control" id="client_key" name="client_key" autocomplete="off"
                                                value="<?= (set_value('client_key') ? set_value('client_key') : $midtrans['client_key']); ?>">
                                            <?= form_error_message('client_key'); ?>
                                        </div>

                                        <!-- SERVER KEY -->
                                        <div class="form-group row">
                                            <label for="server_key" class="col-form-label">Server Key*</label>
                                            <input type="text" class="form-control" id="server_key" name="server_key" autocomplete="off"
                                                value="<?= (set_value('server_key') ? set_value('server_key') : $midtrans['server_key']); ?>">
                                            <?= form_error_message('server_key'); ?>
                                        </div>
                                        <hr />

                                        <!-- TAB -->
                                        <input type="hidden" name="tab" value="midtrans">

                                        <!-- SAVE -->
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary" name="midtrans-save"
                                                value="save">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- KODE -->
                        <div class="tab-pane fade <?= ($tab == 'kode' ? 'show active' : ''); ?>" id="nav-kode" role="tabpanel"
                            aria-labelledby="nav-kode-tab">
                            <div class="row m-3">
                                <div class="col-lg-12">
                                    <form action="<?= base_url('admin/settings?tab=kode'); ?>" method="POST">
                                        <!-- INPUT -->
                                        <div class="form-group row">
                                            <label for="kode" class="col-form-label">Kode*</label>
                                            <input type="number" class="form-control" id="kode" name="kode" autocomplete="off"
                                                value="<?= (set_value('kode') ? set_value('kode') : $kode['kode']); ?>">
                                            <?= form_error_message('kode'); ?>
                                            <div class="alert alert-warning alert-dismissible fade show col-sm-12 mt-2" role="alert">
                                                Warning! Kode digunakan untuk melakukan <b>hapus tryout</b>, <b>membuka formulir bobot
                                                    nilai</b>,
                                                dan
                                                <b>mengubah role user</b>.
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <!-- TAB -->
                                        <input type="hidden" name="tab" value="kode">

                                        <!-- SAVE -->
                                        <div class="form-group row">
                                            <button type="submit" class="btn btn-primary" name="kode-save" value="save">Save</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <?php destroysession(); ?>