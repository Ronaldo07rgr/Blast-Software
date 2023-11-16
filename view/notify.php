<?php
if (isset($_COOKIE["notify"])) {
    $notify = unserialize($_COOKIE["notify"]);
?>
    <div class="notify">
        <?php
        switch ($notify["status"]) {
            case "success":
        ?>
                <div class="success-head">
                    <div>
                        <div class="<?= $notify["status"] ?>"><i class="fa-solid fa-check"></i></div>
                        <div>Correcto</div>
                    </div>
                    <div id="close-notify"><i class="fa-solid fa-times"></i></div>
                </div>
            <?php
                break;
            case "error":
            ?>
                <div class="error-head">
                    <div>
                        <div class="<?= $notify["status"] ?>"><i class="fa-solid fa-warning"></i></div>
                        <div>Error</div>
                    </div>
                    <div id="close-notify"><i class="fa-solid fa-times"></i></div>
                </div>
        <?php
                break;
        }
        ?>
        <div><?= $notify["message"] ?></div>
    </div>
    <script>
        (() => {
            const closeNotify = document.querySelector('#close-notify');
            const notifyContainer = document.querySelector('.notify');

            closeNotify.addEventListener('click', () => {
                notifyContainer.style.setProperty('opacity', 0);
                notifyContainer.style.setProperty('transform', "translateX(5px)");
                setTimeout(() => {
                    notifyContainer.remove();
                }, 200);
            })
            setTimeout(() => closeNotify.click(), 5000);
        })();
    </script>
<?php
}
