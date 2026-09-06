# Todoアプリ

## アプリ概要

- 単一ユーザーで利用するシンプルなTodo管理アプリ
- 認証機能なし

## 技術スタック

- バックエンド: Laravel（PHP 8.4）
- フロントエンド: Blade のみ（通常のフォーム送信＋リダイレクト。Livewire/Alpine/Inertia等は使用しない）
- データベース: SQLite
- その他: Tailwind CSS

## 主な機能

- 一覧表示（新しい順）
- 作成
- 編集
- 削除
- 完了トグル

## セットアップ手順

1. `composer install` を実行
2. `.env.example` をコピーして `.env` を作成し、`php artisan key:generate` を実行
3. `php artisan migrate` を実行
4. `npm install && npm run build`（または `npm run dev`）を実行
5. Laravel Herd を起動
6. http://todo_app.test/todos にアクセス

## テストの実行方法

- `php artisan test`

## 関連ドキュメントへのリンク

- [要件定義](docs/requirements.md)
- [実装チェックリスト](docs/implementation-checklist.md)
