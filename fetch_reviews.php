<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $google_review_url = "https://maps.app.goo.gl/XMFZ3UQhKrkaobm48?g_st=iw";
    echo json_encode(['success' => true, 'redirect_url' => $google_review_url]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid review ID.']);
}
?>
