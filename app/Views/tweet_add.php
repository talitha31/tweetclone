<?= $this->extend('components/layout') ?>

<?= $this->section('content') ?>

<?php helper('form');
$validation = \Config\Services::validation(); ?>

<div class="row" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="col-md-6 offset-md-3 align-self-center">
        <div class="card">
            <div class="card-header bg-info">
                <strong>Tweet Baru</strong>
            </div>
            <div class="card-body">
                <?= form_open_multipart('/add') ?>
                <div class="mb-3">
                    <label for="content" class="form-label <?= ($validation->hasError('content')) ? 'is-invalid' : '' ?>">Tweet</label>
                    <textarea name="content" id="tweet" class="form-control"></textarea>
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('content') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar</label>
                    <br>
                    <input type="file" name="image" class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : '' ?>">
                    <div style="color: red; font-size: small;">
                        <?= $validation->getError('image') ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kategori</label>
                    <?= form_dropdown('category', $categories, '', 'class="form-select"') ?>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Tambah Tweet">
                    <a href="<?= previous_url() ?>" class="btn btn-warning">Kembali</a>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>