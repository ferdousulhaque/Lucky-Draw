## Lucky Draw

This class takes an example array (format is given in index file will also be explained below) and generates Item and Item count for winners.

### Caution

Please don't use this to generate things/prizes for their hard earned money. It is only intended to make things fun with bonus gifts only.

### Usage

Example available in example.php file.

```markdown
    'item'=>'<span style="color:red">Bag</span>',
    'chances'=>1,
    'amounts'=>[rand(1,100)]
```

- **item**: Provide your item's unique identifier (for example I have used HTML Text)
- **chances**: Weight of item. It will be compared along all the items in array. The higher the chances the greater the chances of getting the item.
- **amounts**: Array of Item amount. It can be a (randomized/single) value or can be a array like,
```markdown
    'amounts'=>[1=>100,5=>50,10=>10,20=>5]
```
in above amount example keys mean the item count and the values means the probability.

### Support

Having trouble? Create an issue!
