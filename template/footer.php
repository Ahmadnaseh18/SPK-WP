</div> </div> <footer class="main-footer">
    <p>© <?= date('Y') ?> Sistem Pendukung Keputusan Kelompok 7</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("btnHybrid");
  const submenu = document.getElementById("submenu");

  btn.addEventListener("click", function () {
    if (submenu.style.display === "block") {
      submenu.style.display = "none";
    } else {
      submenu.style.display = "block";
    }
  });
});
</script>

</body>
</html>