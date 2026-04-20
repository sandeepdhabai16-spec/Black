<?php
// Get mobile number from GET parameter
$mobile = isset($_GET['num']) ? $_GET['num'] : '987643210';

// Function to execute cURL requests
function executeCurl($url, $headers, $data, $method = 'POST') {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'response' => $response,
        'error' => $error
    ];
}

// Function to process all APIs
function processAllAPIs($mobile) {
    $results = [];
    
    // API 1: Swiggy
    $swiggyData = json_encode(["mobile" => $mobile]);
    $swiggyHeaders = [
        "Host: profile.swiggy.com",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "accept-encoding: gzip, deflate, br",
        "content-type: application/json",
        "Content-length: " . strlen($swiggyData)
    ];
    $results['swiggy'] = executeCurl(
        "https://profile.swiggy.com/api/v3/app/request_call_verification",
        $swiggyHeaders,
        $swiggyData
    );
    
    // API 2: IndiaLends
    $indialendsData = "MobileNumber=" . urlencode($mobile) . "&Mode=2";
    $indialendsHeaders = [
        "Host: indialends.com",
        "content-length: " . strlen($indialendsData),
        'sec-ch-ua-platform: "Android"',
        "x-requested-with: XMLHttpRequest",
        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/131.0.6778.135 Mobile Safari/537.36",
        "accept: */*",
        'sec-ch-ua: "Android WebView";v="131", "Chromium";v="131", "Not_A Brand";v="24"',
        "content-type: application/x-www-form-urlencoded; charset=UTF-8",
        "sec-ch-ua-mobile: ?1",
        "origin: https://indialends.com",
        "sec-fetch-site: same-origin",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "referer: https://indialends.com/personal-loan",
        "accept-encoding: gzip, deflate, br, zstd",
        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
        "priority: u=1, i"
    ];
    $results['indialends'] = executeCurl(
        "https://indialends.com/pl/SP_MVResend",
        $indialendsHeaders,
        $indialendsData
    );
    
    // API 3: PenPencil
    $penpencilData = json_encode([
        "organizationId" => "5eb393ee95fab7468a79d189",
        "mobile" => $mobile
    ]);
    $penpencilHeaders = [
        "Host: api.penpencil.co",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "accept-encoding: gzip, deflate, br",
        "content-type: application/json",
        "Content-length: " . strlen($penpencilData)
    ];
    $results['penpencil'] = executeCurl(
        "https://api.penpencil.co/v1/users/resend-otp?smsType=2",
        $penpencilHeaders,
        $penpencilData
    );
    
    // API 4: Tata Capital
    $tatacapitalData = json_encode([
        "phone" => $mobile,
        "applSource" => "",
        "isOtpViaCallAtLogin" => "true"
    ]);
    $tatacapitalHeaders = [
        "Host: mobapp.tatacapital.com",
        "user-agent: okhttp/3.9.1",
        "accept: */*",
        "accept-encoding: gzip, deflate, br",
        "content-type: application/json",
        "Content-length: " . strlen($tatacapitalData)
    ];
    $results['tatacapital'] = executeCurl(
        "https://mobapp.tatacapital.com/DLPDelegator/authentication/mobile/v0.1/sendOtpOnVoice",
        $tatacapitalHeaders,
        $tatacapitalData
    );
    
    // API 5: Zomato SMS
    $zomatoSmsData = "number=" . urlencode($mobile) . "&country_id=1&lc=bed7238d427f41e7a34ea6ea134d2628&type=initiate&verification_type=sms&package_name=com.application.zomato&message_uuid=";
    $zomatoSmsHeaders = [
        "Host: accounts.zomato.com",
        "Accept: */*",
        "user-agent: &source=android_market&version=9&device_manufacturer=google&device_brand=google&device_model=Pixel+4&api_version=907&app_version=v19.0.7",
        "content-type: application/x-www-form-urlencoded",
        "accept-encoding: br, gzip",
        "Content-Length: " . strlen($zomatoSmsData)
    ];
    $results['zomato_sms'] = executeCurl(
        "https://accounts.zomato.com/login/phone",
        $zomatoSmsHeaders,
        $zomatoSmsData
    );
    
    // API 6: Zomato Call
    $zomatoCallData = "number=" . urlencode($mobile) . "&country_id=1&lc=bed7238d427f41e7a34ea6ea134d2628&type=initiate&verification_type=call&package_name=&message_uuid=sms-service-v2-12cf2bdc-7cd9-4e1a-9cd1-6470f83d56f0";
    $zomatoCallHeaders = [
        "Host: accounts.zomato.com",
        "Accept: */*",
        "user-agent: &source=android_market&version=9&device_manufacturer=google&device_brand=google&device_model=Pixel+4&api_version=907&app_version=v19.0.7",
        "content-type: application/x-www-form-urlencoded",
        "accept-encoding: br, gzip",
        "Content-Length: " . strlen($zomatoCallData)
    ];
    $results['zomato_call'] = executeCurl(
        "https://accounts.zomato.com/login/phone",
        $zomatoCallHeaders,
        $zomatoCallData
    );
    
    // API 7: Pride of Cows
    $prideofcowsData = json_encode(["MobileNo" => $mobile]);
    $prideofcowsHeaders = [
        "Host: prideofcows.com",
        "Connection: keep-alive",
        'sec-ch-ua-platform: "Android"',
        "X-CSRF-Token: iZ0Sk-jaQuHHIP1lFfuV47-LtTgSErAPTnuCuoebNVP6yUf0xagsrY5FiSFhncSh3b7SXUJ25F19GNPA4_dPAw==",
        'sec-ch-ua: "Chromium";v="140", "Not=A?Brand";v="24", "Android WebView";v="140"',
        "sec-ch-ua-mobile: ?1",
        "X-Requested-With: XMLHttpRequest",
        "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
        "Accept: */*",
        "Content-Type: application/json",
        "Origin: https://prideofcows.com",
        "Sec-Fetch-Site: same-origin",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Dest: empty",
        "Referer: https://prideofcows.com/poc/",
        "Accept-Encoding: gzip, deflate, br, zstd",
        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8",
        "Content-Length: " . strlen($prideofcowsData)
    ];
    $results['prideofcows'] = executeCurl(
        "https://prideofcows.com/prideofcows/api/customer/voiceotp",
        $prideofcowsHeaders,
        $prideofcowsData
    );
    
    // API 8: Milkbasket
    $milkbasketData = json_encode([
        "operationName" => "registerNumber",
        "variables" => [
            "phone" => $mobile,
            "retry" => true,
            "retryType" => "voice",
            "appHash" => "",
            "udid" => "7X6mgrT7lIYb3OkF"
        ],
        "query" => "mutation registerNumber(\$phone: String!, \$retry: Boolean!, \$retryType: String!, \$appHash: String!, \$udid: String!) {\n  registerPhoneNumber(\n    phone: \$phone\n    retry: \$retry\n    retryType: \$retryType\n    appHash: \$appHash\n    udid: \$udid\n  ) {\n    status\n    error\n    errorMsg\n    otpBlockTime\n    __typename\n  }\n}"
    ]);
    $milkbasketHeaders = [
        "Host: consumerbff.milkbasket.com",
        "content-type: application/json",
        'sec-ch-ua-platform: "Android"',
        'sec-ch-ua: "Not;A=Brand";v="99", "Android WebView";v="139", "Chromium";v="139"',
        "accept: */*",
        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/139.0.7258.158 Mobile Safari/537.36",
        "origin: https://milkbasket.web.app",
        "sec-fetch-site: cross-site",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "referer: https://milkbasket.web.app/",
        "accept-encoding: gzip, deflate, br, zstd",
        "Content-Length: " . strlen($milkbasketData)
    ];
    $results['milkbasket'] = executeCurl(
        "https://consumerbff.milkbasket.com/graphql",
        $milkbasketHeaders,
        $milkbasketData
    );
    
    // API 9: Happi Mobiles
    $happimobilesData = json_encode(["phone" => $mobile]);
    $happimobilesHeaders = [
        "Host: dev-services.happimobiles.com",
        "Connection: keep-alive",
        "Content-Length: " . strlen($happimobilesData),
        'sec-ch-ua-platform: "Android"',
        "x-sign: 039babb5984ef534593dbf045e54a798522d3fd35a91b1652aaa12b12bc6d51d",
        "User-Agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.7339.51 Mobile Safari/537.36",
        'sec-ch-ua: "Chromium";v="140", "Not=A?Brand";v="24", "Android WebView";v="140"',
        "content-type: application/json",
        "sec-ch-ua-mobile: ?1",
        "Accept: */*",
        "Origin: https://www.happimobiles.com",
        "X-Requested-With: mark.via.gp",
        "Sec-Fetch-Site: same-site",
        "Sec-Fetch-Mode: cors",
        "Sec-Fetch-Dest: empty",
        "Referer: https://www.happimobiles.com/",
        "Accept-Encoding: gzip, deflate, br, zstd",
        "Accept-Language: en-GB,en-US;q=0.9,en;q=0.8"
    ];
    $results['happimobiles'] = executeCurl(
        "https://dev-services.happimobiles.com/api/user-login/homepage",
        $happimobilesHeaders,
        $happimobilesData
    );
    
    // API 10: Smartcoin
    $smartcoinData = json_encode([
        "phone_number" => $mobile,
        "app_version" => "100085",
        "channel" => "IVR",
        "request_type" => "REGISTRATION",
        "onboarding_consent" => true
    ]);
    $smartcoinHeaders = [
        "Host: webapp.smartcoin.co.in",
        "content-length: " . strlen($smartcoinData),
        'sec-ch-ua-platform: "Android"',
        "user_platform: WEBFLOW",
        'sec-ch-ua: "Android WebView";v="143", "Chromium";v="143", "Not A(Brand";v="24"',
        "sec-ch-ua-mobile: ?1",
        "platform_code: olyv",
        "user-agent: Mozilla/5.0 (Linux; Android 13; RMX3081 Build/RKQ1.211119.001) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.7499.34 Mobile Safari/537.36",
        "accept: application/json, text/plain, */*",
        "content-type: application/json",
        "origin: https://app.olyv.co.in",
        "x-requested-with: mark.via.gp",
        "sec-fetch-site: cross-site",
        "sec-fetch-mode: cors",
        "sec-fetch-dest: empty",
        "referer: https://app.olyv.co.in/",
        "accept-encoding: gzip, deflate, br, zstd",
        "accept-language: en-GB,en-US;q=0.9,en;q=0.8",
        "priority: u=1, i"
    ];
    $results['smartcoin'] = executeCurl(
        "https://webapp.smartcoin.co.in/webflow/pre_auth/otp/request",
        $smartcoinHeaders,
        $smartcoinData
    );
    
    return $results;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit'])) {
    $results = processAllAPIs($mobile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Caller</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; text-align: center; }
        .form-group { margin: 20px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
        button { background: #007bff; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-size: 16px; cursor: pointer; display: block; margin: 20px auto; }
        button:hover { background: #0056b3; }
        .result { margin-top: 30px; }
        .api-result { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 15px; margin-bottom: 15px; }
        .api-name { font-weight: bold; color: #007bff; margin-bottom: 10px; }
        .status { display: inline-block; padding: 5px 10px; border-radius: 3px; font-weight: bold; }
        .status-success { background: #d4edda; color: #155724; }
        .status-error { background: #f8d7da; color: #721c24; }
        pre { background: #343a40; color: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; font-size: 12px; }
        .mobile-info { background: #e7f3ff; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>API Caller</h1>
        
        <div class="mobile-info">
            Current Mobile Number: <strong><?php echo htmlspecialchars($mobile); ?></strong>
        </div>
        
        <form method="GET" action="">
            <div class="form-group">
                <label for="num">Enter Mobile Number:</label>
                <input type="text" id="num" name="num" value="<?php echo htmlspecialchars($mobile); ?>" required>
            </div>
            <button type="submit" name="submit">Submit All APIs</button>
        </form>
        
        <?php if (isset($results)): ?>
        <div class="result">
            <h2>Results</h2>
            <p>Total APIs executed: <?php echo count($results); ?></p>
            
            <?php foreach ($results as $apiName => $result): ?>
            <div class="api-result">
                <div class="api-name"><?php echo ucfirst(str_replace('_', ' ', $apiName)); ?></div>
                <div class="status <?php echo $result['status'] >= 200 && $result['status'] < 300 ? 'status-success' : 'status-error'; ?>">
                    Status: <?php echo $result['status']; ?>
                </div>
                
                <?php if ($result['error']): ?>
                    <p>Error: <?php echo htmlspecialchars($result['error']); ?></p>
                <?php endif; ?>
                
                <?php if ($result['response']): ?>
                    <details>
                        <summary>View Response</summary>
                        <pre><?php echo htmlspecialchars($result['response']); ?></pre>
                    </details>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>