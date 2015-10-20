<?php

  $to = "postmaster@ms-innov.com , j.morel@ms-innov.com";

  extract($_POST);
  $nom_txt = strip_tags($name);
  $email_txt = strip_tags($email);
  $message_txt = strip_tags($message);
  $phone_txt = strip_tags($phone);
  $subject_txt = strip_tags($subject);

  //=====Vérifier si les valeurs sont vides
  if(empty($nom_txt)     ||
     empty($email_txt)   ||
     empty($message_txt) ||
     empty($phone_txt)   ||
     empty($subject_txt) ||
     !filter_var($email_txt,FILTER_VALIDATE_EMAIL))
  {
    http_response_code(406);
    exit;
  }

  //=====Convertire les saut de ligne suivant les serveurs :
  if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $to))
  {
    $passage_ligne = "\r\n";
  }
  else
  {
    $passage_ligne = "\n";
  }

  //=====Définition du sujet.
  $subject = "From ms-innov.com - \"".$subject_txt."\"";
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
  mail($to,$subject,$msg,$header);
?>
