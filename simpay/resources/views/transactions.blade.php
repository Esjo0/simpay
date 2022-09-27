<x-guest-layout >
    <div class="container text-center">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-2 h-20 fill-current text-gray-500" style="width:200px" />
            </a>
        </x-slot>
        <h3>List of all transactions on the the system</h3>
        <div class="table-wrap">
            <table id="list_table" style="width:100%" class="table table-striped table-bordered table-hover col-12">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
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
                        <td><?=$transaction->user->name?></td>
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
    </x-auth-card>
    </div>
</x-guest-layout>
