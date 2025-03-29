<?php
if (isset($_POST['tambah'])) {
    $id_pengguna = $_COOKIE['id_pengguna'];
    $nis = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT NIS from pengguna WHERE Id_Pengguna = '$id_pengguna'"))['NIS'] ?? NULL; 
    $tanggal_upload         = date('Y-m-d');
    $catatan                = $_POST['catatan'] ?? NULL;
    $status                 = $_POST['status'] ?? 'Pending';
    $tanggal_status_berubah = $_POST['tanggal_status_berubah'] ?? date('Y-m-d');
    $id_kegiatan            = $_POST['kegiatan'];
    
    if ($id_kegiatan === '') {
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: 'Data Tidak Boleh Kosong!',
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        }).then(() => {
            setTimeout(() => {
                window.location.href = 'dashboard.php?page=tambah_sertifikat';
            }, 500);
        });
        clearInterval(intervalId);
        }, 2000);
        </script>";
    }
    
    function generateCertificateName($nis) {
        $randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
        return $nis . $randomString;
    }
    
    $sertifikat         = generateCertificateName($nis);
    $sertifikat_tmp     = $_FILES['sertifikat']['tmp_name'];
    $sertifikat_error   = $_FILES['sertifikat']['error'];
    $sertifikat_size    = $_FILES['sertifikat']['size'];
    $file_ext           = strtolower(pathinfo($_FILES['sertifikat']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['pdf'];
    $max_size           = 2 * 1024 * 1024;

    if ($sertifikat_error == 0) {
        if ($sertifikat_size <= $max_size) {
            if (in_array($file_ext, $allowed_extensions)) {
                $upload_dir = '../uploads/';
        
                $upload_file = $upload_dir . $sertifikat;
                move_uploaded_file($sertifikat_tmp, $upload_file);
                
                if($nis == NULL){
                    $hasil = mysqli_query($koneksi, "INSERT INTO sertifikat (Id_Sertifikat, Tanggal_Upload, Catatan, Sertifikat, Status, Tanggal_Status_Berubah, NIS, Id_Kegiatan) VALUES(NULL, '$tanggal_upload', '$catatan', '$sertifikat', '$status', '$tanggal_status_berubah', NULL, '$id_kegiatan')");
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
                            window.location.href = 'dashboard.php?page=tambah_sertifikat';
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
                                window.location.href = 'dashboard.php?page=sertifikat';
                            }, 1000);
                        });
                            clearInterval(intervalId);
                        }, 2000);
                        </script>";
                    }
                }else{
                    $hasil = mysqli_query($koneksi, "INSERT INTO sertifikat (Id_Sertifikat, Tanggal_Upload, Catatan, Sertifikat, Status, Tanggal_Status_Berubah, NIS, Id_Kegiatan) VALUES(NULL, '$tanggal_upload', '$catatan', '$sertifikat', '$status', '$tanggal_status_berubah', '$nis', '$id_kegiatan')");
                    $id_sertifikat_query = mysqli_query($koneksi, "SELECT LAST_INSERT_ID() AS last_id");
                    $row = mysqli_fetch_assoc($id_sertifikat_query);
                    $id_sertifikat = $row['last_id'];
                    $pesan_notifikasi = "Terdapat sertifikat yang baru saja ditambahkan!";
                    $hasil_notif = mysqli_query($koneksi, "INSERT INTO notifikasi (NIS, Pesan, Status, Id_Sertifikat, isTambah) VALUES ('$nis', '$pesan_notifikasi', 'Unread', '$id_sertifikat', 1)");
                    if (!$hasil && !$hasil_notif) {
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
                            window.location.href = 'dashboard.php?page=tambah_sertifikat';
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
                                window.location.href = 'dashboard.php?page=sertifikat';
                            }, 1000);
                        });
                            clearInterval(intervalId);
                        }, 2000);
                        </script>";
                    }
                }
            } else{
                echo "<script>
                let intervalId = setInterval(function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Gambar Gagal Di Upload Pastikan Format Gambar/PDF.',
                    type: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                    backdrop: false
                }).then(() => {
                });
                    clearInterval(intervalId);
                }, 1600);
                </script>";
            }
        }else{
            echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Ukuran file maksimal 2MB.',
                type: 'error',
                timer: 2000,
                showConfirmButton: false,
                backdrop: false
            });
            </script>";
        }
    } else {
        echo "<script>
        let intervalId = setInterval(function() {
        Swal.fire({
            title: 'Gagal!',
            text: 'Gambar Gagal Di Upload.',
            type: 'error',
            timer: 2000,
            showConfirmButton: false,
            backdrop: false
        }).then(() => {
        });
            clearInterval(intervalId);
        }, 1600);
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
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Sertifikat</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Tambah Sertifikat</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Sertifikat</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-validation">
                            <form class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="sertifikatUpload">Upload
                                                Sertifikat
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <div class="file-upload-wrapper">
                                                    <input type="file"
                                                        class="file-upload-input form-file-input form-control"
                                                        id="sertifikatUpload" name="sertifikat" required="">
                                                    <div class="file-upload-box">
                                                        <i
                                                            class="fas fa-cloud-upload-alt animate__animated animate__pulse animate__infinite"></i>
                                                        <div class="file-upload-text">Drag & Drop file atau klik
                                                            untuk memilih</div>
                                                        <div class="file-upload-help">Format yang diizinkan: PDF
                                                            (Maks. 2MB)</div>
                                                        <div class="file-name"></div>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select a file.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Kategori
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <?php
                                                // Get student NIS from cookie
                                                $nis = $_COOKIE['nis'] ?? null;
                                                
                                                // If NIS is available, get categories already used by the student
                                                $used_categories = [];
                                                if ($nis) {
                                                    $query_used = mysqli_query($koneksi, 
                                                        "SELECT DISTINCT k.Id_Kategori 
                                                         FROM sertifikat s 
                                                         JOIN kegiatan kg ON s.Id_Kegiatan = kg.Id_Kegiatan 
                                                         JOIN kategori k ON kg.Id_Kategori = k.Id_Kategori 
                                                         WHERE s.NIS = '$nis'");
                                                    
                                                    while ($data_used = mysqli_fetch_assoc($query_used)) {
                                                        $used_categories[] = $data_used['Id_Kategori'];
                                                    }
                                                }
                                                ?>
                                                <select class="default-select wide form-control" name="kategori"
                                                    id="kategori">
                                                    <option data-display="Pilihan Kategori">Pilih Kategori</option>
                                                    <?php
                                                        $data_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                                                        while ($data = mysqli_fetch_assoc($data_kategori)) {
                                                            $is_used = in_array($data['Id_Kategori'], $used_categories);
                                                            $is_mandatory = strtolower($data['Kategori']) === 'wajib';
                                                            
                                                            // If category is mandatory and already used, add styling and disable
                                                            $disabled = ($is_used && $is_mandatory) ? 'disabled' : '';
                                                            $style = ($is_used && $is_mandatory) ? 'style="color: #777; background-color: #e9e9e9;"' : '';
                                                            
                                                            echo "<option value='{$data['Id_Kategori']}' $disabled $style>{$data['Sub_Kategori']} " . 
                                                                 ($is_used && $is_mandatory ? '(Sudah Diupload)' : '') . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-lg-4 col-form-label" for="validationCustom07">Kegiatan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="kegiatan" id="kegiatan" class="wide default-select form-control">
                                                    <option data-display="Pilihan Kegiatan">Pilih Kegiatan</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a one.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-8 ms-auto">
                                                <button type="submit" class="btn btn-primary"
                                                    name="tambah">Tambah</button>
                                                <a href="dashboard.php?page=sertifikat"
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
<script>
document.querySelector(".needs-validation").addEventListener("submit", function(event) {
    let inputNamaJurusan = document.getElementById("validationCustom07");

    if (inputNamaJurusan.value.trim() === "") {
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
});

// File upload preview
const fileInput = document.getElementById('sertifikatUpload');
const fileUploadBox = document.querySelector('.file-upload-box');
const fileName = document.querySelector('.file-name');

fileInput.addEventListener('change', function(e) {
    if (this.files && this.files[0]) {
        const file = this.files[0];
        fileName.textContent = file.name;
        fileName.style.display = 'block';

        if (file.type === 'application/pdf') {
            fileUploadBox.innerHTML = `
                            <i class="fas fa-file-pdf" style="font-size: 48px; color: #e74a3b;"></i>
                            <div class="file-upload-text">${file.name}</div>
                            <div class="file-upload-help">${(file.size / (1024 * 1024)).toFixed(2)} MB</div>
                        `;
        } else {
            fileUploadBox.innerHTML = `
                            <i class="fas fa-file" style="font-size: 48px; color: #4e73df;"></i>
                            <div class="file-upload-text">${file.name}</div>
                            <div class="file-upload-help">${(file.size / (1024 * 1024)).toFixed(2)} MB</div>
                        `;
        }
    }
});

// Drag and drop functionality
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    fileUploadBox.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    fileUploadBox.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    fileUploadBox.addEventListener(eventName, unhighlight, false);
});

function highlight() {
    fileUploadBox.style.borderColor = '#4e73df';
    fileUploadBox.style.backgroundColor = '#eef1ff';
}

function unhighlight() {
    fileUploadBox.style.borderColor = '#ccc';
    fileUploadBox.style.backgroundColor = '#f6f6fd';
}

fileUploadBox.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    fileInput.files = files;

    // Trigger change event
    const event = new Event('change');
    fileInput.dispatchEvent(event);
}



</script>
<!--**********************************
    Content body end
***********************************-->