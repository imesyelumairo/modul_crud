<?php
    //koneksi Database
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "dblatihan";

    $koneksi = mysqli_connect($server, $user, $pass, $database) or die (mysqli_eror($koneksi));

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD 2021 PHP & Mysq + Boostrap 4</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <h1 class="text-center">CRUD PHP dan Mysq + Boostrap 4</h1>
    <h2 class="text-center">@ImesyeLumairo</h2>

    <!-- Awal Card Form -->
    <div class="card mt-3">
    <div class="card-header bg-primary text-white">
        Form Input data Mahasiswa
    </div>
    <div class="card-body">
        <form method="post" action="">
            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="tnim" class="form-control" placeholder="Input Nim Anda disini!" required>
            </div>
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" name="tnama" class="form-control" placeholder="Input Nama Anda disini!" required>
            </div>
            <div class="form-group">
                <label>ALAMAT</label>
                <textarea class="form-control" name="talamat" placeholder="Input Alamat Anda Disini!"></textarea>
            </div>
            <div class="form-group">
                <label>JURUSAN</label>
               <select class="form-control" name="tjurusan">
                   <option></option>
                   <option value="D3"-Keperawatan">D3-Keperawatan></option>
                   <option value="D3"-Perikanan">D3-Perikanan></option>
                   <option value="D3"-Sistem Informasi">D3-Sistem Informasi></option>
               </select>
            </div>

            <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
            <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
        </form>
    </div>
    </div>
    <!-- Akhir Card Form -->


    <!-- Awal Card tabel -->
    <div class="card mt-3">
    <div class="card-header bg-success text-white">
        Daftar Mahasiswa Polnustar
    </div>
    <div class="card-body">
        
    <table class="table table-boordered table-striped">
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th>JURUSAN</th>
            <th>AKSI</th>
        </tr>
        <?php
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * from tmhs order by id_mhs desc");
            while($data = mysqli_fetch_array($tampil)) : 

        ?>
        <tr>
            <td><?=$no++;?></td>
            <td><?=$data['nim']?></td>
            <td><?=$data['nama']?></td>
            <td><?=$data['alamat']?></td>
            <td><?=$data['prodi']?></td>
            <td>
                <a href="#"> Edit </a>
                <a href="#"> Hapus </a>
            </td>
        </tr>
        <?php endwhile; //penutup perulangan while ?>
    </table>

    </div>
    </div>
    <!-- Akhir Card tabel -->
</div>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>