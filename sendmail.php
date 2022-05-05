<?php
// the message
$msg = "hi";

// send email
if (mail("webbased2020@gmail.com", "My subject", $msg)) {
    echo "email was sent";
} else {
    echo "email wasn't sent";
}