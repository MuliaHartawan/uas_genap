<div class="container-fluid">
    <h1>Edit Data Koleksi</h1>
    <form action="<?php echo base_url('index.php/buku/update/'.$buku->id); ?>" method="post">
  <div class="form-group">
    <label for="judul">Judul</label>
    <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukan Nama Judul" value="<?php echo $buku->judul; ?>">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="pengarang">Pengarang</label>
    <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukan Nama Pengarang" value="<?php echo $buku->pengarang; ?>">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="url_gambar">Gambar (jika ada)</label>
    <input type="file" class="form-control" id="url_gambar" name="url_gambar">  
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>