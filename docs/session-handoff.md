# MO Store Session Handoff

Saved: 2026-05-22 15:23 +03:00

## Repository

- Local workspace: `F:\one griffin\Documents\store-review`
- GitHub repository: `https://github.com/mooutdooreg-source/store.git`
- Current branch: `codex/pre-media-fixes`
- Last pushed commit before the current local Why MO edits: `75cb727 Update store preview media and pages`

## Current Git State

There are local, uncommitted changes in:

- `assets/css/mo-store.css`
- `template-parts/why-mo/page.php`
- `why-mo.html`

These changes update the Why MO page copy and styling. They have been deployed to Vercel preview but have not been committed or pushed to GitHub yet.

## Latest Vercel Preview

Use this updated preview:

- `https://store-review-cfnfnjkyo-mooutdooreg-sources-projects.vercel.app/why-mo`

Stable alias also showed the latest copy:

- `https://store-review-mooutdooreg-source-mooutdooreg-sources-projects.vercel.app/why-mo`

Do not use the older URL as the source of truth:

- `https://store-review-arl5wsnkw-mooutdooreg-sources-projects.vercel.app/why-mo`

That older URL is an immutable deployment URL from May 17, 2026 and still shows older Why MO content.

## What Was Done

### Pre-media fixes and media integration

- Reviewed the store repository before media work.
- Added and wired visual assets for:
  - Home hero
  - TAKUMO
  - MATADOR
  - PITMASTER
  - MO GEAR
  - Standard process bar
  - Footer social icons
- MO GEAR is no longer treated as a separate standalone concept in the homepage cards. It is included with the other three line cards, for a total of four cards.
- Header navigation became:
  - `Lines`
  - `Why MO`
  - `Custom Orders`
- `Custom Orders` links to `https://moknives.art/`.
- `Why MO` replaced the previous About MO direction.

### Homepage layout decisions

- Home hero uses the latest culinary blade image asset.
- The heavy dark overlay on the home hero was reduced so the image is visible.
- The hero copy was revised toward direct product positioning:
  - Product-first headline direction.
  - Limited numbered releases.
  - New batch production note as announcement-style messaging.
- The moving standard bar under the hero was widened and changed to use small process images instead of only icons.
- The home page keeps `Explore the Lines` only, then the four cards.
- Detailed content for each line should live on its own line page, opened by clicking the card.
- `Shape the Next Batch` should be the final section on the homepage.

### Explore the Lines behavior

The intended behavior:

- Four cards: TAKUMO, MATADOR, PITMASTER, MO GEAR.
- The second card should be centered automatically on page load.
- Small parts of the previous and next cards must be visible on both sides.
- No arrows.
- User drags/swipes left and right.
- Infinite loop behavior: after the last card, the slider continues smoothly.
- Each card links to its own page.

Implementation references:

- `template-parts/home/explore-lines.php`
- `inc/helpers.php` function `mo_store_get_home_lines()`
- `assets/css/mo-store.css`
- `assets/js/mo-store.js` function `initHomeLinesSlider()`

Important selectors:

- `[data-mo-lines-slider]`
- `[data-mo-slider-track]`
- `[data-mo-slider-card]`

CSS principle:

```css
.mo-lines {
  --mo-line-card-width: min(76vw, 380px);
}

@media (min-width: 768px) {
  .mo-lines {
    --mo-line-card-width: min(76vw, 760px);
  }
}

.mo-lines__track {
  display: flex;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  padding: 0 calc((100% - var(--mo-line-card-width)) / 2);
  scroll-padding-inline: calc((100% - var(--mo-line-card-width)) / 2);
}

.mo-line-card {
  flex: 0 0 var(--mo-line-card-width);
  scroll-snap-align: center;
}
```

JS principle:

- Clone cards before and after the original set.
- Start at the second card:

```js
centerCard(Math.min(1, cards.length - 1));
```

- Rebalance scroll position invisibly when the user reaches either edge.

## Current Why MO Copy Direction

The latest requested Why MO page is story-driven, but the phrase `Story-Driven Version` must not be shown on the page. It was removed from both:

- `template-parts/why-mo/page.php`
- `why-mo.html`

The page title should simply be:

- `Why MO`

Hero copy starts with:

```text
It started with one simple truth: ordinary knives just couldn't keep up with what I needed.
```

Main sections:

- `My Journey Begins`
- `Learning the Science`
- `From Small Requests to Full-Time Bladesmith`
- `ECC - From the Wild to the Kitchen`
- `The MO Standard Today`

Closing CTA:

```text
Field Tested. Chef Proven. Built by Mo.
```

CTA links:

- `Limited batches live here -> Explore the Lines`
- `One-of-one customs live at moknives.art`

## Verification Already Run

- `node --check assets\js\mo-store.js`
- `git diff --check`
- Local preview returned `200` for `/why-mo`.
- Vercel preview returned `200` for `/why-mo`.
- The text `Story-Driven Version` was verified as removed after the final edit.

PHP lint was not run because `php` was not available in the local environment.

## Next Recommended Step

If continuing in a new chat:

1. Ask Codex to read this file:
   - `docs/session-handoff.md`
2. Review the current local diff.
3. If everything looks good, commit and push the three current Why MO files.
4. Optionally deploy again after committing.

Suggested continuation prompt:

```text
Continue from docs/session-handoff.md in F:\one griffin\Documents\store-review. Review the local Why MO changes, then commit, push, and deploy if everything is clean.
```
