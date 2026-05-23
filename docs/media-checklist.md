# MO Store Media Checklist

Use this checklist before replacing placeholder media. Keep the exact filenames unless the PHP data maps are updated in `inc/line-data.php`, `inc/helpers.php`, or the relevant template part.

## Output Guidelines

- Images: optimized WebP, sRGB, visually sharp after compression.
- Desktop hero images: 2200 x 1400 px.
- Mobile hero images: 900 x 1400 px.
- Line card images: 1100 x 1400 px.
- Line detail / filmstrip images: 1200 x 900 px.
- MO Gear hero image: 2200 x 1000 px.
- Videos: optimized MP4, H.264, muted loop friendly, 6-10 seconds, no audio required.
- Keep total file weight lean enough for mobile storefront pages.

## Existing Real Assets

These files are already real media and do not need replacement unless the art direction changes:

- `assets/img/logo-mo.svg`
- `assets/img/abs-member-badge.svg`
- `assets/img/hero-home-culinary.webp`
- `assets/img/lines-takumo.webp`
- `assets/img/lines-matador.jpg`
- `assets/img/matador-in-use.webp`
- `assets/img/social-facebook.png`
- `assets/img/social-instagram.png`
- `assets/img/social-snapchat.png`
- `assets/img/social-tiktok.png`
- `assets/img/social-youtube.png`
- `assets/img/standard-grinding.jpg`
- `assets/img/standard-heat-treatment.webp`
- `assets/img/standard-limited-batch.webp`
- `assets/img/standard-sharpening.jpg`

## Homepage Hero

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/hero-01.webp` | Desktop homepage hero slide 1 | Cinematic blade / craft close-up |
| `assets/img/hero-01-mobile.webp` | Mobile homepage hero slide 1 | Mobile crop of slide 1 |
| `assets/img/hero-02.webp` | Desktop homepage hero slide 2 | Handle / material detail |
| `assets/img/hero-02-mobile.webp` | Mobile homepage hero slide 2 | Mobile crop of slide 2 |
| `assets/img/hero-03.webp` | Desktop homepage hero slide 3 | Grinding / finishing moment |
| `assets/img/hero-03-mobile.webp` | Mobile homepage hero slide 3 | Mobile crop of slide 3 |
| `assets/img/hero-04.webp` | Desktop homepage hero slide 4 | Finished knife beauty shot |
| `assets/img/hero-04-mobile.webp` | Mobile homepage hero slide 4 | Mobile crop of slide 4 |
| `assets/img/hero-05.webp` | Desktop homepage hero slide 5 | Dark craft / workshop mood |
| `assets/img/hero-05-mobile.webp` | Mobile homepage hero slide 5 | Mobile crop of slide 5 |
| `assets/img/hero-06.webp` | Desktop homepage hero slide 6 | Usage / product-in-context mood |
| `assets/img/hero-06-mobile.webp` | Mobile homepage hero slide 6 | Mobile crop of slide 6 |

## Homepage Line Cards

| File | Use | Notes |
| --- | --- | --- |
| `assets/img/lines-pitmaster.webp` | PITMASTER homepage line card | Match TAKUMO / MATADOR line-card framing |

## TAKUMO Line Page

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/takumo-hero.webp` | TAKUMO desktop hero | Primary TAKUMO product hero |
| `assets/img/takumo-hero-mobile.webp` | TAKUMO mobile hero | Mobile crop of hero |
| `assets/img/takumo-form.webp` | Filmstrip chapter 01 | Full form / silhouette |
| `assets/img/takumo-edge.webp` | Filmstrip chapter 02 poster | Edge detail |
| `assets/img/takumo-handle.webp` | Filmstrip chapter 03 | Handle detail |
| `assets/img/takumo-finish.webp` | Filmstrip chapter 04 | Finish / polish detail |
| `assets/img/takumo-in-use.webp` | Filmstrip chapter 05 | Kitchen use scene |
| `assets/video/takumo-loop-01.mp4` | TAKUMO filmstrip video 1 | Edge / motion detail |
| `assets/video/takumo-loop-02.mp4` | TAKUMO filmstrip video 2 | Finish / detail loop |

## MATADOR Line Page

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/matador-hero.webp` | MATADOR desktop hero | Primary MATADOR product hero |
| `assets/img/matador-hero-mobile.webp` | MATADOR mobile hero | Mobile crop of hero |
| `assets/img/matador-form.webp` | Filmstrip chapter 01 | Full form / silhouette |
| `assets/img/matador-edge.webp` | Filmstrip chapter 02 poster | Edge detail |
| `assets/img/matador-handle.webp` | Filmstrip chapter 03 | Handle detail |
| `assets/img/matador-finish.webp` | Filmstrip chapter 04 | Finish / polish detail |
| `assets/video/matador-loop-01.mp4` | MATADOR filmstrip video 1 | Edge / motion detail |
| `assets/video/matador-loop-02.mp4` | MATADOR filmstrip video 2 | Finish / detail loop |

## PITMASTER Line Page

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/pitmaster-hero.webp` | PITMASTER desktop hero | Primary PITMASTER product hero |
| `assets/img/pitmaster-hero-mobile.webp` | PITMASTER mobile hero | Mobile crop of hero |
| `assets/img/pitmaster-form.webp` | Filmstrip chapter 01 | Full form / silhouette |
| `assets/img/pitmaster-edge.webp` | Filmstrip chapter 02 poster | Edge detail |
| `assets/img/pitmaster-handle.webp` | Filmstrip chapter 03 | Handle detail |
| `assets/img/pitmaster-finish.webp` | Filmstrip chapter 04 | Finish / polish detail |
| `assets/img/pitmaster-in-use.webp` | Filmstrip chapter 05 | BBQ / serving use scene |
| `assets/video/pitmaster-loop-01.mp4` | PITMASTER filmstrip video 1 | Edge / motion detail |
| `assets/video/pitmaster-loop-02.mp4` | PITMASTER filmstrip video 2 | Finish / detail loop |

## MO Gear

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/mo-gear-card.webp` | MO Gear homepage card desktop | Premium gear collection / workshop spread |
| `assets/img/mo-gear-card-mobile.webp` | MO Gear homepage card mobile | Vertical premium gear collection crop |

## Why MO

| File | Use | Recommended source |
| --- | --- | --- |
| `assets/img/abs-member-badge.svg` | ABS trust proof badge | American Bladesmith Society member badge |
| `assets/video/performance-proof.mp4` | Why MO performance proof video | Process / proof clip from Why MO page |

## Replacement Check

After replacing media:

1. Run `rg -n "TEMPORARY PLACEHOLDER FILE" assets`.
2. Confirm the command returns no results.
3. Review homepage, each line page, and MO Gear on a WordPress staging site with WoodMart and WooCommerce active.
4. Check desktop and mobile crops before publishing.
