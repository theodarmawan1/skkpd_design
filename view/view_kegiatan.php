<?php
if (isset($_GET['id_kegiatan'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id_kegiatan']);
    $hasil = mysqli_query($koneksi, "DELETE FROM kegiatan WHERE Id_Kegiatan = '$id'");

    if (!$hasil) {
        echo "<script>
        Swal.fire({
            title: 'Gagal!',
            text: 'Data gagal dihapus.',
            type: 'error',
            timer: 1000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'dashboard.php?page=kegiatan';
        });
        </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data telah dihapus.',
            type: 'success',
            timer: 1000,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'dashboard.php?page=kegiatan';
        });
        </script>";
    }
}

// Logic untuk pencarian
$where_clause = "";
if(isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $where_clause = " WHERE k.Jenis_Kegiatan LIKE '%$keyword%' OR kat.Sub_Kategori LIKE '%$keyword%' OR kat.Kategori LIKE '%$keyword%'";
}
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Table</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kegiatan</a></li>
            </ol>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Tabel Kegiatan</h4>
                        <div class="d-flex align-items-center">
                            <!-- Search Input -->
                            <div class="input-group me-2 position-relative" style="width: 250px;">
                                <input type="text" class="form-control" id="live-search" placeholder="Cari kegiatan..." autocomplete="off">
                                <div class="spinner-border spinner-border-sm text-primary position-absolute end-0 top-50 translate-middle-y me-2" id="search-spinner" style="display: none;"></div>
                            </div>
                            <div id="search-info" class="me-2" style="display: none;">
                                <small class="text-muted">Ditemukan <span id="result-count">0</span> hasil</small>
                            </div>
                            <button id="reset-search" class="btn btn-sm btn-outline-secondary text-white me-2" style="display: none;">Reset</button>
                            <a href="dashboard.php?page=tambah_kegiatan" class="btn btn-rounded btn-info">
                                <span class="btn-icon-start text-info"><i class="fa fa-plus color-secondary"></i></span>Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Angka Kredit/Point</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="kegiatan-tbody">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategori kat INNER JOIN kegiatan k ON kat.Id_Kategori = k.Id_Kategori ORDER BY kat.Sub_Kategori");
                                    $last_kategori_id = null;
                                    $no = 1;

                                    while ($baris = mysqli_fetch_assoc($query)) {
                                        if ($last_kategori_id !== $baris['Id_Kategori']) {
                                            if ($last_kategori_id !== null) {
                                                echo "<tr class='spacer-row'><td colspan='5'>&nbsp;</td></tr>";
                                            }
                                            
                                            // Menentukan apakah kategori Opsional atau Wajib
                                            $jenis_kategori = (strpos(strtolower($baris['Kategori']), 'wajib') !== false) ? 'Wajib' : 'Opsional';
                                            
                                            echo "<tr class='bg-kegiatan kategori-header' data-kategori='" . htmlspecialchars($baris['Sub_Kategori']) . "'>
                                                    <td colspan='3'>
                                                        <div style='display: flex; align-items: center;'><div class='btn btn-danger p-2 me-3 sertifikat_kategori'>
                                                            <h5 class='mb-0'>{$jenis_kategori}</h5>
                                                        </div>
                                                        <h3 class='mt-2'>" . htmlspecialchars($baris['Sub_Kategori']) . "</h3></div>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href='dashboard.php?page=update_kegiatan&id_kategori=" . htmlspecialchars($baris['Id_Kategori']) . "' class='btn btn-primary shadow sharp'>
                                                        <i class='fas fa-pencil-alt'></i>
                                                        </a>
                                                    </td>
                                                </tr>" ; $no=1; } 
                                    ?>
                                <tr class="kegiatan-row" data-kategori="<?= htmlspecialchars($baris['Sub_Kategori']) ?>">
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($baris['Jenis_Kegiatan']) ?></td>
                                    <td>
                                        <div class="badge badge-primary rounded-circle p-2 d-flex justify-content-center align-items-center"
                                            style="height: 35px; width: 35px;">
                                            <?= htmlspecialchars($baris['Angka_Kredit']) ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="dashboard.php?page=update_kegiatan&id_kegiatan=<?= $baris['Id_Kegiatan'] ?>"
                                                class="btn btn-primary shadow btn-xs sharp me-1">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <?php
                                                $id = $baris['Id_Kegiatan'];
                                                $cek = mysqli_query($koneksi, "SELECT Id_Kegiatan FROM sertifikat  WHERE Id_Kegiatan = '$id'");
                                                if(mysqli_num_rows($cek) > 0){
                                                    echo "";
                                                }else {
                                            ?>
                                                <a onclick="confirmDelete(<?= $baris['Id_Kegiatan'] ?>)"
                                                class="btn btn-danger shadow btn-xs sharp">
                                                <i class="fa fa-trash"></i>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                        $last_kategori_id = $baris['Id_Kategori'];
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="empty-state-message" style="display: none;" class="text-center py-5 my-4">
                                <div class="mb-3">
                                    <i class="fas fa-search text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="text-muted">Tidak ada hasil pencarian</h4>
                                <p class="text-muted">Tidak ditemukan kegiatan yang sesuai dengan kriteria pencarian</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data akan dihapus dan tidak bisa dikembalikan!",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location.href = 'dashboard.php?page=kegiatan&id_kegiatan=' + id;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('live-search');
    const searchSpinner = document.getElementById('search-spinner');
    const searchInfo = document.getElementById('search-info');
    const resultCount = document.getElementById('result-count');
    const resetButton = document.getElementById('reset-search');
    const kegiatanRows = document.querySelectorAll('.kegiatan-row');
    const kategoriHeaders = document.querySelectorAll('.kategori-header');
    const spacerRows = document.querySelectorAll('.spacer-row');
    const emptyStateMessage = document.getElementById('empty-state-message');
    const tableBody = document.getElementById('kegiatan-tbody');
    
    // Variabel untuk throttling
    let searchTimeout = null;
    
    // Live search ketika mengetik
    searchInput.addEventListener('input', function() {
        const keyword = this.value.trim().toLowerCase();
        
        // Tampilkan spinner
        searchSpinner.style.display = 'block';
        
        // Clear timeout sebelumnya jika ada
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        
        // Set timeout baru (throttling untuk mengurangi beban)
        searchTimeout = setTimeout(() => {
            performSearch(keyword);
        }, 300); // 300ms delay
    });
    
    // Reset pencarian
    resetButton.addEventListener('click', function() {
        searchInput.value = '';
        performSearch('');
        this.style.display = 'none';
    });
    
    // Fungsi untuk melakukan pencarian
    function performSearch(keyword) {
        // Sembunyikan spinner setelah search selesai
        searchSpinner.style.display = 'none';
        
        // Reset highlights
        document.querySelectorAll('.highlight-text').forEach(el => {
            el.outerHTML = el.textContent;
        });
        
        if (keyword === '') {
            // Jika keyword kosong, tampilkan semua rows dan headers
            kegiatanRows.forEach(row => {
                row.style.display = '';
            });
            
            kategoriHeaders.forEach(header => {
                header.style.display = '';
            });
            
            spacerRows.forEach(row => {
                row.style.display = '';
            });
            
            // Sembunyikan info pencarian dan reset button
            searchInfo.style.display = 'none';
            resetButton.style.display = 'none';
            emptyStateMessage.style.display = 'none';
            
            return;
        }
        
        // Tampilkan tombol reset
        resetButton.style.display = 'block';
        
        // Variabel untuk tracking
        let matchCount = 0;
        let visibleKategori = new Set();
        
        // Cari di rows kegiatan
        kegiatanRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const kategoriName = row.getAttribute('data-kategori');
            
            if (rowText.includes(keyword)) {
                row.style.display = '';
                matchCount++;
                visibleKategori.add(kategoriName);
                highlightMatches(row, keyword);
            } else {
                row.style.display = 'none';
            }
        });
        
        // Tampilkan atau sembunyikan headers kategori sesuai hasil pencarian
        kategoriHeaders.forEach(header => {
            const kategoriName = header.getAttribute('data-kategori');
            if (visibleKategori.has(kategoriName) || header.textContent.toLowerCase().includes(keyword)) {
                header.style.display = '';
                if (header.textContent.toLowerCase().includes(keyword)) {
                    highlightMatches(header, keyword);
                }
            } else {
                header.style.display = 'none';
            }
        });
        
        // Sembunyikan spacer rows
        spacerRows.forEach(row => {
            row.style.display = 'none';
        });
        
        // Tampilkan info hasil pencarian
        resultCount.textContent = matchCount;
        searchInfo.style.display = 'block';
        
        // Tampilkan pesan kosong jika tidak ada hasil
        if (matchCount === 0) {
            emptyStateMessage.style.display = 'block';
        } else {
            emptyStateMessage.style.display = 'none';
        }
    }
    
    // Fungsi untuk highlight teks yang cocok
    function highlightMatches(element, keyword) {
        // Fungsi rekursif untuk mencari dan highlight teks
        function searchAndHighlight(node) {
            if (node.nodeType === 3) { // Text node
                const text = node.nodeValue;
                const lowerText = text.toLowerCase();
                const lowerKeyword = keyword.toLowerCase();
                
                if (lowerText.includes(lowerKeyword)) {
                    const parts = [];
                    let lastIndex = 0;
                    let index;
                    
                    // Find all instances of the keyword
                    while ((index = lowerText.indexOf(lowerKeyword, lastIndex)) > -1) {
                        // Add text before match
                        if (index > lastIndex) {
                            parts.push(document.createTextNode(text.substring(lastIndex, index)));
                        }
                        
                        // Add highlighted match
                        const span = document.createElement('span');
                        span.className = 'highlight-text';
                        span.style.backgroundColor = '#ffff00';
                        span.style.color = '#000';
                        span.textContent = text.substring(index, index + keyword.length);
                        parts.push(span);
                        
                        lastIndex = index + keyword.length;
                    }
                    
                    // Add remaining text
                    if (lastIndex < text.length) {
                        parts.push(document.createTextNode(text.substring(lastIndex)));
                    }
                    
                    // Replace original node with highlighted parts
                    const fragment = document.createDocumentFragment();
                    parts.forEach(part => fragment.appendChild(part));
                    node.parentNode.replaceChild(fragment, node);
                    return true;
                }
            } else if (node.nodeType === 1 && // Element node
                node.nodeName !== 'SCRIPT' &&
                node.nodeName !== 'STYLE' &&
                !node.classList.contains('highlight-text')) {
                // Process child nodes
                Array.from(node.childNodes).forEach(child => {
                    searchAndHighlight(child);
                });
            }
            return false;
        }
        
        searchAndHighlight(element);
    }
});
</script>