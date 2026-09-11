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

    }
}
