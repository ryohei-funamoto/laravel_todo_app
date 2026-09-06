<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
    <input type="text" id="title" name="title" value="{{ old('title', $todo->title ?? '') }}" class="w-full border border-gray-300 rounded px-3 py-2 mb-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
    @error('title')
        <p class="text-red-600 text-sm mb-2">{{ $message }}</p>
    @enderror
</div>
