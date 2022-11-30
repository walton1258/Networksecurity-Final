<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Help Portal</title>
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        main {
            height: calc(100%);
            width: calc(100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>


<body class="bg-dark bg-gradient">

    <main>

        <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 mb-4">
            <h1 class="text-light text-center">Customer Help Portal</h1>
        </div>
        <div class="col-lg-3 col-md-8 col-sm-12 col-xs-12">
            <div class="card shadow rounded-0">
                <div class="card-header py-1">
                    <h4 class="card-title text-center">Contact Us</h4>
                </div>
                <div class="card-body py-4">
                    <div class="container-fluid">

                        <?php

                        $errors = [];
                        $errorMessage = '';

                        if (!empty($_POST)) {
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $message = $_POST['message'];

                            if (empty($name)) {
                                $errors[] = 'Name is empty';
                            }

                            if (empty($email)) {
                                $errors[] = 'Email is empty';
                            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $errors[] = 'Email is invalid';
                            }

                            if (empty($message)) {
                                $errors[] = 'Message is empty';
                            }

                            if (empty($errors)) {
                                $toEmail = 'jomicharles05@gmail.com';
                                $emailSubject = 'New email from your contact form';
                                $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
                                $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
                                $body = join(PHP_EOL, $bodyParagraphs);

                                if (mail($toEmail, $emailSubject, $body, $headers))

                                    header('Location: thanks.html');
                            } else {
                                $errorMessage = 'Oops, something went wrong. Please try again later';
                            }
                        } else {

                            $allErrors = join('<br/>', $errors);
                            $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
                        }


                        ?>
                        <html>

                        <body>
                            <form method="post" id="contact-form">

                                <?php echo ((!empty($errorMessage)) ? $errorMessage : '') ?>
                                <p>
                                    <label>First Name:</label>
                                    <input name="name" type="text" class="form-control" />
                                </p>
                                <p>
                                    <label>Email Address:</label>
                                    <input style="cursor: pointer;" name="email" type="text" class="form-control" />
                                </p>
                                <p><br>
                                    <label>Message:</label>
                                    <br>
                                    <textarea class="form-control" name="message"></textarea>
                                </p>
                                <p>

                                    <input type="submit" value="Send" class="btn btn-primary bg-gradient rounded-0" />
                                </p>
                            </form>

                            <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
                            <script>
                                const constraints = {
                                    name: {
                                        presence: {
                                            allowEmpty: false
                                        }
                                    },
                                    email: {
                                        presence: {
                                            allowEmpty: false
                                        },
                                        email: true
                                    },
                                    message: {
                                        presence: {
                                            allowEmpty: false
                                        }
                                    }
                                };

                                const form = document.getElementById('contact-form');
                                form.addEventListener('submit', function(event) {

                                    const formValues = {
                                        name: form.elements.name.value,
                                        email: form.elements.email.value,
                                        message: form.elements.message.value
                                    };


                                    const errors = validate(formValues, constraints);
                                    if (errors) {
                                        event.preventDefault();
                                        const errorMessage = Object
                                            .values(errors)
                                            .map(function(fieldValues) {
                                                return fieldValues.join(', ')
                                            })
                                            .join("\n");

                                        alert(errorMessage);
                                    }
                                }, false);
                            </script>
                        </body>



                    </div>
                </div>
            </div>
        </div>

    </main>

</html>