<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    use WithoutModelEvents;

    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // - ini akun admin 1
        $admin = User::firstOrCreate(
            ['email' => 'admin@anivent.my.id'],
            [
                'name'     => 'Admin Anivent',
                'password' => Hash::make('skibidi'),
                'role'     => 'admin',
            ]
        );

        // SECTION AKUN VENDOR //

         // ─── Vendor Pending ke 1 ────────────────────────────────────────────────
        $userPending = User::firstOrCreate(
            ['email' => 'hello@nekoneko.id'],
            [
                'name'     => 'vendor pending',
                'password' => Hash::make('password123'),
                'role'     => 'vendor',
            ]
        );

        Vendor::firstOrCreate(
            ['user_id' => $userPending->id],
            [
                'organization_name' => 'Neko Neko Studio',
                'description'       => 'Studio kreatif untuk event komunitas anime, ilustrasi, dan pop culture lokal.',
                'phone'             => '081273401182',
                'address'           => 'Jl. Kemang Raya 18, Jakarta Selatan, DKI Jakarta.',
                'status'            => 'pending',
            ]
        );


        // ─── 2. Vendor Approved  ────────────────────────────────────────────────
        $userApproved = User::firstOrCreate(
            ['email' => 'halo@kitsunemarket.id'],
            [
                'name'     => 'vendor approved',
                'password' => Hash::make('password987'),
                'role'     => 'vendor',
            ]
        );

       $vendorApproved = Vendor::firstOrCreate(
            ['user_id' => $userApproved->id],
            [
                'organization_name' => 'kitsune-market',
                'description'       => 'Studio kreatif untuk event komunitas anime, ilustrasi, dan pop culture lokal.',
                'phone'             => '081273401182',
                'address'           => 'Jl. Kemang Raya 18, Jakarta Selatan, DKI Jakarta.',
                'status'            => 'approved',
                'instagram'         => '@kitsune_market_official',
                'reviewed_by'       => $admin->id,
                'reviewed_at'       => now()->subDays(5),
            ]
        );


        // ─── Vendor Pending ke 2 ────────────────────────────────────────────────
        $userPending = User::firstOrCreate(
            ['email' => 'admin@yorustage.id'],
            [
                'name'     => 'vendor pending',
                'password' => Hash::make('password321'),
                'role'     => 'vendor',
            ]
        );

        Vendor::firstOrCreate(
            ['user_id' => $userPending->id],
            [
                'organization_name' => 'Yoru Night Stageworks',
                'description'       => 'Tim produksi pertunjukan panggung dan acara komunitas pop culture.',
                'phone'             => '085790124460',
                'address'           => 'Jl. Jendral Soedirman 09, Bekasi, JawaBarat.',
                'status'            => 'pending',
                'instagram'         => '@Yoru_Night_Stage.Comunity',
                'facebook'          => '@YNS_YoruNightStage.Comunity',
                'x_twitter'         => '@Yoru_Night_Stage.Comunity',
                'reviewed_by'       => $admin->id,
                'reviewed_at'       => now()->subDays(5),
            ]
        );

        // Vendor tambahan: 5 pending, 5 approved.
        $additionalVendors = [
            ['name' => 'vendor pending 01', 'email' => 'sora@cosplaycorner.id', 'organization' => 'Sora Cosplay Corner', 'status' => 'pending', 'instagram' => '@soracosplaycorner'],
            ['name' => 'vendor pending 02', 'email' => 'hello@otakugoods.id', 'organization' => 'Otaku Goods Collective', 'status' => 'pending', 'instagram' => null],
            ['name' => 'vendor pending 03', 'email' => 'contact@harajukucraft.id', 'organization' => 'Harajuku Craft Hall', 'status' => 'pending', 'instagram' => '@harajukucrafthall'],
            ['name' => 'vendor pending 04', 'email' => 'admin@mechamarket.id', 'organization' => 'Mecha Market Depok', 'status' => 'pending', 'instagram' => null],
            ['name' => 'vendor pending 05', 'email' => 'team@moondropstudio.id', 'organization' => 'MoonDrop Studio', 'status' => 'pending', 'instagram' => '@moondropstudio'],
            ['name' => 'vendor approved 01', 'email' => 'hello@komorebuevents.id', 'organization' => 'Komorebu Events', 'status' => 'approved', 'instagram' => '@komorebuevents'],
            ['name' => 'vendor approved 02', 'email' => 'admin@pixelparade.id', 'organization' => 'Pixel Parade Works', 'status' => 'approved', 'instagram' => '@pixelparadeworks'],
            ['name' => 'vendor approved 03', 'email' => 'studio@akibaframe.id', 'organization' => 'Akiba Frame Studio', 'status' => 'approved', 'instagram' => null],
            ['name' => 'vendor approved 04', 'email' => 'halo@tokusatsuhub.id', 'organization' => 'Tokusatsu Hub', 'status' => 'approved', 'instagram' => '@tokusatsuhub'],
            ['name' => 'vendor approved 05', 'email' => 'crew@starlightcos.id', 'organization' => 'Starlight Cosplay Crew', 'status' => 'approved', 'instagram' => '@starlightcos'],
        ];

        foreach ($additionalVendors as $index => $vendorData) {
            $user = User::updateOrCreate(
                ['email' => $vendorData['email']],
                [
                    'name' => $vendorData['name'],
                    'password' => Hash::make('password123'),
                    'role' => 'vendor',
                ]
            );

            $reviewData = $vendorData['status'] === 'approved'
                ? ['reviewed_by' => $admin->id, 'reviewed_at' => now()->subDays(3)]
                : ['reviewed_by' => null, 'reviewed_at' => null];

            Vendor::updateOrCreate(
                ['user_id' => $user->id],
                array_merge([
                    'organization_name' => $vendorData['organization'],
                    'description' => 'Penyelenggara event anime dan pop culture untuk komunitas lokal.',
                    'phone' => '0812' . str_pad((string) ($index + 10000001), 8, '0', STR_PAD_LEFT),
                    'address' => 'Jl. Komunitas Kreatif No. ' . ($index + 1) . ', Jakarta.',
                    'instagram' => $vendorData['instagram'],
                    'status' => $vendorData['status'],
                    'rejection_reason' => null,
                ], $reviewData)
            );
        }

    }
}
