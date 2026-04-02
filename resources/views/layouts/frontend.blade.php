<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dapur Ibu Iim</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include("layouts.component_pelanggan.navbar")
    <!-- Navbar End -->


    <!--content-->
    @yield('content')
    <!--endcontent-->


    <!-- Footer Start -->
    @include("layouts.component_pelanggan.footer")
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
    const toggle = document.getElementById('userToggle');
    const card = document.getElementById('userCard');

    toggle.addEventListener('click', function (e) {
        e.preventDefault();
        card.style.display = (card.style.display === 'block') ? 'none' : 'block';
    });

    // klik luar = nutup
    document.addEventListener('click', function (e) {
        if (!toggle.contains(e.target) && !card.contains(e.target)) {
            card.style.display = 'none';
        }
    });
</script>
<script>
const featureModal = document.getElementById('featureModal');

featureModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;

    document.getElementById('modalTitle').innerText = button.getAttribute('data-title');
    document.getElementById('modalDesc').innerText = button.getAttribute('data-desc');
    document.getElementById('modalFull').innerText = button.getAttribute('data-full');
});
</script>
<script>
document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', function () {

        // aktif button
        document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active','btn-primary'));
        this.classList.add('active','btn-primary');

        let filter = this.getAttribute('data-filter');

        document.querySelectorAll('.product-item-filter').forEach(item => {

            if (filter === 'all') {
                item.style.display = 'block';
            } else {
                if (item.classList.contains(filter)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            }

        });

    });
});


</script>
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let keyword = this.value.toLowerCase();

    document.querySelectorAll('.product-item-filter').forEach(item => {
        let text = item.innerText.toLowerCase();

        if (text.includes(keyword)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
<script>
document.getElementById('schedule_date').addEventListener('change', function () {

    let selectedDate = this.value;

    if (!selectedDate) return;

    fetch(`/check-schedule?date=${selectedDate}`)
        .then(response => response.json())
        .then(data => {

            if (!data.available) {
                alert("❌ Tanggal ini sudah penuh! Silakan pilih tanggal lain.");
                this.value = ""; // reset input
                document.getElementById('estimasiText').innerText = "";
                return;
            }

            // lanjut hitung estimasi kalau tersedia
            let selected = new Date(selectedDate);
            let today = new Date();

            selected.setHours(0,0,0,0);
            today.setHours(0,0,0,0);

            let diffDays = Math.ceil((selected - today) / (1000 * 60 * 60 * 24));

            let text = '';

            if (diffDays < 0) {
                text = "⚠️ Tidak bisa pesan untuk tanggal yang sudah lewat";
            } else if (diffDays < 2) {
                text = "⚠️ Minimal pemesanan H-2";
            } else if (diffDays <= 3) {
                text = "Estimasi: pengerjaan cepat (1-3 hari)";
            } else {
                text = "Estimasi: pengerjaan normal";
            }

            document.getElementById('estimasiText').innerText = text;
        });
});
</script>
<script>
function changeQty(id, change) {

    let qtyInput = document.getElementById('qty-' + id);
    let currentQty = parseInt(qtyInput.value);

    let newQty = currentQty + change;

    if (newQty < 1) newQty = 1;

    qtyInput.value = newQty;

    updateCart(id, newQty);
}

function updateCart(id, qty) {

    fetch("{{ route('cart.update.ajax') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id: id,
            qty: qty
        })
    })
    .then(response => response.json())
    .then(data => {

        if (data.success) {
            location.reload(); // refresh biar total ikut update
        }
    });
}
</script>
<script>
function increaseQty() {
    let input = document.getElementById('qty');
    let max = parseInt(input.max);

    if (parseInt(input.value) < max) {
        input.value = parseInt(input.value) + 1;
    }
}

function decreaseQty() {
    let input = document.getElementById('qty');
    let min = parseInt(input.min);

    if (parseInt(input.value) > min) {
        input.value = parseInt(input.value) - 1;
    }
}

function validateQty() {
    let input = document.getElementById('qty');
    let min = parseInt(input.min);
    let max = parseInt(input.max);

    if (input.value < min) input.value = min;
    if (input.value > max) input.value = max;
}
</script>
<script>
    function toggleItem(id) {

    fetch("{{ route('cart.toggle') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            id: id
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>
</body>

</html>
