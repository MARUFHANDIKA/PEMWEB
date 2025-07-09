// ===============================
// main.js untuk responsivitas & UX
// ===============================

// Scroll-to-top button
document.addEventListener('DOMContentLoaded', function () {
    var scrollBtn = document.getElementById("scrollTopBtn");
    if (scrollBtn) {
        window.addEventListener("scroll", function () {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        });
        scrollBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});

// Toggle custom navbar menu on mobile (jika pakai)
var toggleBtn = document.getElementById('toggleMenu');
var navMenu = document.getElementById('navMenu');
if (toggleBtn && navMenu) {
    toggleBtn.addEventListener('click', function(){
        navMenu.classList.toggle('d-none');
    });
}

// Animasi fade-in saat scroll
document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll(".fade-in-on-scroll");

    function checkVisible() {
        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if(rect.top < window.innerHeight - 100){
                el.classList.add("visible");
            }
        });
    }

    window.addEventListener("scroll", checkVisible);
    checkVisible(); // run on load
});

// Highlight menu navbar sesuai scroll (opsional, simple)
window.addEventListener("scroll", function() {
    const sections = document.querySelectorAll("section[id]");
    const scrollY = window.pageYOffset;

    sections.forEach(current => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 50;
        sectionId = current.getAttribute("id");

        const navItem = document.querySelector(".navbar-nav a[href*=" + sectionId + "]");
        if(navItem){
            if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
                navItem.classList.add("active");
            } else {
                navItem.classList.remove("active");
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll('.btn-delete-item');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            const card = this.closest('.item-card');

            if(confirm('Yakin ingin menghapus item ini?')){
                fetch('/cart/delete/' + itemId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success){
                        card.remove(); // hapus item dari tampilan
                    } else {
                        alert(data.message || 'Gagal menghapus item.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                });
            }
        });
    });
});

$(document).on('click', '.btnRemove', function () {
    let row = $(this).closest('tr');
    let productId = row.find('.productId').val();

    Swal.fire({
        title: 'Hapus item ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.remove.item') }}",
                data: { productId: productId },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.status === 'success') {
                        row.fadeOut(300, function () {
                            $(this).remove();

                            // Hitung ulang total
                            let total = 0;
                            $('#dataTable tbody tr').each(function () {
                                total += Number($(this).find('.total').text().replace("Rp.", "").replace(/,/g, ''));
                            });

                            $('#subTotalPrice').text(`Rp.${total}`);
                            $('#finalTotal').text(`Rp.${total + 3000}`);
                        });

                        Swal.fire('Berhasil!', 'Item berhasil dihapus.', 'success');
                    } else {
                        Swal.fire('Gagal', res.message || 'Gagal menghapus item.', 'error');
                    }
                },
                error: function () {
                    Swal.fire('Gagal', 'Terjadi kesalahan.', 'error');
                }
            });
        }
    });
});

$('#clearBtn').click(function () {
    Swal.fire({
        title: 'Yakin?',
        text: "Keranjang akan dikosongkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, kosongkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: "{{ route('ajax.clear.cart') }}",
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res.status === 'success') {
                        $('#dataTable tbody').html('');
                        $('#subTotalPrice').text('Rp.0');
                        $('#finalTotal').text('Rp.0');

                        Swal.fire('Berhasil!', 'Keranjang dikosongkan.', 'success');
                    }
                },
                error: function () {
                    Swal.fire('Gagal', 'Terjadi kesalahan.', 'error');
                }
            });
        }
    });
});
