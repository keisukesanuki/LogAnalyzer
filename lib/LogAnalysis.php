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
     * @param string $dateFieldNum
     * @param string $anyFieldNum
     * @param string $headNum
     * @return string|null
     */
    public function getAggressiveItem($dateFieldNum = "4", $anyFieldNum = "1", $headNum = "5")
    {
        $command = "awk -vFdate=`echo $this->from_date` -vTdate=`echo $this->to_date` ' { if (\$$dateFieldNum > Fdate && \$$dateFieldNum < Tdate) print \$$anyFieldNum}' $this->name | cut -f2 | cut -d: -f2 | sort -n | uniq -c | sort -rn | head -n $headNum";
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