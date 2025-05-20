@extends($layout ?? 'layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-900 ">Add New Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
            Back to Categories
        </a>
    </div>

    <div class="bg-white  shadow-md rounded-lg overflow-hidden p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 ">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 ">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500 ">Leave empty to auto-generate from name</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="parent_id" class="block text-sm font-medium text-gray-700 ">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                        <option value="">None (Top Level Category)</option>
                        @foreach ($parentCategories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" {{ old('parent_id') == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 ">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 ">Description</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 ">Image</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500  file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100  ">
                    <p class="mt-1 text-sm text-gray-500 ">Upload a category image (optional)</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="is_active" class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} class="rounded border-gray-300 text-pink-600 shadow-sm focus:border-pink-300 focus:ring focus:ring-pink-200 focus:ring-opacity-50  ">
                        <span class="ml-2 text-sm text-gray-700 ">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded-md hover:bg-pink-700 transition-colors">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    nameInput.addEventListener('input', function() {
        if (!slugInput.value) {
            slugInput.value = nameInput.value
                .toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });
</script>
@endpush