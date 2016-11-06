<?php

return [
    'apiKey'      => 'be3024178c0140178d355571ac43fc7c',
    'apiSecret'   => '023a875f1c7447078918fdf92f27326b',
//    'apiCallback' => 'http://instaprint.alpha.trycatch.in.th/callback'
    'apiCallback' => 'http://' . $_SERVER["SERVER_NAME"] . '/callback'
//    'apiCallback' => 'http://nds-instaprint.dev/callback'
];
