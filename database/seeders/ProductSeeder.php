<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                'name' => 'Zaštitna maska za mobitel',
                "description" => "Kvalitetna, pouzdana i neklizajuca maska pruza vrhunsku zastitu za vas mobitel. Stiti ga od udaraca, ogrebotina i padova.",
                'photo' => 'https://i.ebayimg.com/00/s/ODY0WDgwMA==/z/9S4AAOSwMZRanqb7/$_35.JPG?set_id=89040003C1',
                'price' => 21.00,
                'slug' => Str::slug('Zaštitna maska za mobitel'),
            ]
        );
        DB::table('products')->insert(
            [
                'name' => 'Apple iPhone X',
                'description' => 'GSM & CDMA FACTORY UNLOCKED! WORKS WORLDWIDE! FACTORY UNLOCKED. iPhone x 64gb. iPhone 8 64gb. iPhone 8 64gb. iPhone X with iOS 11.',
                'photo' => 'https://i.ebayimg.com/00/s/MTYwMFg5OTU=/z/9UAAAOSwFyhaFXZJ/$_35.JPG?set_id=89040003C1',
                'price' => 983.00,
                'slug' => Str::slug('Apple iPhone X')
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'Google Pixel 2 XL',
                'description' => 'New condition
• No returns, but backed by eBay Money back guarantee',
                'photo' => 'https://i.ebayimg.com/00/s/MTYwMFg4MzA=/z/G2YAAOSwUJlZ4yQd/$_35.JPG?set_id=89040003C1',
                'price' => 675.00,
                'slug' => Str::slug('Google Pixel 2 XL')
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'LG V10 H900',
                'description' => 'NETWORK Technology GSM. Protection Corning Gorilla Glass 4. MISC Colors Space Black, Luxe White, Modern Beige, Ocean Blue, Opal Blue. SAR EU 0.59 W/kg (head).',
                'photo' => 'https://i.ebayimg.com/00/s/NjQxWDQyNA==/z/VDoAAOSwgk1XF2oo/$_35.JPG?set_id=89040003C1',
                'price' => 159.99,
                'slug' => Str::slug('LG V10 H900')
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'Huawei Elate',
                'description' => 'Cricket Wireless - Huawei Elate. New Sealed Huawei Elate Smartphone.',
                'photo' => 'https://ssli.ebayimg.com/images/g/aJ0AAOSw7zlaldY2/s-l640.jpg',
                'price' => 68.00,
                'slug' => Str::slug('Huawei Elate')
            ]
        );

        DB::table('products')->insert(
            [
                'name' => 'HTC One M10',
                'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
                'photo' => 'https://i.ebayimg.com/images/g/u-kAAOSw9p9aXNyf/s-l500.jpg',
                'price' => 129.99,
                'slug' => Str::slug('HTC One M10')
            ]
        );
    }
}
