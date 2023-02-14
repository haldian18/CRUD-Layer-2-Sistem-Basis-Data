<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
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
        case "hapus";
            hapus_data($id);
            break;
        default;
            read_data();
            break;
    }
    mysqli_close($hub);
    ?>

    <?php
    function read_data()
    {
        global $hub;
        $query = "select * from dt_prodi";
        $result = mysqli_query($hub, $query); ?>

        <div class="card mx-4 mt-5">
            <h2 class="col-md-auto text-center mx-4 mb-4 mt-3">Data Program Studi</h2>
            <div class="mx-4">
                <a href="crud4.php?a=input" class="btn btn-primary active" aria-current="page">INPUT</a>
            </div>
            <div class="card mx-4 mt-3 mb-3">
                <table class="table table-striped table-hover">
                    <tr>
                        <td>NO</td>
                        <td>KODE</td>
                        <td>NAMA PRODI</td>
                        <td>AKREDITASI</td>
                        <td>AKSI</td>
                    </tr>
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?php echo $row['kdprodi']; ?></td>
                            <td><?php echo $row['nmprodi']; ?></td>
                            <td><?php echo $row['akreditasi']; ?></td>
                            <td class="mx-4">
                                <a href="crud4.php?a=edit&id=<?php echo $row['idprodi']; ?>"
                                 class="mx-4 btn btn-warning active" aria-current="page">EDIT</a>
                                <a href="crud4.php?a=hapus&id=<?php echo $row['idprodi']; ?>"
                                 class="btn btn-danger active" aria-current="page">HAPUS</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <?php
            function input_data()
            {
                $row = array(
                    "kdprodi" => "",
                    "nmprodi" => "",
                    "akreditasi" => "-"
                ); ?>
                <div class="card mx-4 mt-5">
                    <h2 class="col-md-auto text-center mx-4 mb-4 mt-3">Input Data Program Studi</h2>
                    <form class="mx-4 mb-4 mt-3" name="latihan" action="crud4.php?a=list" 
                    method="post" onsubmit=" return validate()">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kode Prodi</label>
                            <input type="hidden" name="sql" value="create">
                            <input type="text" class="form-control" name="kdprodi" id="kdprodi"
                             value="<?php echo trim($row['kdprodi']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" name="nmprodi" id="nmprodi" value="<?php echo trim($row['nmprodi']) ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-check-label" for="exampleCheck1">Akreditasi Prodi</label>
                            <input type="radio" name="akreditasi" id="akreditasi" value="-" <?php if ($row["akreditasi"] == '-' || $row["akreditasi"] == '') {
                                                                                                echo
                                                                                                "checked=\"checked\"";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?>> -
                            <input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"] == 'A') {
                                                                                echo "checked=\"checked\"";
                                                                            } else {
                                                                                echo "";
                                                                            } ?>> A
                            <input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"] == 'B') {
                                                                                echo "checked=\"checked\"";
                                                                            } else {
                                                                                echo "";
                                                                            } ?>> B
                            <input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"] == 'C') {
                                                                                echo "checked=\"checked\"";
                                                                            } else {
                                                                                echo "";
                                                                            } ?>> C
                        </div>
                        <button type="submit" name="action" class="btn btn-primary">SIMPAN</button>
                        <a href="crud4.php?a=list" class="btn btn-warning active" aria-current="page">Batal</a>
                    </form>
                <?php } ?>
                <?php
                function edit_data($id)
                {
                    global $hub;
                    $query = "select * from dt_prodi where idprodi = $id";
                    $result = mysqli_query($hub, $query);
                    $row = mysqli_fetch_array($result); ?>


                    <div class="card mx-4 mt-5">
                        <h2 class="col-md-auto text-center mx-4 mb-4 mt-3">Edit Data Program Studi</h2>
                        <form class="mx-4 mb-4 mt-3" action="crud4.php?a=list" method="post">
                            <div class="mx-3 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Kode Prodi</label>
                                <input type="hidden" name="sql" value="update">
                                <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
                                <input type="text" class="form-control" name="kdprodi" id="kdprodi" value="<?php echo trim($row['kdprodi']) ?>">
                            </div>
                            <div class="mx-3 mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nama Prodi</label>
                                <input type="text" class="form-control" name="nmprodi" id="nmprodi" value="<?php echo trim($row['nmprodi']) ?>">
                            </div>
                            <div class="mx-3 mb-3">
                                <label class="form-check-label" for="exampleCheck1">Akreditasi Prodi</label>
                                <input type="radio" name="akreditasi" id="akreditasi" value="-" <?php if ($row["akreditasi"] == '-' || $row["akreditasi"] == '') {
                                                                                                    echo
                                                                                                    "checked=\"checked\"";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>> -
                                <input type="radio" name="akreditasi" value="A" <?php if ($row["akreditasi"] == 'A') {
                                                                                    echo "checked=\"checked\"";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>> A
                                <input type="radio" name="akreditasi" value="B" <?php if ($row["akreditasi"] == 'B') {
                                                                                    echo "checked=\"checked\"";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>> B
                                <input type="radio" name="akreditasi" value="C" <?php if ($row["akreditasi"] == 'C') {
                                                                                    echo "checked=\"checked\"";
                                                                                } else {
                                                                                    echo "";
                                                                                } ?>> C
                            </div>
                            <button type="submit" name="action" class="mx-3 btn btn-primary">UPDATE</button>
                            <a href="crud4.php?a=list" class="btn btn-warning active" aria-current="page">Batal</a>
                        </form>

                    <?php } ?>

                    <?php
                    function hapus_data($id)
                    {
                        global $hub;
                        $query = " select * from dt_prodi where idprodi = $id";
                        $result = mysqli_query($hub, $query);
                        $row = mysqli_fetch_array($result); ?>

                        <div class="card mx-4 mt-5">
                            <h2 class="col-md-auto text-center mx-4 mb-4 mt-3">Hapus Data Program Studi</h2>
                            <form class="mx-4 mb-4 mt-3" action="crud4.php?a=list" method="post">
                                <div class="mx-3 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Kode Prodi</label>
                                    <input type="hidden" name="sql" value="delete">
                                    <input type="hidden" name="idprodi" value="<?php echo trim($id) ?>">
                                    <input type="text" class="form-control" name="kdprodi" id="kdprodi" value="<?php echo trim($row['kdprodi']) ?>">
                                </div>
                                <div class="mx-3 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Nama Prodi</label>
                                    <input type="text" class="form-control" name="nmprodi" id="nmprodi" value="<?php echo trim($row['nmprodi']) ?>">
                                </div>
                                <div class="mx-3 mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Akreditasi</label>
                                    <input type="text" class="form-control" name="akrediasi" id="akreditasi" value="<?php echo trim($row["akreditasi"]) ?>">
                                </div>
                                <button type="submit" name="action" class="mx-3 btn btn-danger">DELETE</button>
                                <a href="crud4.php?a=list" class="btn btn-warning active" aria-current="page">Batal</a>

                            </form>
                        <?php } ?>

                        <?php
                        function create_prodi()
                        {
                            global $hub;
                            global $_POST;
                            $query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi) 
    VALUES";
                            $query .= " ('" . $_POST["kdprodi"] . "', '" . $_POST["nmprodi"] . "', 
    '" . $_POST["akreditasi"] . "')";


                            if (isset($_POST['action'])) {
                                $nmprodi = $_POST['nmprodi'];
                                $kdprodi = $_POST['kdprodi'];
                                $query = mysqli_query($hub, "SELECT nmprodi, kdprodi FROM dt_prodi WHERE nmprodi = '$nmprodi' OR kdprodi = '$kdprodi'");
                                if ($query->num_rows > 0) {
                                    echo "<script>alert('nmprodi atau kdprodi sudah terdaftar');</script>";
                                } else {
                                    $query = "INSERT INTO dt_prodi (kdprodi, nmprodi, akreditasi)  VALUES";
                                    $query .= " ('" . $_POST["kdprodi"] . "', '" . $_POST["nmprodi"] . "', '" . $_POST["akreditasi"] . "')";
                                    mysqli_query($hub, $query);
                                }
                            }
                        }

                        function update_prodi()
                        {
                            global $hub;
                            global $_POST;

                            $query = "UPDATE dt_prodi";
                            $query .= " SET kdprodi='" . $_POST["kdprodi"] . "', nmprodi= '" . $_POST["nmprodi"] . "', akreditasi='" . $_POST["akreditasi"] . "'";
                            $query .= " WHERE idprodi = " . $_POST["idprodi"];

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
                                mysqli_query($hub, $query) or die(mysqli_error($hub));
                            }
                        }

                        function delete_prodi()
                        {
                            global $hub;
                            global $_POST;
                            $query = " DELETE FROM dt_prodi";
                            $query .= " WHERE idprodi = " . $_POST["idprodi"];
                            mysqli_query($hub, $query);
                        }
                        ?>
</body>
<script type="text/javascript">
    function validate() {
        if (document.forms["latihan"]["kdprodi"].value == "") {
            alert("Nama Tidak Boleh Kosong");
            documentbb.forms["latihan"]["kdprodi"].focus();
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

</html>