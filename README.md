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
  "url" => "https://2071799228.cdnle.net/play.videocache.lecloud.com/255/18/8/bcloud/101641/ver_00_22-1132472772-avc-364642-aac-48000-13800-731613-08fe929efe54eb6e2ae4a3d8ea323e77-1598496634743.m3u8?crypt=70aa7f2e353&b=420&nlh=4096&nlt=60&bf=67&p2p=1&video_type=mp4&termid=2&tss=ios&platid=2&splatid=209&its=0&qos=3&fcheck=0&amltag=8&mltag=8&uid=2071673442.rp&keyitem=GOw_33YJAAbXYE-cnQwpfLlv_b2zAkYctFVqe5bsXQpaGNn3T1-vhw..&ntm=1598761200&nkey=66ad2e55c545ca5533aa07b323498bfe&nkey2=383af1ca9cedaac28aebd1417199c21e&auth_key=1598761200-1-2071673442.rp-2-209-9c6172eaaf6e6019c21519a6f38271d0&geo=CN-1-0-2&p1=3&payff=0&ajax=1&m3v=3&sign=bcloud_101641&uuid=6E64C0CD7A92ECC97BD32EF5B76EE0B0_0&cf=h5-android&playid=0&p3=310&vid=49764464&_r=json&hwtype=un&dur=13&tag=mobile&cuid=101641&ostype=android&vtype=13&pay=0&tm=1598674223&mmsid=250965401&p2=31&key=d60ea7da3f2975af85bb83895341c39a&p=101&uidx=0&errc=0&gn=3001&ndtype=0&vrtmcd=102&buss=8&cips=123.123.58.98",
  "width" => 960,
  "height" => 528
];
```

注意：获取到的url有时效性，需要用到时再获取。