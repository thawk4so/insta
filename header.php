<?php 
$uri = 'https://www.instagram.com/footjobshoutout/media/';
$ch = curl_init($uri);
curl_setopt_array($ch, array(
    CURLOPT_HTTPHEADER  => array('Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                                'Accept-Encoding:    gzip, deflate, br',
                                'Accept-Language:    en-US,en;q=0.5',
                                'Connection:    keep-alive',
                                'Cookie:    csrftoken=6Mf2E7cQDRQy9hREIFMolc8FlyaHjs1f; mid=WVZUpAAEAAEwwJctPlfDTrffc-Xd; rur=ATN; ig_vw=1350; ig_pr=1; fbm_124024574287414=base_domain=.instagram.com; fbsr_124024574287414=VhvNdkrxX6yWisRStq-4xTZqo1D97PLJdJ1Zg8NcJU8.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUURiY2ktX21JRnFhdEVwQmFzd3dBOGZNc0IzRmUxcTdPbnJETTIwRHRVUGo2RlY0WTltZTZUdTByT19xenVWT1dPMFhuWDdxT3hYSGxlSWplT2xFcVNwdHhVRm5UV3pSNUg5Q1lvdDJNZUZIa3c3anR2Q2dNTkV3VVhhWDJPWHg1ellsRnROM3RtaHI1OS0wWGg4UlZ5eXcxM2hrODJVZFRBb25zdGZIMEdKem5CQmFTNm56U1hVU3gtWTJlT2ZmOS1UQW0zMzB5d3ZxRFZxS01wMFlrRGItNlNscHdwaWNqV2tOYm1ObXRKRnhHREJBMWhDUWZqU2RDVm1YX2FpRE9qUkYyYVpETlZPU2ZOaVRYTmdMR19VSGVLN1c2M1JjalZsYVd1bG1RM3ZHb3BadnBnS1ZWb1Y2TklZdDkwdktaWmJ6SHlzdkZlVEcyMklxUEYweUZqdCIsImlzc3VlZF9hdCI6MTUwMDQwODk0NywidXNlcl9pZCI6IjExMzEwMzEzMzgifQ; ds_user_id=1756557203; sessionid=IGSC437f7422ab48d88326994cb53489a8c0612d79ad88e239802f830859846bb316%3AwZbnD02vIJcRENm4D6syY6OEcgD0HnEg%3A%7B%22_auth_user_id%22%3A1756557203%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_token_ver%22%3A2%2C%22_token%22%3A%221756557203%3AyUDPdrpeozKIKkMmL5CZEttFsPykgWcw%3A1371fb3fb162dbd721b76cee7bf43f275de8b19328257ffc140e012bc026590c%22%2C%22_platform%22%3A4%2C%22last_refreshed%22%3A1500408944.5716297626%2C%22asns%22%3A%7B%22time%22%3A1500408944%2C%22199.27.232.69%22%3A22571%7D%7D',
                                'Host:    www.instagram.com',
                                'Upgrade-Insecure-Requests:    1',
                                'User-Agent:    Mozilla/5.0 (Windows NT 6.1; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0'
                                ),
    CURLOPT_RETURNTRANSFER  =>true,
    CURLOPT_VERBOSE     => 1
));
$out = curl_exec($ch);
curl_close($ch);
// echo response output
echo $out;

$opts = array (
    'http' => array (
        'method' => 'POST',
        'header'=> "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
                    . "Accept-Encoding:    gzip, deflate, br\r\n"
                    . "Accept-Language:    en-US,en;q=0.5\r\n"
                    . "Connection:    keep-alive\r\n"
                    . "Cookie:    csrftoken=6Mf2E7cQDRQy9hREIFMolc8FlyaHjs1f; mid=WVZUpAAEAAEwwJctPlfDTrffc-Xd; rur=ATN; ig_vw=1350; ig_pr=1; fbm_124024574287414=base_domain=.instagram.com; fbsr_124024574287414=VhvNdkrxX6yWisRStq-4xTZqo1D97PLJdJ1Zg8NcJU8.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImNvZGUiOiJBUURiY2ktX21JRnFhdEVwQmFzd3dBOGZNc0IzRmUxcTdPbnJETTIwRHRVUGo2RlY0WTltZTZUdTByT19xenVWT1dPMFhuWDdxT3hYSGxlSWplT2xFcVNwdHhVRm5UV3pSNUg5Q1lvdDJNZUZIa3c3anR2Q2dNTkV3VVhhWDJPWHg1ellsRnROM3RtaHI1OS0wWGg4UlZ5eXcxM2hrODJVZFRBb25zdGZIMEdKem5CQmFTNm56U1hVU3gtWTJlT2ZmOS1UQW0zMzB5d3ZxRFZxS01wMFlrRGItNlNscHdwaWNqV2tOYm1ObXRKRnhHREJBMWhDUWZqU2RDVm1YX2FpRE9qUkYyYVpETlZPU2ZOaVRYTmdMR19VSGVLN1c2M1JjalZsYVd1bG1RM3ZHb3BadnBnS1ZWb1Y2TklZdDkwdktaWmJ6SHlzdkZlVEcyMklxUEYweUZqdCIsImlzc3VlZF9hdCI6MTUwMDQwODk0NywidXNlcl9pZCI6IjExMzEwMzEzMzgifQ; ds_user_id=1756557203; sessionid=IGSC437f7422ab48d88326994cb53489a8c0612d79ad88e239802f830859846bb316%3AwZbnD02vIJcRENm4D6syY6OEcgD0HnEg%3A%7B%22_auth_user_id%22%3A1756557203%2C%22_auth_user_backend%22%3A%22accounts.backends.CaseInsensitiveModelBackend%22%2C%22_auth_user_hash%22%3A%22%22%2C%22_token_ver%22%3A2%2C%22_token%22%3A%221756557203%3AyUDPdrpeozKIKkMmL5CZEttFsPykgWcw%3A1371fb3fb162dbd721b76cee7bf43f275de8b19328257ffc140e012bc026590c%22%2C%22_platform%22%3A4%2C%22last_refreshed%22%3A1500408944.5716297626%2C%22asns%22%3A%7B%22time%22%3A1500408944%2C%22199.27.232.69%22%3A22571%7D%7D\r\n"
                    . "Host:    www.instagram.com\r\n"
                    . "Upgrade-Insecure-Requests:    1\r\n"
                    . "User-Agent:    Mozilla/5.0 (Windows NT 6.1; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0\r\n"
        )
    );

$context  = stream_context_create($opts);
$returnedData= file_get_contents("https://www.instagram.com/footjobshoutout/media/", false, $context);
echo $returnedData;

?>