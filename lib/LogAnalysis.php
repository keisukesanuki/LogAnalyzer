<?php

class LogAnalysis 
{
    public $name;
    public $from_date;
    public $to_date;

    /**
     * NOTE: コンストラクタ
     */
    public function __construct(string $name, string $from_date, string $to_date) 
    {
        $this->name = $name;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
     * TODO: 
     */
    public function thisMethodTest()
    {
        $command = "awk -vFdate=`echo $this->from_date` -vTdate=`echo $this->to_date` ' { if ($4 > Fdate && $4 < Tdate) print $7}' $this->name";
        $output = shell_exec($command);
        return $output;
    }

    /**
     * @param string $dateFieldNum
     * @param string $ipFieldNum
     * @param string $headNum
     * @return string|null
     */
    public function getAggressiveIP($dateFieldNum = "4", $ipFieldNum = "1", $headNum = "5")
    {
        $command = "awk -vFdate=`echo $this->from_date` -vTdate=`echo $this->to_date` ' { if (\$$dateFieldNum > Fdate && \$$dateFieldNum < Tdate) print \$$ipFieldNum}' $this->name | cut -f2 | cut -d: -f2 | sort -n | uniq -c | sort -rn | head -n $headNum";
        $output = shell_exec($command);
        return $output;
    }

    /**
     * @param string $dateFieldNum
     * @return string|null
     */
    public function getMinutesNum($dateFieldNum = "4")
    {
        $command = "awk -vFdate=`echo $this->from_date` -vTdate=`echo $this->to_date` ' { if (\$$dateFieldNum > Fdate && \$$dateFieldNum < Tdate) print \$$dateFieldNum}' $this->name | awk -F\":\" '{print $1\" \"$2\":\"$3}' | sort | uniq -c";
        $output = shell_exec($command);
        return $output;
    }

}

?>