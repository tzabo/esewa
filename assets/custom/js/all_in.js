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
    locale: 'id',
    dayMaxEvents: true,
    eventDisplay: 'block',
    headerToolbar: {
        right: 'prev,next',
        left: 'title',
    },
    events: {
        url: '/esewa/api/get_events.php',
        method: 'GET',
        extraParams: function() {
            return {
                gedung: document.getElementById('filterGedung').value
            };
        }
    },

    // =========================
    // EVENT CLICK
    // =========================
    eventClick: function(info) {

    const clickedDate = info.event.startStr;

    const eventsSameDate = calendar.getEvents().filter(e => e.startStr === clickedDate);

    const total = eventsSameDate.length;

    const container = document.getElementById("modalBodyContent");

    container.innerHTML = "";

    // ================================
    // MODE 1 EVENT (TANPA CAROUSEL)
    // ================================
    if(total === 1){

        const ev = eventsSameDate[0];

        let sesiHTML = "-";

        if(ev.extendedProps.waktu){
            sesiHTML = ev.extendedProps.waktu
            .split(/\n|;/)
            .map(s => `<div>${s}</div>`)
            .join('');
        }

        container.innerHTML = `
        <div class="p-3">

            <table class="table table-borderless">

            <tr>
                <td width="150">Gedung</td>
                <td width="10">:</td>
                <th>${ev.extendedProps.gedung}</th>
            </tr>

            <tr>
                <td>Nama Pemesan</td>
                <td>:</td>
                <th>${ev.extendedProps.nama}</th>
            </tr>

            <tr>
                <td>Jenis Acara</td>
                <td>:</td>
                <th>${ev.extendedProps.acara}</th>
            </tr>

            <tr>
                <td>Info Sesi</td>
                <td>:</td>
                <th>${sesiHTML}</th>
            </tr>

            <tr>
                <td>Durasi</td>
                <td>:</td>
                <th>${ev.extendedProps.durasi}</th>
            </tr>

            </table>

        </div>
        `;

    }

    // ================================
    // MODE CAROUSEL (LEBIH DARI 1 EVENT)
    // ================================
    else{

        let slides = "";

        eventsSameDate.forEach((ev,index)=>{

            let sesiHTML = "-";

            if(ev.extendedProps.waktu){
                sesiHTML = ev.extendedProps.waktu
                .split(/\n|;/)
                .map(s => `<div>${s}</div>`)
                .join('');
            }

            const active = index === 0 ? "active" : "";

            slides += `
            <div class="carousel-item ${active}">
                <div class="p-3">

                    <table class="table table-borderless">

                    <tr>
                        <td width="150">Gedung</td>
                        <td width="10">:</td>
                        <th>${ev.extendedProps.gedung}</th>
                    </tr>

                    <tr>
                        <td>Nama Pemesan</td>
                        <td>:</td>
                        <th>${ev.extendedProps.nama}</th>
                    </tr>

                    <tr>
                        <td>Jenis Acara</td>
                        <td>:</td>
                        <th>${ev.extendedProps.acara}</th>
                    </tr>

                    <tr>
                        <td>Info Sesi</td>
                        <td>:</td>
                        <th>${sesiHTML}</th>
                    </tr>

                    <tr>
                        <td>Durasi</td>
                        <td>:</td>
                        <th>${ev.extendedProps.durasi}</th>
                    </tr>

                    </table>

                </div>
            </div>
            `;

        });

        container.innerHTML = `
        <div id="eventCarousel" class="carousel slide">

            <div class="carousel-inner">
                ${slides}
            </div>

            <button class="carousel-control-prev"
                type="button"
                data-bs-target="#eventCarousel"
                data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>

            </button>

            <button class="carousel-control-next"
                type="button"
                data-bs-target="#eventCarousel"
                data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>

            </button>

        </div>
        `;

        const carousel = document.getElementById("eventCarousel");

        carousel.addEventListener("slid.bs.carousel", function(e){

            const index = e.to + 1;

            document.getElementById("eventCounter").innerText =
            `(${index}/${total})`;

        });

    }

    // counter awal
    document.getElementById("eventCounter").innerText =
    total > 1 ? `(1/${total})` : `(1)`;

    // tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById("eventModal"));
    modal.show();

    } // <-- PENUTUP eventClick
    
    });
    
    calendar.render();

    // --- Fungsi load event dari API ---
    async function updateCalendarEvents(gedung) {
        try {
            const res = await fetch(`/esewa/api/get_events.php?gedung=${gedung}`);
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