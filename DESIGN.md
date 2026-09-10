# Anime Event Organizer — Design System

> Source of truth untuk typography, warna, layout, motion, dan komponen UI.
> Baseline ini terinspirasi dari referensi visual Kyou Hobby Shop yang diberikan pengguna; token warna perlu dikalibrasi ulang jika logo/asset resmi tersedia.

## Aesthetic direction

Editorial event operations: hangat, berani, dan terstruktur—energi hobby shop Kyou dengan kepadatan informasi yang tetap tenang dibaca.

## Dials

- DESIGN_VARIANCE: 6 / 10 — sedikit asimetris pada discovery page, lebih tenang pada area admin.
- MOTION_INTENSITY: 2 / 10 — transisi singkat dan fungsional; tidak ada animasi dekoratif.
- VISUAL_DENSITY: 5 / 10 — data mudah dipindai tanpa dashboard penuh kotak.

## Type stack

- Display: Outfit, weights 500–800.
- Body: Plus Jakarta Sans, weights 400–700.
- Data/IDs: JetBrains Mono, hanya untuk kode booking, ticket code, dan angka tabular.
- Loaded via: self-hosted atau Google Fonts melalui asset pipeline; jangan memakai Inter reguler, Roboto, Arial, atau system-ui sebagai font utama.
- Body line-height minimum: 1.5. Reading width maksimum: 65ch.

## Color tokens

Palette: primary orange + terracotta + sub-white. Orange menjadi aksen aksi; terracotta menjadi bidang brand dan navigasi; sub-white menjadi kanvas utama.

| Token | Hex baseline | Peran |
|---|---|---|
| `--color-primary-orange` | `#F4511E` | CTA utama, focus accent, active state |
| `--color-orange-soft` | `#FFF0E9` | hover, alert ringan, selected background |
| `--color-terracotta` | `#A9361F` | header, admin rail, brand surface |
| `--color-terracotta-dark` | `#762817` | teks/kontras pada surface terracotta |
| `--color-sub-white` | `#FFF9F3` | page background |
| `--color-surface` | `#FFFFFF` | form, table, modal surface |
| `--color-ink` | `#2C221E` | heading dan body text |
| `--color-muted` | `#756861` | secondary text; jangan dipakai untuk body penting |
| `--color-line` | `#EADFD6` | border dan divider |
| `--color-success` | `#287A54` | paid, published, active, checked-in result |
| `--color-warning` | `#9A6700` | pending, sales closing, attention |
| `--color-error` | `#B33D38` | validation, rejected, failed |

### Color rules

- Jangan memakai purple-to-blue gradient.
- Jangan memakai pure `#000` atau `#FFF` sebagai default text/background.
- Gunakan satu aksen dominan per screen; orange dan terracotta adalah satu keluarga brand, bukan dua CTA yang bersaing.
- Status selalu memiliki label teks, bukan warna saja.
- Shadow harus tinted ke warm neutral: `0 16px 36px rgba(118, 40, 23, .10)`.
- Verifikasi kontras WCAG 2.2 AA sebelum shipping; body text minimum 4.5:1.

## Layout

- Container utama: `max-width: 1400px`, padding `24px` mobile dan `40–64px` desktop.
- Customer discovery: editorial left-aligned hero dengan visual/event feed asimetris; hindari hero terpusat dengan dua CTA.
- Admin: sidebar/rail tetap, konten utama memakai metric rows dan tabel; hindari empat kartu KPI identik.
- Vendor: header ringan + event workspace; event list memakai row/divider dan satu panel ringkasan bila memang diperlukan.
- Grid selalu runtuh menjadi satu kolom di bawah 768px.
- Tabel mobile memakai `overflow-x: auto` atau berubah menjadi list card; tidak boleh menyebabkan horizontal scroll halaman.
- Tidak menggunakan `h-screen`; gunakan `min-height: 100dvh` bila section memang full height.

## Component inventory

- `layouts`: Admin, Vendor, Customer dengan navigation state dan flash-message slot.
- `button`: primary orange, secondary outline, destructive error; label memakai kata kerja spesifik.
- `field`: label nyata, helper text opsional, inline validation, focus-visible ring.
- `status-badge`: published, pending, cancelled, paid, unpaid, used.
- `data-table`: header jelas, row hover, empty/error state, mobile fallback.
- `event-card`: poster, category, date, venue, availability, CTA.
- `ticket-row`: ticket name, price snapshot, quota/sales period, quantity control.
- `ticket-pass`: ticket code, QR image, status, used time.
- Icon: SVG konsisten (Phosphor/Lucide jika dependency tersedia); jangan gunakan emoji sebagai icon.

## Motion

- Default transition: `cubic-bezier(0.16, 1, 0.3, 1)` selama 150–250ms.
- Animasi hanya untuk opacity/transform; tidak menganimasikan width/height.
- Hover tidak boleh menggeser layout.
- Hormati `prefers-reduced-motion: reduce`.
- Motion dipakai untuk feedback (button, row, toast), bukan dekorasi terus-menerus.

## Copy and states

- Bahasa utama UI: Bahasa Indonesia; istilah domain seperti booking, ticket, check-in boleh dipertahankan bila lebih jelas.
- Gunakan label konkret: `Buat event`, `Simpan draft`, `Bayar booking`, `Check-in ticket`.
- Hindari jargon promosi seperti “elevate”, “seamless”, “next-gen”, dan filler generik.
- Setiap halaman data wajib memiliki loading, empty, error, dan success state yang inline serta actionable.
- Data contoh harus realistis dan tidak memakai John Doe/Acme atau angka bulat palsu.

## Accessibility floor

- Semua input memiliki `<label>` dan `autocomplete` yang sesuai.
- Semua interactive element dapat dicapai keyboard dalam urutan visual.
- Focus ring terlihat pada `:focus-visible`.
- Target sentuh minimum 44×44px.
- Jangan menjadikan warna satu-satunya penanda status.
- Semua gambar memiliki alt text; QR memiliki alternatif ticket code yang dapat dibaca.

## Project notes

- Stack aktual: Laravel 12 + Blade + Vite 6 + Tailwind CSS 4.
- Shared CSS berada di `resources/css/app.css`; hindari CSS inline yang menduplikasi token.
- Shared JavaScript saat ini hanya bootstrap; jangan menambah library interaksi sebelum kebutuhan nyata muncul.
- Route `/admin/auth` saat ini perlu diselaraskan dengan view `admin/Auth/login.blade.php` sebelum integrasi login.

## Last updated

2026-08-31 — baseline palette Kyou-inspired (primary orange, terracotta, sub-white) dan aturan UI/UX project.
2026-08-31 — added native responsive hamburger navigation for the admin top bar.
