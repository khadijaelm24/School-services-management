<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demander un document</title>
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
                    <form action="{{ route('demande') }}" method="POST" id="signup-form" class="signup-form" novalidate>
                        @csrf
                        <h2 class="form-title">demander un document</h2>@if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                @if ($error == 'Vous avez déjà demandé ce document!')
                                    <!-- Message spécifique pour la première condition -->
                                    <p>{{ $error }}</p>
                                @elseif ($error == 'Étudiant non trouvé avec les informations saisies, Veuillez réessayer!')
                                    <!-- Message spécifique pour la deuxième condition -->
                                    <p>{{ $error }}</p>
                                @else
                                    <!-- Message générique pour les autres erreurs, si nécessaire -->
                                    <p>{{ $error }}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                                @if (Session::has('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success') }}
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
                            <input type="email" class="form-input" name="email" id="email" placeholder="Votre Adresse E-mail (eg. prenom.nom@etu.uae.ac.ma)" required/>
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
                            <input type="text" class="form-input" name="cin" id="cin" placeholder="Votre CIN (eg. A123456)" pattern="^[A-Z]{1,2}\d{1,6}$" title="Le CIN doit commencer au minimum par une lettre majuscule puis au minimun un chiffre" required/>
                            <div id="cin-validation-message" class="invalid-message"></div>
                            <script>
                                const cinInput = document.getElementById('cin');
                                const cinValidationMessage = document.getElementById('cin-validation-message');
                        
                                cinInput.addEventListener('input', function () {
                                    const isValid = cinInput.checkValidity();
                        
                                    if (isValid) {
                                        cinValidationMessage.textContent = 'Format valide';
                                        cinValidationMessage.className = 'valid-message';
                                    } else {
                                        cinValidationMessage.textContent = 'Format invalide';
                                        cinValidationMessage.className = 'invalid-message';
                                    }
                                });
                            </script>
                        </div>
                        <label for="document" style="font-weight: bold; font-size:20; color:black;">CHOISISSEZ LE DOCUMENT :</label>
                        <select class="form-input" id="document" name="document" onchange="showSubForm()" required>
                        <option value="option1">Attestation de scolarité</option>
                        <option value="option2">Attestation de réussite</option>
                        <option value="option3">Convention de stages</option>
                        <option value="option4">Relevé de notes</option>
                        </select>
                        <br /><br />
                        <div id="sub-form1" class="sub-form hidden">
                                <div class="form-group">
                                    <select class="form-input" name="niveau" id="niveau" required>
                                        <option value="1ere annee">1ere annee</option>
                                        <option value="2eme annee">2eme annee</option>
                                        <option value="3eme annee">3eme annee</option>
                                        <option value="4eme annee">4eme annee</option>
                                        <option value="5eme annee">5eme annee</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="date_naissance" id="date_naissance" placeholder="Votre date de naissance (Format:AAAA-MM-JJ)"pattern="^\d{4}-\d{2}-\d{2}$" title="Veuillez entrer une date au format AAAA-MM-JJ" required/>
                                <div id="date-validation-message" class="invalid-message"></div>
                                <script>
                                    const dateInput = document.getElementById('date_naissance');
                                    const dateValidationMessage = document.getElementById('date-validation-message');
                            
                                    dateInput.addEventListener('input', function () {
                                        const isValid = dateInput.checkValidity();
                            
                                        if (isValid) {
                                            dateValidationMessage.textContent = 'Format valide';
                                            dateValidationMessage.className = 'valid-message';
                                        } else {
                                            dateValidationMessage.textContent = 'Format invalide';
                                            dateValidationMessage.className = 'invalid-message';
                                        }
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="cne" id="cne" placeholder="Votre CNE (ex: J123456789)"  pattern="^[A-Za-z]\d{9}$" title="Veuillez entrer un CNE commençant par une lettre suivie de neuf chiffres"/>
                                <div id="cne-validation-message" class="invalid-message"></div>
                                <script>
                                    const cneInput = document.getElementById('cne');
                                    const cneValidationMessage = document.getElementById('cne-validation-message');
                            
                                    cneInput.addEventListener('input', function () {
                                        const isValid = cneInput.checkValidity();
                            
                                        if (isValid) {
                                            cneValidationMessage.textContent = 'Format valide';
                                            cneValidationMessage.className = 'valid-message';
                                        } else {
                                            cneValidationMessage.textContent = 'Format invalide';
                                            cneValidationMessage.className = 'invalid-message';
                                        }
                                    });
                                </script>
                            </div>
                          </div>
                      
                          <div id="sub-form2" class="sub-form hidden">
                            <div class="form-group">
                                <input type="text" class="form-input" name="nomm" id="nomm" placeholder="Votre Prénom et Nom" required/>
                            </div>
                          </div>
                      
                          <div id="sub-form3" class="sub-form hidden">
                            <div class="form-group">
                                <input type="text" class="form-input" name="nom" id="nom" placeholder="Votre Prénom et Nom" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="annee_etude" id="annee_etude" placeholder="L'année d'étude (Format: YYYY)" required pattern="\d{4}" title="Format attendu : YYYY"/>                        </div>
                                <div id="annee-etude-validation-message" class="invalid-message">
                                    <script>
                                        const anneeEtudeInput = document.getElementById('annee_etude');
                                        const anneeEtudeValidationMessage = document.getElementById('annee-etude-validation-message');
                                
                                        anneeEtudeInput.addEventListener('input', function () {
                                            const isValid = anneeEtudeInput.checkValidity();
                                
                                            if (isValid) {
                                                anneeEtudeValidationMessage.textContent = 'Format valide';
                                                anneeEtudeValidationMessage.className = 'valid-message';
                                            } else {
                                                anneeEtudeValidationMessage.textContent = 'Format invalide';
                                                anneeEtudeValidationMessage.className = 'invalid-message';
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                <select class="form-input" name="filiere" id="filiere" required>
                                    <option value="GI">Génie Informatique (GI)</option>
                                    <option value="SCM">Supply Chain Management (SCM)</option>
                                    <option value="GC">Génie Civil (GC)</option>
                                    <option value="GSTR">Génie des Systèmes de Télécommunications et Réseaux (GSTR)</option>
                                    <option value="GM">Génie Mécatronique (GM)</option>
                                    <option value="BDIA">Big Data et Intelligence Artificielle (BDIA)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="date_debut" id="date_debut" placeholder="La date de début de votre stage sous format:AAAA-MM-JJ" pattern="^\d{4}-\d{2}-\d{2}$" required/>
                                <div id="date-debut-validation-message" class="invalid-message"></div>
                                <script>
                                    const dateDebutInput = document.getElementById('date_debut');
                                    const dateDebutValidationMessage = document.getElementById('date-debut-validation-message');
                            
                                    dateDebutInput.addEventListener('input', function () {
                                        const isValid = dateDebutInput.checkValidity();
                            
                                        if (isValid) {
                                            dateDebutValidationMessage.textContent = 'Format valide';
                                            dateDebutValidationMessage.className = 'valid-message';
                                        } else {
                                            dateDebutValidationMessage.textContent = 'Format invalide';
                                            dateDebutValidationMessage.className = 'invalid-message';
                                        }
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="date_fin" id="date_fin" placeholder="La date de fin de votre stage sous format:AAAA-MM-JJ" pattern="^\d{4}-\d{2}-\d{2}$" required />
                                <div id="date-fin-validation-message" class="invalid-message"></div>
                                <script>
                                    const dateFinInput = document.getElementById('date_fin');
                                    const dateFinValidationMessage = document.getElementById('date-fin-validation-message');
                            
                                    dateFinInput.addEventListener('input', function () {
                                        const isValid = dateFinInput.checkValidity();
                            
                                        if (isValid) {
                                            dateFinValidationMessage.textContent = 'Format valide';
                                            dateFinValidationMessage.className = 'valid-message';
                                        } else {
                                            dateFinValidationMessage.textContent = 'Format invalide';
                                            dateFinValidationMessage.className = 'invalid-message';
                                        }
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="sujet_stage" id="sujet_stage" placeholder="Tapez votre sujet de stage" required/>
                            </div>
                            <!-- Your existing form groups for the second part go here -->
                            <div class="form-group">
                                <input type="text" class="form-input" name="nom_societe" id="nom_societe" placeholder="Le nom de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="adr_societe" id="adr_societe" placeholder="L'adresse de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="tel_societe" id="tel_societe" placeholder="Le téléphone de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-input" name="email_societe" id="email_societe" placeholder="L'email de l'entreprise" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Veuillez entrer une adresse e-mail valide de la forme user@example.com" required/>
                                <div id="email-societe-validation-message" class="invalid-message"></div>
                                <script>
                                    const emailSocieteInput = document.getElementById('email_societe');
                                    const emailSocieteValidationMessage = document.getElementById('email-societe-validation-message');
                            
                                    emailSocieteInput.addEventListener('input', function () {
                                        const isValid = emailSocieteInput.checkValidity();
                            
                                        if (isValid) {
                                            emailSocieteValidationMessage.textContent = 'Format valide';
                                            emailSocieteValidationMessage.className = 'valid-message';
                                        } else {
                                            emailSocieteValidationMessage.textContent = 'Format invalide';
                                            emailSocieteValidationMessage.className = 'invalid-message';
                                        }
                                    });
                                </script>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="nom_rep_societe" id="nom_rep_societe" placeholder="Le Nom du représentant de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="qualite_rep_societe" id="qualite_rep_societe" placeholder="La fonction du représentant de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="encadrant_societe" id="encadrant_societe" placeholder="Le nom de l'encadrant de l'entreprise" required/>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-input" name="encadrant_pedagogique" id="encadrant_pedagogique" placeholder="Le nom de votre encadrant pédagogique" required/>
                            </div>
                          </div>
                      
                          <div id="sub-form4" class="sub-form hidden">
                            <div class="form-group">
                                <label for="year" style="font-weight: 450; font-size:20; color:black;">Année Universitaire :</label>
                                <select class="form-input" id="year" name="year" required>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2022-2023">2022-2023</option>
                                <option value="2021-2022">2021-2022</option>
                                <option value="2020-2021">2020-2021</option>
                                <option value="2019-2020">2019-2020</option>
                                <option value="2018-2019">2018-2019</option>
                                <option value="2017-2018">2017-2018</option>
                                <option value="2016-2017">2016-2017</option>
                                </select>
                                <br /><br />
                            </div>
                          </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Envoyer"/>
                        </div>
                    </form>
                    <script>
                        function showSubForm() {
                            var documentSelect = document.getElementById("document");
                            var subForm1 = document.getElementById("sub-form1");
                            var subForm2 = document.getElementById("sub-form2");
                            var subForm3 = document.getElementById("sub-form3");
                            var subForm4 = document.getElementById("sub-form4");
                    
                            // Masquer tous les sous-formulaires
                            subForm1.classList.add("hidden");
                            subForm2.classList.add("hidden");
                            subForm3.classList.add("hidden");
                            subForm4.classList.add("hidden");

                            // Masquer tous les sous-formulaires
                            // subForm1.style.display = "none";
                            // subForm2.style.display = "none";
                            // subForm3.style.display = "none";
                            // subForm4.style.display = "none";
                    
                            // Afficher le sous-formulaire correspondant à l'option sélectionnée
                            if (documentSelect.value === "option1") {
                                subForm1.classList.remove("hidden");
                            } else if (documentSelect.value === "option2") {
                                subForm2.classList.remove("hidden");
                            } else if (documentSelect.value === "option3") {
                                subForm3.classList.remove("hidden");
                            } else if (documentSelect.value === "option4") {
                                subForm4.classList.remove("hidden");
                            }
                        }
                    </script>
                    <style>
                        .hidden {
                            display: none;
                        }
                    </style>
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