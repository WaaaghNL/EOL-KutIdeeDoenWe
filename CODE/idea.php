<!DOCTYPE html>
<html lang="en" class="h-100">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title><?= $siteTitle; ?></title>

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
                                    <form id="kutideeForm" action="submit.php" method="post">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control" placeholder="Naam" name="name">
                                        </div>
                                        <div class="form-group mb-4">
                                            <textarea class="form-control" rows="8" id="comment" name="idea" placeholder="Wat is je kut idee?"></textarea>
                                        </div>
                                        <input type="hidden" name="recaptcha_response" value="" id="recaptchaResponse">
                                        <button class="btn btn-primary btn-block border-0" type="submit">Moet ik het doen?</button>
                                    </form>
                                </div>
                                <div class="card-footer text-center border-0 pt-0">
                                    <div id="return_message"></div>
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

        <script>
            $('form').submit(function (event) {
                event.preventDefault(); //Prevent the default form submission
                grecaptcha.ready(function () {
                    grecaptcha.execute('6LcthSQnAAAAAPqFPNy8ohaRdj9wzmcICEOY5eiQ', {action: 'submit'}).then(function (token) {
                        var recaptchaResponse = document.getElementById('recaptchaResponse');
                        recaptchaResponse.value = token;
                        // Making the simple AJAX call to capture the data and submit
                        $.ajax({
                            url: 'submit.php',
                            type: 'post',
                            data: $('form').serialize(),
                            dataType: 'json',
                            success: function (response) {
                                var error = response.error;
                                var success = response.success;
                                if (error != "") {
                                    $('#return_message').html(error);
                                } else {
                                    $('#return_message').html(success);
                                }
                            },
                            error: function (jqXhr, json, errorThrown) {
                                var error = jqXhr.responseText;
                                $('#return_message').html(error);
                            }
                        });

                    });
                });
            });
        </script>
    </body>
</html>