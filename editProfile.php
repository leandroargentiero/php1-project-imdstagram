<?php
    include_once('includes/no-session.inc.php');
    include_once ("classes/users.class.php");

    if(!empty($_POST)){
        $editEmail = $_POST['editEmail'];
        $editUsername = $_POST['editUsername'];
        $editBio = $_POST['editBio'];

        $newPassword = $_POST['newPassword'];
        $confirmNewPassword = $_POST['confirmNewPassword'];


        // edit details
        if(strlen(trim($editEmail)) != 0 or strlen(trim($editUsername)) != 0 or strlen(trim($editUsername)) != 0)
        {
            $updateProfile = new Users();
            $updateProfile->EditEmail = $editEmail;
            $updateProfile->EditUsername = $editUsername;
            $updateProfile->EditBio = $editBio;
            $updateProfile->updateProfile();

            $messageDetails = "Jouw gegevens werden succesvol aangepast.";
        }
        else if(strlen(trim($newPassword)) != 0 or strlen(trim($confirmNewPassword)) != 0)
        {
            if(strcmp($newPassword, $confirmNewPassword) == 0){

                $passwordSucces = "Jouw wachtwoord werd succesvol gewijzigd.";
            }
            else
            {
                $passwordError = "Woops, wachtwoorden komen niet overeen. Probeer opnieuw!";
            }
        }
        else
        {
            $messageEmptySubmit = "Sorry, we hebben geen gegevens kunnen wijzigen. Gelieve minsten één veld in te vullen.";
        }
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imdstagram</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        .editContainer {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        .editContainer h1 {
            color: #06365F;
            font-family: 'instaRegular', 'sans-serif';
            font-size: 1.3em;
            margin-bottom: 15px;
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dddbd9;

        }

        .editContainer form {
            margin-bottom: 50px;
        }

        .editContainer label {
            width: 150px;
            display: inline-block;
            font-size: 0.8em;

        }

        .editContainer input {
            margin-bottom: 10px;
            width: 250px;
            border-radius: 5px;
            border: 1px solid #dddbd9;
        }

        .formDetails select, textarea {
            margin-bottom: 10px;
            border-radius: 5px;
            width: 250px;
            border: 1px solid #dddbd9;
        }

        .formDetails textarea {
            vertical-align: top;
        }
        .messageUpdate{
            font-family: 'instaLight', sans-serif;
            background-color: #00D062;
            font-size: .7em;
            color: white;
            padding: 1em;
            width: 227px;
            border-radius: 5px;
        }
        .error{
            background-color: #FE3554;
        }
    </style>
</head>
<body>
    <?php include_once("includes/nav.inc.php"); ?>

    <div class="editContainer">
        <div class="editDetails">
            <h1>Profiel bewerken</h1>

            <form class="formDetails formPassword" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <label for="email">E-mailadres:</label>
                <input type="email" name="editEmail"></br>

                <label for="username">Gebruikersnaam:</label>
                <input type="text" name="editUsername"></br>

                <label for="bio">Biografie:</label>
                <textarea name="editBio" maxlength="150" id="bio" cols="30" rows="5"></textarea></br>

                <?php
                    if( isset($messageDetails) ) {
                    echo "<p class='messageUpdate'>$messageDetails</p>";
                    }
                ?>

                <h1>Wachtwoord wijzigen</h1>

                <label for="newpassword">Nieuw wachtwoord:</label>
                <input type="password" name="newPassword"></br>

                <label for="confirmnewpassword">Nieuw wachtwoord bevestigen:</label>
                <input type="password" name="confirmNewPassword"></br>

                <?php
                if( isset($passwordSucces) )
                {
                    echo "<p class='messageUpdate'>$passwordSucces</p>";
                }
                else if( isset($passwordError) )
                {
                    echo "<p class='messageUpdate error'>$passwordError</p>";
                }
                else if( isset($messageEmptySubmit) )
                {
                    echo "<p class='messageUpdate error'>$messageEmptySubmit</p>";
                }
                ?>

                <input class="submitEdit" type="submit" value="Gegevens wijzigen">
            </form>

        </div>
    </div>
</body>
</html>