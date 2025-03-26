<?php
// Initialize variables
$selected_kategori = '';
$sub_kategori_options = '';

// Check if kategori is set (either from GET or POST)
if (isset($_GET['kategori']) && $_GET['kategori'] != '') {
    $selected_kategori = $_GET['kategori'];
} elseif (isset($_POST['kategori']) && $_POST['kategori'] != '') {
    $selected_kategori = $_POST['kategori'];
}

// If kategori is selected, load sub-categories
if ($selected_kategori != '') {
    // Fetch sub categories for the selected category
    $sub_query = mysqli_query($koneksi, "SELECT Sub_Kategori FROM kategori WHERE Kategori = '$selected_kategori' ORDER BY Sub_Kategori");
    
    // Create options for sub categories
    while ($sub_row = mysqli_fetch_assoc($sub_query)) {
        $sub_kategori_options .= "<option value='" . $sub_row['Sub_Kategori'] . "'>" . $sub_row['Sub_Kategori'] . "</option>";
    }
}

// Handle the form submission for adding data
if (isset($_POST['tambah'])) {
    $sub_kategori = $_POST['sub_kategori'];
    $jenis_kegiatan = $_POST['jenis_kegiatan'];
    $angka_kredit = $_POST['angka_kredit'];
    
    // Get the Id_Kategori based on selected sub-category
    $id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT Id_Kategori FROM kategori WHERE Sub_Kategori = '$sub_kategori'"));
    
    if($id == NULL){
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: 'Nama kategori tidak terdaftar.',
            type: 'error',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
        }).then(() => {
        });
            clearInterval(intervalId);
        }, 1600);
        </script>";
    } else {
        $last_id = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT LAST_INSERT_ID()"))['LAST_INSERT_ID()'];
        $id_kategori = $id['Id_Kategori'];

        $hasil = mysqli_query($koneksi, "INSERT INTO kegiatan (Id_Kegiatan, Jenis_Kegiatan, Angka_Kredit, Id_Kategori) 
                            VALUES('$last_id', '$jenis_kegiatan', '$angka_kredit', '$id_kategori')");

        if (!$hasil) {
            echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: 'Data gagal ditambahkan.',
            type: 'error',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
        }).then(() => {
            setTimeout(() => {
                window.location.href = 'dashboard.php?page=tambah_kegiatan';
            }, 1000);
        });
            clearInterval(intervalId);
        }, 2000);
        </script>";
        } else {
            echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah ditambahkan.',
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Kegiatan</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Kegiatan</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Kegiatan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationKategori">Kategori
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="default-select wide form-control" name="kategori" id="validationKategori" onchange="this.form.action='?page=tambah_kegiatan&kategori='+this.value; this.form.submit();">
                                                    <option value="" selected>Pilih Kategori</option>
                                                    <?php
                                                    // Fetch all distinct categories from the database
                                                    $kategori_query = mysqli_query($koneksi, "SELECT DISTINCT Kategori FROM kategori ORDER BY Kategori");
                                                    while ($kategori_row = mysqli_fetch_assoc($kategori_query)) {
                                                        $selected = ($kategori_row['Kategori'] == $selected_kategori) ? 'selected' : '';
                                                        echo "<option value='" . $kategori_row['Kategori'] . "' $selected>" . $kategori_row['Kategori'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih kategori.
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Only show these fields if a category is selected -->
                                        <?php if ($selected_kategori != ''): ?>
                                        <div id="additionalFields">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationSubKategori">Sub Kategori
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select class="default-select wide form-control" name="sub_kategori" id="validationSubKategori" required>
                                                        <option value="">Pilih Sub Kategori</option>
                                                        <?php echo $sub_kategori_options; ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Silahkan pilih sub kategori.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationJenisKegiatan">Jenis Kegiatan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="validationJenisKegiatan"
                                                        placeholder="Project Gaya Hidup Berkelajutan" required=""
                                                        name="jenis_kegiatan">
                                                    <div class="invalid-feedback">
                                                        Silahkan masukkan jenis kegiatan.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationAngkaKredit">Angka Kredit
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="number" class="form-control" id="validationAngkaKredit"
                                                        name="angka_kredit" placeholder="10" required="">
                                                    <div class="invalid-feedback">
                                                        Silahkan masukkan angka kredit.
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <div class="col-lg-8 ms-auto">
                                                    <!-- Include hidden field to preserve selected kategori when submitting -->
                                                    <input type="hidden" name="kategori" value="<?php echo $selected_kategori; ?>">
                                                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                                                    <a href="dashboard.php?page=kegiatan" class="btn light btn-warning ms-3">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
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

<script>
document.querySelector(".needs-validation").addEventListener("submit", function(event) {
    // Only validate if the form has the "tambah" button (not just category selection)
    if (event.submitter && event.submitter.name === 'tambah') {
        let subKategori = document.getElementById("validationSubKategori");
        let jenisKegiatan = document.getElementById("validationJenisKegiatan");
        let angkaKredit = document.getElementById("validationAngkaKredit");

        if (subKategori.value.trim() === "" || jenisKegiatan.value.trim() === "" || angkaKredit.value.trim() === "") {
            event.preventDefault(); // Mencegah form dikirim
            event.stopPropagation();
            let intervalId = setInterval(function() {
                Swal.fire({
                    title: "Error!",
                    text: "Data tidak boleh kosong!",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false
                });
                clearInterval(intervalId);
            }, 2000);
        }
    }
});
</script>
<!--**********************************
    Content body end
***********************************-->