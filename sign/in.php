<?php
include_once("../assets/templates/head.html");
?>
    </head>
<?php
include_once("../assets/templates/navbar.html");
?>
    </nav>
    </a>
    <main class="container">
        <div class="row my-5 ml-3 ml-md-0 w-75">
            <form action="session.php" method="post">
                <h2>Sign-In</h2>
                <input type="text" class="form-control my-2" name="uName" id="uName" placeholder="Username"/>
                <input type="password" name="pWord" class="form-control my-2" id="pWord" placeholder="Password"/>
                <?php
                if (count($_GET)) {
                    if ($_GET["error"] == "true") {
                        ?>
                        <div class="text-danger my-2">
                            Please enter a valid username and/or password
                        </div>
                        <?php
                    }
                }
                ?>
                <button type="submit" class="btn btn-dark mr-3">Submit</button>
                <a href="up.php" class="text-secondary">Register</a>
            </form>
        </div>
    </main>
    </body>

    </html>