<?php namespace Everalan\VOD;

use Everalan\Api\Exception\VODException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class VOD
{
    protected $uu;
    protected $UUID;
    public function __construct($uu)
    {
        $this->uu = $uu;
        $this->UUID = Str::random(32);
    }

    /**
     * 获取视频摘要信息
     * @param $vu
     * @param int $media_index 多重编码的时候，指定第几个编码，如果指定为-1，则是最后一个，通常是最清晰的
     * @return array
     * @throws VODException
     */
    public function getVideoSummary($vu, $media_index = -1)
    {
        $info = $this->getVideoInfo($vu);
        if($media_index == -1) {
            $media_index = count($info['videoinfo']['medialist']) - 1;
        }
        $out = [
            'pic' => $info['videoinfo']['pic'],
            'title' => urldecode($info['videoinfo']['title']),
            'duration' => $info['videoinfo']['duration'],
            'url' => $this->getM3U8Url($info['videoinfo']['medialist'][$media_index]['urllist'][0]['url'], $info['videoinfo']['vid']),
            'width' => $info['videoinfo']['medialist'][$media_index]['vwidth'],
            'height' => $info['videoinfo']['medialist'][$media_index]['vheight'],
        ];
        return $out;
    }

    /**
     * 从乐视获取完整视频信息
     * @param $vu
     * @return mixed
     * @throws VODException
     */
    protected function getVideoInfo($vu)
    {
        $params = [
            'cf' =>"html5",
            'ran' => time(),
            'pver' => "H5_Vod_20200610_4.5.20",
            'bver' => "chrome84.0.4147.135",
            'uuid' => $this->UUID,
            'pf' => "html5",
            'spf' => 0,
            'uu' => "dfa091e731",
            'vu' => $vu,
            'lang' => "zh_CN",
            'pet' => time() * 10000,
        ];

        $params['sign'] = $this->sign([$params['cf'], $params['uu'], $params['vu'], $params['ran']]);

        $url = 'http://apiletv.lecloud.com/gpc.php?format=json&ver=2.4&' . http_build_query($params) . '&page_url=http%3A%2F%2Fwww.ppthub.com.cn%2Fv.html&callback=letvcloud159862438441131';
        $ret = Http::get($url)->json();
        if($ret['code'] !== 0) {
            throw new VODException($ret['message'] ?: '获取视频信息失败');
        }
        return $ret['data'];
    }

    protected function getM3U8Url($url, $vid)
    {
        $url = base64_decode($url) . '&uuid=6E64C0CD7A92ECC97BD32EF5B76EE0B0_0&vid=49764464&ajax=1&_r=json&format=1&expect=3';
        return Http::get($url)->json()['location'];
    }
    protected function sign($strs)
    {
        return md5(join("", $strs) . "fbeh5player12c43eccf2bec3300344");
    }
}
