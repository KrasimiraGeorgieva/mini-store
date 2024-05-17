<?php declare(strict_types=1);

namespace unit;

require 'Scanner.php';

use PHPUnit\Framework\TestCase;
use Scanner;

final class ScannerTest extends TestCase
{
    public function test_total_price_with_special_discount(): void
    {
        $scanner = new Scanner();
        $scanner->scan('#RA');
        $scanner->scan('#RA');
        $scanner->scan('#RA');
        $scanner->scan('#RA');
        $scanner->scan('#WA');
        $scanner->scan('#WA');
        $scanner->scan('#AP');
        $scanner->scan('#RA');

        $this->assertEquals('15.00', $scanner->total());
    }

    public function test_total_price_with_special_discount_without_RA(): void
    {
        $scanner = new Scanner();
        $scanner->scan('#WA');
        $scanner->scan('#AP');
        $scanner->scan('#WA');
        $scanner->scan('#WA');
        $scanner->scan('#WA');
        $scanner->scan('#AP');
        $scanner->scan('#AP');
        $scanner->scan('#WA');

        $this->assertEquals('25.50', $scanner->total());
    }

    public function test_total_price_with_special_discount_same_number_of_product_type(): void
    {
        $scanner = new Scanner();
        $scanner->scan('#AP');
        $scanner->scan('#WA');
        $scanner->scan('#RA');
        $scanner->scan('#AP');
        $scanner->scan('#WA');
        $scanner->scan('#RA');
        $scanner->scan('#AP');
        $scanner->scan('#WA');
        $scanner->scan('#RA');

        $this->assertEquals('25.00', $scanner->total());
    }
}