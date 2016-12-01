<?php

class CheckUrlsTest extends \PHPUnit\Framework\TestCase
{
    
    function test_checker_detects_failed_urls()
    {
        $urls        = [
            'https://babystep.tv/en',
            'https://babystep.tv/ru',
            'https://babystep.tv/gg',
        ];
        $failed_urls = [];
        
        $request = new \Lezhnev74\HLSMonitor\Services\CheckUrls\CheckUrlsRequest($urls,
            function ($url, $reason) use (&$failed_urls) {
                $failed_urls[] = $url;
            });
        
        $service = get_container()->make(Lezhnev74\HLSMonitor\Services\CheckUrls\CheckUrls::class, [
            'request' => $request,
        ]);
        $service->execute();
        
        $this->assertEquals(1, count($failed_urls));
    }
    
}