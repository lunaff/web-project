function loadJumlahSiswa() {
    fetch("/report/jumlah-siswa") // Panggil endpoint Laravel
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data); // Debugging

            if (data.total_siswa !== undefined && data.total_siswi !== undefined) {
                document.getElementById("jumlah-siswa").innerText = data.total_siswa;
                document.getElementById("jumlah-siswi").innerText = data.total_siswi;
            } else {
                document.getElementById("jumlah-siswa").innerText = "N/A";
                document.getElementById("jumlah-siswi").innerText = "N/A";
            }
        })
        .catch(error => {
            console.error("Error fetching jumlah siswa:", error);
            document.getElementById("jumlah-siswa").innerText = "Error";
            document.getElementById("jumlah-siswi").innerText = "Error";
        });
}

// Panggil fungsi saat halaman selesai dimuat
document.addEventListener("DOMContentLoaded", loadJumlahSiswa);

document.addEventListener("DOMContentLoaded", function () {
    const selectTahun = document.getElementById("filter-tahun-kasus");
    const tahunSekarang = new Date().getFullYear();

    // Generate 4 tahun terakhir
    for (let i = 0; i < 4; i++) {
        const tahun = tahunSekarang - i;
        const option = document.createElement("option");
        option.value = tahun;
        option.textContent = tahun;
        selectTahun.appendChild(option);
    }

    // Set tahun default ke tahun ini
    selectTahun.value = tahunSekarang;
    loadChartKasus(tahunSekarang);

    // Event Listener saat tahun diubah
    selectTahun.addEventListener("change", function () {
        loadChartKasus(this.value);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const selectTahun = document.getElementById("filter-tahun-prestasi");
    const tahunSekarang = new Date().getFullYear();

    // Generate 4 tahun terakhir
    for (let i = 0; i < 4; i++) {
        const tahun = tahunSekarang - i;
        const option = document.createElement("option");
        option.value = tahun;
        option.textContent = tahun;
        selectTahun.appendChild(option);
    }

    // Set tahun default ke tahun ini
    selectTahun.value = tahunSekarang;
    loadChartPrestasi(tahunSekarang);

    // Event Listener saat tahun diubah
    selectTahun.addEventListener("change", function () {
        loadChartPrestasi(this.value);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const selectTahun = document.getElementById("filter-tahun-pembinaan");
    const tahunSekarang = new Date().getFullYear();

    // Generate 4 tahun terakhir
    for (let i = 0; i < 4; i++) {
        const tahun = tahunSekarang - i;
        const option = document.createElement("option");
        option.value = tahun;
        option.textContent = tahun;
        selectTahun.appendChild(option);
    }

    // Set tahun default ke tahun ini
    selectTahun.value = tahunSekarang;
    loadChartPembinaan(tahunSekarang);

    // Event Listener saat tahun diubah
    selectTahun.addEventListener("change", function () {
        loadChartPembinaan(this.value);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const selectTahun = document.getElementById("filter-tahun-pelanggaran");
    const tahunSekarang = new Date().getFullYear();

    // Generate 4 tahun terakhir
    for (let i = 0; i < 4; i++) {
        const tahun = tahunSekarang - i;
        const option = document.createElement("option");
        option.value = tahun;
        option.textContent = tahun;
        selectTahun.appendChild(option);
    }

    // Set tahun default ke tahun ini
    selectTahun.value = tahunSekarang;
    loadChartPelanggaran(tahunSekarang);

    // Event Listener saat tahun diubah
    selectTahun.addEventListener("change", function () {
        loadChartPelanggaran(this.value);
    });
});

function loadChartKasus(tahun) {
    console.log("Mengambil data laporan untuk tahun:", tahun);

    fetch(`/report/laporan-kasus?tahun=${tahun}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);

            const chartContainer = document.querySelector("#chart-laporan-kasus");
            chartContainer.innerHTML = ""; // Hapus chart lama

            const options = {
                series: [{ name: "Jumlah Kasus", data: data }],
                chart: { type: "bar", height: 300 },
                xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"] },
                yaxis: {
                    title: { text: "Jumlah Kasus" },
                    labels: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di sumbu Y
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di tooltip
                        }
                    }
                },
                colors: ["#1f58c7"],
                fill: { opacity: 1 }
            };

            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        })
        .catch(error => console.error("Error fetching data:", error));
}

function loadChartPrestasi(tahun) {
    console.log("Mengambil data laporan untuk tahun:", tahun);

    fetch(`/report/prestasi?tahun=${tahun}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);

            const chartContainer = document.querySelector("#chart-prestasi");
            chartContainer.innerHTML = ""; // Hapus chart lama

            const options = {
                series: [{ name: "Jumlah Prestasi", data: data }],
                chart: { type: "bar", height: 300 },
                xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"] },
                yaxis: {
                    title: { text: "Jumlah Prestasi" },
                    labels: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di sumbu Y
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di tooltip
                        }
                    }
                },
                colors: ["#1f58c7"],
                fill: { opacity: 1 }
            };

            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        })
        .catch(error => console.error("Error fetching data:", error));
}

function loadChartPembinaan(tahun) {
    fetch(`/report/pembinaan?tahun=${tahun}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);

            const chartContainer = document.querySelector("#chart-pembinaan");
            chartContainer.innerHTML = ""; // Hapus chart lama

            const options = {
                series: [{ name: "Jumlah Pembinaan", data: data }],
                chart: { type: "line", height: 350, zoom: { enabled: false }},
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
                },
                yaxis: {
                    title: { text: "Jumlah Pembinaan" },
                    labels: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di sumbu Y
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di tooltip
                        }
                    }
                },
                colors: ["#1f58c7"],
                stroke: { curve: 'smooth' }
            };

            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        })
        .catch(error => console.error("Error fetching data:", error));
}

function loadChartPelanggaran(tahun) {
    fetch(`/report/pelanggaran?tahun=${tahun}`)
        .then(response => response.json())
        .then(data => {
            console.log("Data dari server:", data);

            const chartContainer = document.querySelector("#chart-pelanggaran");
            chartContainer.innerHTML = ""; // Hapus chart lama

            const options = {
                series: [{ name: "Jumlah Pelanggaran", data: data }],
                chart: { type: "line", height: 350, zoom: { enabled: false }},
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
                },
                yaxis: {
                    title: { text: "Jumlah Pelanggaran" },
                    labels: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di sumbu Y
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function (value) {
                            return Math.round(value); // Membulatkan angka di tooltip
                        }
                    }
                },
                colors: ["#1f58c7"],
                stroke: { curve: 'smooth' }
            };

            const chart = new ApexCharts(chartContainer, options);
            chart.render();
        })
        .catch(error => console.error("Error fetching data:", error));
}

document.addEventListener("DOMContentLoaded", function () {
    fetch("/report/top-kasus") // Panggil endpoint yang udah kita buat tadi
        .then(response => response.json())
        .then(data => {
            console.log("Data siswa:", data);
            const container = document.getElementById("top-kasus-list");

            if (data.length === 0) {
                container.innerHTML = "<p class='text-muted'>Tidak ada data kasus.</p>";
                return;
            }

            // Reset kontainer biar gak numpuk
            container.innerHTML = "";

            // Loop & Tampilin data siswa
            data.slice(0, 6).forEach((item, index) => {
                container.innerHTML += `
                    <div class="border-bottom loyal-customers-box py-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <i class="fas fa-exclamation-circle text-danger font-size-20 mx-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="font-size-15 mb-1 text-truncate">${item.nama_lengkap}</h5>
                                <p class="text-muted text-truncate mb-0">${item.kelas}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <h5 class="font-size-14 mb-0 text-truncate w-xs bg-light p-2 rounded text-center">
                                    ${item.total_kasus} Kasus
                                </h5>
                            </div>
                        </div>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error("Gagal memuat data:", error);
            document.getElementById("top-kasus-list").innerHTML =
                "<p class='text-danger'>Gagal memuat data.</p>";
        });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch("/report/prestasi-terbaru")
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector("#list-prestasi");
            container.innerHTML = ""; // Kosongkan sebelum render ulang

            data.slice(0, 5).forEach(item => {
                const listItem = `
                    <div class="list-group-item d-flex justify-content-between align-items-start py-2 border-bottom">
                        <div class="d-flex align-items-center mt-3">
                            <i class="fa fa-medal text-warning font-size-20 mx-3"></i>
                            <div>
                                <h6 class="mb-0">${item.siswa.nama_lengkap}</h6>
                                <small class="text-muted">${item.jenis} - ${item.deskripsi}</small>
                            </div>
                        </div>
                        <small class="text-muted text-end mt-3">${new Date(item.tanggal).toLocaleDateString()}</small>
                    </div>
                `;
                container.innerHTML += listItem;
            });
        })
        .catch(error => console.error("Gagal mengambil data:", error));
});

