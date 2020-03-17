
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Form Input Kelas</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="POST">
        <div class="card-body">
          <div class="form-group">
            <label>Mata Pelajaran</label>
            <select class="form-control" name="matapelajaran">
                <option selected="true" disabled="disabled">--Pilih Mata Pelajaran--</option>
              <?php
              include'../database/koneksi.php';
              $querymapel = mysqli_query($koneksi,"SELECT * FROM tbl_mata_pelajaran");

              while ($rowmapel = mysqli_fetch_array($querymapel)) {

               ?>
              <option value="<?php echo $rowmapel['kode_mapel']; ?>"><?php echo $rowmapel['nama_mapel']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Siswa</label>
            <select class="form-control" name="siswa">
                <option selected="true" disabled="disabled">--Pilih Siswa--</option>
              <?php
              include'../database/koneksi.php';
              $queryguru = mysqli_query($koneksi,"SELECT * FROM tbl_siswa");

              while ($rowguru = mysqli_fetch_array($queryguru)) {

               ?>
              <option value="<?php echo $rowguru['no_identitas']; ?>"><?php echo $rowguru['nama_siswa']; ?></option>
            <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nilai</label>
            <input type="text" class="form-control" name="nilai" placeholder="Nilai">
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include'../database/koneksi.php';

if (isset($_POST['submit'])) {
    $mapel = $_POST['matapelajaran'];
    $siswa= $_POST['siswa'];
    $nilai = $_POST['nilai'];

    $query = mysqli_query($koneksi, "INSERT INTO tbl_nilai VALUES ('', '$mapel','$siswa', '$nilai')");

    if ($query) {
      echo "<script>alert('Data Berhasil Ditambahkan')</script>";
    }else {
      echo "<script>alert('Data Gagal Ditambahkan')</script>";
    }
}
?>
