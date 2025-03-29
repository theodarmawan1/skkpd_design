(function($) {
    /* "use strict" aktif untuk mode ketat JavaScript, 
       membantu menangkap kesalahan pengkodean yang biasa diabaikan */
	
    // Fungsi utama untuk mengelola daftar chart
    var chartlist = function(){

        // Fungsi untuk membuat bar chart pertama (Total Sertifikat Aktif)
        var chartBar = function(chartData){
            
            var options = {
                // Data series untuk chart, mengambil data sertifikat aktif dari setiap jurusan
                series: [
                    {
                        name: 'Total Sertifikat',
                        // Mengambil data dari objek chartData untuk jurusan RPL, TKJ, AN, dan DKV
                        data: [chartData.rpl_a, chartData.tkj_a, chartData.an_a, chartData.dkv_a],
                    } 
                ],
                // Konfigurasi dasar chart
                chart: {
                    type: 'bar', // Tipe chart adalah batang
                    height: 417, // Tinggi chart
                    toolbar: {
                        show: false, // Sembunyikan toolbar
                    },
                },
                // Opsi untuk mengatur tampilan batang
                plotOptions: {
                    bar: {
                        horizontal: false, // Batang vertikal
                        columnWidth: '57%', // Lebar kolom
                        endingShape: "rounded", // Ujung batang membulat
                        borderRadius: 12, // Radius sudut batang
                    },
                },
                // Pengaturan warna, label, dan tooltip
                states: { hover: { filter: 'none' } },
                colors:['#FFA26D', '#FF5ED2'],
                dataLabels: { enabled: false },
                legend: { show: false },
                // Pengaturan sumbu x (kategori jurusan)
                xaxis: {
                    categories: ['RPL', 'TKJ', 'AN', 'DKV'],
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                // Tooltip untuk menampilkan jumlah sertifikat
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " sertifikat"
                        }
                    }
                },
            };

            // Render chart
            var chartBar1 = new ApexCharts(document.querySelector("#chartBar"), options);
            chartBar1.render();
        }

        // Fungsi untuk membuat bar chart kedua (Total Sertifikat Pending)
        var chartBar1 = function(chartData){
            
            var options = {
                // Serupa dengan chartBar, tapi menggunakan data sertifikat pending
                series: [
                    {
                        name: 'Total Sertifikat',
                        data: [chartData.rpl_p, chartData.tkj_p, chartData.an_p, chartData.dkv_p],
                    } 
                ],
                chart: {
                    type: 'bar',
                    height: 417,
                    toolbar: { show: false },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '57%',
                        endingShape: "rounded",
                        borderRadius: 12,
                    },
                },
                // Pengaturan yang sama dengan chartBar
                states: { hover: { filter: 'none' } },
                colors:['#FFA26D', '#FF5ED2'],
                dataLabels: { enabled: false },
                legend: { show: false },
                xaxis: {
                    categories: ['RPL', 'TKJ', 'AN', 'DKV'],
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " sertifikat"
                        }
                    }
                },
            };

            // Render chart
            var chartBar1 = new ApexCharts(document.querySelector("#chartBar1"), options);
            chartBar1.render();
        }

        // Fungsi untuk membuat bar chart ketiga (Total Sertifikat Canceled)
        var chartBar2 = function(chartData){
            
            var options = {
                // Serupa dengan chartBar, tapi menggunakan data sertifikat canceled
                series: [
                    {
                        name: 'Total Sertifikat',
                        data: [chartData.rpl_c, chartData.tkj_c, chartData.an_c, chartData.dkv_c],
                    } 
                ],
                chart: {
                    type: 'bar',
                    height: 417,
                    toolbar: { show: false },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '57%',
                        endingShape: "rounded",
                        borderRadius: 12,
                    },
                },
                // Pengaturan yang sama dengan chartBar
                states: { hover: { filter: 'none' } },
                colors:['#FFA26D', '#FF5ED2'],
                dataLabels: { enabled: false },
                legend: { show: false },
                xaxis: {
                    categories: ['RPL', 'TKJ', 'AN', 'DKV'],
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " sertifikat"
                        }
                    }
                },
            };

            // Render chart
            var chartBar1 = new ApexCharts(document.querySelector("#chartBar2"), options);
            chartBar1.render();
        }

        // Fungsi untuk membuat donut chart status sertifikat
        var donutchart = function(chartData) {
            // Hitung total sertifikat
            var total = chartData.approved + chartData.pending + chartData.canceled;

            // Jika total 0, tambahkan data dummy agar chart tetap terlihat
            var seriesData = total === 0 ? [1, 1, 1] : [
                parseInt(chartData.approved), 
                parseInt(chartData.pending), 
                parseInt(chartData.canceled)
            ];

            var options = {
                // Data seri untuk donut chart
                series: seriesData,
                // Label untuk setiap bagian chart
                labels: ['Approved', 'Pending', 'Canceled'],
                chart: {
                    type: 'donut',
                    height: 237 // Tinggi chart
                },
                // Aktifkan label data
                dataLabels: { 
					enabled: true, 
					style: { fontSize: '18px', fontWeight: '600'},},
                // Hapus garis tepi
                stroke: { width: 0 },
                // Warna untuk setiap bagian chart
                colors: ['#61CFF1', '#FFC67B', '#FF86B1'],
                // Pengaturan legenda
                legend: {
                    position: 'bottom',
                    show: true,
                    labels: {
                        colors: 'var(--primary)',
                        useSeriesColors: true,
                        fontWeight: '600',
                        fontFamily: 'Poppins, sans-serif',
                    }
                },
                // Tooltip untuk menampilkan jumlah sertifikat
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: function(val) {
                            return val + " Sertifikat";
                        }
                    }
                },
                // Responsif untuk berbagai ukuran layar
                responsive: [{
                    breakpoint: 1800,
                    options: {
                        chart: { height: 237 }
                    }
                }]
            };

            // Render chart
            var chart = new ApexCharts(document.querySelector("#donutchart"), options);
            chart.render();
        };

        // Fungsi untuk membuat bar chart total siswa per jurusan
        var chartBarSiswa = function(chartData){
            
            var options = {
                // Data seri untuk total siswa per jurusan
                series: [
                    {
                        name: 'Total Siswa',
                        data: [
                            chartData.siswa_rpl, 
                            chartData.siswa_tkj, 
                            chartData.siswa_an, 
                            chartData.siswa_dkv
                        ],
                    } 
                ],
                chart: {
                    type: 'bar',
                    height: 260,
                    toolbar: { show: false },
                },
                // Pengaturan tampilan batang
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '57%',
                        endingShape: "rounded",
                        borderRadius: 12,
                    },
                },
                // Pengaturan warna dan style
                states: { hover: { filter: 'none' } },
                colors:['#FF5ED2'],
                dataLabels: { enabled: false },
                legend: { show: false },
                // Kategori jurusan
                xaxis: {
                    categories: ['RPL', 'TKJ', 'AN', 'DKV'],
                    labels: {
                        style: {
                            colors: '#787878',
                            fontSize: '13px',
                            fontFamily: 'poppins',
                        },
                    },
                },
                // Tooltip untuk menampilkan jumlah siswa
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return "" + val + " siswa"
                        }
                    }
                },
            };

            // Render chart
            var chartBar1 = new ApexCharts(document.querySelector("#chartBarSiswa"), options);
            chartBar1.render();
        }

        // Objek return untuk fungsi utama
        return {
            // Fungsi load untuk mengambil data chart dari API
            load:function(){
                fetch("../api/get_chart_data.php")
                .then(response => response.json())
                .then(chartData => {
                    // Panggil fungsi chart dengan data yang diambil
                    donutchart(chartData);
                    chartBar(chartData);
                    chartBar1(chartData);
                    chartBar2(chartData);
                    chartBarSiswa(chartData);
                    // Pastikan donut chart bersih sebelum dirender
                    document.querySelector("#donutchart").innerHTML = ""; 
                    donutchart(chartData);
                })
                .catch(error => console.error("Error fetching data:", error));
            },
            
            // Fungsi resize (kosong untuk saat ini)
            resize:function(){}
        }
    
    }();

    // Jalankan fungsi load saat window selesai dimuat, dengan delay 1 detik
    jQuery(window).on('load',function(){
        setTimeout(function(){
            chartlist.load();
        }, 1000); 
    });

})(jQuery);