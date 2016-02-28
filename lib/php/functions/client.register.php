<?php

  $isRegistered = isset($_SESSION['client']) && $_SESSION['client'] !== null;

  if (!$isRegistered) {
    $client = new Client(session_id());
    $success = true;

    if (!Client::isKnown($client)) {
      $success = Client::save($client);
    }

    if ($success) {
      $_SESSION['client'] = $client;
    } else {
      FileFunctions::log('Registration of client failed..');
    }

  }
