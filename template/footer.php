</div> </div> <footer class="main-footer">
    <p>© <?= date('Y') ?> Sistem Pendukung Keputusan Kelompok 7</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const btn = document.getElementById("btnHybrid");
  const menu = document.getElementById("submenu");

  btn.addEventListener("click", function () {
    menu.style.display =
      menu.style.display === "block" ? "none" : "block";
  });
});
</script>
</body>
</html>