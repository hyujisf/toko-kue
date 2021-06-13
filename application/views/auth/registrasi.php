<h6 class="">Isikan dengan data yang benar yups..</h6>

<form class="pt-3" method="POST" action="<?= base_url('auth/regist');?>">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>">
        <?= form_error('nama','<small class="text-danger">','</small>')?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="mail" name="mail" placeholder="Email" value="<?= set_value('mail') ?>">
        <?= form_error('mail','<small class="text-danger">','</small>')?>
    </div>
    <div class="row">
        <div class="form-group col-6 mb-0 pb-0">
            <input type="password" class="form-control form-control-lg" id="1pass" name="1pass" placeholder="Password">
        </div>
        <div class="form-group col-6 mb-0 pb-0">
            <input type="password" class="form-control form-control-lg" id="upass" name="upass" placeholder="Ulangi Password">
        </div>
        <div class="col-12 pt-0 mt-0 mb-1 pb-1">
        <?= form_error('1pass','<small class="text-danger">','</small>')?>
        </div>
        
    </div>
    <div class="mt-3">
        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><b style="font-weight: 600;">DAFTAR</b></button>
    </div>
    <div class="text-center mt-4 font-weight-light">
        Sudah punya akun? Yukk <a href="<?= base_url('masuk');?>" class="text-primary"><b style="font-weight: 600;">Login</b></a>
    </div>
</form>