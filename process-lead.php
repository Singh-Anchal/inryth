<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    json_response(['ok' => false, 'message' => 'Please submit the form.'], 405);
}

if (!verify_csrf($_POST['csrf'] ?? null)) {
    json_response(['ok' => false, 'message' => 'Your session expired. Refresh the page and try again.'], 419);
}

if (trim((string) ($_POST['website_hp'] ?? '')) !== '') {
    json_response(['ok' => true, 'redirect' => url('/thank-you')]);
}

if (rate_limited('lead-form')) {
    json_response(['ok' => false, 'message' => 'Please wait a few minutes before sending another enquiry, or continue on WhatsApp.'], 429);
}

$type = sanitize_text($_POST['form_type'] ?? 'enquiry', 30);
$allowed_types = ['enquiry', 'website', 'marketing'];
if (!in_array($type, $allowed_types, true)) {
    $type = 'enquiry';
}

$name = sanitize_text($_POST['name'] ?? '', 120);
$phone = sanitize_text($_POST['phone'] ?? '', 30);
$email = sanitize_text($_POST['email'] ?? '', 180);

$errors = [];
if (mb_strlen($name) < 2) {
    $errors[] = 'Please enter your name.';
}
if (!valid_phone($phone)) {
    $errors[] = 'Enter a valid phone number.';
}
if ($email !== '' && !valid_email($email)) {
    $errors[] = 'Enter a valid email or leave it blank.';
}
if ($errors) {
    json_response(['ok' => false, 'message' => implode(' ', $errors)], 422);
}

$lead = [
    'id' => bin2hex(random_bytes(8)),
    'created_at' => gmdate('c'),
    'form_type' => $type,
    'page_path' => sanitize_text($_POST['page_path'] ?? '', 200),
    'ip_hash' => hash('sha256', client_ip()),
    'name' => $name,
    'phone' => $phone,
    'email' => $email,
    'business_name' => sanitize_text($_POST['business_name'] ?? '', 160),
    'service' => sanitize_text($_POST['service'] ?? '', 80),
    'budget' => sanitize_text($_POST['budget'] ?? '', 40),
    'message' => sanitize_text($_POST['message'] ?? '', 2000),
    'business_type' => sanitize_text($_POST['business_type'] ?? '', 120),
    'website_type' => sanitize_text($_POST['website_type'] ?? '', 80),
    'pages' => sanitize_text($_POST['pages'] ?? '', 40),
    'features' => sanitize_text($_POST['features'] ?? '', 300),
    'timeline' => sanitize_text($_POST['timeline'] ?? '', 80),
    'current_website' => sanitize_text($_POST['current_website'] ?? '', 200),
    'marketing_goal' => sanitize_text($_POST['marketing_goal'] ?? '', 200),
    'ad_budget' => sanitize_text($_POST['ad_budget'] ?? '', 80),
    'user_agent' => sanitize_text($_SERVER['HTTP_USER_AGENT'] ?? '', 250),
];

if (config('lead_storage')) {
    $dir = STORAGE_PATH . DIRECTORY_SEPARATOR . 'leads';
    if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
        json_response(['ok' => false, 'message' => 'Could not store the enquiry. Please continue on WhatsApp.'], 500);
    }
    $file = $dir . DIRECTORY_SEPARATOR . gmdate('Ymd-His') . '-' . $lead['id'] . '.json';
    file_put_contents($file, json_encode($lead, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$webhook = trim((string) config('lead_webhook_url', ''));
if ($webhook !== '') {
    $payload = json_encode($lead);
    $ctx = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json\r\n",
            'content' => $payload,
            'timeout' => 4,
            'ignore_errors' => true,
        ],
    ]);
    @file_get_contents($webhook, false, $ctx);
}

$notify = trim((string) config('lead_notify_email', ''));
if ($notify !== '' && filter_var($notify, FILTER_VALIDATE_EMAIL)) {
    $body = "New {$type} enquiry from {$name}\nPhone: {$phone}\nEmail: {$email}\nService: {$lead['service']}\nMessage: {$lead['message']}\n";
    @mail($notify, '[' . config('site_name') . '] New website enquiry', $body, 'Content-Type: text/plain; charset=UTF-8');
}

json_response(['ok' => true, 'redirect' => url('/thank-you')]);
