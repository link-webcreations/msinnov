<?php

  // Check for empty fields
  if(empty($_POST['name'])   ||
    empty($_POST['phone'])     ||
    empty($_POST['email'])   ||
    empty($_POST['subjet'])  ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
    {
      echo "No arguments Provided!";
      return false;
    }

  $to = "postmaster@ms-innov.com , yves.andolfatto@gmail.com";

  extract($_POST);
  $nom_txt = strip_tags($name);
  $email_txt = strip_tags($email);
  $message_txt = strip_tags($message);
  $phone_txt = strip_tags($phone);
  $subjet_txt = strip_tags($subjet);

  // Suivant les serveurs :
  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to))
  {
    $passage_ligne = "\r\n";
  }
  else
  {
    $passage_ligne = "\n";
  }

  //=====Définition du sujet.
  $subjet = "From ms-innov.com - \"".$subjet_txt."\"";
  //=====Création du header de l'e-mail.
  $header = "From: \"".$nom_txt."\"<".$email_txt.">".$passage_ligne;
  $header.= "Reply-to: \"".$nom_txt."\"<".$email_txt.">".$passage_ligne;
  $header.= "MIME-Version: 1.0".$passage_ligne;

  //=====Création du message.
  $msg = $passage_ligne;
  $msg.= $passage_ligne."Nom : ".$nom_txt.$passage_ligne;
  $msg.= $passage_ligne."Email : ".$email_txt.$passage_ligne;
  $msg.= $passage_ligne."Tel : ".$phone_txt.$passage_ligne;
  $msg.= $passage_ligne.$message_txt.$passage_ligne;

  //=====Envoi de l'e-mail.
  mail($to,$subjet,$msg,$header);
?>
