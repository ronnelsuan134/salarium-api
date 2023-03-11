<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->banks() as $index => $bank) {
            Bank::create($bank);
        }
    }

    private function banks()
    {
        return [
            [
                'name' => 'Alipay',
                'type' => 'instapay'
            ],
            [
                'name' => 'AllBank',
                'type' => 'instapay'
            ],
            [
                'name' => 'AUB',
                'type' => 'instapay'
            ],
            [
                'name' => 'Bank of China (Manila Branch)',
                'type' => 'instapay'
            ],
            [
                'name' => 'Bangko Mabuhay*',
                'type' => 'instapay'
            ],
            [
                'name' => 'Bank of Commerce',
                'type' => 'instapay'
            ],
            [
                'name' => 'BDO',
                'type' => 'instapay'
            ],
            [
                'name' => 'BDO Network Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Binangonan Rural Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'BPI / BPI Family',
                'type' => 'instapay'
            ],
            [
                'name' => 'BPI Direct BanKO',
                'type' => 'instapay'
            ],
            [
                'name' => 'Camalig Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'CARD BANK',
                'type' => 'instapay'
            ],
            [
                'name' => 'CARD SME Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Cebuana Lhuillier Rural Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'China Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'China Bank Savings',
                'type' => 'instapay'
            ],
            [
                'name' => 'CIMB',
                'type' => 'instapay'
            ],
            [
                'name' => 'CIS Bayad Center',
                'type' => 'instapay'
            ],
            [
                'name' => 'CTBC (Philippines)',
                'type' => 'instapay'
            ],
            [
                'name' => 'DBP',
                'type' => 'instapay'
            ],
            [
                'name' => 'DCPay (Coins.ph)',
                'type' => 'instapay'
            ],
            [
                'name' => 'Dumaguete City Development Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Dungganon Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'East West Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'East West Rural Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Equicom Savings Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'GPay Network PH (GrabPay)',
                'type' => 'instapay'
            ],
            [
                'name' => 'G-Xchange (GCash)',
                'type' => 'instapay'
            ],
            [
                'name' => 'Infoserve Incorporated (Nationlink)',
                'type' => 'instapay'
            ],

            [
                'name' => 'ING Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'ISLA Bank*',
                'type' => 'instapay'
            ],
            [
                'name' => 'Landbank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Legazpi Savings Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Lulu Financial Services',
                'type' => 'instapay'
            ],

            [
                'name' => 'Malayan Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Maya Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Maybank Philippines',
                'type' => 'instapay'
            ],
            [
                'name' => 'Metrobank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Mindanao Consolidated Cooperative Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Netbank',
                'type' => 'instapay'
            ],

            [
                'name' => 'Omnipay*',
                'type' => 'instapay'
            ],

            [
                'name' => 'Partner Rural Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'PayMaya Philippines, Inc. / Maya Wallet',
                'type' => 'instapay'
            ],

            [
                'name' => 'PBCom',
                'type' => 'instapay'
            ],

            [
                'name' => 'Philippine Business Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Philtrust Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'PNB',
                'type' => 'instapay'
            ],
            [
                'name' => 'PPS-PEPP Financial Services',
                'type' => 'instapay'
            ],

            [
                'name' => 'Producers Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'PSBank',
                'type' => 'instapay'
            ],

            [
                'name' => 'QCRB*',
                'type' => 'instapay'
            ],

            [
                'name' => 'Queen Bank',
                'type' => 'instapay'
            ],

            [
                'name' => 'RCBC',
                'type' => 'instapay'
            ],
            [
                'name' => 'Robinsons Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Rural Bank of Guinobatan',
                'type' => 'instapay'
            ],
            [
                'name' => 'Seabank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Security Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'ShopeePay',
                'type' => 'instapay'
            ],
            [
                'name' => 'Standard Chartered Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Starpay',
                'type' => 'instapay'
            ],
            [
                'name' => 'Sterling Bank of Asia',
                'type' => 'instapay'
            ],
            [
                'name' => 'Sun Savings Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Tayocash',
                'type' => 'instapay'
            ],
            [
                'name' => 'Tonik Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'UCPB Savings Bank*',
                'type' => 'instapay'
            ],
            [
                'name' => 'Union Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'UnionDIgital Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'USSC Money Services',
                'type' => 'instapay'
            ],
            [
                'name' => 'Veterans Bank*',
                'type' => 'instapay'
            ],
            [
                'name' => 'Wealth Bank',
                'type' => 'instapay'
            ],
            [
                'name' => 'Zybi Tech (JuanCash)',
                'type' => 'instapay'
            ],
            [
                'name' => 'Al-amanah Islamic bank',
                'type' => 'pesonet'
            ],
            [
                'name' => 'AllBank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bangko Kabayan, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bank of Makati, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'BanKo, A Subsidiary of BPI',
                'type' => 'pesonet'
            ],
            [
                'name' => 'China Bank Savings, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Dumaguete City Development Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Equicom Savings Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'First Consolidated Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'HSBC Savings Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Malayan Bank Savings and Mortgage Bank',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Philippine Business Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Philippine Savings Bank',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Producers Savings Bank Corporation',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Queen City Development Bank',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Sterling Bank of Asia, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Wealth Development Bank Corporation',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Yuanta Savings Bank Philippines, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Mabuhay, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bangko Nuestra Señora del Pilar, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bank of Florida, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'BDO Network Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Biñan Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Camalig Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cantilan Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cebuana Lhuillier Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Community Rural Bank of Romblon',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cooperative Bank of Quezon Province',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Country Builders Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Dungganon Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'East West Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Guagua Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Innovative Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Laguna Prestige Banking Corporation',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Money Mall Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'MVSM Bank (Rural Bank), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rang-Ay Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'RBT Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Bauang, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Digos, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Guinobatan, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Lebak (Sultan Kudarat), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Montalban, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Porac (Pampanga), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Rosario (L.U.), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Sta. Ignacia, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Tonik Digital Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bangko Mabuhay, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bangko Nuestra Señora del Pilar, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Bank of Florida, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'BDO Network Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Biñan Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Camalig Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cantilan Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cebuana Lhuillier Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Community Rural Bank of Romblon',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Cooperative Bank of Quezon Province',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Country Builders Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Dungganon Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'East West Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Guagua Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Innovative Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Laguna Prestige Banking Corporation',
                'type' => 'pesonet'
            ],

            [
                'name' => 'Money Mall Rural Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'MVSM Bank (Rural Bank), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rang-Ay Bank, Inc.',
                'type' => 'pesonet'
            ],

            [
                'name' => 'RBT Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Bauang, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Digos, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Guinobatan, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Lebak (Sultan Kudarat), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Montalban, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Porac (Pampanga), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Rural Bank of Rosario (L.U.), Inc.',
                'type' => 'pesonet'
            ],

            [
                'name' => 'Rural Bank of Sta. Ignacia, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Tonik Digital Bank, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'DCPay Philippines, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'G-Xchange, Inc. (GXI)',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Lulu Financial Services (Phils), Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'PayMaya Philippines, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'USSC Money Services, Inc.',
                'type' => 'pesonet'
            ],
            [
                'name' => 'Zybi Tech, Inc.',
                'type' => 'pesonet'
            ],
        ];
    }
}
