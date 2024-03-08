<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CardRepoInterface;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    protected CardRepoInterface $cardRepository;

    public function __construct(CardRepoInterface $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }
    public function rechargeCard(Request $request)
    {
        $data = $request->all();
        $data['customer_id'] = Auth::id();
        $this->cardRepository->store($data, Card::class);

        return redirect()->back()->with('success', 'Nạp thẻ cào thành công');
    }
}
