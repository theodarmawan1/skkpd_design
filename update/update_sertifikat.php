<?php

$id_sertifikat = $_GET['id_sertifikat'];
$data_sertifikat = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM sertifikat RIGHT JOIN kegiatan USING(Id_Kegiatan) JOIN siswa USING(NIS) JOIN kategori USING(Id_Kategori) JOIN jurusan USING(Id_Jurusan) WHERE Id_Sertifikat = '$id_sertifikat'"));

if (isset($_POST['update-approved'])) {
    $status = "Approved";
    $tanggal_status_berubah = date('Y-m-d');
    
    $update = mysqli_query($koneksi, "UPDATE sertifikat SET Status='$status', Tanggal_Status_Berubah='$tanggal_status_berubah' WHERE Id_Sertifikat='$id_sertifikat'");
    
    $pesan = "Sertifikat-mu baru saja diubah oleh Admin menjadi $status";
    mysqli_query($koneksi, "INSERT INTO notifikasi (NIS, Pesan, Status, Id_Sertifikat) VALUES ('{$data_sertifikat['NIS']}', '$pesan', 'Unread', '$id_sertifikat')");
    
    if ($update) {
        echo "<script>
        let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Status sertifikat telah diupdate menjadi Approved.',
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

if (isset($_POST['update-canceled'])) {
    $status = "Canceled";
    $catatan = $_POST['catatan'];
    $tanggal_status_berubah = date('Y-m-d');
    
    $update = mysqli_query($koneksi, "UPDATE sertifikat SET Status='$status', Catatan='$catatan', Tanggal_Status_Berubah='$tanggal_status_berubah' WHERE Id_Sertifikat='$id_sertifikat'");
    
    $pesan = "Sertifikat-mu baru saja diubah oleh Admin menjadi $status";
    mysqli_query($koneksi, "INSERT INTO notifikasi (NIS, Pesan, Status, Id_Sertifikat) VALUES ('{$data_sertifikat['NIS']}', '$pesan', 'Unread', '$id_sertifikat')");
    
    if ($update) {
        echo "<script>
        let intervalId = setInterval(function() {
            Swal.fire({
                title: 'Berhasil!',
                text: 'Status sertifikat telah diupdate menjadi Canceled.',
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
?>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Sertifikat</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Detail Sertifikat</a></li>
            </ol>
        </div>
        <!-- row -->
        <div class="row">
            <!-- Left side: PDF Preview -->
            <div class="col-lg-7">
                <div class="preview-column">
                    <div class="preview-header">
                        <h3 class="preview-title">
                            <i class="fas fa-file-pdf"></i>
                            Preview Sertifikat
                        </h3>
                    </div>
                    <div class="preview-container">
                        <div id="pdfContainer">
                            <div class="file-info">
                                <i class="fas fa-file-pdf file-icon"></i>
                                <div class="file-details">
                                    <strong id="currentFileName"><?= $data_sertifikat['Sertifikat'] ?></strong>
                                </div>
                            </div>
                            <!-- PDF Viewer -->
                            <embed src="../uploads/<?= $data_sertifikat['Sertifikat'] ?>" class="pdf-viewer"
                                type="application/pdf">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right side: Certificate Details and Actions -->
            <div class="col-lg-5">
                <div class="card h-auto">
                    <div class="card-header">
                        <h4 class="card-title">Detail Siswa</h4>
                    </div>
                    <div class="card-body">
                        <div class="student-info mb-4">
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Nama:</strong></div>
                                <div class="col-sm-8"><?= $data_sertifikat['Nama_Siswa'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>NIS:</strong></div>
                                <div class="col-sm-8"><?= $data_sertifikat['NIS'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Jurusan:</strong></div>
                                <div class="col-sm-8"><?= $data_sertifikat['Jurusan'] ?></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Tanggal Upload:</strong></div>
                                <div class="col-sm-8"><?= date('d M Y', strtotime($data_sertifikat['Tanggal_Upload'])) ?></div>
                            </div>
                        </div>
                        
                        <h4 class="mb-3">Kategori Kegiatan</h4>
                        <div class="category-info mb-4">
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Kategori:</strong></div>
                                <div class="col-sm-8">
                                    <span class="badge light badge-primary"><?= $data_sertifikat['Sub_Kategori'] ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Kegiatan:</strong></div>
                                <div class="col-sm-8">
                                    <span class="badge light badge-info"><?= $data_sertifikat['Jenis_Kegiatan'] ?></span>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Status:</strong></div>
                                <div class="col-sm-8">
                                    <?php
                                    $badge_class = '';
                                    switch($data_sertifikat['Status']) {
                                        case 'Approved':
                                            $badge_class = 'badge-success';
                                            break;
                                        case 'Canceled':
                                            $badge_class = 'badge-danger';
                                            break;
                                        default:
                                            $badge_class = 'badge-warning';
                                    }
                                    ?>
                                    <span class="badge light <?= $badge_class ?>"><?= $data_sertifikat['Status'] ?></span>
                                </div>
                            </div>
                            <?php if($data_sertifikat['Catatan']): ?>
                            <div class="row mb-2">
                                <div class="col-sm-4"><strong>Catatan:</strong></div>
                                <div class="col-sm-8"><?= $data_sertifikat['Catatan'] ?></div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <?php if ($data_sertifikat['Status'] !== 'Approved' && $data_sertifikat['Status'] !== 'Canceled'): ?>
                        <div class="status-actions">
                            <div id="action-buttons" class="d-flex justify-content-between mt-4">
                                <button id="btn-cancel" class="btn btn-danger" onclick="showCancelForm()">Canceled</button>
                                <button type="button" id="btn-batal" style="display: none;" class="btn btn-info light" onclick="hideCancelForm()">Batal</button>
                                <button id="btn-approve" class="btn btn-success" onclick="approveStatus()">Approved</button>
                            </div>
                            
                            <div id="cancel-form" style="display: none;" class="mt-3">
                                <form method="post" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea class="form-control p-4" id="catatan" name="catatan" rows="10" cols="38" placeholder="Alasan pembatalan sertifikat..." style="height: 7rem;" ></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" name="update-canceled" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                            
                            <form id="approve-form" method="post" style="display: none;">
                                <input type="hidden" name="update-approved" value="1">
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="dashboard.php?page=sertifikat" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Sertifikat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Function to show cancel form
function showCancelForm() {
    document.getElementById('action-buttons').style.display = 'none';
    document.getElementById('cancel-form').style.display = 'block';
    document.getElementById('btn-batal').style.display = 'block';
    document.getElementById('btn-cancel').style.display = 'none';
    document.getElementById('btn-approve').style.display = 'none';
}

// Function to hide cancel form
function hideCancelForm() {
    document.getElementById('cancel-form').style.display = 'none';
    document.getElementById('action-buttons').style.display = 'flex';
    document.getElementById('btn-batal').style.display = 'none';
    document.getElementById('btn-cancel').style.display = 'block';
    document.getElementById('btn-approve').style.display = 'block';
}

// Function to approve status immediately
function approveStatus() {
    document.getElementById('approve-form').submit();
}

document.querySelector(".needs-validation").addEventListener("submit", function(event) {
    let inputNamaJurusan = document.getElementById("catatan");

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
        }, 600);
    }
});

</script>