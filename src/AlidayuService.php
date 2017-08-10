<?php
/**
 * Created by PhpStorm.
 * User: saber
 * Date: 2017/8/9
 * Time: 下午9:08
 */

namespace iscms\Alidayu;

use Illuminate\Support\Facades\Log;
use iscms\Alidayu\Exceptions\AlidayuSendMessageException;

class AlidayuService
{
    private $alidayu;

    public function __construct($accessKeyId, $accessKeySecret)
    {
        $this->alidayu = new Alidayu($accessKeyId, $accessKeySecret);
    }

    /**
     * @param string $signName
     * @param string $templateCode
     * @param string $phoneNumbers
     * @param array|null $templateParam
     * @param string|null $outId
     */
    public function sendMessage(string $signName, string $templateCode, string $phoneNumbers, array $templateParam = [], string $outId = null)
    {
        $result = $this->alidayu->sendSms($signName, $templateCode, $phoneNumbers, $templateParam, $outId);

        return $this->write_log($signName, $templateCode, $phoneNumbers, $templateParam, $outId, $result);
    }


    public function query()
    {

    }

    private function checkSendResult($result)
    {
        if ($result->Code === 'OK') {
            return true;
        } else {
            return false;
        }
    }


    private function write_log(string $signName, string $templateCode, string $phoneNumbers, array $templateParam = [], string $outId = null, $result)
    {
        $status=$this->checkSendResult($result);
        Log::info("使用[{$signName}]签名,发送模板[{$templateCode}]短信到[{$phoneNumbers}],参数为:[" . json_encode($templateParam) . "],发送结果为" . $status);
        return [
            'result'=>$status,
            'message'=>$result->Message . ' 状态码:' . $result->Code
        ];
    }
}