<x-app-layout>
    <div class="text-center container">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    @include('common.alert')

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Make Payment
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <form class="" method="POST" action="{{ route('make.payment') }}">
            @csrf
            <div class="modal-body">
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword2" class="sr-only">Amount</label>
                <input name="amount" type="number" class="form-control" id="" placeholder="Enter the amount"/>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Pay</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<div class="table-wrap">
    <table id="list_table" style="width:100%" class="table table-striped table-bordered table-hover col-12">
        <thead>
            <tr>
                <th>SN</th>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @php $sn=1; @endphp
            @if(isset($transactions) && !empty($transactions))
            @foreach ($transactions as $transaction)
            <tr>
                <td><?=$sn++?></td>
                <td><?=$transaction->transaction_id?></td>
                <td>&#8358;<?=number_format($transaction->amount)?></td>
                <td><span class="badge badge-secondary"><?=$status[$transaction->status]?></span></td>
                <td><?=$transaction->created_at?></td>
            </tr>
            @endforeach
            @else
            @php echo "<tr><td colspan='4' class='text-danger'><em>No results to display</em></td></tr>"; @endphp
            @endif
        </tbody>
    </table>
    </div>
</div>
</x-app-layout>
