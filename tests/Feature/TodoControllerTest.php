<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_index_displays_todos_ordered_newest_first(): void
    {
        $oldTodo = Todo::factory()
            ->create([
                'title' => 'oldTodo',
                'created_at' => now()->subDays(2),
            ]);
        $middleTodo = Todo::factory()
            ->create([
                'title' => 'middleTodo',
                'created_at' => now()->subDay(),
            ]);
        $newTodo = Todo::factory()
            ->create([
                'title' => 'newTodo',
                'created_at' => now(),
            ]);

        $response = $this->get(route('todos.index'));

        $todosInView = $response->viewData('todos');

        $this->assertEquals(
            [$newTodo->id, $middleTodo->id, $oldTodo->id],
            $todosInView->pluck('id')->toArray()
        );
    }

    public function test_index_displays_completed_and_incomplete_todos_together(): void
    {
        $incompleteTodo = Todo::factory()->create(['title' => 'incompleteTodo']);
        $completedTodo = Todo::factory()->completed()->create(['title' => 'completedTodo']);

        $expectedTodos = [$incompleteTodo, $completedTodo];

        $response = $this->get(route('todos.index'));

        $todosInView = $response->viewData('todos');

        foreach ($expectedTodos as $todo) {
            $this->assertContains($todo->id, $todosInView->pluck('id')->toArray());
        }

        $this->assertCount(count($expectedTodos), $todosInView->toArray());
    }

    public function test_create_page_renders_successfully(): void
    {
        $response = $this->get(route('todos.create'));

        $response->assertStatus(200);

        $response->assertViewIs('todos.create');
    }

    public function test_valid_title_creates_todo_and_redirects(): void
    {
        $response = $this->post(route('todos.store'), ['title' => 'newTodo']);

        $response->assertRedirect(route('todos.index'));

        $response->assertSessionHas('status', '登録が完了しました。');

        $this->assertDatabaseHas('todos', ['title' => 'newTodo']);
    }

    public function test_missing_title_fails_validation_on_store(): void
    {
        $response = $this->from(route('todos.create'))->post(route('todos.store'), ['title' => '']);

        $response->assertSessionHasErrors('title');

        $response->assertRedirect(route('todos.create'));

        $this->assertDatabaseCount('todos', 0);
    }

    public function test_edit_page_renders_successfully(): void
    {
        $todo = Todo::factory()->create(['title' => 'todo']);

        $response = $this->get(route('todos.edit', $todo));

        $response->assertStatus(200);

        $response->assertViewIs('todos.edit');

        $response->assertViewHas('todo', $todo);
    }

    public function test_valid_title_updates_todo_and_redirects(): void
    {
        $todo = Todo::factory()->create(['title' => 'oldTitle']);

        $response = $this->put(route('todos.update', $todo), ['title' => 'newTitle']);

        $response->assertRedirect(route('todos.index'));

        $response->assertSessionHas('status', '更新が完了しました。');

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'title' => 'newTitle']);
    }

    public function test_missing_title_fails_validation_on_update(): void
    {
        $todo = Todo::factory()->create(['title' => 'originalTitle']);

        $response = $this->from(route('todos.edit', $todo))
            ->put(route('todos.update', $todo), ['title' => '']);

        $response->assertSessionHasErrors('title');

        $response->assertRedirect(route('todos.edit', $todo));

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'title' => $todo->title]);
    }

    public function test_destroy_deletes_todo_and_redirects(): void
    {
        $todo = Todo::factory()->create(['title' => 'todo']);

        $response = $this->delete(route('todos.destroy', $todo));

        $response->assertRedirect(route('todos.index'));

        $response->assertSessionHas('status', '削除が完了しました。');

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }

    public function test_toggling_incomplete_todo_marks_it_completed(): void
    {
        $todo = Todo::factory()->create(['completed' => false]);

        $response = $this->patch(route('todos.toggle', $todo));

        $response->assertRedirect(route('todos.index'));

        $response->assertSessionHas('status', 'ステータスを更新しました。');

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'completed' => true]);
    }

    public function test_toggling_completed_todo_marks_it_incomplete(): void
    {
        $todo = Todo::factory()->completed()->create();

        $response = $this->patch(route('todos.toggle', $todo));

        $response->assertRedirect(route('todos.index'));

        $response->assertSessionHas('status', 'ステータスを更新しました。');

        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'completed' => false]);
    }
}
