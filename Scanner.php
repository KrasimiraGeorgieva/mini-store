<?php declare(strict_types=1);

class Scanner
{
    protected array $scannedItems = [];
    protected array $prices = [
        '#RA' => 1.50,
        '#AP' => 3.50,
        '#WA' => 5.00,
    ];
    public function scan(string $productCode): void
    {
        if (!isset($this->scannedItems[$productCode])) {
            $this->scannedItems[$productCode] = 0;
        }

        $this->scannedItems[$productCode]++;
    }

    public function total(): string
    {
        $total = 0.0;

        foreach ($this->scannedItems as $productCode => $quantity) {
            $price = $this->prices[$productCode];

            if ($productCode === '#RA') {
                $total += ($quantity >= 3)
                    ? (3 * $price) + ($quantity - 3) * 1.00
                    : $quantity * $price;
            } elseif ($productCode === '#WA') {
                $freeWatermelons = floor($quantity / 2);
                $total += ($quantity - $freeWatermelons) * $price;
            } else {
                $total += $price * $quantity;
            }
        }

        return number_format($total, 2);
    }
}

$scanner = new Scanner();
$scanner->total();