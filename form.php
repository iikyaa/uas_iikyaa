<?php
include 'koneksi.php';

$hari        = "";
$nama       = "";
$spesialis     = "";
$dokter   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from tb_pasien where id = '$id'";
    $q1         = mysqli_query($conn,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from tb_pasien where id = '$id'";
    $q1         = mysqli_query($conn, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $hari      = $r1['hari'];
    $nama       = $r1['nama_pasien'];
    $spesialis     = $r1['spesialis'];
    $dokter   = $r1['dokter'];

    if ($hari == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $hari        = $_POST['hari'];
    $nama       = $_POST['nama'];
    $spesialis     = $_POST['spesialis'];
    $dokter   = $_POST['dokter'];

    if ($hari && $nama && $spesialis && $dokter) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update tb_pasien set hari = '$hari',nama_pasien='$nama',spesialis = '$spesialis', dokter='$dokter' where id = '$id'";
            $q1         = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into tb_pasien(hari,nama_pasien,spesialis,dokter) values('$hari','$nama','$spesialis','$dokter')";
            $q1     = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pendaftaran | Periksa Dokter</title>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <link rel="icon" href="gambar/logo-rmbg.png" type="image">
        <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
        </style>

    </head>
    <style>
        * {
    padding:0;
    margin:0;
    font-family:'Quicksand', sans-serif ;
}
header {
    height:70px;
    background-color: #545B77;
    text-align:left;
}
header h1 {
    display: inline-block;
    padding: 15px 24px;
    text-transform: uppercase;
    font-family: 'Quicksand';
    color: white;
    text-align: left;
}
body {
    width: 100%;
    height: 100vh;
    background-color: #F2D8D8;
    align-items: center;
    justify-content: space-between;
    font-family: "Quicksand";
    
}
.text h1 {
    color: #374259;
    font-size:xx-large;
    text-align: center;
    padding: 45px;
    text-transform: none;
    font-size: 50px;

}
div button {
   display: block;
   margin: auto;
   padding: 7px 25px;
   background-color: #FCFFE7;
   border: 2px solid #3A4F7A;
   border-radius: 5px;
   color: #3A4F7A;
   font-size: medium;
   text-decoration: none;
   transition: all .5s ease;
   font-weight: bolder;
}
div button:hover {
    color:brown;
    transition: .4s;
    border: 2px solid #F2789F;
}
footer {
    background-color: #545B77;
    padding: 10px;
    text-align: center;
}
footer p {
    color: white;
}
</style>
    <body>
        <header>
            <div class="header"></div>
                <h1>Form Pendaftaran</h1>
            </div>
        </header> 
        <div class="body"></div>
        <div class="text">
            <h1>Pendaftaran Periksa Dokter </h1>
        
            <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=form.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url= form.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="abs" class="col-sm-2 col-form-label">Hari</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="hari" id="hari">
                                <option value="">- Choose Day -</option>
                                <option value="Senin" <?php if ($hari == "Senin") echo "selected" ?>>Senin</option>
                                <option value="Selasa" <?php if ($hari == "Selasa") echo "selected" ?>>Selasa</option>
                                <option value="Rabu" <?php if ($hari == "Rabu") echo "selected" ?>>Rabu</option>
                                <option value="Kamis" <?php if ($hari == "Kamis") echo "selected" ?>>Kamis</option>
                                <option value="Jumat" <?php if ($hari == "Jumat") echo "selected" ?>>Jumat</option>
                                <option value="Sabtu" <?php if ($hari == "Sabtu") echo "selected" ?>>Sabtu</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label" name="spesialis">Spesialis</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="spesialis" id="spesialis">
                                <option value="">- Choose Spesialist -</option>
                                <option value="Anak" <?php if ($spesialis == "Anak") echo "selected" ?>>Anak</option>
                                <option value="Gigi" <?php if ($spesialis == "Gigi") echo "selected" ?>>Gigi</option>
                                <option value="THT" <?php if ($spesialis == "THT") echo "selected" ?>>THT</option>
                                <option value="Mata" <?php if ($spesialis == "Mata") echo "selected" ?>>Mata</option>
                                <option value="Orthopedi" <?php if ($spesialis == "Orthopedi") echo "selected" ?>>Orthopedi</option>
                                <option value="Umum" <?php if ($spesialis == "Umum") echo "selected" ?>>Umum</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Dokter</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dokter" id="dokter">
                                <option value="">- Choose Doctor -</option>
                                <option value="dr. Oky Arfianda, Sp. A" <?php if ($dokter == "dr. Oky Arfianda, Sp. A") echo "selected" ?>>dr. Oky Arfianda, Sp. A</option>
                                <option value="drg. Ikya Ariferen" <?php if ($dokter == "drg. Ikya Ariferen") echo "selected" ?>>drg. Ikya Ariferen</option>
                                <option value="dr. Kiyo Arifinda, Sp. THT-KL" <?php if ($dokter == "dr. Kiyo Arifinda, Sp. THT-KL") echo "selected" ?>>dr. Kiyo Arifinda, Sp. THT-KL</option>
                                <option value="dr. Ayki Arfanda, Sp. M" <?php if ($dokter == "dr. Ayki Arfanda, Sp. M") echo "selected" ?>>dr. Ayki Arfanda, Sp. M</option>
                                <option value="dr. Kia Arianda, Sp. OT" <?php if ($dokter == "dr. Kia Arianda, Sp. OT") echo "selected" ?>>dr. Kia Arianda, Sp. OT</option>
                                <option value="dr. Kyra Arifira" <?php if ($dokter == "dr. Kyra Arifira") echo "selected" ?>>dr. Kyra Arifira</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data nama
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Spesialis</th>
                            <th scope="col">Dokter</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from tb_pasien order by id desc";
                        $q2     = mysqli_query($conn, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $hari        = $r2['hari'];
                            $nama       = $r2['nama_pasien'];
                            $spesialis     = $r2['spesialis'];
                            $dokter   = $r2['dokter'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $hari ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $spesialis ?></td>
                                <td scope="row"><?php echo $dokter ?></td>
                                <td scope="row">
                                    <a href="form.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="form.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

        <br><div class="button"></br>
           <a href="home.php"><button>Back</button></a>
        </div>
        <br>
        <br>
        <br>
        <footer>
            <p>copyright@kliniksehat</p>
        </footer>
    </body>
</html>