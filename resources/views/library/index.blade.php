@extends('layouts.app')

@section('title', __('Library'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ __('Library') }}</h2>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Books') }}</h5>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="{{ __('Search') }}..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                            <option value="">{{ __('Category') }}</option>
                            <option value="reference" {{ request('category') == 'reference' ? 'selected' : '' }}>Reference</option>
                            <option value="textbook" {{ request('category') == 'textbook' ? 'selected' : '' }}>Textbook</option>
                            <option value="fiction" {{ request('category') == 'fiction' ? 'selected' : '' }}>Fiction</option>
                            <option value="journal" {{ request('category') == 'journal' ? 'selected' : '' }}>Journal</option>
                            <option value="magazine" {{ request('category') == 'magazine' ? 'selected' : '' }}>Magazine</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="available" class="form-select">
                            <option value="">{{ __('Availability') }}</option>
                            <option value="1" {{ request('available') == '1' ? 'selected' : '' }}>{{ __('Available') }}</option>
                            <option value="0" {{ request('available') == '0' ? 'selected' : '' }}>{{ __('Not Available') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">{{ __('Search') }}</button>
                    </div>
                </form>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('ISBN') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Publisher') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Available') }}</th>
                            <th>{{ __('Total') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr>
                            <td>{{ $book->isbn }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ ucfirst($book->category) }}</td>
                            <td>
                                <span class="badge bg-{{ $book->available_copies > 0 ? 'success' : 'danger' }}">
                                    {{ $book->available_copies }}
                                </span>
                            </td>
                            <td>{{ $book->total_copies }}</td>
                            <td>
                                @if($book->available_copies > 0)
                                    <form action="{{ route('library.borrow') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Borrow this book?')">
                                            <i class="bi bi-book"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">{{ __('No data found') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('My Borrowed Books') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Book') }}</th>
                            <th>{{ __('Borrow Date') }}</th>
                            <th>{{ __('Due Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($myTransactions as $transaction)
                        <tr>
                            <td>{{ $transaction->book->title ?? '-' }}</td>
                            <td>{{ $transaction->checkout_date }}</td>
                            <td>{{ $transaction->due_date }}</td>
                            <td>
                                @if($transaction->status == 'borrowed')
                                    <span class="badge bg-warning">{{ __('Borrowed') }}</span>
                                @elseif($transaction->status == 'returned')
                                    <span class="badge bg-success">{{ __('Returned') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Overdue') }}</span>
                                @endif
                            </td>
                            <td>
                                @if($transaction->status == 'borrowed')
                                    <form action="{{ route('library.return') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Return this book?')">
                                            <i class="bi bi-arrow-return-left"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No borrowed books') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('All Transactions') }}</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('Student') }}</th>
                            <th>{{ __('Book') }}</th>
                            <th>{{ __('Borrow Date') }}</th>
                            <th>{{ __('Due Date') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->student->first_name ?? '' }} {{ $transaction->student->last_name ?? '' }}</td>
                            <td>{{ $transaction->book->title ?? '-' }}</td>
                            <td>{{ $transaction->checkout_date }}</td>
                            <td>{{ $transaction->due_date }}</td>
                            <td>
                                @if($transaction->status == 'borrowed')
                                    <span class="badge bg-warning">{{ __('Borrowed') }}</span>
                                @elseif($transaction->status == 'returned')
                                    <span class="badge bg-success">{{ __('Returned') }}</span>
                                @else
                                    <span class="badge bg-danger">{{ __('Overdue') }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">{{ __('No transactions') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
