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
        foreach($items as $item){
            if(!isset($item['item'])||!isset($item['chances'])||!isset($item['amounts'])){
                throw new \InvalidArgumentException('Required keys(item,chances,amounts) not present with all items!');
            } elseif(!is_numeric($item['chances'])){ //Enable fixed Decimal places
                throw new \UnexpectedValueException('Chances should be a number(integer/float)!');
            } elseif(!is_array($item['amounts'])){
                throw new \UnexpectedValueException('Amounts should be a formatted array!');
            }
        }
        return self::gift($items);
    }
    private static function gift($items) {
        $chances = array_column($items,'chances','item');
        $item = self::generate($chances);
        $amounts = $items[array_search($item, array_column($items, 'item'))]['amounts'];
        $count = self::generate($amounts);
        return [$item,$count];
    }
    private static function generate($items) {
        if(count($items)==1) return $items[0];
        $min=min($items);
        $return = array_search(max($items), $items);
        if ((int) $min != $min) {
            $multiplier=str_pad(1,strlen(explode(".",$min)[1])+1,'0');
            $items=array_combine(array_keys($items),array_map('bcmul', $items, array_fill(0, count($items), $multiplier)));
        }
        if(array_sum($items)>mt_getrandmax()||array_sum($items)<1)
            throw new \UnexpectedValueException('Chances(Item/Amount) out of range!');
        $rand = mt_rand(1, (int)array_sum($items));
        foreach ($items as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
        return $return;
    }
}
