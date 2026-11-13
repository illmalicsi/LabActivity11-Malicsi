# Barangay Bulletin – Purok Malicsi

Lab Activity 11 for 4-334 Full-Stack Web Development. This builds on my Lab 10 bulletin and adds post authors, tags, comments, a login, and Form Request validation.

## My personalized details

- **Posts per page:** 7, because my last name, Malicsi, has 7 letters.
- **Categories:** Announcement, Health, Peace & Order, Ayuda, Events (my custom one)
- **Birthday post date:** 2026-06-17 (pinned post)

## Seeded logins

Both accounts use the password `bulletin2026` (stored hashed).

| Who | Email | Can do |
|---|---|---|
| Lola Malicsi (resident) | `lola.malicsi@bulletin.test` | Comment on posts |
| Kagawad Ivan Louie Malicsi | `kagawad.malicsi@bulletin.test` | Comment and write new posts (linked to an author profile) |

The seeder also makes 8 more resident users with the factory (password `password`).

## Tags

1. Purok Malicsi
2. Urgent
3. Libre
4. Schedule
5. Fiesta (my own tag)

Every post gets 1–3 random tags. The pinned post is always synced to exactly **Purok Malicsi** and **Urgent**.

## Relationships I used and why

| Link | Type | Why |
|---|---|---|
| User → Author | `hasOne` / `belongsTo` | A login account can have at most one author profile. `authors.user_id` is unique and nullable because not every author has a login and residents have no author profile. I use it in `StorePostRequest` to check whether the user may post. |
| Author → Post | `hasMany` / `belongsTo` | One author writes many posts, and each post has one author through `posts.author_id`. New posts are created through `$user->author->posts()->create()`. |
| Post → Comment | `hasMany` / `belongsTo` | A post can have many comments, but each comment belongs to only one post. |
| User → Comment | `hasMany` / `belongsTo` | A resident can write many comments, and each comment shows who wrote it. |
| Post ↔ Tag | `belongsToMany` | A post can have many tags and a tag is used on many posts, so it needs the `post_tag` pivot table. Tags are added with `attach()` and `sync()` only. |
| Author → Comment | `hasManyThrough` (via Post) | Comments don't have an `author_id`, but I can reach them through the author's posts. This is used for "N comments received" on the author page. |

To avoid N+1 queries, `preventLazyLoading` is turned on outside production. The index page uses `with(['author', 'tags'])->withCount('comments')` and the show page uses `load()` with `comments.user`.

## How to run

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
npm install
npm run dev
php artisan serve
```

Then open `/posts` and sign in at `/login` with one of the accounts above.
