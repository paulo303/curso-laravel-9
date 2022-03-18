<div class="py-4">
    {{ $users->appends([
        'search' => request()->get('search', '')
    ])->links() }}
</div>
