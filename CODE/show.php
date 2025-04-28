<!DOCTYPE html>
<html lang="en" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Kut idee van: <?= $idea['name']; ?> | <?= $siteTitle; ?></title>

        <?php require_once 'meta.php'; ?>
        <!-- Custom Stylesheet -->
        <link href="/css/style.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script async src="https://www.google.com/recaptcha/api.js?render=6LcthSQnAAAAAPqFPNy8ohaRdj9wzmcICEOY5eiQ"></script>
    </head>

    <body class="h-100">
        <div class="login-bg h-100">
            <div class="container h-100">
                <div class="row justify-content-center h-100">
                    <div class="col-md-5">
                        <noscript>
                        <div class="card text-white bg-danger">
                            <div class="card-body mb-0">
                                <h5 class="card-title">JavaScript nodig!</h5>
                                <p class="card-text">Sorry deze website werkt alleen wanneer JavaScript is ingeschakeld! Hoe je dit inschakeld kun je lezen door op de grijze knop te drukken.</p>
                                <a href="https://www.enable-javascript.com/" target="_blank" class="btn btn-dark btn-card">JavaScript Inschakelen?</a>
                            </div>
                        </div>
                        </noscript>
                        <div class="form-input-content">
                            <div class="card card-login">
                                <div class="card-header text-center d-block">
                                    <h1 class="mb-0 p-2"><strong><?= $siteTitle; ?></strong></h1>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-4">
                                        <h3>Naam</h3>
                                        <p><?= $idea['name']; ?></p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <h3>Datum</h3>
                                        <p><?= $idea['created_at']; ?></p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <h3>Idee</h3>
                                        <p><?= $idea['idea']; ?></p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <h3>Resultaat</h3>
                                        <?php
                                        if ($idea['status']) {
                                            echo $resultAwnserTRUE['title'] . " " . $resultAwnserTRUE['msg'];
                                        }
                                        else {
                                            echo $resultAwnserFALSE['title'] . " " . $resultAwnserFALSE['msg'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="card-footer text-center border-0 pt-0">
                                    <h3>Share</h3>
                                    <p><input type="text" class="form-control" value="<?= $_SERVER['SCRIPT_URI']; ?>"></p>

                                    <p><a class="btn btn-primary btn-block border-0" href="<?= $siteBase; ?>">Zelf een KUT IDEE?</a></p>
                                </div>

                                <div class="card-footer text-center border-0 pt-0">
                                    <p><?= $siteCopyright; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>