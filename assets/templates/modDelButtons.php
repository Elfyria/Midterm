<div class="btn-group mr-3 d-flex flex-column h-100 flex-md-row">
    <a class="btn btn-dark" href='modify.php?id=<?= $_GET["id"] ?>'>
        <span class="bi bi-pencil-fill"></span><br>
        Modify
    </a>
    <!-- So this setup doesn't look great, but it looks a lot better than the alternative imo -->
    <a class="btn btn-dark" href='delete.php?id=<?= $_GET["id"] ?>'>
        <span class="bi bi-trash-fill"></span><br>
        Delete
    </a>
</div>