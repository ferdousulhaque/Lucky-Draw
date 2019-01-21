<?php
class LuckyDraw {
    /**
     * @param array $items, the list of items
     * @return array with Item Code/Name and Item Counter
     * @exception If required keys not present/values for the keys are not properly formatted
     */
    public static function get(array $items) {
        if(count($items)<1){
            throw new \LengthException('Invalid number of items!');
        }
        $length=0;
        foreach($items as $item){
            if(!isset($item['item'])||!isset($item['chances'])||!isset($item['amounts'])){
                throw new \InvalidArgumentException('Required keys(item,chances,amounts) not present with all items!');
            } elseif(!is_numeric($item['chances'])){
                throw new \UnexpectedValueException('Chances should be a number(integer/float)!');
            } elseif(!is_array($item['amounts'])){
                throw new \UnexpectedValueException('Amounts should be a formatted array!');
            }
            if ((int) $item['chances'] != $item['chances']) {
                $fraction=strlen(explode(".",$item['chances'])[1])+1;
                if($fraction>$length)$length=$fraction;
            }
        }
        return self::gift($items,$length);
    }
    private static function gift($items,$length) {
        $chances = array_column($items,'chances','item');
        if($length>0)
            $chances=array_combine(
                array_keys($chances),
                array_map('bcmul', $chances, 
                array_fill(0, count($chances), 
                str_pad(1,$length,'0'))));
        $item = self::generate($chances);
        $amounts = $items[array_search($item, array_column($items, 'item'))]['amounts'];
        $count = self::generate($amounts);
        return [$item,$count];
    }
    private static function generate($items) {
        if(count($items)==1) return $items[0];
        $min=min($items);$sum=array_sum($items);
        if($sum>mt_getrandmax()||$sum<1)
            throw new \UnexpectedValueException('Chances(Item/Amount) out of range!');
        $rand = mt_rand(1, (int)$sum);
        foreach ($items as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
        return array_search(max($items), $items);
    }
}
