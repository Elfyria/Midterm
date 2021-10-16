<div class="btn-group mr-3 d-flex flex-column h-100 flex-md-row">
<a href="<?=($isAuthors) ? "../" : (($isQuotes) ? "." : "")."./authors/" ?>index.php" class="btn btn-dark mr-2">
    <span class="bi bi-chat-left-quote"></span><br>
    <?=($isAuthors) ? "Quotes" : "Authors" ?>
</a>
<a class="btn btn-dark" href='<?=($isAuthors) ? "../" : (($isQuotes) ? "../" : "") ?>sign/<?=($logged) ? "out" : "in"?>.php'>
    <span class="bi bi-key"></span><br>
    Sign <?=($logged) ? "out" : "in"?>
</a>
</div>
</nav>
</a>