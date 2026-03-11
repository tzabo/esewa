document.addEventListener("DOMContentLoaded", () => {

    const filter = document.getElementById("filterGedung");
    const carouselEl = document.getElementById("carouselExample");
    const calendarEl = document.getElementById("calendar");

    if (!carouselEl || !filter || !calendarEl) return;

    // --- Carousel Setup ---
    const carousel = bootstrap.Carousel.getOrCreateInstance(carouselEl, {
        interval: 3000,
        pause: 'hover'
    });

    const items = carouselEl.querySelectorAll('.carousel-item');
    const controls = carouselEl.querySelectorAll('.carousel-control-prev, .carousel-control-next');

    if (![...items].some(item => item.classList.contains('active'))) {
        items[0].classList.add('active');
    }

    // --- FullCalendar Setup ---
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id', // <--- pakai bahasa Indonesia
        headerToolbar: {
            right: 'prev,next',
            left: 'title',
        },
        events: [], // dinamis
        eventClick: function(info) {
            const clickedDate = info.event.startStr;

            // Ambil semua event di tanggal yang sama
            const eventsSameDate = calendar.getEvents().filter(ev => ev.startStr === clickedDate);

            let modalHTML = '';

            eventsSameDate.forEach((ev, index) => {
                // Format tanggal Indonesia
                const tanggalFormatted = new Date(ev.startStr).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });

                // Info Sesi bertingkat
                const sesiData = ev.extendedProps.waktu;
                let sesiHTML = '';
                if (Array.isArray(sesiData)) {
                    sesiHTML = sesiData.map(s => `<div>${s}</div>`).join('');
                } else if (typeof sesiData === 'string') {
                    sesiHTML = sesiData.split(/\r?\n|;/).map(s => `<div>${s.trim()}</div>`).join('');
                } else {
                    sesiHTML = '-';
                }

                // Tambahkan ke modal
                modalHTML += `
                    <tr>
                        <td style="width:150px;">Tanggal</td>
                        <td style="width:50px;">:</td>
                        <th>${tanggalFormatted}</th>
                    </tr>
                    <tr>
                        <td>Gedung</td>
                        <td style="width:50px;">:</td>
                        <th>${ev.extendedProps.gedung || '-'}</th>
                    </tr>
                    <tr>
                        <td>Jenis Acara</td>
                        <td style="width:50px;">:</td>
                        <th>${ev.extendedProps.acara || ev.title}</th>
                    </tr>
                    <tr>
                        <td>Info Sesi</td>
                        <td style="width:50px;">:</td>
                        <th>${sesiHTML}</th>
                    </tr>
                    <tr>
                        <td>Durasi</td>
                        <td style="width:50px;">:</td>
                        <th>${ev.extendedProps.durasi || '-'}</th>
                    </tr>
                `;

                // Tambahkan garis pemisah jika ada lebih dari 1 event dan bukan event terakhir
                if (eventsSameDate.length > 1 && index < eventsSameDate.length - 1) {
                    modalHTML += `<tr><td colspan="3"><hr style="border-top:4px solid red; margin: 10px 0;"></td></tr>`;
                }
            });

            document.getElementById("modalBodyContent").innerHTML = modalHTML;

            // Tampilkan modal
            const modalEl = document.getElementById('eventModal');
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    });
    calendar.render();

    // --- Fungsi load event dari API ---
    async function updateCalendarEvents(gedung) {
        try {
            const res = await fetch(`api/get_events.php?gedung=${gedung}`);
            if (!res.ok) throw new Error("Network response not ok");
            const events = await res.json();
            calendar.removeAllEvents();
            calendar.addEventSource(events);
        } catch(e) {
            console.error("Gagal load events:", e);
        }
    }

    // --- Fungsi update filter carousel + kalender ---
    async function updateFilter() {
        const gedung = filter.value;
        let firstVisibleIndex = -1;

        // Update carousel
        items.forEach((item, index) => {
            if (gedung === "" || item.dataset.gedung === gedung) {
                item.classList.remove("d-none");
                if (firstVisibleIndex === -1) firstVisibleIndex = index;
            } else {
                item.classList.add("d-none");
            }
            item.classList.remove("active");
        });

        if (firstVisibleIndex !== -1) {
            items[firstVisibleIndex].classList.add("active");
            carousel.to(firstVisibleIndex);
        }

        // Jalankan / pause carousel
        if (gedung === "") {
            carousel.cycle();
            controls.forEach(ctrl => ctrl.style.display = "block");
            carouselEl.classList.add("carousel", "slide");
        } else {
            carousel.pause();
            controls.forEach(ctrl => ctrl.style.display = "none");
            carouselEl.classList.remove("carousel", "slide");
        }

        // Update kalender
        await updateCalendarEvents(gedung);
    }

    // Inisialisasi awal
    updateFilter();

    // Event saat filter berubah
    filter.addEventListener("change", updateFilter);

});