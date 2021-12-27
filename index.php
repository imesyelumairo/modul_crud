<?php
    //koneksi Database
    $host = "db4free.net";
    $user = "imesyelumairo";
    $pass ="1905005lumairo";
    $database = "doublenn";

    $koneksi = mysqli_connect($host, $user, $pass, $database) or die (mysqli_eror($koneksi));

    //jika tombol simpan di klik
    if(isset($_POST['bsimpan']))
    {
        //Pengujian apakah data akan diedit atau di simpan baru
        if($_GET['hal'] == "edit")
        {
            //Data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE tmhs set
                                                nim = '$_POST[tnim]',
                                                nama = '$_POST[tnama]',
                                                alamat = '$_POST[talamat]',
                                                prodi = '$_POST[tprodi]'
                                            WHERE id_mhs = '$_GET[id]'
                                        ");
            if($edit) //jika edit sukses
            {
                echo "<script>
                        alert('edit data Sukses');
                        document.location='index.php';
                    </script>";
            }
            else
            {
                echo "<script>
                        alert('edit data Gagal!!');
                        document.location='index.php';
                    </script>";
            }
        }else
        {
            //Data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
                                          VALUES ('$_POST[tnim]', 
                                                 '$_POST[tnama]', 
                                                 '$_POST[talamat]', 
                                                 '$_POST[prodi]')
                                        ");
            if($simpan) //jika simpan sukses
            {
                echo "<script>
                        alert('Simpan data Sukses');
                        document.location='index.php';
                    </script>";
            }
            else
            {
                echo "<script>
                        alert('Simpan data Gagal!!');
                        document.location='index.php';
                    </script>";
            }
        }
    }



        //pengujian jika tombol edit atau hapus di klik
        if(isset($_GET['hal']))
        {
            //pengujian jike edit data
            if($_GET["hal"] == "edit")
            {
                //tampil data yang akan diedit
                $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]' ");
                $data = mysqli_fetch_array($tampil);
                if($data)
                {
                    //jika data ditemukan, maka data ditampung ke dalam variabel
                    $vnim = $data['nim'];
                    $vnama = $data['nama'];
                    $valamat = $data['alamat'];
                    $vprodi = $data['prodi'];
                }
            }
            else if ($_GET ['hal'] == "hapus")
            {
                //Persiapan hapus data
                $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs = '$_GET[id]' ");
                if($hapus){
                    echo "<script>
                        alert('Hapus data Sukses!!');
                        document.location='index.php';
                    </script>";
                }
            }
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD 2021 PHP & Mysq + Boostrap 4</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <h1 class="text-center">CRUD PHP dan Mysql + Boostrap 4</h1>
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
                <input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Input Nim Anda disini!" required>
            </div>
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama Anda disini!" required>
            </div>
            <div class="form-group">
                <label>ALAMAT</label>
                <textarea class="form-control" name="talamat" placeholder="Input Alamat Anda Disini!"><?=@$valamat?></textarea>
            </div>
            <div class="form-group">
                <label>JURUSAN</label>
               <select class="form-control" name="tprodi">
                   <option value="<?=@$vprodi?>"><?=@$vprodi?></option>
                   <option value="D3"-Keperawatan">D3-Keperawatan></option>
                   <option value="D3"-Perikanan">D3-Perikanan</option>
                   <option value="D3"-Sistem Informasi">D3-Sistem Informasi</option>
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
                <a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning"> Edit </a>
                <a href="index.php?hal=hapus&id=<?=$data['id_mhs']?>" 
                onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
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