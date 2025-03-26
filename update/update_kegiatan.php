<?php

if(isset($_GET['id_kegiatan'])){
    $id_kegiatan = $_GET['id_kegiatan'];
    $data_kegiatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kegiatan JOIN kategori USING(Id_Kategori) WHERE Id_Kegiatan = '$id_kegiatan'"));
    if (isset($_POST['update'])) {

        $kategori       = $_POST['sub_kategori'];
        $id_kegiatan    = $_POST['id_kegiatan'];
        $jenis_kegiatan = $_POST['jenis_kegiatan'];
        $angka_kredit   = $_POST['angka_kredit'];

        $update = mysqli_query($koneksi, "UPDATE kegiatan SET Jenis_Kegiatan='$jenis_kegiatan', Angka_Kredit='$angka_kredit' WHERE Id_Kegiatan='$id_kegiatan'");

        if ($update) {
            echo "<script>
            let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data telah diupdate.',
                type: 'success',
                timer: 2000,
                showConfirmButton: false,
                backdrop: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=kegiatan';
                }, 1000);
            });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        } else {
            echo "<script>
            let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Gagal!',
                text: 'Data gagal diupdate.',
                type: 'error',
                timer: 2000,
                showConfirmButton: false,
                backdrop: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=update_kegiatan&id_kegiatan=$id_kegiatan';
                }, 1000);
            });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        }
    }
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kegiatan</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Update Kegiatan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Kegiatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="id_kegiatan"
                                            value="<?= $data_kegiatan['Id_Kegiatan'] ?>">

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Jenis
                                                Kegiatan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="Project Gaya Hidup Berkelajutan" required=""
                                                    value="<?= $data_kegiatan['Jenis_Kegiatan'] ?>"
                                                    name="jenis_kegiatan">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Sub Kategori
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" name="sub_kategori" id="validationCustom05">
                                                    <?php
                                                    // Fetch all distinct sub categories from the database
                                                    $sub_kategori_query = mysqli_query($koneksi, "SELECT DISTINCT Sub_Kategori FROM kategori ORDER BY Sub_Kategori");
                                                    while ($sub_kategori_row = mysqli_fetch_assoc($sub_kategori_query)) {
                                                        $selected = ($data_kegiatan['Sub_Kategori'] == $sub_kategori_row['Sub_Kategori']) ? 'selected' : '';
                                                        echo "<option value='" . $sub_kategori_row['Sub_Kategori'] . "' $selected>" . $sub_kategori_row['Sub_Kategori'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom06">Angka Kredit
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="validationCustom06"
                                                    name="angka_kredit" placeholder="10" required=""
                                                    value="<?= $data_kegiatan['Angka_Kredit'] ?>">
                                                <div class="invalid-feedback">
                                                    Please enter a angka kredit.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="update">Update</button>
                                                <a href="dashboard.php?page=kegiatan"
                                                    class="btn light btn-warning ms-3">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->

<?php
}elseif (isset($_GET['id_kategori'])) {
    $id_kategori = $_GET['id_kategori'];
    $data_kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori WHERE Id_Kategori = '$id_kategori'"));

    if(isset($_POST['update'])){

        $sub_kategori = $_POST['sub_kategori'];

        $update = mysqli_query($koneksi, "UPDATE kategori SET Sub_Kategori='$sub_kategori' WHERE Id_Kategori = '$id_kategori'");

        if ($update) {
            echo "<script>
            let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data telah diupdate.',
                type: 'success',
                timer: 2000,
                showConfirmButton: false,
                backdrop: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=kegiatan';
                }, 1000);
            });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        } else {
            echo "<script>
            let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Gagal!',
                text: 'Data gagal diupdate.',
                type: 'error',
                timer: 2000,
                showConfirmButton: false,
                backdrop: false
            }).then(() => {
                setTimeout(() => {
                    window.location.href = 'dashboard.php?page=update_kegiatan&id_kegiatan=$id_kegiatan';
                }, 1000);
            });
                clearInterval(intervalId);
            }, 2000);
            </script>";
        }
    }
}
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kategori</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Update Kategori</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <input type="hidden" name="id_kategori"
                                            value="<?= $data_kategori['Id_Kategori'] ?>">

                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Kategori
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" readonly class="form-control" id="validationCustom07"
                                                    placeholder="" required=""
                                                    value="<?= $data_kategori['Kategori'] ?>"
                                                    name="kategori">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom05">Sub Kategori
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="validationCustom07"
                                                    placeholder="" required=""
                                                    value="<?= $data_kategori['Sub_Kategori'] ?>"
                                                    name="sub_kategori">
                                                <div class="invalid-feedback">
                                                    Please enter a url.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="update">Update</button>
                                                <a href="dashboard.php?page=kegiatan"
                                                    class="btn light btn-warning ms-3">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->