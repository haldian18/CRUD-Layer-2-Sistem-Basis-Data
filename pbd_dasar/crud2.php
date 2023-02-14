<?php
require("../sistem/koneksi.php");

$hub = open_connection();
$a = @$_GET["a"];
$id = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
    case "create":
        create_prodi();
        break;
    case "update":
        update_prodi();
        break;
    case "delete":
        delete_prodi();
        break;
}
switch ($a) {
    case "list":
        read_data();
        break;
    case "input":
        input_data();
        break;
    case "edit":
        edit_data($id);
        break;
    case "hapus":
        hapus_data($id);
        break;
    default:
        read_data();
        break;
}
mysqli_close($hub);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap');
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ffefd0;
        }
        .container {
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        @media (min-width: 768px) {
            .container {
                width: 750px;
            }
        }
        @media (min-width: 992px) {
            .container {
                width: 970px;
            }
        }
        @media (min-width: 1200px) {
            .container {
                width: 1170px;
            }
        }

        h2 {
            padding: 0px;
            margin: 0px;
            width: fit-content;
            margin-bottom: 30px;
            display: inline-block;
            font-size: 30px;
            margin-bottom: 15px;
        }

        .clear {
            float: none;
            clear: both;
        }

        .button {
            margin-bottom: 10px;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 13px;
            background-color: #e1e1e1;
            text-decoration: none;
            color: #fff;
            box-sizing: border-box;
            border: none;
            font-size: 14px;
            font-family: 'Nunito', sans-serif;
        }

        .edit {
            background-color: rgb(203 203 203 / 24%);
            font-weight: 700;
        }

        .hapus {
            background-color: rgb(145 145 145 / 0%);
            color: rgb(255 255 255 / 77%);
        }

        .save {
            background-color: #33BC84;
            font-weight: 700;
            cursor: pointer;
            margin-top: 15px;
        }

        .back {
            margin-top: 15px;
            background-color: rgb(145 145 145 / 0%);
            color: rgb(223 156 35 / 77%);
            font-weight: 700;
        }

        .danger {
            background-color: #105157;
            font-weight: 700;
            cursor: pointer;
        }

        .small {
            font-size: 15px;
            display: inline-block;
            margin-left: 10px;
            color: #fbebd5;
            background-color: #105157;
            margin-bottom: 15px;
        }

        .box {
            margin-top: 50px;
            margin-bottom: 50px;
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-sizing: border-box;
        }

        .contents {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            color: #fff;
            padding: 20px;
            margin: 10px 10px;
            border-radius: 20px;
            flex-grow: 1
        }

        .grade {
            padding: 10px;
            margin: 0;
            background-color: rgba(0,0,0,0.2);
            font-weight: bold;
            width: fit-content;
            border-radius: 10px;
            font-size: 20px;
        }

        .kdprodi {
            font-weight: 500;
        }

        .form-control > input[type=text] {
            padding: 10px 15px;
            font-family: 'Nunito', sans-serif;
            width: 100%;
            font-size: 20px;
            border-radius: 13px;
            border: 1px solid #eee;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    
    <?php
    function read_data() {
        global $hub;
        $query = "select * from dt_prodi";
        $result = mysqli_query($hub, $query); ?>
        
        <div class="container">
            <div class="box">
                <h2>Data Program Studi </h2><a href="?a=input" class="btn small">add prodi</a>
                <div class="contents">
                    <?php while($row = mysqli_fetch_array($result)) { ?>
                    
                    <div class="card" style="background-color: #<?php if($row['akreditasi'] == 'A') {echo '33BC84';} else if($row['akreditasi'] == 'B') {echo 'FEB12F';} else if($row['akreditasi'] == 'C') {echo 'DE7588';} else {echo '105157';} ?>;">
                        <p class="grade"><?php echo $row['akreditasi']; ?></p>
                        <h3><span class="kdprodi"><?php echo $row['kdprodi']; ?> </span><?php echo $row['nmprodi']; ?></h3>
                        <div class="button">
                            <a class="btn edit" href="curd_prodi.php?a=edit&id=<?php echo $row['idprodi']; ?>">Edit</a>
                            <a class="btn hapus" href="curd_prodi.php?a=hapus&id=<?php echo $row['idprodi']; ?>">Hapus</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    <?php } ?>

    <?php
    function input_data() {
        $row = array(
            "kdprodi" => "",
            "nmprodi" => "",
            "akreditasi" => "-"
        ); ?>

        <div class="container">
            <div class="box">
        
                <h2>Input Data Program Studi</h2>
                <form class="form-control" name="latihan" action="curd_prodi.php?a=list" method="post" onsubmit="return validate()">
                    <input type="hidden" name="sql" value="create">
                    Kode Prodi <br>
                    <input type="text" placeholder="Masukkan kode prodi" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
                    <br>
                    Nama Prodi <br>
                    <input type="text" placeholder="Masukkan nama prodi" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
                    <br>
                    Akreditasi Prodi <br>
                    <input type="radio" name="akreditasi" value="-" <?php if($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
                    <input type="radio" name="akreditasi" value="A" <?php if($row["akreditasi"]=='A') { echo "checked=\"checked\""; } else {echo ""; } ?>> A
                    <input type="radio" name="akreditasi" value="B" <?php if($row["akreditasi"]=='B') { echo "checked=\"checked\""; } else {echo ""; } ?>> B
                    <input type="radio" name="akreditasi" value="C" <?php if($row["akreditasi"]=='C') { echo "checked=\"checked\""; } else {echo ""; } ?>> C
                    <br>
                    <input class="btn save" type="submit" name="action" value="Simpan">
                    <a class="btn back" href="curd_prodi.php?a=list">Batal</a>
                </form>

            </div>
        </div>
    <?php } ?>

    <?php 
    function edit_data($id) {
        global $hub;
        $query  = "select * from dt_prodi where idprodi = $id";
        $result = mysqli_query($hub, $query);
        $row    = mysqli_fetch_array($result); ?>

        <div class="container">
            <div class="box">
                <h2>Edit Data Program Studi</h2>
                <form class="form-control" action="curd_prodi.php?a=list" method="post">
                    <input type="hidden" name="sql" value="update">
                    <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
                    Kode Prodi <br>
                    <input type="text" name="kdprodi" maxlength="6" size="6" value="<?php echo trim($row["kdprodi"]) ?>" />
                    <br>
                    Nama Prodi <br>
                    <input type="text" name="nmprodi" maxlength="70" size="70" value="<?php echo trim($row["nmprodi"]) ?>" />
                    <br>
                    Akreditasi Prodi <br>
                    <input type="radio" name="akreditasi" value="-" <?php if($row["akreditasi"]=='-' || $row["akreditasi"]=='') { echo "checked=\"checked\""; } else {echo ""; } ?>> -
                    <input type="radio" name="akreditasi" value="A" <?php if($row["akreditasi"]=='A' ) { echo "checked=\"checked\""; } else {echo "";} ?> > A
                    <input type="radio" name="akreditasi" value="B" <?php if($row["akreditasi"]=='B' ) { echo "checked=\"checked\""; } else {echo "";} ?> > B
                    <input type="radio" name="akreditasi" value="C" <?php if($row["akreditasi"]=='C' ) { echo "checked=\"checked\""; } else {echo "";} ?> > C
                    <br>
                    <input class="btn save" type="submit" name="action" value="Simpan">
                    <a class="btn back" href="curd_prodi.php?a=list">Batal</a>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php
    function hapus_data($id) {
        global $hub;
        $query  = "select * from dt_prodi where idprodi = $id";
        $result = mysqli_query($hub, $query);
        $row    = mysqli_fetch_array($result); ?>

        <div class="container">
            <div class="box">
                <h2>Hapus Data Program Studi</h2>
                <form action="curd_prodi.php?a=list" method="post">
                    <input type="hidden" name="sql" value="delete">
                    <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
                    <table>
                        <tr>
                            <td width=100>Kode</td>
                            <td><?php echo trim($row["kdprodi"]) ?></td>
                        </tr>
                        <tr>
                            <td>Nama Prodi</td>
                            <td><?php echo trim($row["nmprodi"]) ?></td>
                        </tr> 
                        <tr>
                            <td>Akreditasi</td>
                            <td><?php echo trim($row["akreditasi"]) ?></td>
                        </tr>
                    </table>
                    <br>
                    <input class="btn danger" type="submit" name="action" value="Hapus">
                    <a class="btn back" href="curd_prodi.php?a=list">Batal</a>
                </form>
            </div>
        </div>
    <?php } ?>

    <?php
    function create_prodi() {
        global $hub;
        global $_POST;
        $kdprodi = $_POST['kdprodi'];
        $nmprodi = $_POST['nmprodi'];

        $query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) VALUES ";
        $query .= " ('". $_POST["kdprodi"]."', '".$_POST["nmprodi"]."', '".$_POST["akreditasi"]."')";
        $row = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi' OR kdprodi = '$kdprodi'");
        if (mysqli_num_rows($row) > 0) {
            echo "<script>alert('kode prodi atau nama prodi sudah ada di database');</script>";
        } else {
            mysqli_query($hub, $query) or die(mysqli_error($hub));
        }
    }

    function update_prodi() {
        global $hub;
        global $_POST;

        $query = "UPDATE dt_prodi";
        $query .= " SET kdprodi='" . $_POST["kdprodi"]."', nmprodi= '". $_POST["nmprodi"]."', akreditasi='". $_POST["akreditasi"]."'";
        $query .= " WHERE idprodi = ".$_POST["idprodi"];

        $kdprodi = $_POST['kdprodi'];
        $nmprodi = $_POST['nmprodi'];
        $akreditasi = $_POST['akreditasi'];
        $id = $_POST['idprodi'];

        $cekNamaProdi = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi' AND idprodi = '$id'");
        $cekNamaProdiLain = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE nmprodi = '$nmprodi'");
        $cekKodeProdi = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE kdprodi = '$kdprodi' AND idprodi = '$id'");
        $cekKodeProdiLain = mysqli_query($hub, "SELECT * FROM dt_prodi WHERE kdprodi = '$kdprodi'");

        if (mysqli_num_rows($cekNamaProdi) == 1 && mysqli_num_rows($cekKodeProdi) == 1) {
            mysqli_query($hub, "UPDATE dt_prodi SET akreditasi='$akreditasi' WHERE idprodi='$id'");
        } else if (mysqli_num_rows($cekKodeProdi) == 1 && mysqli_num_rows($cekNamaProdiLain) == 0) {
            echo "<script>alert('nama prodi diperbarui');</script>";
            mysqli_query($hub, "UPDATE dt_prodi SET nmprodi='$nmprodi', akreditasi='$akreditasi' WHERE idprodi='$id'");
        } else if (mysqli_num_rows($cekNamaProdi) == 1 && mysqli_num_rows($cekKodeProdiLain) == 0) {
            echo "<script>alert('kode prodi diperbarui');</script>";
            mysqli_query($hub, "UPDATE dt_prodi SET kdprodi='$kdprodi', akreditasi='$akreditasi' WHERE idprodi='$id'");
        } else if (mysqli_num_rows($cekKodeProdiLain) > 0 && mysqli_num_rows($cekNamaProdi) == 1) {
            echo "<script>alert('kode prodi already exist');</script>";
        } else if (mysqli_num_rows($cekNamaProdiLain) > 0 && mysqli_num_rows($cekKodeProdi) == 1) {
            echo "<script>alert('nama prodi already exist');</script>";
        } else {
            echo "<script>alert('semua data berhasil diperbarui');</script>";
            mysqli_query($hub, $query) or die (mysqli_error($hub));
        }
    }

    function delete_prodi() {
        global $hub;
        global $_POST;
        $query  = "DELETE FROM dt_prodi";
        $query .= " WHERE idprodi = ".$_POST["idprodi"];
        mysqli_query($hub, $query) or die (mysqli_error($hub));
    }
    ?>

    <script type="text/javascript">
        function validate() {
            if (document.forms["latihan"]["kdprodi"].value == "") {
                alert("Nama Tidak Boleh Kosong");
                document.forms["latihan"]["kdprodi"].focus();
                return false;
            }
            if (document.forms["latihan"]["nmprodi"].value == "") {
                alert("Nmprodi Tidak Boleh Kosong");
                document.forms["latihan"]["nmprodi"].focus();
                return false;
            }
            if (document.forms["latihan"]["akreditasi"].selectedIndex < 1) {
                alert("Pilih Jurusan.");
                document.forms["latihan"]["akreditasi"].focus();
                return false;
            }
        }
    </script>

</body>
</html>