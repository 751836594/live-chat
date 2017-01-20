<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/19/16 10:52 AM
 */

namespace common\helper;

use yii;

/**
 * Class DateTimeHelper
 * @package common\helpers
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 */
class DateTimeHelper
{
    /**
     * 解析date time range string，获取开始日期和结束日期
     * @param $dateRangeStr e.g. 2015-10-09 - 2015-10-30
     * @return array ['startDate' => 'start date timestamp', 'endDate' => 'end date timestamp']
     */
    public static function getStartEndDateFromRange($dateRangeStr)
    {
        $startDate = 0;
        $endDate = 0;
        $pos = strpos($dateRangeStr, '-', 10); //find "-" in timerange string，如 2015-10-09 - 2015-10-30
        if ($pos != false) {
            //10位置后存在"-"字符
            $startDate = strtotime(trim(substr($dateRangeStr, 0, $pos)));
            $endDate = strtotime(trim(substr($dateRangeStr, $pos + 1)));
        } else {
            $startDate = 0;
            $endDate = 0;
        }
        return ['startDate' => $startDate, 'endDate' => $endDate];
    }

    /**
     * 解析date time range string，获取开始时间和结束时间
     * @param $dateTimeRangeStr 2015-12-05 18:09 - 2015-12-06 23:59
     * @return array ['startTime' => 'start time timestamp', 'endTime' => 'end time timestamp']
     */
    public static function getStartEndTimeFromRange($dateTimeRangeStr)
    {
        $startTime = 0;
        $endTime = 0;
        $pos = strpos($dateTimeRangeStr, '-', 12); //find "-" in timerange string，如 2015-10-09 - 2015-10-30
        if ($pos != false) {
            //12位置后存在"-"字符
            $startTime = strtotime(trim(substr($dateTimeRangeStr, 0, $pos)));
            $endTime = strtotime(trim(substr($dateTimeRangeStr, $pos + 1)));
        } else {
            $startTime = 0;
            $endTime = 0;
        }
        return ['startTime' => $startTime, 'endTime' => $endTime];
    }

    /**
     * 获得格式化的时间日期
     * Y-m-d
     * Y-m-d H:i
     * Y-m-d H:i:s
     */
    public static function getFormattedDateTime($timestamp, $format = 'Y-m-d')
    {
        if($timestamp == ''){
            return '-';
        }else{
            return date($format, $timestamp);
        }

    }
} 