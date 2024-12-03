<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\BaseServiceInterface;
use App\Http\Services\ContactServiceInterface;
use App\Mail\ReplyContact;
use App\Models\Contact;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    protected ContactServiceInterface $contactService;
    protected BaseServiceInterface $baseService;

    public function __construct(
        ContactServiceInterface $contactService,
        BaseServiceInterface $baseService
    )
    {
        $this->contactService = $contactService;
        $this->baseService = $baseService;
    }

    public function index(): View|Factory|Application
    {
        return view('admins.contact.index');
    }

    public function getList(Request $request): array
    {
        return $this->contactService->getList($request);
    }

    public function delete(Contact $contact): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $contact->delete();
            DB::commit();

            return redirect()->route('admin.contacts.index')->with('success', 'Xóa liên hệ thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.contacts.index')->with('warning', $e->getMessage());
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $this->contactService->update((int) $request->get('is_read'), (int) $id);

             return redirect()->route('admin.contact.index')->with('success', 'Cập nhật trạng thái liên hệ thành công');
        } catch (\Exception $e) {

            return redirect()->route('admin.contact.index')->with('warning', $e->getMessage());
        }
    }

    public function replyContact(Contact $id, Request $request): JsonResponse
    {
        $request->validate([
            'contact_email' => 'required|email',
            'title_mail' => 'required|max:500',
            'content_mail' => 'required|max:255',
        ]);
        DB::beginTransaction();
        try {
            Mail::to($request->get('contact_email'))->send(new ReplyContact($request->all()));
            $id->update(['is_read' => 1]);
            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'Gửi mail trả lời thành công'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'code' => 500,
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
