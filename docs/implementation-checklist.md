# Todoアプリ実装チェックリスト

`docs/requirements.md` の要件を実装するための工程表。実装はユーザー自身が行い、Claudeはペアプログラミングのナビゲーターとしてレビュー・解説を行う。各工程が完了したらチェックを入れて進捗を管理する。

## 1. マイグレーション

- [x] `php artisan make:migration create_todos_table` で生成
- [x] `title`(string), `completed`(boolean, default false), timestamps を定義

```php
Schema::create('todos', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->boolean('completed')->default(false);
    $table->timestamps();
});
```

## 2. モデル

- [x] `app/Models/Todo.php` を作成（`User.php` と同じ属性ベーススタイル）
- [x] `#[Fillable(['title', 'completed'])]`
- [x] `casts()` で `completed` を `boolean` にキャスト

## 3. ファクトリ

- [ ] `database/factories/TodoFactory.php` を作成
- [ ] `definition()`: `title` はダミー文, `completed` は `false`
- [ ] `completed()` ステートを追加（完了済みTodoを簡単に作れるように）

## 4. ルーティング

- [ ] `routes/web.php` に `Route::resource('todos', TodoController::class)->except('show')` を追加
- [ ] `PATCH todos/{todo}/toggle` を `todos.toggle` として追加

## 5. コントローラ

- [ ] `app/Http/Controllers/TodoController.php` を作成
- [ ] `index()` — `orderByDesc('created_at')->orderByDesc('id')` で一覧取得
- [ ] `create()` / `store()` — インラインバリデーション（`title required|string|max:255`）＋作成
- [ ] `edit()` / `update()` — 暗黙のルートモデルバインディング＋タイトル更新
- [ ] `destroy()` — 削除
- [ ] `toggle()` — `completed` を反転

## 6. Bladeビュー

- [ ] `resources/views/layouts/app.blade.php`（共通レイアウト、`@vite`読み込み、フラッシュメッセージ表示）
- [ ] `resources/views/todos/_form.blade.php`（title入力＋バリデーションエラー表示の共有パーシャル）
- [ ] `resources/views/todos/create.blade.php`
- [ ] `resources/views/todos/edit.blade.php`
- [ ] `resources/views/todos/index.blade.php`（一覧・完了/未完了を同一リストに表示し取り消し線で区別・トグル/編集/削除の各インラインフォーム）

## 7. フィーチャーテスト

- [ ] `tests/Feature/TodoControllerTest.php` を作成（`LazilyRefreshDatabase` 使用）
- [ ] `test_index_displays_todos_ordered_newest_first`
- [ ] `test_index_displays_completed_and_incomplete_todos_together`
- [ ] `test_create_page_renders_successfully`
- [ ] `test_valid_title_creates_todo_and_redirects`
- [ ] `test_missing_title_fails_validation_on_store`
- [ ] `test_edit_page_renders_successfully`
- [ ] `test_valid_title_updates_todo_and_redirects`
- [ ] `test_missing_title_fails_validation_on_update`
- [ ] `test_destroy_deletes_todo_and_redirects`
- [ ] `test_toggling_incomplete_todo_marks_it_completed`
- [ ] `test_toggling_completed_todo_marks_it_incomplete`

## 8. 検証

- [ ] `php artisan test --filter=TodoControllerTest` が全件パス
- [ ] `vendor/bin/pint --dirty --format agent` でフォーマット
- [ ] ブラウザで `/todos` の一覧・作成・編集・削除・完了トグル・バリデーションエラーの挙動を確認
- [ ] `npm run dev` または `npm run build` でTailwindスタイルが反映されていることを確認

## 対象ファイル一覧

- `database/migrations/<timestamp>_create_todos_table.php`
- `app/Models/Todo.php`
- `database/factories/TodoFactory.php`
- `app/Http/Controllers/TodoController.php`
- `routes/web.php`（追記）
- `resources/views/layouts/app.blade.php`
- `resources/views/todos/_form.blade.php`
- `resources/views/todos/create.blade.php`
- `resources/views/todos/edit.blade.php`
- `resources/views/todos/index.blade.php`
- `tests/Feature/TodoControllerTest.php`
