<div class="container-fluid">

  <?php if(validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo validation_errors(); ?>
            </div>
          <?php } ?>

    <h1>Tambah Data Koleksi</h1>
    <form action="<?php echo base_url('index.php/buku/store'); ?>" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="judul">Judul</label>
    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Nama Judul">
    <?php if(form_error('judul')){ ?>
      <small class="text-danger"><?php echo form_error('judul')?></small>
    <?php } ?>
  </div>
  <div class="form-group">
    <label for="pengarang">Pengarang</label>
    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukan Nama Pengarang">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="url_gambar">Gambar (jika ada)</label>
    <input type="file" class="form-control" id="url_gambar" name="url_gambar">  
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>