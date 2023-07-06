<?= $this->extend('components/layout') ?>

<?= $this->section('content') ?>
    <?php
        $session = session();
        $error = $session->getFlashdata('error');
        $success = $session->getFlashdata('success');
    ?>

    <div class="row" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="col-md-6 offset-md-3 align-self-center">
            <div class="card">
                <div class="card-header text-white bg-dark">
                    <strong>Reset Password</strong>
                </div>
                <div class="card-body">
                    <?php if ($error) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($success) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= $success ?>
                        </div>
                    <?php endif; ?>

                    <?= form_open('reset-password/process-reset') ?>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Reset Password">
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection('content') ?>
