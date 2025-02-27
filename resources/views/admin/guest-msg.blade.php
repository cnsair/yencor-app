@extends('layouts.app-admin')

@section('content')

<div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content">
        <div class="tab-content">
            <div class="container-fluid">
                    
                <div class="card mb-3">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-settings mr-3 text-muted opacity-6"> </i>
                            Guest Messages                           
                        </div>
                    </div>
                </div>
                       
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        
                        @if (session('status') === 'success')
                            <x-success-msg>
                                {{ __('Message deleted!') }}
                            </x-success-msg>
                        @elseif (session('status') === 'error')
                            <x-failed-msg>
                                {{ __('An error occured!') }}
                            </x-failed-msg>
                        @endif

                        <div class="card mb-3">
                            <div class="card-body">
                                <table style="width: 100%;" id="example"
                                        class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Messages</th>
                                            <th>Recieved At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td>
                                                    <a class="font-weight-bold" href="{{ route('admin.guest-msg.show', ['message'=>$message->id]) }}">{{ $message->name }}</a>
                                                </td>
                                                <td>{{ $message->email }}</td>
                                                <td>{{ Str::limit($message->message, 50) }}</td>
                                                <td>{{ $message->created_at->diffForHumans() }}</td>
                                                <td>
                                                    <span class="d-flex justify-content-center gap-3">
   
                                                        <form method="POST" action="{{ route('admin.guest-msg.toggle', ['message' => $message->id]) }}" >
                                                            @csrf
                                                            @method('PUT')

                                                            @if ($message->is_read)
                                                                <button type="submit" class="btn btn-sm btn-success mr-2">
                                                                    Read
                                                                </button>
                                                            @else
                                                                <button type="submit" class="btn btn-sm btn-warning mr-2">
                                                                    Unread
                                                                </button>
                                                            @endif

                                                            @if (session('status') === 'toggled' && session('msg_id') == $message->id)
                                                                <p
                                                                    x-data="{ show: true }"
                                                                    x-show="show"
                                                                    x-transition
                                                                    x-init="setTimeout(() => show = false, 2000)"
                                                                    class="text-sm text-gray-600 dark:text-gray-400"
                                                                >
                                                                {{ __('Updated!') }}</p>
                                                            @endif
                                                        </form>

                                                        <form method="POST" action="{{ route('admin.guest-msg.destroy', ['message'=>$message->id]) }}" onsubmit="return confirm('Are you sure you want to delete this message. This action is not reversible?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash fa-xs"></i>
                                                            </button>
                                                        </form>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Messages</th>
                                            <th>Recieved At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.mini-card mb3 card -->
                        
                    
             
            </div>
        </div>
    </div>
</div>

@endsection
