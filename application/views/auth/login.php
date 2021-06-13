<?php if($this->session->flashdata('alert') =='' ) {
    ?>
    <!-- Logikanya :
        Kalau $alert yang dikirim bernilai 'false' (tidak ada yang dikirim)
        maka jalankan Holla Shay -->
        <h4 class="mt-4">Holla Shay...</h4>
        <h6 class="font-weight-light">Mari masuk dan belanja</h6>
    <?php
}else{
    // Tapi... Kalau $alert bernilai true (ada data yg dikirim)
    // maka lakukan Echo (Keluarkan/tampilkan) perintah dibawah ini.
    echo $this->session->flashdata('alert');
}?>

<form class="pt-3" method="POST" action="<?= base_url('auth'); ?>">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="mail" name="mail" placeholder="Email" value="<?= set_value('mail') ?>">
        <?= form_error('mail','<small class="text-danger">','</small>')?>
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="pass" name="pass" placeholder="Password">
        <?= form_error('pass','<small class="text-danger">','</small>')?>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><b style="font-weight: 600;">LOGIN</b></button>
    </div>
    <!-- Saat ini belum butuh ingat aku & lupa password, krn ribet settingnya -->
    <!-- <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input">
                Ingat Aku
            </label>
        </div>
        <a href="#" class="auth-link text-black">Lupa Password?</a>
    </div> -->
    <div class="text-center mt-4 font-weight-light">
        Belum punya akun? <a href="<?= base_url('mendaftar');?>" class="text-primary"><b style="font-weight: 600;">Buat</b></a>
    </div>
</form>