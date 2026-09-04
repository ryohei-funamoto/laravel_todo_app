<div>
    <label for="title">タイトル</label>
    <input type="text" id="title" name="title" value="{{ old('title', $todo->title ?? '') }}">
    @error('title')
        <p>{{ $message }}</p>
    @enderror
</div>
