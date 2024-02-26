<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $addDokterRule = [
        'nama' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
            ]
        ],
        'nip' => [
            'rules' => 'required|min_length[3]|is_unique[dokter.nip]',
            'errors' => [
                'required' => 'harus disi',
                'min_length' => 'minimal harus 3 karakter',
                'is_unique' => 'nip sudah terdaftar'
            ]
        ],
        'gender' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ],
        'umur' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ],
        'alamat' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ],
        'telp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ],
        'pelayanan_id' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'harus disi'
            ]
        ]
    ];
    // public $updateDokterRule = [
    //     'nama' => [
    //         'rules' => 'required|min_length[3]',
    //         'errors' => [
    //             'required' => 'harus disi',
    //             'min_length' => 'minimal harus 3 karakter',
    //         ]
    //     ],
    //     'nip' => [
    //         'rules' => 'required|min_length[3]',,
    //         'errors' => [
    //             'required' => 'harus disi',
    //             'min_length' => 'minimal harus 3 karakter'
    //         ]
    //     ],
    //     'gender' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'harus disi'
    //         ]
    //     ],
    //     'umur' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'harus disi'
    //         ]
    //     ],
    //     'alamat' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'harus disi'
    //         ]
    //     ],
    //     'telp' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'harus disi'
    //         ]
    //     ],
    //     'pelayanan_id' => [
    //         'rules' => 'required',
    //         'errors' => [
    //             'required' => 'harus disi'
    //         ]
    //     ]
    // ];
}
