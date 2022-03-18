<div class="py-4">
    {{ $comments->appends([
        'search' => request()->get('search', '')
    ])->links() }}
</div>
