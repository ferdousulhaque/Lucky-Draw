class luckyDraw {
    public static function get(array $items) {
        $chances = array_column($items,'chances','item');
        $item = self::generate($chances);
        $amounts = $items[array_search($item, array_column($items, 'item'))]['amounts'];
        $count = self::generate($amounts);
        return [$item,$count];
    }

    private static function generate(array $items) {
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
