<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réclamer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="{{ route('reclamer') }}" method="POST" id="signup-form" class="signup-form">
                        @csrf
                        <h2 class="form-title">envoyer une réclamation</h2>
                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <style>
                            .valid-message {
                                color: green;
                                font-weight: bold;
                                font-size: 14px;
                            }

                            .invalid-message {
                                color: red;
                                font-weight: bold;
                                font-size: 14px;
                            }
                        </style>

                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Votre Adresse E-mail (eg. prenom.nom@etu.uae.ac.ma)" pattern="[a-zA-Z0-9._%+-]+@etu\.uae\.ac\.ma" title="Veuillez entrer une adresse e-mail valide de la forme prenom.nom@etu.uae.ac.ma" required/>
                            <div id="email-validation-message" class="invalid-message"></div>
                            <script>
                                const emailInput = document.getElementById('email');
                                const emailValidationMessage = document.getElementById('email-validation-message');
                        
                                emailInput.addEventListener('input', function () {
                                    const emailPattern = /^[a-zA-Z]+\.[a-zA-Z]+@etu\.uae\.ac\.ma$/;
                                    const isValid = emailPattern.test(emailInput.value);
                        
                                    if (isValid) {
                                        emailValidationMessage.textContent = 'Format valide';
                                        emailValidationMessage.className = 'valid-message';
                                    } else {
                                        emailValidationMessage.textContent = 'Format invalide';
                                        emailValidationMessage.className = 'invalid-message';
                                    }
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="apogee" id="apogee" pattern="\d{8}" placeholder="Votre Numéro Apogée (8 chiffres)" title="Veuillez entrer 8 chiffres consécutifs" required/>
                            <div id="validation-message" class="invalid-message"></div>
                            <script>
                                const apogeeInput = document.getElementById('apogee');
                                const validationMessage = document.getElementById('validation-message');
                        
                                apogeeInput.addEventListener('input', function () {
                                    const isValid = apogeeInput.checkValidity();
                        
                                    if (isValid) {
                                        validationMessage.textContent = 'Format valide';
                                        validationMessage.className = 'valid-message';
                                    } else {
                                        validationMessage.textContent = 'Format invalide';
                                        validationMessage.className = 'invalid-message';
                                    }
                                });
                            </script>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="description" id="description" placeholder="Description de Votre Réclamation" required/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Envoyer"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        <a href="{{ route('welcome') }}" class="loginhere-link">Retour à la page d'acceuil</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>