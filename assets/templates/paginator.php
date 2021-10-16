</body>

<div class="w-100 d-flex justify-content-center text-secondary">
    <ul class="pagination">
        <li class="page-item <?= (!$pnVar) ? "disabled" : (($_GET["pn"] == 0) ? "disabled" : "") ?>">
            <a class="page-link text-dark bi bi-chevron-left <?= (!$pnVar) ? "bg-transparent" : (($_GET["pn"] == 0) ? "bg-transparent" : "") ?>"
               href="index.php<?= (!$pnVar) ? "" : "?pn=".($_GET["pn"] - 1); ?>"
               tabindex="-1"></a>
        </li>
        <?php
        for ($i = 0; $i <= $pgLen + 1; $i++) {
            ?>
            <li class="page-item <?= (!$pnVar && $i == 0) ? "disabled" : (($pnVar && $i == $_GET["pn"]) ? "disabled" : "") ?>">
                <a class="page-link text-<?= (!$pnVar && $i == 0) ? "white bg-secondary text-decoration-underline" : (($pnVar && $i == $_GET["pn"]) ? "white bg-secondary text-decoration-underline" : "dark bg-body") ?>" href="index.php?pn=<?=$i?>"><?=$i + 1?></a>
            </li>
            <?php
        }
        ?>
        <li class="page-item <?= ($pnVar && $_GET["pn"] == $pgLen + 1) ? "disabled" : ""?>">
            <a class="page-link text-dark bi bi-chevron-right <?= ($pnVar && $_GET["pn"] == $pgLen + 1) ? "bg-transparent" : ""?>" href="index.php<?= ($pnVar && $_GET["pn"] > $pgLen + 1) ? "?pn=".($_GET["pn"] + 1) : ""; ?>"></a>
        </li>
    </ul>
</div>