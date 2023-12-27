<?php

namespace Database\Seeders;

use App\Models\Formula;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormulaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $formulas = [
            [
                'name' => 'Basique',
                'options' => json_encode([])
            ],
            [
                'name' => 'Standard',
                'options' => json_encode(["SSH", "RSYNC", "SFTP", "FTP/SFTP"])
            ],
            [
                'name' => 'Entreprise',
                'options' => json_encode(["SSH", "RSYNC", "SFTP", "FTP/SFTP", "ISCSI", "CIFS", "Webdav", "SI"])
            ],
            [
                'name' => 'Dédié',
                'options' => json_encode([])
            ]
        ];

        foreach ($formulas as $formula) {
            Formula::create($formula);
        }
    }
}
