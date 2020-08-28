# lecloud-vod
低权限的乐视云标准点播用户由于没有开放 API，无法获取视频文件的地址，导致难以在小程序中使用。  
通过反编译乐视播放器 js 源代码，得到获取视频文件的方法。

# 安装
```bash
composer require everalan/lecloud-vod
```
发布配置文件
```bash
php artisan vendor:publish --provider="Everalan\VOD\VODServiceProvider"
``` 
在配置文件 `lecloud-vod.php` 里修改 `uu` 为你的乐视用户的 UUID。
# 使用
```php
use Everalan\VOD\VOD;
$uu = config('lecloud-vod.uu');
$vod = new VOD($uu);
dd($vod->getVideoSummary('64f2ad7122')); //视频VU
```

输出结果
```php
[
  "pic" => "https://i0.letvimg.com/lc12_yunzhuanma/202008/28/11/34/66177372177e72ecd6759dd7c96bb754_v2_NTAxOTMzMjA0/thumb/2_640_360.jpg",
  "title" => "WEBINAR IIoT in Manufacturing Next Digital Disruption zh CN",
  "duration" => 3734,
  "url" => "https://https-play-g3proxy.lecloud.com/vod/v2/MjQxLzQzLzExMi9iY2xvdWQvMTAxNjQxL3Zlcl8wMF8yMi0xMTMyNTg5MzY3LWF2Yy0zODY0NDItYWFjLTQ4MDAwLTM3MzMyNjctMjA3MTMxNDM1LWZlZDk1MTZmZDQ1NmNhMTYwMDAyYzNiMDNjOGMzYjNlLTE1OTg1ODQwMDkwMzMubXA0?b=443&mmsid=250966102&tm=1598632627&pip=54f222eda62da80127b359cb45af4426&key=e314419016686e9efc891eefdd9c33ce&platid=2&splatid=209&payff=0&cuid=101641&vtype=13&dur=3733&p1=3&p2=31&p3=310&cf=h5-android&p=101&playid=0&tss=ios&tag=mobile&sign=bcloud_101641&termid=2&pay=0&ostype=android&hwtype=un",
  "width" => 960,
  "height" => 528
];
```