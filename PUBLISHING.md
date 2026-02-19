# Publishing to Packagist

Step-by-step guide for releasing a new version of **apexglobal/apex-starter-kit** to Packagist.

---

## Prerequisites

- Git installed and authenticated with GitHub
- Packagist account at [packagist.org](https://packagist.org) (linked to the `moshin-gyagenda` GitHub account)
- Package already submitted to Packagist at least once (first-time setup is at the bottom of this doc)

---

## Releasing a new version

### 1. Make and commit your changes

Ensure everything is committed and the working tree is clean:

```bash
git status
git add .
git commit -m "fix: your change description"
```

### 2. Tag the release

Packagist uses Git tags as version numbers. Follow [Semantic Versioning](https://semver.org):

| Change type | Example bump | When to use |
|-------------|-------------|-------------|
| Bug fix | `1.0.0` → `1.0.1` | Backwards-compatible bug fixes |
| New feature | `1.0.1` → `1.1.0` | New backwards-compatible functionality |
| Breaking change | `1.1.0` → `2.0.0` | Changes that break existing installs |

Check your latest tag first:

```bash
git tag
```

Create and push the new tag:

```bash
git tag v1.0.1
git push origin main
git push origin v1.0.1
```

> Packagist detects the new tag automatically (via GitHub webhook) and creates the new release within a minute or two.

---

### 3. Verify on Packagist

Go to:

```
https://packagist.org/packages/apexglobal/apex-starter-kit
```

You should see the new version listed under **Releases**. If it hasn't updated after a few minutes, trigger a manual update (see below).

---

### 4. Manual update (if webhook doesn't fire)

Log in to [packagist.org](https://packagist.org), open the package page, and click **Update** in the top-right corner.

Alternatively, use the Packagist API with your API token:

```bash
curl -XPOST -H "content-type:application/json" "https://packagist.org/api/update-package?username=YOUR_USERNAME&apiToken=YOUR_API_TOKEN" -d '{"repository":{"url":"https://github.com/moshin-gyagenda/apex-starter-kit-package"}}'
```

---

## Updating `composer.json` version (optional)

Packagist reads versions from Git tags — you do **not** need a `"version"` field in `composer.json`. Keep it tag-driven.

---

## Typical release workflow (quick reference)

```bash
# 1. Commit your changes
git add .
git commit -m "fix: description of changes"

# 2. Push commits
git push origin main

# 3. Tag and push the tag
git tag v1.0.1
git push origin v1.0.1
```

That's it. Packagist updates automatically.

---

## First-time Packagist submission (one-time setup)

If the package hasn't been submitted yet:

1. Log in to [packagist.org](https://packagist.org)
2. Click **Submit** in the top nav
3. Paste the GitHub URL:
   ```
   https://github.com/moshin-gyagenda/apex-starter-kit-package
   ```
4. Click **Check** then **Submit**

**Set up the GitHub webhook (so Packagist auto-updates on every push/tag):**

1. In the package page on Packagist, copy the webhook URL shown under **GitHub Service Hook**
2. Go to the GitHub repo → **Settings** → **Webhooks** → **Add webhook**
3. Paste the URL, set content type to `application/json`, and save

After this, every `git push` and new tag will trigger Packagist automatically.

---

## Troubleshooting

| Issue | What to do |
|-------|------------|
| New version not showing on Packagist | Push the tag (`git push origin vX.X.X`), not just the commits |
| Packagist shows old version | Click **Update** on the Packagist package page |
| `Could not find package` in composer | Ensure `minimum-stability` in the consumer app allows the version, or use `composer require apexglobal/apex-starter-kit:^1.0` |
| Webhook not firing | Re-create the webhook in GitHub repo settings (see first-time setup above) |
