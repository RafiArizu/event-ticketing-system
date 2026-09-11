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
                'x_(twitter)'       => '@Yoru_Night_Stage.Comunity',
            ]
        );

        // ─── Vendor Approved ke 2 ────────────────────────────────────────────────
        $userApprovedTwo = User::firstOrCreate(
            ['email' => 'hello@komorebuevents.id'],
            [
                'name'     => 'vendor approved 2',
                'password' => Hash::make('password987'),
                'role'     => 'vendor',
            ]
        );

        Vendor::firstOrCreate(
            ['user_id' => $userApprovedTwo->id],
            [
                'organization_name' => 'Komorebu Events',
                'description'       => 'Penyelenggara event anime dan pop culture untuk komunitas lokal.',
                'phone'             => '081298765432',
                'address'           => 'Jl. Melati No. 12, Jakarta Selatan.',
                'status'            => 'approved',
                'instagram'         => '@komorebuevents',
                'reviewed_by'       => $admin->id,
                'reviewed_at'       => now()->subDays(4),
            ]
        );

        // ─── Vendor Approved ke 3 ────────────────────────────────────────────────
        $userApprovedThree = User::firstOrCreate(
            ['email' => 'admin@pixelparade.id'],
            [
                'name'     => 'vendor approved 3',
                'password' => Hash::make('password987'),
                'role'     => 'vendor',
            ]
        );

        Vendor::firstOrCreate(
            ['user_id' => $userApprovedThree->id],
            [
                'organization_name' => 'Pixel Parade Works',
                'description'       => 'Studio kreatif untuk event komunitas anime dan pop culture.',
                'phone'             => '081287654321',
                'address'           => 'Jl. Kenanga No. 7, Bandung.',
                'status'            => 'approved',
                'instagram'         => '@pixelparadeworks',
                'reviewed_by'       => $admin->id,
                'reviewed_at'       => now()->subDays(2),
            ]
        );

        // ─── Vendor Pending ke 3 ────────────────────────────────────────────────
        $userPendingThree = User::firstOrCreate(
            ['email' => 'hello@otakugoods.id'],
            [
                'name'     => 'vendor pending 3',
                'password' => Hash::make('password321'),
                'role'     => 'vendor',
            ]
        );

        Vendor::firstOrCreate(
            ['user_id' => $userPendingThree->id],
            [
                'organization_name' => 'Otaku Goods Collective',
                'description'       => 'Kolektif merchandise anime dan pop culture untuk komunitas lokal.',
                'phone'             => '081276543210',
                'address'           => 'Jl. Sakura No. 15, Depok.',
                'status'            => 'pending',
                'instagram'         => '@otakugoodscollective',
            ]
        );

    }
}
