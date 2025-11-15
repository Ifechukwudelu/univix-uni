<?php if (!empty($message)): ?>
<div id="msgBox"
     class="fixed top-[10rem] right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg transform transition-all duration-300 opacity-0 -translate-y-2">
    <?= $message ?>
</div>

<script>
    const box = document.getElementById("msgBox");
    setTimeout(() => {
        box.classList.remove("opacity-0", "-translate-y-2");
        box.classList.add("opacity-100", "translate-y-0");
    }, 50);
    setTimeout(() => {
        box.classList.remove("opacity-100");
        box.classList.add("opacity-0");
    }, 2000);
    <?php if (!empty($redirectAfter)): ?>
    setTimeout(() => {
        window.location.href = "<?= $redirectAfter ?>";
    }, 2300);
    <?php endif; ?>
</script>
<?php endif; ?>