function loadUpcomingKegiatan() {
    fetch('/report/upcoming-kegiatan')
        .then(response => response.json())
        .then(data => {
            const listContainer = document.getElementById('list-kegiatan-sekolah');
            listContainer.innerHTML = ''; // Kosongkan kontainer terlebih dahulu

            if (data.length === 0) {
                listContainer.innerHTML = '<div class="text-center p-3">Tidak ada kegiatan yang akan datang.</div>';
                return;
            }

            // Loop untuk menampilkan kegiatan
            data.forEach(kegiatan => {
                const kegiatanItem = document.createElement('div');
                kegiatanItem.classList.add('p-3', 'border-bottom');

                // Menambahkan konten kegiatan
                kegiatanItem.innerHTML = `
                    <div class="card border border-primary">
                        <div class="card-header bg-transparent border-primary">
                            <h6>${kegiatan.nama}</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0"><strong>Tanggal:</strong> ${new Date(kegiatan.tanggal).toLocaleDateString()}</p>
                            <p class="mb-0"><strong>Penyelenggara:</strong> ${kegiatan.penyelenggara}</p>
                        </div>
                    </div>
                `;

                listContainer.appendChild(kegiatanItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            const listContainer = document.getElementById('list-kegiatan-sekolah');
            listContainer.innerHTML = '<div class="text-center p-3">Terjadi kesalahan saat memuat data.</div>';
        });
}

// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadUpcomingKegiatan);