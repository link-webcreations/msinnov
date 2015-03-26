<?php
  $to = "postmaster@ms-innov.com , yves.andolfatto@gmail.com";

  extract($_POST);
  $nom_txt = strip_tags($name);
  $email_txt = strip_tags($email);
  $message_txt = strip_tags($message);
  $tel_txt = strip_tags($tel);
  $sujet_txt = strip_tags($sujet);

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
  $sujet = "From ms-innov.com - \"".$sujet_txt."\"";
  //=====Création du header de l'e-mail.
  $header = "From: \"".$nom_txt."\"<".$email_txt.">".$passage_ligne;
  $header.= "Reply-to: \"".$nom_txt."\"<".$email_txt.">".$passage_ligne;
  $header.= "MIME-Version: 1.0".$passage_ligne;

  //=====Création du message.
  $msg = $passage_ligne;
  $msg.= $passage_ligne."Nom : ".$nom_txt.$passage_ligne;
  $msg.= $passage_ligne."Email : ".$email_txt.$passage_ligne;
  $msg.= $passage_ligne."Tel : ".$tel_txt.$passage_ligne;
  $msg.= $passage_ligne.$message_txt.$passage_ligne;

  //=====Envoi de l'e-mail.
  mail($to,$sujet,$msg,$header);
?>
