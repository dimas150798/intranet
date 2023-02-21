<body class="bg-login">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="text-center">
                                </div>
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-3"><img
                                            src="<?php echo base_url(); ?>assets/img/logoSaja.png"
                                            alt="" width="50px" style="align-items: center;"></br>
                                        Intranet Infly Networks</h3>
                                    <h5 class="text-center font-weight-light my-3">
                                        <?php echo $this->session->flashdata('pesan'); ?>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <form id="form_login" class="user" method="POST"
                                        action="<?php echo base_url('Welcome/index'); ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="username" name="username" type="text"
                                                placeholder="Masukkan username..." />
                                            <?php echo form_error('username', '<div class="text-small text-danger"></div>') ?>
                                            <label for="username"><i class="bi bi-person-circle"></i> Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="password" name="password" type="password"
                                                placeholder="Masukkan password..." />
                                            <?php echo form_error('password', '<div class="text-small text-danger"></div>') ?>
                                            <label for="password"><i class="bi bi-lock"></i> Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                                            <button type="submit" class="button-login mat-primary">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>