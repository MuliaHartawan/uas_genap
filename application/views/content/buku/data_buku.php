
<div class="container-fluid">
  <h1>Data Koleksi</h1>


				<!-- tampilkan flashdata (jika ada) -->
				    <?php if($this->session->flashdata('success')) { ?>
				    <div class="alert alert-success" role="alert">
				    	<?php echo $this->session->flashdata('success'); ?>
				    </div>
					<?php } ?>


	<a class="btn btn-block btn-primary" href="<?php echo base_url('index.php/buku/create'); ?>">Tambah Koleksi</a>
  <table class="table table-hover shadow p-3 mb-5 bg-white rounded">
  	<thead>
  		<tr>
  			<td scope="col">No</td>
  			<td scope="col">Judul</td>
  			<td scope="col">Pengarang</td>
  			<td scope="col">Gambar</td>
  			<td>Aksi</td>
  		</tr>
  	</thead>
  	<tbody>
  		<?php
  			$no = 0;
  			foreach ($buku as $item) {
  				$no++;
  		?>
  			<tr>
  				<th scope="row"><?php echo $no ?></th>
  				<td><?php echo $item->judul ?></td>
  				<td><?php echo $item->pengarang ?></td>
  				<td><?php if ($item->url_gambar) { ?>
              <img src="<?php echo base_url("/uploads/gambar_buku/$item->url_gambar"); ?>" class="img-thumbnail">
          <?php } else { ?>
            -
          <?php } ?>
          </td>
  				<td>
            <a href="<?php echo base_url('index.php/buku/show/'.$item->id) ?>" class="btn btn-xs btn-info">Tampil</a>
  					<a href="<?php echo base_url('index.php/buku/edit/'.$item->id) ?>" class="btn btn-xs btn-warning">Edit</a>
  					<a href="<?php echo base_url('index.php/buku/delete/'.$item->id) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda yakin menghapus <?php echo $item->judul ?> ?')">Hapus</a>
  				</td>
  			</tr>
  		<?php
  			}
  		?>
  	</tbody>
  </table>
</div>