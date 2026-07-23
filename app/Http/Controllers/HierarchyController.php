<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\project;
use App\Models\ledger;
use App\Models\Tally;
use App\Models\project_head;
use DB;

class HierarchyController extends Controller
{
    private function getFilterValues(Request $request)
    {
        return [
            'bank' => $request->get('bank', 1130),
            'from' => $request->get('from', now()->startOfMonth()->toDateString()),
            'to' => $request->get('to', now()->endOfMonth()->toDateString()),
        ];
    }

    public function index(Request $request)
    {
        extract($this->getFilterValues($request));

        $query = Ledger::select(
            'projects.name as name',
            'projects.status as status',
            'projects.sanctioned as sanctioned',
            'ledgers.costcentre as id',
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as count'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('projects', 'projects.id', '=', 'ledgers.costcentre')
        ->groupBy('ledgers.costcentre');

        if (!empty($bank)) {
            $query->where('transactions.bank', $bank);
        }

        if (!empty($from) && !empty($to)) {
            $query->whereBetween('transactiondate', [$from, $to]);
        }

        $parents = $query->get();
        $banks = DB::table('tallies')->where('group', '=', 2.1)->pluck('name', 'id');

        return view('hierarchy.index', compact('parents', 'banks', 'bank', 'from', 'to'));
    }

    public function getChildren(Request $request, $parent_id)
    {
        extract($this->getFilterValues($request));

        $query = ledger::select(
            'project_heads.head as name',
            'ledgers.sub as id',
            'ledgers.costcentre as cos',
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as count'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('project_heads', 'project_heads.id', '=', 'ledgers.sub')
        ->where('ledgers.costcentre', '=', $parent_id)
        ->groupBy('ledgers.sub');

        if (!empty($bank)) {
            $query->where('transactions.bank', $bank);
        }

        if (!empty($from) && !empty($to)) {
            $query->whereBetween('transactiondate', [$from, $to]);
        }

        return response()->json([
            'data' => $query->get(),
            'base_url' => urlencode(url(''))
        ]);
    }

    public function getGrandchildren(Request $request, $child_id, $parent_id)
{
    extract($this->getFilterValues($request));

    $payord = ledger::select('transactions.id as ff')
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->leftJoin('project_heads', 'project_heads.id', '=', 'ledgers.sub')
        ->where('transactions.voucherno_bvrno', '!=', 0);

    if ($child_id == 0) {
        $payord->where('ledgers.costcentre', '=', $parent_id);
    } else {
        $payord->where('ledgers.sub', '=', $child_id);
    }

    $arr = [];
    foreach ($payord->get() as $row) {
        $arr[] = (array) $row->ff;
    }

    $query = transactions::select(
            'transactions.drtotal as count',
            'transactions.id as id',
            'employees.name as name'
        )
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->whereIn('transactions.id', $arr)
        ->groupBy('transactions.id');

    if (!empty($bank)) {
        $query->where('transactions.bank', $bank);
    }

    if (!empty($from) && !empty($to)) {
        $query->whereBetween('transactiondate', [$from, $to]);
    }

    return response()->json([
        'data' => $query->get(),
        'base_url' => urlencode(url(''))
    ]);
}

}
