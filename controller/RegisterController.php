<?php

require_once ('ControllerBase.php');

class RegisterController extends ControllerBase
{
    public function __construct($model) 
    {
        parent::__construct($model);
    }
        public function registration() 
        {
            $this->render('register');
            if(isset($_POST['form_inscription']))
            {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // Si les champs sont complétés
                if(!empty($_POST['pseudo']) AND !empty($_POST['password']))
                {
                    $pseudo_lenght = strlen($pseudo);
                    // On vérifie si le pseudo est déjà pris
                    $doublonPseudo = $this->model->searchPseudoDoublons($pseudo);
                    if ($doublonPseudo == 0)
                    {
                        if ($pseudo_lenght <= 255) 
                        {
                            // On ajoute un utilisateur à la base de données
                            $user = [
                                'pseudo' => $_POST['pseudo'],
                                'motdepasse' => $_POST['password']
                            ];

                            $result = $this->model->save($user);

                            $message = "Votre compte a bien été crée !";
                        }
                        else 
                        {
                            $message = "Votre pseudo ne doit pas dépasser 255 caractères";
                        }
                    }
                    else 
                    {
                        $message = "Mince ! Ce pseudo est déjà pris";
                    }
                }
                else
                {
                    $message = "Tous les champs n'ont pas été complétés...";
                }
            }
            
        } 
   
}

?>