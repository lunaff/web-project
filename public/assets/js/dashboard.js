document.addEventListener("DOMContentLoaded", function () {
    const selectTahun = document.getElementById("filter-tahun");
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
    loadChartData(tahunSekarang);

    // Event Listener saat tahun diubah
    selectTahun.addEventListener("change", function () {
        loadChartData(this.value);
    });
});

function loadChartData(tahun) {
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
                    title: {
                        text: "Jumlah Kasus"
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
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center mt-2">
                            <i class="fa fa-medal text-warning font-size-20 mx-3"></i>
                            <div>
                                <h6 class="mb-0">${item.siswa.nama_lengkap}</h6>
                                <small class="text-muted">${item.jenis} - ${item.deskripsi}</small>
                            </div>
                        </div>
                        <small class="text-muted text-end">${new Date(item.tanggal).toLocaleDateString()}</small>
                    </div>
                `;
                container.innerHTML += listItem;
            });
        })
        .catch(error => console.error("Gagal mengambil data:", error));
});

