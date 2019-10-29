<div class="container-fluid">
    <h1>Edit Data Anggota</h1>
    <form action="<?php echo base_url('index.php/anggota/update/'.$anggota->id_anggota); ?>" method="post">
  <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Anggota" value="<?php echo $anggota->nama_anggota; ?>" readonly>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
      <option value="L" <?php echo ($anggota->jenis_kelamin == 'L') ? 'selected' : ''; ?> >Laki-Laki</option>
      <option value="P" <?php echo ($anggota->jenis_kelamin == 'P') ? 'selected' : ''; ?> >Perempuan</option>
      <option value="" <?php echo ($anggota->jenis_kelamin == '') ? 'selected' : ''; ?> >Tidak Menyebutkan</option>
    </select>
  </div>
  <div class="form-group">
    <label for="kelas">Kelas</label>
    <select name="kelas" id="kelas" class="form-control">
      <option value="A" <?php echo ($anggota->kelas == 'A') ? 'selected' : ''; ?> >Kelas A</option>
      <option value="B" <?php echo ($anggota->kelas == 'B') ? 'selected' : ''; ?> >Kelas B</option>
      <option value="C" <?php echo ($anggota->kelas == 'C') ? 'selected' : ''; ?> >Kelas C</option>
      <option value="" <?php echo ($anggota->kelas == '') ? 'selected' : ''; ?> >Tidak Menyebutkan</option>
    </select>
  </div>
  <div class="form-group">
    <label for="foto">Foto (jika ada)</label>
    <input type="file" class="form-control" id="foto" name="foto">  
  </div>
  <button type="submit" class="btn btn-primary" <a href="<?php echo base_url('index.php/anggota') ?>"></a>kembali</button>
</form>
</div>