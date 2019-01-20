<?php
class LuckyDraw {
    /**
     * @param array $items
     * @return array with Item Code/Name and Item Counter
     */
    public static function get(array $items) {
        if(count($items)<1){
            throw new \LengthException('Invalid number of items!');
        }
        foreach($items as $item){
            if(!isset($item['item'])||!isset($item['chances'])||!isset($item['amounts'])){
                throw new \InvalidArgumentException('Required keys(item,chances,amounts) not present with all items!');
            } elseif(!is_int($item['chances'])){
                throw new \UnexpectedValueException('Chances should be an Integer value!');
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
        $rand = mt_rand(1, (int) array_sum($items));
        foreach ($items as $key => $value) {
            $rand -= $value;
            if ($rand <= 0) {
                return $key;
            }
        }
    }
}