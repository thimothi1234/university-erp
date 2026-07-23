@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Transactions</h1>
        
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Search by vendor name">
        </div>
        
        <div id="transactions-container">
            <!-- Records will be loaded here via AJAX -->
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var page = 1;
    var loading = false;

    function loadTransactions(page, search) {
        if (loading) {
            return;
        }

        loading = true;

        $.ajax({
            url: '/allbills',
            type: 'GET',
            data: { page: page, search: search },
            success: function(data) {
                $('#transactions-container').append(data);
                loading = false;
            }
        });
    }

    // Load transactions initially
    $(document).ready(function() {
        loadTransactions(page);
    });

    // Handle search input
    $('#search-input').on('keyup', function() {
        $('#transactions-container').empty(); // Clear existing data
        page = 1;
        loadTransactions(page, $(this).val());
    });

    // Load more on scroll
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            page++;
            loadTransactions(page, $('#search-input').val());
        }
    });
</script>
@endpush
